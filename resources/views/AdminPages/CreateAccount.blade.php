<x-AdminNavigation>
    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminCreateAccount.css')}}">
    <x-slot:Title>
        Create Account
    </x-slot:Title>
    <form action="{{route('Admin.Store')}}" method="POST" class="CreateAccountForm" enctype="multipart/form-data">
        @csrf
        <div class="FormNameArea">
            <h2>Create Account</h2>
        </div>
        @if (session('Create'))
        <div class="alert alert-success">
            {{ session('Create') }}
        </div>
        @endif
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
               <input type="text" name="Barangay" class="Barangay" placeholder="Barangay / Subdivision*">
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
            <div class="ContactArea">
                <div class="ContactInputArea">
                    <span class="PhCode"></span>
                    <span class="Code">+63</span>
                    <input type="text" name="ContactNumber" class="ContactNumber" maxlength="10" minlength="10" placeholder="Mobile Number *">
                </div>
                <div class="ContactErrorArea">
                    @error('ContactNumber')
                    <div class="ContactNumber-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- Contact --}}
    
            {{-- email --}}
            <div class="emailArea">
                 <div class="emailInputArea">
                    <input type="email" name="email" class="email" placeholder="Email - Address *">
                </div>
                <div class="emailErrorArea">
                    @error('email')
                    <div class="email-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- email --}}
            </div>{{-- Address And Contact Input Area 3 --}} 
{{-- ===================================================================================== --}}
        {{-- Account Information --}}
        <div class="AccountInformationArea">
            <div class="AccountInformationLabel">
                <h3>Account</h3>
            </div>

        </div>{{-- Account Information --}}   
        <div class="AccountInformationInputArea">
            {{-- username --}}
            <div class="usernameArea">
                <div class="usernameInputArea">
                   <input type="text" name="username" class="username" placeholder="Username *">
               </div>
               <div class="usernameErrorArea">
                   @error('username')
                   <div class="username-error">{{ $message }}</div>
                   @enderror
               </div>
           </div>{{-- username --}}

            {{-- password --}}
            <div class="passwordArea">
                 <div class="passwordInputArea">
                    <input type="password" name="password" class="password" minlength="8" placeholder="Password *">
                </div>
                <span class="direction">Use atleast 8 characters one upper, one lower,one number and special characters. </span>
                <div class="passwordErrorArea">
                    @error('password')
                    <div class="password-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>{{-- password --}}
            
            {{-- profile_picture --}}
            <div class="profile_pictureArea">
                <div class="profile_pictureInputArea">
                    <input type="file" name="profile_picture" class="profile_picture" accept="image/*" placeholder="Upload Profile Picture *">
                </div>
            </div>{{-- profile_picture --}}
            <div class="profile_pictureErrorArea">
                @error('profile_picture')
                <div class="profile_picture-error">{{ $message }}</div>
                @enderror
            </div>
            </div>{{-- Account Information --}}            
            
        {{-- Create Btn --}}
        <div class="CreateBtnArea">
            <button type="submit" class="Create bg-primary">Create</button>
        </div>{{-- Create Btn --}}     
    </form>
</x-AdminNavigation>            