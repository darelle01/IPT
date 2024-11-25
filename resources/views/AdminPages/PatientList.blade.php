@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
        {{-- CSS --}}
        <link rel="stylesheet" href="{{asset('AdminAccountCss/PatientFullList.css')}}">
        <link rel="stylesheet" href="{{asset('AdminAccountCss/PatientFullListTable.css')}}">
        {{-- Title --}}
        <x-slot:Title>
            Patient List
        </x-slot:Title>

        {{-- Patient Full List --}}
        <div class="PatientFullListTable">
            <div class="FormTitle">
                <h3>Patient List</h3>
            </div>

            <form action="{{route('Admin.PatientListFilter')}}" method="GET" class="PatientListFilter">
                <div class="FilterName">
                    <h4>Filter</h4>
                </div>
                <div class="FilterConsultationArea">
                    <select name="FilterConsultationValue" class="FilterConsultationValue">
                        <option value="">-- Select Consultation --</option>
                        @if(isset($getAllConsultation) && count($getAllConsultation) > 0)
                            @foreach ($getAllConsultation as $AllConsultation)
                                <option value="{{ $AllConsultation->ConsultationList }}">
                                    {{ $AllConsultation->ConsultationList }}
                                </option>
                            @endforeach
                        @else
                            <option value="">No consultations found</option>
                        @endif
                    </select>
                </div>
                <div class="SortByArea">
                    <select name="SortByValue" class="SortByValue">
                        <option value="" selected>- - Sort by * - -</option>
                        <option value="PatientNumber" {{ request('SortByValue') == 'PatientNumber' ? 'selected' : '' }}>Patient Number</option>
                        <option value="Alphabetical" {{ request('SortByValue') == 'Alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                        <option value="Age" {{ request('SortByValue') == 'Age' ? 'selected' : '' }}>Age</option>
                    </select>
                </div>
                <div class="FilterByGenderArea">
                    <select name="FilterByGender" class="FilterByGender">
                        <option value="" selected>Select Gender *</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="AgeBracketArea">
                    <select name="AgeBracket" class="AgeBracket">
                        <option value="" selected>Select Age Bracket *</option>
                        <option value="Senior" {{ request('AgeBracket') == 'Senior' ? 'selected' : '' }}>Senior</option>
                        <option value="Adult" {{ request('AgeBracket') == 'Adult' ? 'selected' : '' }}>Adult</option>
                        <option value="Teen" {{ request('AgeBracket') == 'Teen' ? 'selected' : '' }}>Teen</option>
                        <option value="Children" {{ request('AgeBracket') == 'Children' ? 'selected' : '' }}>Children</option>
                    </select>
                </div>
                <div class="ApplyBtnArea">
                    <button type="submit" class="btn btn-primary Apply">Apply</button>
                </div>
            </form>{{-- Filter Area --}}

                {{-- Patient Full List Table --}}
                <div class="PatientFullListTableArea">
                    @if($patients->isEmpty())
                        <p class="warn">No data found for the specified filters.</p>
                    @else
                    <table class="PatientTableGenerator">
                    <tr>
                        <th class="PN">Patient Number</th>
                        <th class="LN">Last Name</th>
                        <th class="FN">First Name</th>
                        <th class="MN">Middle Name</th>
                        <th class="AgeVal">Age</th>
                        <th class="GenderVal">Gender</th>
                        <th class="PNo">Phone No.</th>
                        <th class="AddressVal">Address</th>
                        <th class="ActionVal">Action</th>
                    </tr>
                    
                    @foreach($patients as $patientRecord)
                    <tr>
                        <td name="PatientIdVal">{{$patientRecord->PatientID}}</td>
                        <td name="PatientIdVal">{{$patientRecord->LastName}}</td>
                        <td name="PatientIdVal">{{$patientRecord->FirstName}}</td>
                        <td name="PatientIdVal">{{$patientRecord->MiddleName}}</td>
                        <td name="PatientIdVal">{{$patientRecord->Age}}</td>
                        <td name="PatientIdVal">{{$patientRecord->Gender}}</td>
                        <td name="PatientIdVal">+{{$patientRecord->ContactNumber}}</td>
                        <td name="PatientIdVal">
                            {{$patientRecord->HouseNumber}}, 
                            {{$patientRecord->Street}}, 
                            {{$patientRecord->Barangay}}, 
                            {{$patientRecord->Municipality}}, 
                            {{$patientRecord->Province}}
                        </td>
                        <td name="PatientIdVal">
                            <form action="{{route('Admin.ViewMore')}}" class="ViewBtnform">
                                <input type="text" value="{{$patientRecord->PatientID}}" name="View" class="ViewValue" hidden>
                                <button type="submit" class="btn btn-primary seemore">View</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    @endif
                </div>{{-- Patient Full List Table --}}

        </div>{{-- Patient Full List --}}

</x-AdminNavigation>
@else
    <x-StaffNavigation>
        {{-- CSS --}}
        <link rel="stylesheet" href="{{asset('AdminAccountCss/PatientFullList.css')}}">
        <link rel="stylesheet" href="{{asset('AdminAccountCss/PatientFullListTable.css')}}">
        {{-- Title --}}
        <x-slot:Title>
            Patient List
        </x-slot:Title>

        {{-- Patient Full List --}}
        <div class="PatientFullListTable">
            <div class="FormTitle">
                <h3>Patient List</h3>
            </div>

            <form action="{{route('Admin.PatientListFilter')}}" method="GET" class="PatientListFilter">
                <div class="FilterName">
                    <h4>Filter</h4>
                </div>
                <div class="FilterConsultationArea">
                    <select name="FilterConsultationValue" class="FilterConsultationValue">
                        <option value="">-- Select Consultation --</option>
                        @if(isset($getAllConsultation) && count($getAllConsultation) > 0)
                            @foreach ($getAllConsultation as $AllConsultation)
                                <option value="{{ $AllConsultation->ConsultationList }}">
                                    {{ $AllConsultation->ConsultationList }}
                                </option>
                            @endforeach
                        @else
                            <option value="">No consultations found</option>
                        @endif
                    </select>
                </div>
                <div class="SortByArea">
                    <select name="SortByValue" class="SortByValue">
                        <option value="" selected>- - Sort by * - -</option>
                        <option value="PatientNumber" {{ request('SortByValue') == 'PatientNumber' ? 'selected' : '' }}>Patient Number</option>
                        <option value="Alphabetical" {{ request('SortByValue') == 'Alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                        <option value="Age" {{ request('SortByValue') == 'Age' ? 'selected' : '' }}>Age</option>
                    </select>
                </div>
                <div class="FilterByGenderArea">
                    <select name="FilterByGender" class="FilterByGender">
                        <option value="" selected>Select Gender *</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="AgeBracketArea">
                    <select name="AgeBracket" class="AgeBracket">
                        <option value="" selected>Select Age Bracket *</option>
                        <option value="Senior" {{ request('AgeBracket') == 'Senior' ? 'selected' : '' }}>Senior</option>
                        <option value="Adult" {{ request('AgeBracket') == 'Adult' ? 'selected' : '' }}>Adult</option>
                        <option value="Teen" {{ request('AgeBracket') == 'Teen' ? 'selected' : '' }}>Teen</option>
                        <option value="Children" {{ request('AgeBracket') == 'Children' ? 'selected' : '' }}>Children</option>
                    </select>
                </div>
                <div class="ApplyBtnArea">
                    <button type="submit" class="btn btn-primary Apply">Apply</button>
                </div>
            </form>{{-- Filter Area --}}

                {{-- Patient Full List Table --}}
                <div class="PatientFullListTableArea">
                    @if($patients->isEmpty())
                        <p class="warn">No data found for the specified filters.</p>
                    @else
                    <table class="PatientTableGenerator">
                    <tr>
                        <th class="PN">Patient Number</th>
                        <th class="LN">Last Name</th>
                        <th class="FN">First Name</th>
                        <th class="MN">Middle Name</th>
                        <th class="AgeVal">Age</th>
                        <th class="GenderVal">Gender</th>
                        <th class="PNo">Phone No.</th>
                        <th class="AddressVal">Address</th>
                        <th class="ActionVal">Action</th>
                    </tr>
                    
                    @foreach($patients as $patientRecord)
                    <tr>
                        <td name="PatientIdVal">{{$patientRecord->PatientID}}</td>
                        <td name="PatientIdVal">{{$patientRecord->LastName}}</td>
                        <td name="PatientIdVal">{{$patientRecord->FirstName}}</td>
                        <td name="PatientIdVal">{{$patientRecord->MiddleName}}</td>
                        <td name="PatientIdVal">{{$patientRecord->Age}}</td>
                        <td name="PatientIdVal">{{$patientRecord->Gender}}</td>
                        <td name="PatientIdVal">+{{$patientRecord->ContactNumber}}</td>
                        <td name="PatientIdVal">
                            {{$patientRecord->HouseNumber}}, 
                            {{$patientRecord->Street}}, 
                            {{$patientRecord->Barangay}}, 
                            {{$patientRecord->Municipality}}, 
                            {{$patientRecord->Province}}
                        </td>
                        <td name="PatientIdVal">
                            <form action="{{route('Admin.ViewMore')}}" class="ViewBtnform">
                                <input type="text" value="{{$patientRecord->PatientID}}" name="View" class="ViewValue" hidden>
                                <button type="submit" class="btn btn-primary seemore">View</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    @endif
                </div>{{-- Patient Full List Table --}}

        </div>{{-- Patient Full List --}}
    </x-StaffNavigation>
@endif