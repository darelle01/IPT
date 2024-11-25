@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
        
    {{-- Script for Google Pie Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Consultation', 'HighestToLowest'],
            @foreach($PieCharts as $pieChart)
                ['{{ $pieChart->Consultation }}', {{ $pieChart->HighestToLowest }}],
            @endforeach
        ]);
        var options = {
        is3D: true,
        backgroundColor: { fill: 'transparent' },
        legend: 'none',
        pieStartAngle: 90,
        chartArea: { left: '5%', top: '0', width: '90%', height: '80%'},
        titleTextStyle: { color: 'black', fontName: 'Arial', fontSize: 18, italic: true, bold: true}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>{{-- Script for Google Pie Chart --}}
    {{-- Script for Google   Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Total Patients'],
          @foreach($OverAllPerMonth as $record)
            ['{{ date("F", mktime(0, 0, 0, $record->month, 10)) }}', {{ $record->TotalPerMonth }}],
          @endforeach
        ]);

        var options = {
          title : 'Total of combine number of every Consultations',
          vAxis: {title: 'Patients'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}},
          chartArea: { left: '6%', top: '30%', width: '100%', height: '50%'},
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>{{-- Script for Google   Chart --}}
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/Dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/FirstArea.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/SecondArea.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/ThirdArea.css') }}">

    <x-slot name="Title">
        Dashboard
    </x-slot>
    

    {{-- Dashboard Area --}}
    <div class="DashBoardArea">
        <div class="DashboardTitle">
            <h3 class="title">Dashboard</h3>
        </div>
        {{-- First Area --}}
        <div class="FirstArea">

            {{-- Total Patient Count For this Month --}}
            <div class="ThisMonthPatientCount">
                <div class="ThisMonthPatientCountUpperLabel">
                    <span class="ThisMonth">This month</span>
                </div>
                <div class="ThisMonthPatientCountVal">
                    <span class="FinalCountThisMonth">{{$FinalCountThisMonth}}</span>
                </div>
                <div class="ThisMonthPatientCountLowerLabel">
                    <span class="Totalnumber">Total number of Patient</span>
                </div>
            </div>{{-- Total Patient Count For this Month --}}

            {{-- Pie Chart of this Month Label--}}
            <div class="PieChartLabelArea">
                <div class="PieChartLabel">
                    <span class="ThisMonthPieChart">
                        This Month PieChart
                    </span>
                    <span id="Month"></span>
                    <span id="Year"></span>
                </div>
            </div>{{-- Pie Chart of this Month Label--}}
            
            {{-- Pie Chart Figure Area --}}
            <div class="PieChartFigure">
                <div id="piechart_3d" style="width: 350px; height: 350px;"></div>
            </div>{{-- Pie Chart Figure Area --}}

            {{-- Highest Consultation --}}
            <div class="HighestConsultationArea">
                <div class="HighestConsultationLabel1">
                    <span class="HighestConsultation">Current Highest</span>
                </div>  

                <div class="HighestConsultationValue">
                    <span class="HighestConsultation">
                        {{$ThisMonthTopConsultation}}
                    </span>
                    <span class="HighestConsultationPercentage">
                        Patient: {{ $ThisMonthBiggestNumberOfPatient }}
                    </span>
                </div>

                <div class="HighestConsultationLabel2">      
                    @if($ThisMonthBiggestNumberOfPatient > $ValueOfPastRecordOfCurrentTopConsul)
                        <span class="">
                            There is a {{number_format(abs($TopDifference),2)}}% 
                            <i class="fa-solid fa-up-long"></i>
                        </span> 
                        <span class="">
                            increase in Patients
                        </span>
                    @elseif ($ThisMonthBiggestNumberOfPatient < $ValueOfPastRecordOfCurrentTopConsul)
                    <span class="">
                        There is a {{number_format(abs($TopDifference),2)}}% 
                        <i class="fa-solid fa-down-long"></i>
                    </span> 
                    <span class="">
                        decrease in Patients
                    </span>
                    @else
                    <span class="">
                        There is no increase or decrease
                    </span>
                    <span class="">
                        in Patients
                    </span>
                    @endif
                </div>
            </div>{{-- Highest Consultation --}}

            {{-- Lowest Consultation --}}
            <div class="LowestConsultationArea">
                <div class="LowestConsultationLabel1">
                    <span class="LowestConsultation">Current Lowest</span>
                </div>
                <div class="LowestConsultationValue">
                    <span class="LowestConsultation">
                        {{$ThisMonthBottomConsultation}}
                        
                    </span>
                    <span class="LowestConsultationPercentage">
                        Patient: {{$ThisMonthLowestNumberOfPatient}}
                    </span>
                </div>

                <div class="LowestConsultationLabel2">
                    @if($ThisMonthLowestNumberOfPatient > $ValueOfPastRecordOfCurrentBottomConsul)
                    <span class="">
                        There is a {{number_format(abs($BotDifference),2)}}% 
                        <i class="fa-solid fa-up-long"></i>
                    </span> 
                    <span class="">
                        increase in Patients
                    </span>
                    @elseif ($ThisMonthLowestNumberOfPatient < $ValueOfPastRecordOfCurrentBottomConsul)
                    <span class="">
                    There is a {{number_format(abs($BotDifference),2)}}% 
                    <i class="fa-solid fa-down-long"></i>
                    </span> 
                    <span class="">
                    decrease in Patients
                    </span>
                    @else
                    <span class="">
                        There is no increase or decrease
                    </span>
                    <span class="">
                        in Patients
                    </span>
                    @endif
                </div>
            </div>{{-- Lowest Consultation --}}            

        </div>{{-- First Area --}}
        {{-- Second Area --}}
        <div class="SecondArea">
            {{-- Table Of Consultation Area --}}
            <div class="TableOfConsultation">
                <table class="ConsultationTable">
                    <tr>
                        <th class="Consultation">Consultation</th>
                        <th class="TotalNumberPatient">Total Number of Patient</th>
                        <th class="Percentage">Percentage</th>
                        <th class="Male">Male</th>
                        <th class="SeniorMale">Senior Male</th>
                        <th class="AdultMale">Adult Male</th>
                        <th class="TeenMale">Teen Male</th>
                        <th class="ChildMale">Child Male</th>
                        <th class="Female">Female</th>
                        <th class="SeniorFemale">Senior Female</th>
                        <th class="AdultFemale">Adult Female</th>
                        <th class="TeenFemale">Teen Female</th>
                        <th class="ChildFemale">Child Female</th>
                    </tr>
                    @foreach ($DisplayAllConsultation as $AllConsultationValue)
                    <tr>
                        <td class="ConsultationVal">{{$AllConsultationValue->Consultation}}</td>
                        <td class="TotalNumberPatientVal">{{$AllConsultationValue->TotalConsultations}}</td>
                        {{-- Percentage --}}
                        <td class="PercentageVal">
                            @if($FinalSum > 0)
                            {{ number_format(($AllConsultationValue->TotalConsultations / $FinalSum) * 100, 2) }}%
                            @else
                            0%
                            @endif
                        </td>
                        {{-- Male --}}
                        <td class="MaleVal">{{$AllConsultationValue->MaleConsultations}}</td>
                        <td class="SeniorMaleVal">{{$AllConsultationValue->MaleSenior}}</td>
                        <td class="AdultMaleVal">{{$AllConsultationValue->MaleAdult}}</td>
                        <td class="TeenMaleVal">{{$AllConsultationValue->MaleTeen}}</td>
                        <td class="ChildMaleVal">{{$AllConsultationValue->MaleChild}}</td>
                        {{-- Female --}}
                        <td class="FemaleVal">{{$AllConsultationValue->FemaleConsultations}}</td>
                        <td class="SeniorFemaleVal">{{$AllConsultationValue->FemaleSenior}}</td>
                        <td class="AdultFemaleVal">{{$AllConsultationValue->FemaleAdult}}</td>
                        <td class="TeenFemaleVal">{{$AllConsultationValue->FemaleTeen}}</td>
                        <td class="ChildFemaleVal">{{$AllConsultationValue->FemaleChild}}</td>
                    </tr>
                @endforeach
                </table>
            </div>{{-- Table Of Consultation Area --}} 

        </div>{{-- Second Area --}}
        {{-- Third Area --}}
        <div class="ThirdArea">
            <div class="GraphArea">
                <div id="chart_div" style="width: 1600px; height: fit-content; border-radius: 15px; overflow: hidden;"></div>
            </div>
        </div>{{-- Third Area --}}
    </div> {{-- Dashboard Area --}} 
    {{-- Script --}}
    <script src="{{asset('/javascript/Date.js')}}" ></script>
</x-AdminNavigation>

@else
    <x-StaffNavigation>
            {{-- Script for Google Pie Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Consultation', 'HighestToLowest'],
            @foreach($PieCharts as $pieChart)
                ['{{ $pieChart->Consultation }}', {{ $pieChart->HighestToLowest }}],
            @endforeach
        ]);
        var options = {
        is3D: true,
        backgroundColor: { fill: 'transparent' },
        legend: 'none',
        pieStartAngle: 90,
        chartArea: { left: '5%', top: '0', width: '90%', height: '80%'},
        titleTextStyle: { color: 'black', fontName: 'Arial', fontSize: 18, italic: true, bold: true}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>{{-- Script for Google Pie Chart --}}
    {{-- Script for Google   Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Total Patients'],
          @foreach($OverAllPerMonth as $record)
            ['{{ date("F", mktime(0, 0, 0, $record->month, 10)) }}', {{ $record->TotalPerMonth }}],
          @endforeach
        ]);

        var options = {
          title : 'Total of combine number of every Consultations',
          vAxis: {title: 'Patients'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}},
          chartArea: { left: '6%', top: '30%', width: '100%', height: '50%'},
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>{{-- Script for Google   Chart --}}
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/Dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/FirstArea.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/SecondArea.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/ThirdArea.css') }}">

    <x-slot name="Title">
        Dashboard
    </x-slot>
    

    {{-- Dashboard Area --}}
    <div class="DashBoardArea">
        <div class="DashboardTitle">
            <h3 class="title">Dashboard</h3>
        </div>
        {{-- First Area --}}
        <div class="FirstArea">

            {{-- Total Patient Count For this Month --}}
            <div class="ThisMonthPatientCount">
                <div class="ThisMonthPatientCountUpperLabel">
                    <span class="ThisMonth">This month</span>
                </div>
                <div class="ThisMonthPatientCountVal">
                    <span class="FinalCountThisMonth">{{$FinalCountThisMonth}}</span>
                </div>
                <div class="ThisMonthPatientCountLowerLabel">
                    <span class="Totalnumber">Total number of Patient</span>
                </div>
            </div>{{-- Total Patient Count For this Month --}}

            {{-- Pie Chart of this Month Label--}}
            <div class="PieChartLabelArea">
                <div class="PieChartLabel">
                    <span class="ThisMonthPieChart">
                        This Month PieChart
                    </span>
                    <span id="Month"></span>
                    <span id="Year"></span>
                </div>
            </div>{{-- Pie Chart of this Month Label--}}
            
            {{-- Pie Chart Figure Area --}}
            <div class="PieChartFigure">
                <div id="piechart_3d" style="width: 350px; height: 350px;"></div>
            </div>{{-- Pie Chart Figure Area --}}

            {{-- Highest Consultation --}}
            <div class="HighestConsultationArea">
                <div class="HighestConsultationLabel1">
                    <span class="HighestConsultation">Current Highest</span>
                </div>  

                <div class="HighestConsultationValue">
                    <span class="HighestConsultation">
                        {{$ThisMonthTopConsultation}}
                    </span>
                    <span class="HighestConsultationPercentage">
                        Patient: {{ $ThisMonthBiggestNumberOfPatient }}
                    </span>
                </div>

                <div class="HighestConsultationLabel2">      
                    @if($ThisMonthBiggestNumberOfPatient > $ValueOfPastRecordOfCurrentTopConsul)
                        <span class="">
                            There is a {{number_format(abs($TopDifference),2)}}% 
                            <i class="fa-solid fa-up-long"></i>
                        </span> 
                        <span class="">
                            increase in Patients
                        </span>
                    @elseif ($ThisMonthBiggestNumberOfPatient < $ValueOfPastRecordOfCurrentTopConsul)
                    <span class="">
                        There is a {{number_format(abs($TopDifference),2)}}% 
                        <i class="fa-solid fa-down-long"></i>
                    </span> 
                    <span class="">
                        decrease in Patients
                    </span>
                    @else
                    <span class="">
                        There is no increase or decrease
                    </span>
                    <span class="">
                        in Patients
                    </span>
                    @endif
                </div>
            </div>{{-- Highest Consultation --}}

            {{-- Lowest Consultation --}}
            <div class="LowestConsultationArea">
                <div class="LowestConsultationLabel1">
                    <span class="LowestConsultation">Current Lowest</span>
                </div>
                <div class="LowestConsultationValue">
                    <span class="LowestConsultation">
                        {{$ThisMonthBottomConsultation}}
                        
                    </span>
                    <span class="LowestConsultationPercentage">
                        Patient: {{$ThisMonthLowestNumberOfPatient}}
                    </span>
                </div>

                <div class="LowestConsultationLabel2">
                    @if($ThisMonthLowestNumberOfPatient > $ValueOfPastRecordOfCurrentBottomConsul)
                    <span class="">
                        There is a {{number_format(abs($BotDifference),2)}}% 
                        <i class="fa-solid fa-up-long"></i>
                    </span> 
                    <span class="">
                        increase in Patients
                    </span>
                    @elseif ($ThisMonthLowestNumberOfPatient < $ValueOfPastRecordOfCurrentBottomConsul)
                    <span class="">
                    There is a {{number_format(abs($BotDifference),2)}}% 
                    <i class="fa-solid fa-down-long"></i>
                    </span> 
                    <span class="">
                    decrease in Patients
                    </span>
                    @else
                    <span class="">
                        There is no increase or decrease
                    </span>
                    <span class="">
                        in Patients
                    </span>
                    @endif
                </div>
            </div>{{-- Lowest Consultation --}}            

        </div>{{-- First Area --}}
        {{-- Second Area --}}
        <div class="SecondArea">
            {{-- Table Of Consultation Area --}}
            <div class="TableOfConsultation">
                <table class="ConsultationTable">
                    <tr>
                        <th class="Consultation">Consultation</th>
                        <th class="TotalNumberPatient">Total Number of Patient</th>
                        <th class="Percentage">Percentage</th>
                        <th class="Male">Male</th>
                        <th class="SeniorMale">Senior Male</th>
                        <th class="AdultMale">Adult Male</th>
                        <th class="TeenMale">Teen Male</th>
                        <th class="ChildMale">Child Male</th>
                        <th class="Female">Female</th>
                        <th class="SeniorFemale">Senior Female</th>
                        <th class="AdultFemale">Adult Female</th>
                        <th class="TeenFemale">Teen Female</th>
                        <th class="ChildFemale">Child Female</th>
                    </tr>
                    @foreach ($DisplayAllConsultation as $AllConsultationValue)
                    <tr>
                        <td class="ConsultationVal">{{$AllConsultationValue->Consultation}}</td>
                        <td class="TotalNumberPatientVal">{{$AllConsultationValue->TotalConsultations}}</td>
                        {{-- Percentage --}}
                        <td class="PercentageVal">
                            @if($FinalSum > 0)
                            {{ number_format(($AllConsultationValue->TotalConsultations / $FinalSum) * 100, 2) }}%
                            @else
                            0%
                            @endif
                        </td>
                        {{-- Male --}}
                        <td class="MaleVal">{{$AllConsultationValue->MaleConsultations}}</td>
                        <td class="SeniorMaleVal">{{$AllConsultationValue->MaleSenior}}</td>
                        <td class="AdultMaleVal">{{$AllConsultationValue->MaleAdult}}</td>
                        <td class="TeenMaleVal">{{$AllConsultationValue->MaleTeen}}</td>
                        <td class="ChildMaleVal">{{$AllConsultationValue->MaleChild}}</td>
                        {{-- Female --}}
                        <td class="FemaleVal">{{$AllConsultationValue->FemaleConsultations}}</td>
                        <td class="SeniorFemaleVal">{{$AllConsultationValue->FemaleSenior}}</td>
                        <td class="AdultFemaleVal">{{$AllConsultationValue->FemaleAdult}}</td>
                        <td class="TeenFemaleVal">{{$AllConsultationValue->FemaleTeen}}</td>
                        <td class="ChildFemaleVal">{{$AllConsultationValue->FemaleChild}}</td>
                    </tr>
                @endforeach
                </table>
            </div>{{-- Table Of Consultation Area --}} 

        </div>{{-- Second Area --}}
        {{-- Third Area --}}
        <div class="ThirdArea">
            <div class="GraphArea">
                <div id="chart_div" style="width: 1600px; height: fit-content; border-radius: 15px; overflow: hidden;"></div>
            </div>
        </div>{{-- Third Area --}}
    </div> {{-- Dashboard Area --}} 
    {{-- Script --}}
    <script src="{{asset('/javascript/Date.js')}}" ></script>
    </x-StaffNavigation>
@endif

    