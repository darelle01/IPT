@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- Css  --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminNewPatient.css')}}">
    <x-slot:Title>
        New Patient
    </x-slot:Title>
    <form action="{{route('Admin.Save')}}" method="POST" class="NewPatientForm">
        @csrf
        <div class="FormNameArea">
            <h2>New Patient</h2>
        </div>
        @if (session('Update'))
        <div class="alert alert-success">
            {{ session('Update') }}
        </div>
        @endif
        <div class="PatientIDArea">
            <input type="text" name="PatientID" class="PatientID" placeholder="Patient ID *">
            <div class="PatientIDerrorArea">
                @error('PatientID')
                <div class="PatientID-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Basic Information Label --}}
        <div class="BasicInfoArea">
            <div class="BasicInfoLabel">
                <h3>Basic Information</h3>
            </div>
        </div>{{-- Basic Information Label --}}


        {{-- Basic Information Input 1 --}}
        <div class="BasicInfoInputArea">

            {{-- Last Name --}}
            <div class="LastNameArea">
                <div class="LastNameInputArea">
                    <input type="text" name="LastName" class="LastName" placeholder="Last Name *">
                </div>
                <div class="LastNameErrorArea">
                    @error('LastName')
                    <div class="LastName-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Last Name --}}

            {{-- First Name --}}
            <div class="FirstNameArea">
                <div class="FirstNameInputArea">
                    <input type="text" name="FirstName" class="FirstName" placeholder="First Name *">
                </div>
                <div class="FirstNameErrorArea">
                    @error('FirstName')
                    <div class="FirstName-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- First Name --}} 

            {{-- Middle Name --}}
            <div class="MiddleNameArea">
                <div class="MiddleNameInputArea">
                    <input type="text" name="MiddleName" class="MiddleName" placeholder="Middle Name *">
                </div>
                <div class="MiddleNameErrorArea">
                    @error('MiddleName')
                    <div class="MiddleName-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Middle Name --}}  

        </div>{{-- Basic Information Input 1 --}}

        {{-- Basic Information Input 2 --}}
        <div class="BasicInfoInputArea2">

            {{-- Birthdate --}}
            <div class="BirthdateArea">
                <div class="BirthdateInput">
                    <span class="BirthdateLabel">Birthdate :</span>
                    <input type="date" name="Birthdate" class="Birthdate">
                </div>
                <div class="BirthdateErrorArea">
                    @error('Birthdate')
                    <div class="Birthdate-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Birthdate --}}

            {{-- Age --}}
            <div class="AgeArea">
                <div class="AgeInputArea">
                    <input type="number" name="Age" class="Age" min="1" placeholder="Age *">
                </div>
                <div class="AgeErrorArea">
                    @error('Age')
                    <div class="Age-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Age --}}
            {{-- Gender --}}
            <div class="GenderArea">
                <div class="GenderInputArea">
                    <select name="Gender" class="Gender" required>
                        <option value="" disabled selected>Gender *</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                
                <div class="GenderErrorArea">
                    @error('Gender')
                    <div class="Gender-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Age --}}            

        </div>{{-- Basic Information Input 2 --}}

{{-- ------------------------------------------------------------------------------------- --}}
        {{-- Address and Contacts --}}
        <div class="AddressAndContactArea">
            <div class="AddressAndContactLabel">
                <h3>Address and Contacts</h3>
            </div>
        </div>{{-- Address and Contacts --}}

        {{-- Address And Contact Input Area --}}
        <div class="AddressAndContactInputArea">
        {{-- House Number --}}
        <div class="HouseNumberArea">
            <div class="HouseNumberInputArea">
                <input type="text" name="HouseNumber" class="HouseNumber" placeholder="House No. *">
            </div>
            <div class="HouseNumberErrorArea">
                @error('HouseNumber')
                <div class="HouseNumber-error">{{ $message }}</div>
                @enderror
            </div>
        </div>{{-- House Number --}}

        {{-- Street --}}
        <div class="StreetArea">
             <div class="StreetInputArea">
                <input type="text" name="Street" class="Street" placeholder="Street *">
            </div>
            <div class="StreetErrorArea">
                @error('Street')
                <div class="Street-error">{{ $message }}</div>
                @enderror
            </div>
        </div>{{-- Street --}}

        {{-- Barangay --}}
        <div class="BarangayArea">
            <div class="BarangayInputArea">
               <input type="text" name="Barangay" class="Barangay" placeholder="Barangay / Subdivison*">
           </div>
           <div class="BarangayErrorArea">
               @error('Barangay')
               <div class="Barangay-error">{{ $message }}</div>
               @enderror
           </div>
       </div>{{-- Barangay --}}
        </div>{{-- Address And Contact Input Area --}}
{{-- --------------------------------------------------------------------------------- --}}
        {{-- Address And Contact Input Area 2 --}}
        <div class="AddressAndContactInputArea2">
            {{-- Municipality --}}
            <div class="MunicipalityArea">
                <div class="MunicipalityInputArea">
                    <input type="text" name="Municipality" class="Municipality" placeholder="Municipality / City*">
                </div>
                <div class="MunicipalityErrorArea">
                    @error('Municipality')
                    <div class="Municipality-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Municipality --}}
    
            {{-- Province --}}
            <div class="ProvinceArea">
                 <div class="ProvinceInputArea">
                    <input type="text" name="Province" class="Province" placeholder="Province *">
                </div>
                <div class="ProvinceErrorArea">
                    @error('Province')
                    <div class="Province-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Province --}}
    
            </div>{{-- Address And Contact Input Area 2 --}}       
 
{{-- ------------------------------------------------------------------------------------ --}}
        {{-- Address And Contact Input Area 3 --}}
        <div class="AddressAndContactInputArea3">
            {{-- Contact --}}
            <div class="ContactNumberArea">
                <div class="ContactNumberInputArea">
                    <span class="PhCode"></span>
                    <span class="Code">+63</span>
                    <input type="text" name="ContactNumber" class="ContactNumber" maxlength="10" minlength="10" placeholder="Mobile Number *">
                </div>
                <div class="ContactNumberErrorArea">
                    @error('ContactNumber')
                    <div class="ContactNumber-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Contact --}}
    
            {{-- email --}}
            <div class="ProvinceArea">
                 <div class="ProvinceInputArea">
                    <input type="email" name="email" class="email" placeholder="Email - Address ( if - any) *">
                </div>
                <div class="emailErrorArea">
                    @error('email')
                    <div class="email-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- email --}}
            </div>{{-- Address And Contact Input Area 3 --}}  
{{-- ------------------------------------------------------------------------------------- --}}
        {{-- Philhealth --}}
        <div class="PhilhealthArea">
            <div class="PhilhealthLabel">
                <h3>Philhealth</h3>
            </div>
        </div>{{-- Philhealth --}}
        {{-- Philhealth Input Area --}}

        <div class="PhilhealthNumberInputArea">
            <input type="text" name="PhilhealthNumber" class="PhilhealthNumber" placeholder="Philhealth Number *">   
            <div class="PhilhealthNumberErrorArea">
                @error('PhilhealthNumber')
                <div class="PhilhealthNumber-error">{{ $message }}</div>
                @enderror
            </div>     
        </div>{{-- Philhealth Input Area --}}
        
        {{-- Save Btn --}}
        <div class="SaveBtnArea">
            <button type="submit" class="Save bg-primary">Save</button>
        </div>{{-- Save Btn --}}
    </form>
</x-AdminNavigation>
@else
    <x-StaffNavigation>
        {{-- Css  --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminNewPatient.css')}}">
    <x-slot:Title>
        New Patient
    </x-slot:Title>
    <form action="{{route('Admin.Save')}}" method="POST" class="NewPatientForm">
        @csrf
        <div class="FormNameArea">
            <h2>New Patient</h2>
        </div>
        @if (session('Update'))
        <div class="alert alert-success">
            {{ session('Update') }}
        </div>
        @endif
        <div class="PatientIDArea">
            <input type="text" name="PatientID" class="PatientID" placeholder="Patient ID *">
            <div class="PatientIDerrorArea">
                @error('PatientID')
                <div class="PatientID-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Basic Information Label --}}
        <div class="BasicInfoArea">
            <div class="BasicInfoLabel">
                <h3>Basic Information</h3>
            </div>
        </div>{{-- Basic Information Label --}}


        {{-- Basic Information Input 1 --}}
        <div class="BasicInfoInputArea">

            {{-- Last Name --}}
            <div class="LastNameArea">
                <div class="LastNameInputArea">
                    <input type="text" name="LastName" class="LastName" placeholder="Last Name *">
                </div>
                <div class="LastNameErrorArea">
                    @error('LastName')
                    <div class="LastName-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Last Name --}}

            {{-- First Name --}}
            <div class="FirstNameArea">
                <div class="FirstNameInputArea">
                    <input type="text" name="FirstName" class="FirstName" placeholder="First Name *">
                </div>
                <div class="FirstNameErrorArea">
                    @error('FirstName')
                    <div class="FirstName-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- First Name --}} 

            {{-- Middle Name --}}
            <div class="MiddleNameArea">
                <div class="MiddleNameInputArea">
                    <input type="text" name="MiddleName" class="MiddleName" placeholder="Middle Name *">
                </div>
                <div class="MiddleNameErrorArea">
                    @error('MiddleName')
                    <div class="MiddleName-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Middle Name --}}  

        </div>{{-- Basic Information Input 1 --}}

        {{-- Basic Information Input 2 --}}
        <div class="BasicInfoInputArea2">

            {{-- Birthdate --}}
            <div class="BirthdateArea">
                <div class="BirthdateInput">
                    <span class="BirthdateLabel">Birthdate :</span>
                    <input type="date" name="Birthdate" class="Birthdate">
                </div>
                <div class="BirthdateErrorArea">
                    @error('Birthdate')
                    <div class="Birthdate-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Birthdate --}}

            {{-- Age --}}
            <div class="AgeArea">
                <div class="AgeInputArea">
                    <input type="number" name="Age" class="Age" min="1" placeholder="Age *">
                </div>
                <div class="AgeErrorArea">
                    @error('Age')
                    <div class="Age-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Age --}}
            {{-- Gender --}}
            <div class="GenderArea">
                <div class="GenderInputArea">
                    <select name="Gender" class="Gender" required>
                        <option value="" disabled selected>Gender *</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                
                <div class="GenderErrorArea">
                    @error('Gender')
                    <div class="Gender-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Age --}}            

        </div>{{-- Basic Information Input 2 --}}

{{-- ------------------------------------------------------------------------------------- --}}
        {{-- Address and Contacts --}}
        <div class="AddressAndContactArea">
            <div class="AddressAndContactLabel">
                <h3>Address and Contacts</h3>
            </div>
        </div>{{-- Address and Contacts --}}

        {{-- Address And Contact Input Area --}}
        <div class="AddressAndContactInputArea">
        {{-- House Number --}}
        <div class="HouseNumberArea">
            <div class="HouseNumberInputArea">
                <input type="text" name="HouseNumber" class="HouseNumber" placeholder="House No. *">
            </div>
            <div class="HouseNumberErrorArea">
                @error('HouseNumber')
                <div class="HouseNumber-error">{{ $message }}</div>
                @enderror
            </div>
        </div>{{-- House Number --}}

        {{-- Street --}}
        <div class="StreetArea">
             <div class="StreetInputArea">
                <input type="text" name="Street" class="Street" placeholder="Street *">
            </div>
            <div class="StreetErrorArea">
                @error('Street')
                <div class="Street-error">{{ $message }}</div>
                @enderror
            </div>
        </div>{{-- Street --}}

        {{-- Barangay --}}
        <div class="BarangayArea">
            <div class="BarangayInputArea">
               <input type="text" name="Barangay" class="Barangay" placeholder="Barangay / Subdivison*">
           </div>
           <div class="BarangayErrorArea">
               @error('Barangay')
               <div class="Barangay-error">{{ $message }}</div>
               @enderror
           </div>
       </div>{{-- Barangay --}}
        </div>{{-- Address And Contact Input Area --}}
{{-- --------------------------------------------------------------------------------- --}}
        {{-- Address And Contact Input Area 2 --}}
        <div class="AddressAndContactInputArea2">
            {{-- Municipality --}}
            <div class="MunicipalityArea">
                <div class="MunicipalityInputArea">
                    <input type="text" name="Municipality" class="Municipality" placeholder="Municipality / City*">
                </div>
                <div class="MunicipalityErrorArea">
                    @error('Municipality')
                    <div class="Municipality-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Municipality --}}
    
            {{-- Province --}}
            <div class="ProvinceArea">
                 <div class="ProvinceInputArea">
                    <input type="text" name="Province" class="Province" placeholder="Province *">
                </div>
                <div class="ProvinceErrorArea">
                    @error('Province')
                    <div class="Province-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Province --}}
    
            </div>{{-- Address And Contact Input Area 2 --}}       
 
{{-- ------------------------------------------------------------------------------------ --}}
        {{-- Address And Contact Input Area 3 --}}
        <div class="AddressAndContactInputArea3">
            {{-- Contact --}}
            <div class="ContactNumberArea">
                <div class="ContactNumberInputArea">
                    <span class="PhCode"></span>
                    <span class="Code">+63</span>
                    <input type="text" name="ContactNumber" class="ContactNumber" maxlength="10" minlength="10" placeholder="Mobile Number *">
                </div>
                <div class="ContactNumberErrorArea">
                    @error('ContactNumber')
                    <div class="ContactNumber-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Contact --}}
    
            {{-- email --}}
            <div class="ProvinceArea">
                 <div class="ProvinceInputArea">
                    <input type="email" name="email" class="email" placeholder="Email - Address ( if - any) *">
                </div>
                <div class="emailErrorArea">
                    @error('email')
                    <div class="email-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- email --}}
            </div>{{-- Address And Contact Input Area 3 --}}  
{{-- ------------------------------------------------------------------------------------- --}}
        {{-- Philhealth --}}
        <div class="PhilhealthArea">
            <div class="PhilhealthLabel">
                <h3>Philhealth</h3>
            </div>
        </div>{{-- Philhealth --}}
        {{-- Philhealth Input Area --}}

        <div class="PhilhealthNumberInputArea">
            <input type="text" name="PhilhealthNumber" class="PhilhealthNumber" placeholder="Philhealth Number *">   
            <div class="PhilhealthNumberErrorArea">
                @error('PhilhealthNumber')
                <div class="PhilhealthNumber-error">{{ $message }}</div>
                @enderror
            </div>     
        </div>{{-- Philhealth Input Area --}}
        
        {{-- Save Btn --}}
        <div class="SaveBtnArea">
            <button type="submit" class="Save bg-primary">Save</button>
        </div>{{-- Save Btn --}}
    </form>
    </x-StaffNavigation>
@endif