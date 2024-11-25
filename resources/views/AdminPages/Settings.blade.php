@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- Css  --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/Settings.css')}}">
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
                                <p>No profile picture available.</p>
                                @endif
                            </div>
                            <div class="ProfilePicBtns">
                                
                            </div>

                        </div>{{-- Profile Picture --}}

                        {{-- Info Area --}}
                        <div class="InfoArea">
                            <div class="FirstRow">
                                <label class="LastNameLabel">Last Name:</label>
                                <label class="FirstNameLabel">First Name:</label>
                                <label class="MiddleNameLabel">Middle Name:</label>
                            </div>
                            <div class="SecondRow">
                                <label class="LastName">{{$User->LastName}}</label>
                                <label class="FirstName">{{$User->FirstName}}</label>
                                <label class="MiddleName">{{$User->MiddleName}}</label>
                            </div>
                            <div class="ThirdRow">
                                <label class="BirthdateLabel">Birthdate:</label>
                                <label class="AgeLabel">Age:</label>
                                <label class="GenderLabel">Gender:</label>
                            </div>
                            <div class="FourthRow">
                                <label class="Birthdate">{{$User->Birthdate}}</label>
                                <label class="Age">{{$User->Age}}</label>
                                <label class="Gender">{{$User->Gender}}</label>
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
                        <label class="Address">{{$User->HouseNumber}}, {{$User->Street}}, {{$User->Barangay}}, {{$User->Municipality}}, {{$User->Province}}</label>
                        <label class="ContactNumber">+63{{$User->ContactNumber}}</label>
                        <label class="Email">{{$User->email}}</label>
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
                    <div class="SecondRow2">
                        <label class="Username">{{$User->username}}</label>
                        <label type="password" class="Password">{{ str_repeat('*', 20 )}}</label>
                    </div>
                </div>
            </div>{{-- Account Info --}} 
            <form action="{{route('RedirectTo.UpdateSettings')}}" method="GET" class="BtnArea">
                @csrf
                @method('GET')
                <input type="text" class="" name="find" value="{{$User->username}}" hidden>
                <button type="submit" class="btn btn-info Update">Update</button>
            </form>

        </div>{{-- Setting Area --}}

</x-AdminNavigation>




@else
    <x-StaffNavigation>
        {{-- Css  --}}
        <link rel="stylesheet" href="{{asset('AdminAccountCss/Settings.css')}}">
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
                                <p>No profile picture available.</p>
                                @endif
                            </div>
                            <div class="ProfilePicBtns">
                                
                            </div>

                        </div>{{-- Profile Picture --}}

                        {{-- Info Area --}}
                        <div class="InfoArea">
                            <div class="FirstRow">
                                <label class="LastNameLabel">Last Name:</label>
                                <label class="FirstNameLabel">First Name:</label>
                                <label class="MiddleNameLabel">Middle Name:</label>
                            </div>
                            <div class="SecondRow">
                                <label class="LastName">{{$User->LastName}}</label>
                                <label class="FirstName">{{$User->FirstName}}</label>
                                <label class="MiddleName">{{$User->MiddleName}}</label>
                            </div>
                            <div class="ThirdRow">
                                <label class="BirthdateLabel">Birthdate:</label>
                                <label class="AgeLabel">Age:</label>
                                <label class="GenderLabel">Gender:</label>
                            </div>
                            <div class="FourthRow">
                                <label class="Birthdate">{{$User->Birthdate}}</label>
                                <label class="Age">{{$User->Age}}</label>
                                <label class="Gender">{{$User->Gender}}</label>
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
                        <label class="Address">{{$User->HouseNumber}}, {{$User->Street}}, {{$User->Barangay}}, {{$User->Municipality}}, {{$User->Province}}</label>
                        <label class="ContactNumber">+63{{$User->ContactNumber}}</label>
                        <label class="Email">{{$User->email}}</label>
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
                    <div class="SecondRow2">
                        <label class="Username">{{$User->username}}</label>
                        <label type="password" class="Password">{{ str_repeat('*', 20 )}}</label>
                    </div>
                </div>
            </div>{{-- Account Info --}} 
            <form action="{{route('RedirectTo.UpdateSettings')}}" method="GET" class="BtnArea">
                @csrf
                @method('GET')
                <input type="text" class="" name="find" value="{{$User->username}}" hidden>
                <button type="submit" class="btn btn-info Update">Update</button>
            </form>

        </div>{{-- Setting Area --}}
    </x-StaffNavigation>
@endif