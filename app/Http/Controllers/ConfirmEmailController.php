<?php

namespace App\Http\Controllers;

use App\Mail\OTP;
use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class ConfirmEmailController extends Controller
{
    public function ConfirmEmail(Request $request){
        $ValidateEmail = $request->validate([
            'ForgotPassword' => 'email|required|string',
        ]);
        
        $ForgotPassword = $ValidateEmail['ForgotPassword'];
        
        $account = AccountsModel::where('email', $ForgotPassword)->first();
        if ($account) {

            $OTP = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
            $Stamp = 'OTPrequested';

            Mail::to($account->email)->send(new OTP($OTP, $account->FirstName, $account->LastName));

            $EncryptOTPcode = Crypt::encrypt($OTP);
            $EncryptForgotPassword = Crypt::encrypt($ForgotPassword);
            $OTPDuration = now()->addMinutes(5)->timestamp;
                
            session([
                'EncryptForgotPassword' => $EncryptForgotPassword,
                'Stamp' => $Stamp,
                'EncryptOTPcode' => $EncryptOTPcode,
                'OTPDuration' => $OTPDuration,
            ]);
            return redirect()->route('ForgotPassword.OTP');

        } else {
            return back()->withErrors(['ForgotPassword' => 'The provided email does not exist!']);
        }
    }
}
