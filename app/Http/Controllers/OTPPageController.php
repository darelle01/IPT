<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OTPPageController extends Controller
{
    public function ViewAdminOTPPage(){
        return view('LoginFolder.AdminOTPPage');
    }
    public function ViewStaffOTPPage(){
        return view('LoginFolder.StaffOTPPage');
    }
}
