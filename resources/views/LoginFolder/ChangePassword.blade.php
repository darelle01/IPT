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
    <link rel="stylesheet" href="{{asset('LoginCss/Background.css')}}">
    <link rel="stylesheet" href="{{asset('LoginCss/Dimesions.css')}}" >
    <link rel="stylesheet" href="{{asset('LoginCss/UpdatePassword.css')}}" >
    <title>Update Password</title>
</head>
<body>

    {{-- Top Area --}}
    <div class="TopArea">

    </div>{{-- Top Area --}}

    {{-- Main Area --}}
    <div class="MainArea">

        {{-- Left Side --}}
        <div class="LeftSide">

        </div>{{-- Left Side --}}

        {{-- Mid --}}
        <div class="Mid">

            {{-- Update Password Container --}}
            <div class="ForgotPasswordContainer">

                {{-- Update Password Form --}}
                <form action="{{route('Update.NewPassword')}}" method="POST" class="UpdatePasswordForm">
                    @csrf
                    @method('POST')
                    <div class="TitleArea">
                        <h2 class="TitleForm">Update Password</h2>
                    </div>
                    <div class="InputPasswordArea">
                        <input type="password" name="UpdatePassword" class="InputPassword" placeholder="Password *">
                    </div>
                    <div class="InputPasswordAgainArea">
                        <input type="password" name="ReTypePassword" class="InputAgainPassword" placeholder="Re-type Password">
                    </div>
                    <div class="ErrorsArea">

                    </div>
                    <div class="UpdatePassword">
                        <button type="submit" class="btn btn-primary UpdatePasswordBtn">Confirm</button>
                    </div>
                </form>{{-- Update Password Form --}}

            </div>{{-- Update Password Container --}}

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
    <script src="{{asset('/javascript/Adminpopup.js')}}" ></script>
    <script src="{{asset('/javascript/Staffpopup.js')}}" ></script>
</html>