<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class TwoTables
{
    // Highest Consultation ---------------------------------------------------------------------------------------------------------
    public function GetThisMonthHighestConsultation()
    {
        $ThisMonthHighestConsultation = DB::table('patientrecord')
            ->join('patientmedicallog', function (JoinClause $join) {
                $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
            })
            ->select('patientmedicallog.Consultation', 
            DB::raw('count(distinct patientmedicallog.PatientNumber) as HighestToLowest'),
            DB::raw('max(patientmedicallog.DateOfConsultation) as LatestDate'))

            ->whereYear('patientmedicallog.DateOfConsultation', date('Y'))
            ->whereMonth('patientmedicallog.DateOfConsultation', date('m'))
            ->groupBy('patientmedicallog.Consultation')
            ->orderBy('HighestToLowest', 'desc')
            ->orderBy('LatestDate', 'desc')
            ->first();
        
        return $ThisMonthHighestConsultation ?? 0;
    }   
    //  Lowest Consultation ----------------------------------------------------------------------------------------------------------
    public function GetThisMonthLowestConsultation() 
    {
            $ThisMonthLowestConsultation = DB::table('patientrecord')
            ->join('patientmedicallog', function (JoinClause $join) {
                $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
            })
            ->select('patientmedicallog.Consultation', 
            DB::raw('count(distinct patientmedicallog.PatientNumber) as LowestToHighest'),
            DB::raw('max(patientmedicallog.DateOfConsultation) as LatestDate'))

            ->whereYear('patientmedicallog.DateOfConsultation', date('Y'))
            ->whereMonth('patientmedicallog.DateOfConsultation', date('m'))
            ->groupBy('patientmedicallog.Consultation')
            ->orderBy('LowestToHighest', 'asc')
            ->orderBy('LatestDate', 'asc')
            ->first();
    
        return $ThisMonthLowestConsultation ?? 0;
    } 

    // Total number of patient in current month ----------------------------------------------------------------------------------------------------------
    public function ThisMonthPatientTotal() 
    {   
        return DB::table('patientrecord')
            ->join('patientmedicallog', function (JoinClause $join) {
                $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
            })    
            ->select(DB::raw('count(distinct patientmedicallog.PatientNumber) as ThisMonthTotalPatientCount'))
            ->whereYear('patientmedicallog.DateOfConsultation', date('Y')) 
            ->whereMonth('patientmedicallog.DateOfConsultation', date('m'))   
            ->value('ThisMonthTotalPatientCount'); 
    }
    
    public function ThisMonthPatientTotalSecond() 
        {          
            return DB::table('patientrecord')
                ->join('patientmedicallog', function (JoinClause $join) {
                    $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
                })    
                ->select(DB::raw('patientmedicallog.DateOfConsultation, count(patientmedicallog.PatientNumber) as ThisMonthTotalPatientCount'))
                ->whereYear('patientmedicallog.DateOfConsultation', date('Y')) 
                ->whereMonth('patientmedicallog.DateOfConsultation', date('m'))   
                ->groupBy('patientmedicallog.DateOfConsultation')
                ->get();
        }
    // Sum of all Consultation ----------------------------------------------------------------------------------------------------------

    public function TotalOfAllConsultation() 
        {
            $InitialConsult = $this->ThisMonthPatientTotalSecond();
            $FinalConsultationSum = 0; 
        
            foreach ($InitialConsult as $consultation) {
                $FinalConsultationSum += $consultation->ThisMonthTotalPatientCount; 
            }
            return $FinalConsultationSum;
        }

        // Get the Past Record of the Current Highest Consultation
        public function GetPastRecordOfCurrentHighestConsultation()
        {
            $ThisMonthHighestConsultation = $this->GetThisMonthHighestConsultation();
            $FindConsultationTopPast = $ThisMonthHighestConsultation->Consultation ?? 'N/A';

            $findHighest = DB::table('patientrecord')
            ->join('patientmedicallog', function (JoinClause $join) {
                $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
            })
            ->where('patientmedicallog.Consultation', '=', $FindConsultationTopPast)
            ->whereMonth('patientmedicallog.DateOfConsultation', now()->subMonths(1)->month)
            ->count(DB::raw('distinct patientmedicallog.PatientNumber'));

            return $findHighest;
        }
        // Get the Past Record of the Current Lowest Consultation
        public function GetPastRecordOfCurrentLowestConsultation()
        {
            $ThisMonthLowestConsultation = $this->GetThisMonthLowestConsultation();
            $FindConsultationBotPast = $ThisMonthLowestConsultation->Consultation ?? 'N/A';
        
            $last_Month = now()->subMonths(1)->month;
        
            $findLowest = DB::table('patientrecord')
                ->join('patientmedicallog', function (JoinClause $join) {
                    $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
                })
                ->whereMonth('patientmedicallog.DateOfConsultation', $last_Month) 
                ->where('patientmedicallog.Consultation', $FindConsultationBotPast) 
                ->distinct('patientmedicallog.PatientNumber')
                ->count();
        
            return $findLowest;
        }
        // Total for everymonth
        public function TotalForEveryMonth()
        {
            return DB::table('patientrecord')
                    ->join('patientmedicallog', function(JoinClause $join){
                        $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
                    })
                    ->select(DB::raw('Month(DateOfConsultation) as month, count(patientrecord.PatientID) as TotalPerMonth'))    
                    ->groupBy(DB::raw('month(DateOfConsultation)'))
                    ->get();
        }

}
