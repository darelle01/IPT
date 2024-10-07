<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class PieChartTables
{
    public function RespoPieChart()
    {
        $PieChartTable = DB::table('patientrecord')
        ->join('patientmedicallog', function (JoinClause $join) {
            $join->on('patientrecord.PatientID', '=', 'patientmedicallog.PatientNumber');
        })
        ->select('patientmedicallog.Consultation', DB::raw('count(distinct patientmedicallog.PatientNumber) as HighestToLowest'))
        ->whereYear('patientmedicallog.DateOfConsultation', date('Y'))
        ->whereMonth('patientmedicallog.DateOfConsultation', date('m'))
        ->groupBy('patientmedicallog.Consultation')
        ->get();
        return $PieChartTable;
    }
} 