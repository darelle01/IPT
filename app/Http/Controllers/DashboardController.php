<?php

namespace App\Http\Controllers;

use App\Repositories\TwoTables;
use App\Repositories\PieChartTables;
use App\Repositories\ListOfAllConsultation;

class DashboardController extends Controller
{
    protected $CurrentHighestConsul;
    protected $CurrentTopConsulPastRecord;
    protected $CurrentLowestConsul;
    protected $CurrentBottomConsulPastRecord;
    protected $charts;
    protected $all;
    protected $showAllConsultation;
    protected $sumOfAll;
    protected $totalPerMonth;

    
 

    public function __construct(TwoTables $CurrentHighestConsul, TwoTables $CurrentTopConsulPastRecord, TwoTables $CurrentLowestConsul, TwoTables $CurrentBottomConsulPastRecord, PieChartTables $PieCharts, TwoTables $all, ListOfAllConsultation $showAllConsultation, TwoTables $sumOfAll, TwoTables $totalPerMonth)
    {
        $this->CurrentHighestConsul = $CurrentHighestConsul;
        $this->CurrentTopConsulPastRecord = $CurrentTopConsulPastRecord;
        $this->CurrentLowestConsul = $CurrentLowestConsul;
        $this->CurrentBottomConsulPastRecord = $CurrentBottomConsulPastRecord;
        $this->charts = $PieCharts;
        $this->showAllConsultation = $showAllConsultation;
        $this->all = $all;
        $this->sumOfAll = $sumOfAll;
        $this->totalPerMonth = $totalPerMonth;
  
        
    }

    public function ShowDashboard()
    {

        // Get highest consultation ------------------------------------------------------------------------------------------------------------------
        $CurrentTopConsul = $this->CurrentHighestConsul->GetThisMonthHighestConsultation();

        // Get the Current Highest Consultation Past Record ------------------------------------------------------------------------------------------------------------------
        $PastRecordOfTheCurrentTop = $this->CurrentTopConsulPastRecord->GetPastRecordOfCurrentHighestConsultation();
    
        // Get lowest consultation
        $CurrentBottomConsul = $this->CurrentLowestConsul->GetThisMonthLowestConsultation();

        // Get the Current Lowest Consultation Past Record ------------------------------------------------------------------------------------------------------------------
        $PastRecordOfTheCurrentBottom = $this->CurrentBottomConsulPastRecord->GetPastRecordOfCurrentLowestConsultation();

        // Get Pie Chart data ------------------------------------------------------------------------------------------------------------------
        $PieCharts = $this->charts->RespoPieChart();

        // Display Table of Consultation From Highest to Lowest ------------------------------------------------------------------------------------------------------------------
        $ShowAllConsultation = $this->showAllConsultation->AllConsultations();

        // Get the Total Number Of Patient ------------------------------------------------------------------------------------------------------------------
        $TotalCount = $this->all->ThisMonthPatientTotal();

        // Get the Total of all Consultation record ------------------------------------------------------------------------------------------------------------------
        $FinalSumOfAll = $this->sumOfAll->TotalOfAllConsultation();
       
        // Compute the difference form past and current
        if (is_object($CurrentTopConsul) && isset($CurrentTopConsul->HighestToLowest)) {
            if ($PastRecordOfTheCurrentTop > 0) {
                $TopDifference = (($CurrentTopConsul->HighestToLowest - $PastRecordOfTheCurrentTop) / $PastRecordOfTheCurrentTop) * 100;
            } 
            else {
                $TopDifference = $CurrentTopConsul->HighestToLowest * 100;
            }
        } else {
            // Handle the case where $CurrentTopConsul is not an object or property doesn't exist
            $TopDifference = 'N/A'; // or another fallback value
        }
        
        if (is_object($CurrentBottomConsul) && isset($CurrentBottomConsul->LowestToHighest)) {
            if ($PastRecordOfTheCurrentBottom > 0) {
                $BotDifference = (($CurrentBottomConsul->LowestToHighest - $PastRecordOfTheCurrentBottom) / $PastRecordOfTheCurrentBottom) * 100;
            } else {
                $BotDifference = $CurrentBottomConsul->LowestToHighest * 100;
            }
        } else {
            // Handle the case where $CurrentBottomConsul is not an object or property doesn't exist
            $BotDifference = 'N/A'; // or another fallback value
        }

        // Total per Month
        $OverAllPerMonth = $this->totalPerMonth->TotalForEveryMonth();


        return view('AdminPages.RHUDashboard', [
            // Highest Consultation and its Total Area -------------------------------------------------------------------------------------------------
            'ThisMonthTopConsultation' => $CurrentTopConsul->Consultation ?? 'N/A',
            'ThisMonthBiggestNumberOfPatient' => $CurrentTopConsul->HighestToLowest ?? 0,
            // Lowest Consultation and its Total Area -------------------------------------------------------------------------------------------------
            'ThisMonthBottomConsultation' => $CurrentBottomConsul->Consultation ?? 'N/A',
            'ThisMonthLowestNumberOfPatient' => $CurrentBottomConsul->LowestToHighest ?? 0,

            // Pie Chart Data -------------------------------------------------------------------------------------------------------------
            'PieCharts' => $PieCharts,
            // Display Table of Consultation From Highest to Lowest --------------------------------------------------------------------------------------------------------------
            'DisplayAllConsultation' => $ShowAllConsultation,
            // Total Number Of Patient -------------------------------------------------------------------------------------------------------------
            'FinalCountThisMonth' => $TotalCount,
            // Final Count of combined consultation -------------------------------------------------------------------------------------------------------------
            'FinalSum' => $FinalSumOfAll,
            // Get the Current Highest Consultation Past Record ------------------------------------------------------------------------------------------------------------------
            'ValueOfPastRecordOfCurrentTopConsul' => $PastRecordOfTheCurrentTop,
           // Get the Current Lowest Consultation Past Record ------------------------------------------------------------------------------------------------------------------
           'ValueOfPastRecordOfCurrentBottomConsul' => $PastRecordOfTheCurrentBottom,
           
            // Compute the difference form past and current
           'TopDifference' => $TopDifference,
           'BotDifference' => $BotDifference,

           'OverAllPerMonth' => $OverAllPerMonth
        ]);
    }
}
