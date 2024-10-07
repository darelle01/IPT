<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    {{-- Bootstrap --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    {{-- Fontawesome --}}
    {{-- <script src="https://kit.fontawesome.com/6d462838cf.js" crossorigin="anonymous"></script> --}}
    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminAccountBackground.css')}}">
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminNavigation.css')}}">
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AdminSidebar.css')}}">
    <title>{{$Title}}</title>
</head>
<body>

    {{-- Top Area --}}
    <div class="TopArea">

        <div class="MenuBtnArea" id="MenuBtnArea1">
            <button class="MenuBtn" onclick="toggleMenu()">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <form action="{{route('Admin.Result')}}" method="GET" class="SearchBarArea">
            @csrf
            
            <input type="text" name="Search" class="SearchBox" placeholder="Search" autocomplete="on">
            <button type="submit" class="SearchBtn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>{{-- Top Area --}}

    {{-- Main Area --}}
    <div class="MainArea">

        {{-- Left Side --}}
        <div class="LeftSide" id="NavBarArea">
            <div class="LogoArea">
                
            </div>
            <div class="ProfilePictureArea">
                @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profilepicture">
                @else
                <p>No profile picture available.</p>
                @endif
            </div>
            <div class="NameArea">
                <p>{{  Auth::user()->FirstName }}</p>
            </div>

            <div class="DashboardArea">
                <button class="Dashboard" onclick="redirectToAdminDashboard()">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="ButtonName">Dashboard</span>
                </button>
                
            </div>

            <div class="CreateAccountArea">
                <button class="CreateAccount" onclick="redirectToAdminCreateAccount()">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="ButtonName">New Account</span>
                </button>
            </div>
            <div class="AccountListArea">
                <button class="AccountList">
                    <i class="fa-solid fa-users-rectangle"></i>
                    <span class="ButtonName">Account List</span>
                </button>
            </div>
            <div class="NewPatientArea">
                <button class="NewPatient" onclick="redirectToAdminNewPatient()">
                    <i class="fa-solid fa-user-injured"></i>
                    <span class="ButtonName">New Patient</span>
                </button>
            </div>
            <div class="PatientTableArea">
                <button class="PatientTable" onclick="redirectToPatientList()">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span class="ButtonName">Patient Table</span>
                </button>
            </div>
            <div class="AddConsultationArea">
                <button class="AddConsultation" onclick="redirectToAddProgram()">
                    <i class="fa-solid fa-book-medical"></i>
                    <span class="ButtonName">Consultation</span>
                </button>
            </div>
            <div class="contain">
                <div class="SettingsArea">
                    <button class="Settings">
                        <i class="fa-solid fa-gear"></i>
                        <span class="ButtonName">Setting</span>
                    </button>
                </div>  
                <div class="LogoutArea">
                    <button class="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="ButtonName">Logout</span>
                    </button>
                </div>
            </div>
        </div>{{-- Left Side --}}

        {{-- Mid --}}
        <div class="Mid">

            {{$slot}}

        </div>{{-- Mid --}}

        {{-- Right Side --}}
        <div class="RightSide">

        </div>{{-- Right Side --}}
        
    </div>{{-- Main Area --}}

    {{-- Bottom Area --}}
    <div class="BottomArea">

    </div>{{-- Bottom Area --}}

</body>
    {{-- Javascript --}}
    <script src="{{asset('/javascript/Sidebar.js')}}" ></script>
    <script src="{{asset('/javascript/AdminBtn/AdminDashboardBtn.js')}}" ></script>
    <script src="{{asset('/javascript/AdminBtn/AdminCreateAccountBtn.js')}}" ></script>
    <script src="{{asset('/javascript/AdminBtn/AdminNewPatientBtn.js')}}" ></script>
    <script src="{{asset('/javascript/AdminBtn/PatientListBtn.js')}}" ></script>
    <script src="{{asset('/javascript/AdminBtn/AddProgramBtn.js')}}" ></script>
</html>