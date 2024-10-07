<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class PastRecord
{

    // public function PreviousData()
    // {
    //     $PrevData = DB::table('patientrecord')
    //         ->join('patientmedicallog', function (JoinClause $join) {
    //             $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
    //         })
    //         ->select('patientmedicallog.Consultation', DB::raw('count(distinct patientmedicallog.PatientNumber) as PastCount'),
    //         DB::raw('max(patientmedicallog.DateOfConsultation) as LatestDate'))

    //         ->whereMonth('patientmedicallog.DateOfConsultation', now()->subMonths(1)->month)
    //         ->groupBy('patientmedicallog.Consultation')
    //         ->orderBy('PastCount', 'desc')
    //         ->orderBy('LatestDate', 'desc')
    //         ->first();
    //     return $PrevData;
    // }  
    //     public function PreviousDataNumber()
    //     {
    //         $PreDataCount = DB::table('patientrecord')
    //             ->join('patientmedicallog', function (JoinClause $join) {
    //                 $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
    //             })
    //             ->select('patientmedicallog.Consultation', DB::raw('count(distinct patientmedicallog.PatientNumber) as PastCount'),
    //             DB::raw('max(patientmedicallog.DateOfConsultation) as LatestDate'))
    
    //             ->whereMonth('patientmedicallog.DateOfConsultation', now()->subMonths(1)->month)
    //             ->groupBy('patientmedicallog.Consultation')
    //             ->orderBy('PastCount', 'desc')
    //             ->orderBy('LatestDate', 'desc')
    //             ->first();
    //             return $PreDataCount;        
    //     }
        // public function PreviousMonthPatientTotal() 
        // {
            
        //     return DB::table('patientrecord')
        //         ->join('patientmedicallog', function (JoinClause $join) {
        //             $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
        //         })    
        //         ->select(DB::raw('patientmedicallog.DateOfConsultation, count(patientmedicallog.PatientNumber) as PreviousMonthTotalPatientCount'))
        //         ->whereMonth('patientmedicallog.DateOfConsultation', now()->subMonths(1)->month) 
        //         ->groupBy('patientmedicallog.DateOfConsultation')
        //         ->get();
        // }
        // public function PreviousMonthTotalOfAllConsultation() 
        // {
        //     $InitialConsult = $this->PreviousMonthPatientTotal();
        //     $PreviousFinalConsultationSum = 0; 
        
        //     foreach ($InitialConsult as $consultation) {
        //         $PreviousFinalConsultationSum += $consultation->PreviousMonthTotalPatientCount; 
        //     }
        //     return $PreviousFinalConsultationSum;
        // }
    
}