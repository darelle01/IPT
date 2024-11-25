@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminSearchResult.css')}}">
    <x-slot:Title>
        Search Result
    </x-slot:Title>

    <form action="{{route('Admin.FullView')}}" method="GET" class="SearchResultTable">

        {{-- Search Result Title Area --}}
        <div class="SearchResultTitleArea">
            <h3>Search Result</h3>
        </div>{{-- Search Result Title Area --}}
        {{-- Result Table Area --}}
        <div class="ResultTableArea">
            <table class="Result">
                    <tr>
                        <th class="tbPatientID">PatientID</th>
                        <th class="tbLastName">LastName</th>
                        <th class="tbFirstName">FirstName</th>
                        <th class="tbMiddleName">MiddleName</th>
                        <th class="tbAge">Age</th>
                        <th class="tbGender">Gender</th>
                        <th class="tbContact">Contact Number</th>
                        <th class="tbAddress">Address</th>
                        <th class="tbAction">Action</th>
                    </tr>

                    @if(isset($patientsBasicInfo['message']))
                        <tr class="trMessege">
                            <td class="tbMessege">{{ $patientsBasicInfo['message'] }}</td>
                        </tr>
                    @else
                        @foreach($patientsBasicInfo as $patient)
                            <tr>
                               
                                <td class="tbPatientID">{{ $patient->PatientID }}</td>
                                <td class="tbLastName">{{ $patient->LastName }}</td>
                                <td class="tbFirstName">{{ $patient->FirstName }}</td>
                                <td class="tbMiddleName">{{ $patient->MiddleName }}</td>
                                <td class="tbAge">{{ $patient->Age }}</td>
                                <td class="tbGender">{{ $patient->Gender }}</td>
                                <td class="tbContact">+{{ $patient->ContactNumber }}</td>
                                <td class="tbAddress">{{ $patient->HouseNumber }}, {{ $patient->Street }}, {{ $patient->Barangay }}, {{ $patient->Municipality }}, {{ $patient->Province }}</td>
                                <td class="tbAction">
                                    @csrf
                                    <button type="submit" name="Seemore" class="Seemore bg-primary" value="{{ $patient->PatientID }}">See More...</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif

            </table>
        </div>
        {{-- Result Table Area --}}



    </form>

</x-AdminNavigation>
@else
    <x-StaffNavigation>
        {{-- Css --}}
        <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminSearchResult.css')}}">
        <x-slot:Title>
            Search Result
        </x-slot:Title>

        <form action="{{route('Admin.FullView')}}" method="GET" class="SearchResultTable">

            {{-- Search Result Title Area --}}
            <div class="SearchResultTitleArea">
                <h3>Search Result</h3>
            </div>{{-- Search Result Title Area --}}
            {{-- Result Table Area --}}
            <div class="ResultTableArea">
                <table class="Result">
                        <tr>
                            <th class="tbPatientID">PatientID</th>
                            <th class="tbLastName">LastName</th>
                            <th class="tbFirstName">FirstName</th>
                            <th class="tbMiddleName">MiddleName</th>
                            <th class="tbAge">Age</th>
                            <th class="tbGender">Gender</th>
                            <th class="tbContact">Contact Number</th>
                            <th class="tbAddress">Address</th>
                            <th class="tbAction">Action</th>
                        </tr>

                        @if(isset($patientsBasicInfo['message']))
                            <tr class="trMessege">
                                <td class="tbMessege">{{ $patientsBasicInfo['message'] }}</td>
                            </tr>
                        @else
                            @foreach($patientsBasicInfo as $patient)
                                <tr>
                                
                                    <td class="tbPatientID">{{ $patient->PatientID }}</td>
                                    <td class="tbLastName">{{ $patient->LastName }}</td>
                                    <td class="tbFirstName">{{ $patient->FirstName }}</td>
                                    <td class="tbMiddleName">{{ $patient->MiddleName }}</td>
                                    <td class="tbAge">{{ $patient->Age }}</td>
                                    <td class="tbGender">{{ $patient->Gender }}</td>
                                    <td class="tbContact">+{{ $patient->ContactNumber }}</td>
                                    <td class="tbAddress">{{ $patient->HouseNumber }}, {{ $patient->Street }}, {{ $patient->Barangay }}, {{ $patient->Municipality }}, {{ $patient->Province }}</td>
                                    <td class="tbAction">
                                        @csrf
                                        <button type="submit" name="Seemore" class="Seemore bg-primary" value="{{ $patient->PatientID }}">See More...</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                </table>
            </div>
            {{-- Result Table Area --}}



        </form>
    </x-StaffNavigation>
@endif