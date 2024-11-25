@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/UpdatePatientBasicInfo.css')}}">
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AddPatientMedicalRecord.css')}}">
    <x-slot:Title>
        Update Patient Record
    </x-slot:Title>
    {{-- Patient Full Basic Information --}}
    <form action="{{route ('BasicInfo.Updated')}}" method="POST"  class="PatientFullBasicInformation">
    @csrf
    @method('PUT')

        <div class="TitleArea">
            <h3>Update Patient Full Information</h3>
        </div>
        @foreach ($patientsBasicInfo as $patient)
        {{-- Patient Number and Philhealth --}}
        <div class="PatientNumberandPhilhealthArea">
            <div class="PatientNumberandPhilhealthLabel">
                <div class="PatientNumberArea">
                    <label class="PatientNumber">Patient Number</label>
                </div>
                <div class="PhilHealthArea">
                    <label class="PhilHealthNumber">Philhealth Number</label>
                </div> 
            </div>
        </div>{{-- Patient Number and Philhealth --}}
        
        {{-- Patient Number and Philhealth Value --}}
        <div class="PatientNumberandPhilhealthArea">
            <div class="PatientNumberandPhilhealthValue">
                <div class="PatientNumberArea">
                    <input type="text" name="PatientID" class="PatientNumberValue" value="{{$DecryptedPatientNumberValue}}">
                </div>
                <div class="PhilHealthArea">
                    <input type="text" class="PhilHealthNumberValue" name="PhilhealthNumber" value="{{$patient->PhilhealthNumber}}" placeholder="Philhealth Number *">
                </div> 
            </div>
        </div>{{-- Patient Number and Philhealth Value --}}

        {{-- Basic Info Area --}}
        <div class="BasicInfoArea">
            {{-- Full Name Label --}}
            <div class="FullNameLabel">
                <div class="LastNameArea">
                    <label class="LastNameLabel">Last Name</label>
                </div>
                <div class="FirsttNameArea">
                    <label class="FirstNameLabel">First Name</label>
                </div>
                <div class="MiddleNameArea">
                    <label class="MiddleNameLabel">Middle Name</label>
                </div>
            </div>{{-- Full Name Label --}}
            {{-- Full Name Value --}}
            <div class="FullNameValue">
                <div class="LastNameArea">
                    <input type="text" name="LastName" class="LastNameValue" value="{{$patient->LastName}}" placeholder="Last Name *">
                </div>
                <div class="FirsttNameArea">
                    <input type="text" name="FirstName" class="FirstNameValue" value="{{$patient->FirstName}}" placeholder="First Name *">
               </div>
                <div class="MiddleNameArea">
                    <input type="text" name="MiddleName" class="MiddleNameValue" value="{{$patient->MiddleName}}" placeholder="Middle Name *">
                </div>
            </div>{{-- Full Name Value --}}
        </div>{{-- Basic Info Area --}}

        {{-- Birthdate, Age and Gender Label --}}
        <div class="BirthdateAgeGenderArea">
            <div class="BirthdateAgeGenderLabel">
                <div class="BirthdateArea">
                    <label class="BirthdateLabel">Birthdate</label>
                </div>
                <div class="AgeArea">
                    <label class="AgeLabel">Age</label>
                </div>
                <div class="GenderArea">
                    <label class="GenderLabel">Gender</label>
                </div>
            </div>
        </div>{{-- Birthdate, Age and Gender Label --}}

        {{-- Birthdate, Age and Gender Value --}}
        <div class="BirthdateAgeGenderValue">
            <div class="BirthdateArea">
                <input type="date" name="Birthdate" class="BirthdateValue" value="{{ \Carbon\Carbon::parse($patient->Birthdate)->format('Y-m-d') }}">
            </div>
            <div class="AgeArea">
                <input type="number" name="Age" class="AgeValue" value="{{$patient->Age}}" placeholder="Age *">
            </div>
            <div class="GenderArea">
                <select name="Gender" class="GenderValue">
                    <option value="{{$patient->Gender}}">Gender *</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>{{-- Birthdate, Age and Gender --}}     
           
        {{-- Address Contact Label--}}
        <div class="AddressContactArea">
            <div class="AddressContactLabel">
                <div class="HouseNoArea">
                    <label class="HouseNo">House No.</label>
                </div>
                <div class="StreetArea">
                    <label class="Street">Street</label>
                </div>
                <div class="BarangayArea">
                    <label class="Barangay ">Barangay</label>
                </div>
                <div class="MunicipalityArea">
                    <label class="Municipality">Municipality</label>
                </div>
                <div class="ProvinceArea">
                    <label class="Province">Province</label>
                </div>
            </div>
        </div>{{-- Address Contact Label --}}
        {{-- Address Contact Value --}}
        <div class="AddressContactArea">
            <div class="AddressContactValue">
                <div class="HouseNoArea">
                    <input type="text" name="HouseNumber" class="HouseNoValue" value="{{$patient->HouseNumber}}" placeholder="House No. *">
                </div>
                <div class="StreetArea">
                    <input type="text" name="Street" class="StreetValue" value="{{$patient->Street}}" placeholder="Street *">
                </div>
                <div class="BarangayArea">
                    <input type="text" name="Barangay" class="BarangayValue" value="{{$patient->Barangay}}" placeholder="Barangay/Subd. *">
                </div>
                <div class="MunicipalityArea">
                    <input type="text" name="Municipality" class="MunicipalityValue" value="{{$patient->Municipality}}" placeholder="Municipality/City *">
                </div>
                <div class="ProvinceArea">
                    <input type="text" name="Province" class="ProvinceValue" value="{{$patient->Province}}" placeholder="Province *">
                </div>
            </div>
        </div>{{-- Address Contact Value --}}

        {{-- Contact and Email --}}
        <div class="ContactAndEmailArea">
            <div class="ContactAndEmailLabel">
                <div class="ContactArea">
                    <label class="Conatact">Contact</label>
                </div>
                <div class="EmailArea">
                    <label class="Email">Email - Address</label>
                </div> 
            </div>
        </div>{{-- Contact and Email --}}
        
        {{-- Contact and Email Value --}}
        <div class="ContactAndEmailArea">
            <div class="ContactAndEmailValue">
                <div class="ContactArea">
                    <span class="PhCode"></span>
                    <span class="Code">+63</span>
                    <input type="text" name="ContactNumber" class="ContactValue" maxlength="10" minlength="10" placeholder="Mobile Number *" value="{{$patient->ContactNumber}}">
                </div>
                <div class="EmailArea">
                    <input type="email" name="email" class="EmailValue" value="{{$patient->email}}" placeholder="Email - address *">
                </div> 
            </div>
        </div>{{-- Contact and Email Value --}}
        <div class="ButtonArea">
            <button type="submit" class="update bg-primary">Save</button>
        </div>
        @endforeach
    </form>{{-- Patient Full Basic Information --}}
{{-- ------------------------------------------------------------------------------------------------------------ --}}

{{-- ------------------------------------------------------------------------------------------------------------ --}}

    
</x-AdminNavigation>
@else
    <x-StaffNavigation>
            {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/UpdatePatientBasicInfo.css')}}">
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AddPatientMedicalRecord.css')}}">
    <x-slot:Title>
        Add Patient Medical Logs
    </x-slot:Title>
    {{-- Patient Full Basic Information --}}
    <form action="{{route ('BasicInfo.Updated')}}" method="POST"  class="PatientFullBasicInformation">
        @csrf
        @method('PUT')
    
            <div class="TitleArea">
                <h3>Update Patient Full Information</h3>
            </div>
            @foreach ($patientsBasicInfo as $patient)
            {{-- Patient Number and Philhealth --}}
            <div class="PatientNumberandPhilhealthArea">
                <div class="PatientNumberandPhilhealthLabel">
                    <div class="PatientNumberArea">
                        <label class="PatientNumber">Patient Number</label>
                    </div>
                    <div class="PhilHealthArea">
                        <label class="PhilHealthNumber">Philhealth Number</label>
                    </div> 
                </div>
            </div>{{-- Patient Number and Philhealth --}}
            
            {{-- Patient Number and Philhealth Value --}}
            <div class="PatientNumberandPhilhealthArea">
                <div class="PatientNumberandPhilhealthValue">
                    <div class="PatientNumberArea">
                        <input type="text" name="PatientID" class="PatientNumberValue" value="{{$DecryptedPatientNumberValue}}">
                    </div>
                    <div class="PhilHealthArea">
                        <input type="text" class="PhilHealthNumberValue" name="PhilhealthNumber" value="{{$patient->PhilhealthNumber}}" placeholder="Philhealth Number *">
                    </div> 
                </div>
            </div>{{-- Patient Number and Philhealth Value --}}
    
            {{-- Basic Info Area --}}
            <div class="BasicInfoArea">
                {{-- Full Name Label --}}
                <div class="FullNameLabel">
                    <div class="LastNameArea">
                        <label class="LastNameLabel">Last Name</label>
                    </div>
                    <div class="FirsttNameArea">
                        <label class="FirstNameLabel">First Name</label>
                    </div>
                    <div class="MiddleNameArea">
                        <label class="MiddleNameLabel">Middle Name</label>
                    </div>
                </div>{{-- Full Name Label --}}
                {{-- Full Name Value --}}
                <div class="FullNameValue">
                    <div class="LastNameArea">
                        <input type="text" name="LastName" class="LastNameValue" value="{{$patient->LastName}}" placeholder="Last Name *">
                    </div>
                    <div class="FirsttNameArea">
                        <input type="text" name="FirstName" class="FirstNameValue" value="{{$patient->FirstName}}" placeholder="First Name *">
                   </div>
                    <div class="MiddleNameArea">
                        <input type="text" name="MiddleName" class="MiddleNameValue" value="{{$patient->MiddleName}}" placeholder="Middle Name *">
                    </div>
                </div>{{-- Full Name Value --}}
            </div>{{-- Basic Info Area --}}
    
            {{-- Birthdate, Age and Gender Label --}}
            <div class="BirthdateAgeGenderArea">
                <div class="BirthdateAgeGenderLabel">
                    <div class="BirthdateArea">
                        <label class="BirthdateLabel">Birthdate</label>
                    </div>
                    <div class="AgeArea">
                        <label class="AgeLabel">Age</label>
                    </div>
                    <div class="GenderArea">
                        <label class="GenderLabel">Gender</label>
                    </div>
                </div>
            </div>{{-- Birthdate, Age and Gender Label --}}
    
            {{-- Birthdate, Age and Gender Value --}}
            <div class="BirthdateAgeGenderValue">
                <div class="BirthdateArea">
                    <input type="date" name="Birthdate" class="BirthdateValue" value="{{ \Carbon\Carbon::parse($patient->Birthdate)->format('Y-m-d') }}">
                </div>
                <div class="AgeArea">
                    <input type="number" name="Age" class="AgeValue" value="{{$patient->Age}}" placeholder="Age *">
                </div>
                <div class="GenderArea">
                    <select name="Gender" class="GenderValue" required>
                        <option value="" disabled selected>{{$patient->Gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>{{-- Birthdate, Age and Gender --}}     
               
            {{-- Address Contact Label--}}
            <div class="AddressContactArea">
                <div class="AddressContactLabel">
                    <div class="HouseNoArea">
                        <label class="HouseNo">House No.</label>
                    </div>
                    <div class="StreetArea">
                        <label class="Street">Street</label>
                    </div>
                    <div class="BarangayArea">
                        <label class="Barangay ">Barangay</label>
                    </div>
                    <div class="MunicipalityArea">
                        <label class="Municipality">Municipality</label>
                    </div>
                    <div class="ProvinceArea">
                        <label class="Province">Province</label>
                    </div>
                </div>
            </div>{{-- Address Contact Label --}}
            {{-- Address Contact Value --}}
            <div class="AddressContactArea">
                <div class="AddressContactValue">
                    <div class="HouseNoArea">
                        <input type="text" name="HouseNumber" class="HouseNoValue" value="{{$patient->HouseNumber}}" placeholder="House No. *">
                    </div>
                    <div class="StreetArea">
                        <input type="text" name="Street" class="StreetValue" value="{{$patient->Street}}" placeholder="Street *">
                    </div>
                    <div class="BarangayArea">
                        <input type="text" name="Barangay" class="BarangayValue" value="{{$patient->Barangay}}" placeholder="Barangay/Subd. *">
                    </div>
                    <div class="MunicipalityArea">
                        <input type="text" name="Municipality" class="MunicipalityValue" value="{{$patient->Municipality}}" placeholder="Municipality/City *">
                    </div>
                    <div class="ProvinceArea">
                        <input type="text" name="Province" class="ProvinceValue" value="{{$patient->Province}}" placeholder="Province *">
                    </div>
                </div>
            </div>{{-- Address Contact Value --}}
    
            {{-- Contact and Email --}}
            <div class="ContactAndEmailArea">
                <div class="ContactAndEmailLabel">
                    <div class="ContactArea">
                        <label class="Conatact">Contact</label>
                    </div>
                    <div class="EmailArea">
                        <label class="Email">Email - Address</label>
                    </div> 
                </div>
            </div>{{-- Contact and Email --}}
            
            {{-- Contact and Email Value --}}
            <div class="ContactAndEmailArea">
                <div class="ContactAndEmailValue">
                    <div class="ContactArea">
                        <span class="PhCode"></span>
                        <span class="Code">+63</span>
                        <input type="text" name="ContactNumber" class="ContactValue" maxlength="10" minlength="10" placeholder="Mobile Number *" value="{{$patient->ContactNumber}}">
                    </div>
                    <div class="EmailArea">
                        <input type="email" name="email" class="EmailValue" value="{{$patient->email}}" placeholder="Email - address *">
                    </div> 
                </div>
            </div>{{-- Contact and Email Value --}}
            <div class="ButtonArea">
                <button type="submit" class="update bg-primary">Save</button>
            </div>
            @endforeach
        </form>{{-- Patient Full Basic Information --}}
{{-- ------------------------------------------------------------------------------------------------------------ --}}

{{-- ------------------------------------------------------------------------------------------------------------ --}}

    </x-StaffNavigation>
@endif