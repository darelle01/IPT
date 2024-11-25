<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EmailOTPSubmitBtnController extends Controller
{
    public function EmailOTPSubmitBtn(Request $request){
        $ValidateEmailCode = $request->validate([
            'EmailCode' => 'string|required',
        ]);
        
        

        try {
            $OTP = Crypt::decrypt(session('EncryptOTPcode'));
            $ForgotPassword = Crypt::decrypt(session('EncryptForgotPassword'));
        } catch (DecryptException $e) {
            return back()->withErrors(['OTPcode' => 'Unable to decrypt the OTP.']);
        }
       
        $OTPDuration = session('OTPDuration');
        $CurrentTime = now()->timestamp;
        $Stamp = session('Stamp');

        // checking again if the email is existing in database
        $user = AccountsModel::where('email', $ForgotPassword)->first();
        if (!$user) {
            return back()->withErrors(['EmailCode' => 'The provided email does not exist!']);
        }

        if(!$Stamp){
            return back()->withErrors(['EmailCode' => 'Request a code first!']);
        }

        // Check if the OTP is expired
        if ($CurrentTime > $OTPDuration) {
            return redirect()->route('Login')->withErrors(['EmailCode' => 'The OTP has expired. Please try logging in again.']);
        }
        // Check if the input OTP matches the stored OTP
        if ($request->input('EmailCode') === $OTP) {
            // OTP is correct, proceed to Admin dashboard
            if ($user->Position === 'Admin') {  
             
                $OTPVerifiedDuration = now()->addMinutes(2)->timestamp;
                $EncryptedUser = Crypt::encrypt($user->email);
                session(['OTPVerified' => true,
                        'OTPVerifiedDuration' => $OTPVerifiedDuration,
                        'EncryptedUser' => $EncryptedUser,
                    ]);
                return redirect()->route('Update.Password');
            }
        } else {
            // OTP is incorrect
            return back()->withErrors(['EmailCode' => 'Invalid OTP code. Please try again.']);
        }

    }
}
