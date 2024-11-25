<?php

namespace App\Http\Controllers;

use App\Mail\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class AdminLoginBtnController extends Controller
{
    public function AdminLoginBtn(Request $request)
    {
        // Validate login credentials
        $AccountDetails = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt($AccountDetails)) {
            $user = Auth::user();
            if ($user->Status === 'Deactivated') {
                return back()->withErrors(['loginError' => 'Account has been Deactivated!']);
            }
            // Checking if the Account Position is Admin
            if ($user->Position === 'Admin') {
                $OTP = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
    

                Mail::to($user->email)->send(new OTP($OTP, $user->FirstName, $user->LastName));

                $EncryptOTPcode= Crypt::encrypt($OTP);
                $OTPDuration = now()->addMinutes(5)->timestamp;
                $EncryptUsername = Crypt::encrypt($AccountDetails['username']);
                session([
                    'EncryptOTPcode' => $EncryptOTPcode,
                    'OTPDuration' => $OTPDuration,
                    'EncryptUsername' => $EncryptUsername,
                ]);
                return redirect()->route('AdminOTP.Page', ['data' => urlencode($EncryptOTPcode), 'data2' => urlencode($OTPDuration), 'data3' => urlencode($EncryptUsername)]);
            }
            else{
                // If the Account Position is Not Admin
                return back()->withErrors(['loginError' => 'You are not authorized to access this page.']);
            }
        }
        else{
            return back()->withErrors(['loginError' => 'Please login to proceed.']);
        }
       
    }
}
