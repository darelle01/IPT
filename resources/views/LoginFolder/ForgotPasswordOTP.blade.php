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
    <link rel="stylesheet" href="{{asset('LoginCss/ForgotPasswordOTP.css')}}" >
    <title>Forgot Passowrd OTP Verification</title>
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

            {{-- Forgot Password Container --}}
            <div class="ForgotPasswordContainer">

                {{-- Forgot Password OTP Form --}}
                {{-- form for inputing the OTP to verifying --}}
                <form action="{{route('ForgotPassword.Verfication')}}" method="POST" class="ForgotPasswordOTPForm">
                    @csrf
                    @method('POST')

                    <div class="TitleArea">
                        <h3 class="ForgotPasswordOTPTitle">
                            Enter the Verification Code
                        </h3>
                    </div>
                    <div class="InputVerificationCodeArea">
                        <input type="text" name="EmailCode" class="InputVerificationCode">
                    </div>
                    <div class="Errors">
                        @error('EmailCode')
                        <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="SubmitBtnArea">
                        <button type="submit" class="btn btn-primary SubmitBtn">Submit</button>
                    </div>
                </form>{{-- Forgot Password OTP Form --}}

            </div>{{-- Forgot Password Container --}}

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