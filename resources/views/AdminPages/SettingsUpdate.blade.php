@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- Css  --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/UpdateSettings.css')}}">
    <x-slot:Title>
        Settings
    </x-slot:Title>
    
       {{-- Setting Area --}}
       <div class="SettingsProfileArea">
        {{-- Settings Title --}}
        <div class="SettingsTitle">
            <h2 class="">
                Settings
            </h2>
        </div>{{-- Settings Title --}}

        {{-- Profile Settings Area --}}
        <div class="ProfileSettingsArea">

                <div class="ProfileSettingsTitle">
                    <h3 class="">
                        Basic Information
                    </h3>
                </div>

                <div class="BasicInfo">

                    {{-- Profile Picture --}}
                    <div class="ProfilePicArea">

                        <div class="ProfilePictureArea">
                            @if (Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profilepicture">
                            @else
                            {{-- <p>No profile picture available.</p> --}}
                            @endif
                        </div>
                        <div class="ProfilePicBtns">
                            <div class="UploadArea">
                                <button type="button" class="btn btn-primary upload" data-bs-toggle="modal" data-bs-target="#exampleModalUpload">
                                    Upload Avatar
                                </button>
                            </div>
                            {{-- Update Avatar Modal --}}
                                <div class="modal fade" id="exampleModalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('Update.Avatar')}}" method="POST" class="" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <input type="text" name="targetAcc" value="{{$User->username}}" class="" hidden>
                                                    <input class="form-control" type="file" id="formFile" accept="image/*" name="profile_picture">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>{{-- Update Avatar Modal --}}
                            <div class="DeleteArea">
                                <button type="button" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#exampleModaldelete">
                                    Delete Avatar
                                </button>
                                {{-- Delete Avatar Modal  --}}
                                <div class="modal fade" id="exampleModaldelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route ('Delete.Avatar')}}" method="POST" class="" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <h5 class="">Do you really want to delete your profile picture?</h5>
                                                <input type="text" name="targetAcc" value="{{$User->username}}" class="" hidden>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>{{-- Delete Avatar Modal  --}}
                            </div>
                        </div>

                    </div>{{-- Profile Picture --}}
                    <form action="{{route('Settings.UpdateSave')}}" method="POST" class="SettingsForm">
                        @csrf
                        @method('PUT')
                    {{-- Info Area --}}
                    <div class="InfoArea">
                        <div class="FirstRow">
                            <label class="LastNameLabel">Last Name:</label>
                            <label class="FirstNameLabel">First Name:</label>
                            <label class="MiddleNameLabel">Middle Name:</label>
                        </div>
                        <div class="SecondRow">
                            <input type="text" name="LastName" value="{{$User->LastName}}" class="LastName" required>
                            <input type="text" name="FirstName" value="{{$User->FirstName}}" class="FirstName" required>
                            <input type="text" name="MiddleName" value="{{$User->MiddleName}}" class="MiddleName" required>
                        </div>
                        <div class="ThirdRow">
                            <label class="BirthdateLabel">Birthdate:</label>
                            <label class="AgeLabel">Age:</label>
                            <label class="GenderLabel">Gender:</label>
                        </div>
                        <div class="FourthRow">
                            <input type="date" name="Birthdate" value="{{$User->Birthdate}}" class="Birthdate" required>
                            <input type="number" name="Age" class="Age" value="{{$User->Age}}" min="18" max="100" required>
                            <select name="Gender" class="Gender" required>
                                <option value="{{$User->Gender}}">{{$User->Gender}}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div> {{-- Info Area --}}

                </div>
                            

                </div>{{-- Profile Settings Area --}}

                {{-- Contact Info Area--}}
                <div class="ContactInfoArea">
                    <div class="ContactInfoTitle">
                        <h3 class="">
                            Contact Information
                        </h3>
                    </div>
                    <div class="ContactsArea">
                        <div class="FirstRow">
                            <label class="AddressLabel">Address:</label>
                            <label class="ContactNumberLabel">Contact Number:</label>
                            <label class="EmailLabel">Email - Address:</label>
                        </div>
                        <div class="SecondRow2">
                            <div class="Address">
                                <input type="text" name="HouseNumber" value="{{$User->HouseNumber}}" class="HouseNumber" placeholder="House No. *" required>
                                <input type="text" name="Street" value="{{$User->Street}}" class="Street" placeholder="Street *" required>
                                <input type="text" name="Barangay" value="{{$User->Barangay}}" class="Barangay" placeholder="Barangay/Subd. *" required>
                                <input type="text" name="Municipality" value="{{$User->Municipality}}" class="Municipality" placeholder="Municipality/City *" required>
                                <input type="text" name="Province" value="{{$User->Province}}" class="Province" placeholder="Province *" required>
                            </div>
                            <div class="ContactNumberArea">
                                <span class="PhCode"></span>
                                <span class="Code">+63</span>
                                <input type="text" name="ContactNumber" class="ContactNumber" value="{{$User->ContactNumber}}" maxlength="10" minlength="10" required>
                            </div>
                                <input type="text" name="email" value="{{$User->email}}" class="email" required>
                        </div>
                    </div>
                </div>{{-- Contact Info --}} 
                {{-- Account Info Area--}}
                <div class="AccountInfoArea">
                    <div class="AccountInfoTitle">
                        <h3 class="">
                            Account Information
                        </h3>
                    </div>
                    <div class="AccountArea">
                        <div class="FirstRow">
                            <label class="UsernameLabel">Username:</label>
                            <label class="PasswordLabel">Password:</label>
                        </div>
                        <div class="SecondRow3">
                            <input type="text" name="username" class="Username" >
                            <input type="password" name="password" class="password" >
                        </div>
                    </div>
                </div>{{-- Account Info --}} 
                <div  class="BtnArea">
                    <button type="submit" class="btn btn-info Update">Save</button>
                </div>
            </form>
    </div>{{-- Setting Area --}}

</x-AdminNavigation>




@else
    <x-StaffNavigation>
        {{-- Css  --}}
        <link rel="stylesheet" href="{{asset('AdminAccountCss/UpdateSettings.css')}}">
    <x-slot:Title>
        Settings
    </x-slot:Title>
        {{-- Setting Area --}}
        <div class="SettingsProfileArea">
            {{-- Settings Title --}}
            <div class="SettingsTitle">
                <h2 class="">
                    Settings
                </h2>
            </div>{{-- Settings Title --}}

            {{-- Profile Settings Area --}}
            <div class="ProfileSettingsArea">

                    <div class="ProfileSettingsTitle">
                        <h3 class="">
                            Basic Information
                        </h3>
                    </div>

                    <div class="BasicInfo">

                        {{-- Profile Picture --}}
                        <div class="ProfilePicArea">

                            <div class="ProfilePictureArea">
                                @if (Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profilepicture">
                                @else
                                
                                @endif
                            </div>
                            <div class="ProfilePicBtns">
                                <div class="UploadArea">
                                    <button type="button" class="btn btn-info upload">Upload Avatar</button>
                                </div>

                                <div class="DeleteArea">
                                <button type="button" class="btn btn-danger delete">Delete Avatar</button>
                                </div>
                            </div>

                        </div>{{-- Profile Picture --}}
                        <form action="{{route('Settings.UpdateSave')}}" method="POST" class="SettingsForm">
                            @csrf
                            @method('PUT')
                        {{-- Info Area --}}
                        <div class="InfoArea">
                            <div class="FirstRow">
                                <label class="LastNameLabel">Last Name:</label>
                                <label class="FirstNameLabel">First Name:</label>
                                <label class="MiddleNameLabel">Middle Name:</label>
                            </div>
                            <div class="SecondRow">
                                <input type="text" name="LastName" value="{{$User->LastName}}" class="LastName" required>
                                <input type="text" name="FirstName" value="{{$User->FirstName}}" class="FirstName" required>
                                <input type="text" name="MiddleName" value="{{$User->MiddleName}}" class="MiddleName" required>
                            </div>
                            <div class="ThirdRow">
                                <label class="BirthdateLabel">Birthdate:</label>
                                <label class="AgeLabel">Age:</label>
                                <label class="GenderLabel">Gender:</label>
                            </div>
                            <div class="FourthRow">
                                <input type="date" name="Birthdate" value="{{$User->Birthdate}}" class="Birthdate" required>
                                <input type="number" name="Age" class="Age" value="{{$User->Age}}" min="18" max="100" required>
                                <select name="Gender" class="Gender" required>
                                    <option value="{{$User->Gender}}">{{$User->Gender}}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div> {{-- Info Area --}}

                    </div>
                                

                    </div>{{-- Profile Settings Area --}}

                    {{-- Contact Info Area--}}
                    <div class="ContactInfoArea">
                        <div class="ContactInfoTitle">
                            <h3 class="">
                                Contact Information
                            </h3>
                        </div>
                        <div class="ContactsArea">
                            <div class="FirstRow">
                                <label class="AddressLabel">Address:</label>
                                <label class="ContactNumberLabel">Contact Number:</label>
                                <label class="EmailLabel">Email - Address:</label>
                            </div>
                            <div class="SecondRow2">
                                <div class="Address">
                                    <input type="text" name="HouseNumber" value="{{$User->HouseNumber}}" class="HouseNumber" placeholder="House No. *" required>
                                    <input type="text" name="Street" value="{{$User->Street}}" class="Street" placeholder="Street *" required>
                                    <input type="text" name="Barangay" value="{{$User->Barangay}}" class="Barangay" placeholder="Barangay/Subd. *" required>
                                    <input type="text" name="Municipality" value="{{$User->Municipality}}" class="Municipality" placeholder="Municipality/City *" required>
                                    <input type="text" name="Province" value="{{$User->Province}}" class="Province" placeholder="Province *" required>
                                </div>
                                <div class="ContactNumberArea">
                                    <span class="PhCode"></span>
                                    <span class="Code">+63</span>
                                    <input type="text" name="ContactNumber" class="ContactNumber" value="{{$User->ContactNumber}}" maxlength="10" minlength="10" required>
                                </div>
                                    <input type="text" name="email" value="{{$User->email}}" class="email" required>
                            </div>
                        </div>
                    </div>{{-- Contact Info --}} 
                    {{-- Account Info Area--}}
                    <div class="AccountInfoArea">
                        <div class="AccountInfoTitle">
                            <h3 class="">
                                Account Information
                            </h3>
                        </div>
                        <div class="AccountArea">
                            <div class="FirstRow">
                                <label class="UsernameLabel">Username:</label>
                                <label class="PasswordLabel">Password:</label>
                            </div>
                            <div class="SecondRow3">
                                <input type="text" name="username" class="Username" >
                                <input type="password" name="password" class="password" >
                            </div>
                        </div>
                    </div>{{-- Account Info --}} 
                    <div  class="BtnArea">
                        <button type="submit" class="btn btn-info Update">Save</button>
                    </div>
                </form>
        </div>{{-- Setting Area --}}
    </x-StaffNavigation>
@endif