<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailOTPController extends Controller
{
    public function EmailOTP(){
        return view('LoginFolder.ForgotPasswordOTP');
    }
}
