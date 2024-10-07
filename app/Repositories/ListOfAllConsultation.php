<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
class ListOfAllConsultation
{
    public function AllConsultations()
{
    $ShowAllConsultation = DB::table('patientrecord')
        ->join('patientmedicallog', function (JoinClause $join) {
            $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
        })
        ->select(
            'patientmedicallog.Consultation',
            DB::raw('count(distinct patientmedicallog.PatientNumber) as TotalConsultations'),
            // Male ---------------------------------------------------------------------------------------------------------------------------
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Male' THEN patientmedicallog.PatientNumber END) as MaleConsultations"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Male' AND patientrecord.Age BETWEEN 60 AND 120 THEN patientmedicallog.PatientNumber END) as MaleSenior"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Male' AND patientrecord.Age BETWEEN 20 AND 59 THEN patientmedicallog.PatientNumber END) as MaleAdult"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Male' AND patientrecord.Age BETWEEN 13 AND 19 THEN patientmedicallog.PatientNumber END) as MaleTeen"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Male' AND patientrecord.Age BETWEEN 1 AND 12 THEN patientmedicallog.PatientNumber END) as MaleChild"),
            // Female ---------------------------------------------------------------------------------------------------------------------------
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Female' THEN patientmedicallog.PatientNumber END) as FemaleConsultations"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Female' AND patientrecord.Age BETWEEN 60 AND 120 THEN patientmedicallog.PatientNumber END) as FemaleSenior"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Female' AND patientrecord.Age BETWEEN 20 AND 59 THEN patientmedicallog.PatientNumber END) as FemaleAdult"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Female' AND patientrecord.Age BETWEEN 13 AND 19 THEN patientmedicallog.PatientNumber END) as FemaleTeen"),
            DB::raw("count(distinct CASE WHEN patientrecord.Gender = 'Female' AND patientrecord.Age BETWEEN 1 AND 12 THEN patientmedicallog.PatientNumber END) as FemaleChild"),
            
        )
        ->whereYear('patientmedicallog.DateOfConsultation', date('Y'))
        ->whereMonth('patientmedicallog.DateOfConsultation', date('m'))
        ->groupBy('patientmedicallog.Consultation')
        ->orderBy('TotalConsultations', 'desc')
        ->orderBy('patientmedicallog.DateOfConsultation', 'desc')
        ->get();
    
    return $ShowAllConsultation;
}

    
}
