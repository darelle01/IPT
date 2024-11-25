@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminPatientFullInfo.css')}}">
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AddPatientMedicalRecord.css')}}">
    <x-slot:Title>
        Add Patient Medical Logs
    </x-slot:Title>
    {{-- Patient Full Basic Information --}}
    <div class="PatientFullBasicInformation">
        @csrf
        <div class="TitleArea">
            <h3>Patient Full Information</h3>
        </div>
        @foreach ($patientsBasicInfo as $patient)
        {{-- Patient Number and Philhealth --}}
        <div class="PatientNumberandPhilhealthArea">
            <div class="PatientNumberandPhilhealthLabel">
                <div class="PatientNumberArea">
                    <label class="PatientNumber">Patient Number</label>
                </div>
                <div class="PhilHealthArea">
                    <label class="PhilHealthNumber">Philhealth</label>
                </div> 
            </div>
        </div>{{-- Patient Number and Philhealth --}}
        
        {{-- Patient Number and Philhealth Value --}}
        <div class="PatientNumberandPhilhealthArea">
            <div class="PatientNumberandPhilhealthValue">
                <div class="PatientNumberArea">
                    <input type="text" class="PatientNumberValue" name="PatientNumberValue" value="{{$patient->PatientID}}" readonly>
                </div>
                <div class="PhilHealthArea">
                    <label class="PhilHealthNumberValue">{{$patient->PhilhealthNumber}}</label>
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
                    <label class="LastNameValue">{{$patient->LastName}}</label>
                </div>
                <div class="FirsttNameArea">
                    <label class="FirstNameValue">{{$patient->FirstName}}</label>
                </div>
                <div class="MiddleNameArea">
                    <label class="MiddleNameValue">{{$patient->MiddleName}}</label>
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
                <label class="BirthdateValue">
                    {{ \Carbon\Carbon::parse($patient->Birthdate)->format('m-d-Y') }}
                </label>
            </div>
            
                <div class="AgeArea">
                    <label class="AgeValue">{{$patient->Age}}</label>
                </div>
                <div class="GenderArea">
                    <label class="GenderValue">{{$patient->Gender}}</label>
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
                    <label class="HouseNoValue">{{$patient->HouseNumber}}</label>
                </div>
                <div class="StreetArea">
                    <label class="StreetValue">{{$patient->Street}}</label>
                </div>
                <div class="BarangayArea">
                    <label class="BarangayValue">{{$patient->Barangay}}</label>
                </div>
                <div class="MunicipalityArea">
                    <label class="MunicipalityValue">{{$patient->Municipality}}</label>
                </div>
                <div class="ProvinceArea">
                    <label class="ProvinceValue">{{$patient->Province}}</label>
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
                    <label class="ConatactValue">
                        <i class="fa-solid fa-phone"></i>
                        +63{{$patient->ContactNumber}}
                    </label>
                </div>
                <div class="EmailArea">
                    <label class="EmailValue">
                        <i class="fa-solid fa-envelope"></i>
                        {{$patient->email}}
                    </label>
                </div> 
            </div>
        </div>{{-- Contact and Email Value --}}
        <div class="ButtonArea">
        <form action="" class="">
            <button type="button" class="">Generate QR Code</button>
        </form>
        <form action="{{route('Redirect.Update')}}" method="GET"  class="">
            <button type="submit" name="PatientNumberValue" value="{{$patient->PatientID}}" class="update bg-primary">Update</button>
        </form>
        </div>
        @endforeach
    </div>{{-- Patient Full Basic Information --}}
{{-- ------------------------------------------------------------------------------------------------------------ --}}

{{-- ------------------------------------------------------------------------------------------------------------ --}}
    {{-- Add Patient Medical Record --}}
    <div class="AddPatientMedicalRecordArea">
        <form action="{{route('Admin.SaveMedicalLogs')}}" method="POST" class="AddPatientMedicalRecord" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="FormTitle">
                <h3>Add Patient Health Data</h3>
            </div>
            <div class="SuccessAlert">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            {{-- Medical Logs Input Area --}}
            <div class="MedicalLogsInputArea">
                
                {{-- Medical Logs Labels --}}
                <div class="MedicalLogsLabels">

                    {{-- Patient Number Label Area --}}
                    <div class="PatientNoArea">
                        <label class="PatientNo">Patient Number</label>
                    </div>{{-- Patient Number Label Area --}}
                    
                    {{-- Consultation Area --}}
                    <div class="ConsultationArea">
                        <label class="Consultation">Consultation</label>
                    </div>{{-- Consultation Area --}}

                    {{-- Remarks Area --}}
                    <div class="RemarksArea">
                        <label class="Remarks">Remarks</label>
                    </div>{{-- Remarks Area --}}

                    {{-- Date Of Check-up Area --}}
                    <div class="DateOfConsultationArea">
                        <label class="DateOfConsultation">Date Of Check-up</label>
                    </div>{{-- Date Of Check-up Area --}}
                    
                    {{-- Date Of Upload Area --}}
                    <div class="DateOfUploadArea">
                        <label class="DateOfUpload">Date Of Upload</label>
                    </div>{{-- Date Of Upload Area --}}

                    {{-- Files Area --}}
                    <div class="FilesArea">
                        <label class="Files">Files</label>
                    </div>{{-- Files Area --}}  

                    {{-- Action Area --}}
                    <div class="ActionArea">
                        <label class="Action">Action</label>
                    </div>{{-- Action Area --}} 

                </div>{{-- Medical Logs Labels --}}

                {{-- Medical Log Input --}}
                <div class="MedicalLogInput">
                    
                    {{-- Patient Number Input Area --}}
                    <div class="PatientNoInputArea">
                        <input type="text" name="PatientNumber" class="PatientNoValue" value="{{$patient->PatientID}}" readonly>
                    </div>{{-- Patient Number Input Area --}}

                    {{-- Consultation Input Area --}}
                    <div class="ConsultationInputArea">
                        <select name="Consultation" class="ConsultationValue" required>
                            <option value="">Select Consultation</option>
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
                    </div>{{-- Consultation Input Area --}}

                    {{-- Remarks Input Area --}}
                    <div class="RemarksInputArea">
                        <textarea name="Remarks" rows="2" class="RemarksValue" style="resize: none;"></textarea>
                    </div>{{-- Remarks Input Area --}}

                    {{-- Date Of Check-up Input Area --}}
                    <div class="DateOfConsultationInputArea">
                        <input type="date" name="DateOfConsultation" class="DateOfCheckUpValue" required>
                    </div>{{-- Date Of Check-up Input Area --}}

                    {{-- Date Of Upload Input Area --}}
                    <div class="DateOfUploadInputArea">
                        <input type="date" name="DateOfUpload" class="DateOfUploadValue" value="{{ date('Y-m-d') }}" readonly>
                    </div>{{-- Date Of Upload Input Area --}}
                    
                    {{-- File Input Area --}}
                    <div class="FileInputArea">
                        <input type="file" name="Files[]" multiple class="FileUploadValue" accept="image/*" placeholder="Upload Files here*">
                    </div>{{-- File Input Area --}}

                    {{-- Action Slot Area --}}
                    <div class="ActionBtnArea">
                        <button type="submit" class="SaveBtn bg-primary">Save</button>
                    </div>{{-- Action Slot --}}

                </div>{{-- Medical Log Input --}}

                {{-- Error Slot Area --}}
                <div class="ErrorArea">
                    {{-- Patient Number Error Area --}}
                    <div class="PatientNumberError">
                        @error('PatientNumber')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Patient Number Error Area --}}

                    {{-- Consultation Error Area --}}
                    <div class="ConsultationError">
                        @error('Consultation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Consultation Error Area --}}                    

                    {{-- Remarks Error Area --}}
                    <div class="RemarksError">
                        @error('Remarks')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Remarks Error Area --}}

                    {{-- Date Of Check-up Error Area --}}
                    <div class="DateOfCheckupError">
                        @error('DateOfConsultation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Date Of Check-up Error Area --}}

                    {{-- Date Of Upload Error Area --}}
                    <div class="DateOfUploadError">
                        @error('DateOfUpload')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Date Of Upload Error Area --}}

                    {{-- Files Error Area --}}
                    <div class="FilesError">
                        @error('Files')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Files Error Area --}}
                    
                </div>
            </div>{{-- Medical Logs Input Area --}}
        </form>        
    </div>{{-- Add Patient Medical Record --}}

    <form action="{{route('Admin.ViewMedicalLogs')}}" method="GET" class="RedirectBtn">
        <input type="text" name="RedirectToPatientNo" value="{{ $patient->PatientID }}" hidden>
        <button class="ViewMedicalLogs" >View Medical Logs</button>
    </form>
    
</x-AdminNavigation>













@else
<x-StaffNavigation>
            {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminPatientFullInfo.css')}}">
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AddPatientMedicalRecord.css')}}">
    <x-slot:Title>
        Add Patient Medical Logs
    </x-slot:Title>
    {{-- Patient Full Basic Information --}}
    <form action="{{route('Redirect.Update')}}" method="GET" class="PatientFullBasicInformation">
        @csrf
        <div class="TitleArea">
            <h3>Patient Full Information</h3>
        </div>
        @foreach ($patientsBasicInfo as $patient)
        {{-- Patient Number and Philhealth --}}
        <div class="PatientNumberandPhilhealthArea">
            <div class="PatientNumberandPhilhealthLabel">
                <div class="PatientNumberArea">
                    <label class="PatientNumber">Patient Number</label>
                </div>
                <div class="PhilHealthArea">
                    <label class="PhilHealthNumber">Philhealth</label>
                </div> 
            </div>
        </div>{{-- Patient Number and Philhealth --}}
        
        {{-- Patient Number and Philhealth Value --}}
        <div class="PatientNumberandPhilhealthArea">
            <div class="PatientNumberandPhilhealthValue">
                <div class="PatientNumberArea">
                    <input type="text" class="PatientNumberValue" name="PatientNumberValue" value="{{$patient->PatientID}}" readonly>
                </div>
                <div class="PhilHealthArea">
                    <label class="PhilHealthNumberValue">{{$patient->PhilhealthNumber}}</label>
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
                    <label class="LastNameValue">{{$patient->LastName}}</label>
                </div>
                <div class="FirsttNameArea">
                    <label class="FirstNameValue">{{$patient->FirstName}}</label>
                </div>
                <div class="MiddleNameArea">
                    <label class="MiddleNameValue">{{$patient->MiddleName}}</label>
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
                <label class="BirthdateValue">
                    {{ \Carbon\Carbon::parse($patient->Birthdate)->format('m-d-Y') }}
                </label>
            </div>
            
                <div class="AgeArea">
                    <label class="AgeValue">{{$patient->Age}}</label>
                </div>
                <div class="GenderArea">
                    <label class="GenderValue">{{$patient->Gender}}</label>
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
                    <label class="HouseNoValue">{{$patient->HouseNumber}}</label>
                </div>
                <div class="StreetArea">
                    <label class="StreetValue">{{$patient->Street}}</label>
                </div>
                <div class="BarangayArea">
                    <label class="BarangayValue">{{$patient->Barangay}}</label>
                </div>
                <div class="MunicipalityArea">
                    <label class="MunicipalityValue">{{$patient->Municipality}}</label>
                </div>
                <div class="ProvinceArea">
                    <label class="ProvinceValue">{{$patient->Province}}</label>
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
                    <label class="ConatactValue">
                        <i class="fa-solid fa-phone"></i>
                        +63{{$patient->ContactNumber}}
                    </label>
                </div>
                <div class="EmailArea">
                    <label class="EmailValue">
                        <i class="fa-solid fa-envelope"></i>
                        {{$patient->email}}
                    </label>
                </div> 
            </div>
        </div>{{-- Contact and Email Value --}}
     
        <div class="ButtonArea">
            <button type="submit" name="PatientNumberValue" value="{{$patient->PatientID}}" class="update bg-primary">Update</button>
        </div>
        @endforeach
    </form>{{-- Patient Full Basic Information --}}
{{-- ------------------------------------------------------------------------------------------------------------ --}}

{{-- ------------------------------------------------------------------------------------------------------------ --}}
    {{-- Add Patient Medical Record --}}
    <div class="AddPatientMedicalRecordArea">
        <form action="{{route('Admin.SaveMedicalLogs')}}" method="POST" class="AddPatientMedicalRecord" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="FormTitle">
                <h3>Add Patient Health Data</h3>
            </div>
            <div class="SuccessAlert">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            {{-- Medical Logs Input Area --}}
            <div class="MedicalLogsInputArea">
                
                {{-- Medical Logs Labels --}}
                <div class="MedicalLogsLabels">

                    {{-- Patient Number Label Area --}}
                    <div class="PatientNoArea">
                        <label class="PatientNo">Patient Number</label>
                    </div>{{-- Patient Number Label Area --}}
                    
                    {{-- Consultation Area --}}
                    <div class="ConsultationArea">
                        <label class="Consultation">Consultation</label>
                    </div>{{-- Consultation Area --}}

                    {{-- Remarks Area --}}
                    <div class="RemarksArea">
                        <label class="Remarks">Remarks</label>
                    </div>{{-- Remarks Area --}}

                    {{-- Date Of Check-up Area --}}
                    <div class="DateOfConsultationArea">
                        <label class="DateOfConsultation">Date Of Check-up</label>
                    </div>{{-- Date Of Check-up Area --}}
                    
                    {{-- Date Of Upload Area --}}
                    <div class="DateOfUploadArea">
                        <label class="DateOfUpload">Date Of Upload</label>
                    </div>{{-- Date Of Upload Area --}}

                    {{-- Files Area --}}
                    <div class="FilesArea">
                        <label class="Files">Files</label>
                    </div>{{-- Files Area --}}  

                    {{-- Action Area --}}
                    <div class="ActionArea">
                        <label class="Action">Action</label>
                    </div>{{-- Action Area --}} 

                </div>{{-- Medical Logs Labels --}}

                {{-- Medical Log Input --}}
                <div class="MedicalLogInput">
                    
                    {{-- Patient Number Input Area --}}
                    <div class="PatientNoInputArea">
                        <input type="text" name="PatientNumber" class="PatientNoValue" value="{{$patient->PatientID}}" readonly>
                    </div>{{-- Patient Number Input Area --}}

                    {{-- Consultation Input Area --}}
                    <div class="ConsultationInputArea">
                        <select name="Consultation" class="ConsultationValue" required>
                            <option value="">Select Consultation</option>
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
                    </div>{{-- Consultation Input Area --}}

                    {{-- Remarks Input Area --}}
                    <div class="RemarksInputArea">
                        <textarea name="Remarks" rows="2" class="RemarksValue" style="resize: none;"></textarea>
                    </div>{{-- Remarks Input Area --}}

                    {{-- Date Of Check-up Input Area --}}
                    <div class="DateOfConsultationInputArea">
                        <input type="date" name="DateOfConsultation" class="DateOfCheckUpValue" required>
                    </div>{{-- Date Of Check-up Input Area --}}

                    {{-- Date Of Upload Input Area --}}
                    <div class="DateOfUploadInputArea">
                        <input type="date" name="DateOfUpload" class="DateOfUploadValue" value="{{ date('Y-m-d') }}" readonly>
                    </div>{{-- Date Of Upload Input Area --}}
                    
                    {{-- File Input Area --}}
                    <div class="FileInputArea">
                        <input type="file" name="Files[]" multiple class="FileUploadValue" accept="image/*" placeholder="Upload Files here*">
                    </div>{{-- File Input Area --}}

                    {{-- Action Slot Area --}}
                    <div class="ActionBtnArea">
                        <button type="submit" class="SaveBtn bg-primary">Save</button>
                    </div>{{-- Action Slot --}}

                </div>{{-- Medical Log Input --}}

                {{-- Error Slot Area --}}
                <div class="ErrorArea">
                    {{-- Patient Number Error Area --}}
                    <div class="PatientNumberError">
                        @error('PatientNumber')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Patient Number Error Area --}}

                    {{-- Consultation Error Area --}}
                    <div class="ConsultationError">
                        @error('Consultation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Consultation Error Area --}}                    

                    {{-- Remarks Error Area --}}
                    <div class="RemarksError">
                        @error('Remarks')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Remarks Error Area --}}

                    {{-- Date Of Check-up Error Area --}}
                    <div class="DateOfCheckupError">
                        @error('DateOfConsultation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Date Of Check-up Error Area --}}

                    {{-- Date Of Upload Error Area --}}
                    <div class="DateOfUploadError">
                        @error('DateOfUpload')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Date Of Upload Error Area --}}

                    {{-- Files Error Area --}}
                    <div class="FilesError">
                        @error('Files')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>{{-- Files Error Area --}}
                    
                </div>
            </div>{{-- Medical Logs Input Area --}}
        </form>        
    </div>{{-- Add Patient Medical Record --}}

    <form action="{{route('Admin.ViewMedicalLogs')}}" method="GET" class="RedirectBtn">
        <input type="text" name="RedirectToPatientNo" value="{{ $patient->PatientID }}" hidden>
        <button class="ViewMedicalLogs" >View Medical Logs</button>
    </form>
    </x-StaffNavigation>
@endif