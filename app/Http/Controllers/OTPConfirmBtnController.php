<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class OTPConfirmBtnController extends Controller
{
    // Admin Confirm OTP Btn code
    public function AdminOTPConfirmBtn(Request $request)
    {
        if(session('OTPVerified') === true){

            if (now()->timestamp > session('OTPVerifiedDuration')) {
                session()->forget(['OTPVerified', 'OTPVerifiedDuration']);
                return redirect()->route('Login')->withErrors(['OTPcode' => 'The session has expired. Please log in again.']);
            }
            return redirect()->route('Admin.Dashboard');

        }

        $ValidateCode = $request->validate([
            'OTPcode' => 'required|string'
        ]);
    
        try {
            $OTP = Crypt::decrypt(session('EncryptOTPcode'));
            $DecryptedUsername = Crypt::decrypt(session('EncryptUsername'));
            $user = AccountsModel::where('username', $DecryptedUsername)->first();
        } catch (DecryptException $e) {
            return back()->withErrors(['OTPcode' => 'Unable to decrypt the OTP.']);
        }
        $OTPDuration = session('OTPDuration');
        $CurrentTime = now()->timestamp;
       
        // Check if the OTP is expired
        if ($CurrentTime > $OTPDuration) {
            return redirect()->route('Login')->withErrors(['OTPcode' => 'The OTP has expired. Please try logging in again.']);
        }
        
        // Check if the input OTP matches the stored OTP
        if ($request->input('OTPcode') === $OTP && $user) {
            // OTP is correct, proceed to Admin dashboard
            $OTPVerifiedDuration = now()->addMinutes(30)->timestamp;
            $OTPVerified = true;
            if ($OTPVerified) {
                $ActivityStatus = 'Online';
                $user->ActivityStatus = $ActivityStatus;
                $user->save();  
            }

            session(['OTPVerified' => $OTPVerified,
                    'OTPVerifiedDuration' => $OTPVerifiedDuration,       
        ]);
            return redirect()->route('Admin.Dashboard');
        } else {
            // OTP is incorrect
            return back()->withErrors(['OTPcode' => 'Invalid OTP code. Please try again.']);
        }
        
    }
    
    
    // Staff Confirm OTP Btn code
    public function StaffOTPConfirmBtn(Request $request)
    {
        if(session('OTPVerified') === true){

            if (now()->timestamp > session('OTPVerifiedDuration')) {
                session()->forget(['OTPVerified', 'OTPVerifiedDuration']);
                return redirect()->route('Login')->withErrors(['OTPcode' => 'The session has expired. Please log in again.']);
            }
            return redirect()->route('Admin.Dashboard');

        }

        $ValidateCode = $request->validate([
            'OTPcode' => 'required|string'
        ]);
    
        try {
            $OTP = Crypt::decrypt(session('EncryptOTPcode'));
            $DecryptedUsername = Crypt::decrypt(session('EncryptUsername'));
            $user = AccountsModel::where('username', $DecryptedUsername)->first();
        } catch (DecryptException $e) {
            return back()->withErrors(['OTPcode' => 'Unable to decrypt the OTP.']);
        }
        $OTPDuration = session('OTPDuration');
        $CurrentTime = now()->timestamp;
   
       
        // Check if the OTP is expired
        if ($CurrentTime > $OTPDuration) {
            return redirect()->route('Login')->withErrors(['OTPcode' => 'The OTP has expired. Please try logging in again.']);
        }
    
        // Check if the input OTP matches the stored OTP
        if ($request->input('OTPcode') === $OTP && $user) {
            // OTP is correct, proceed to Admin dashboard
            $OTPVerifiedDuration = now()->addMinutes(5)->timestamp;
            $OTPVerified = true;
            if ($OTPVerified) {
                $ActivityStatus = 'Online';
                $user->ActivityStatus = $ActivityStatus;
                $user->save();  
            }

            session(['OTPVerified' => $OTPVerified,
                    'OTPVerifiedDuration' => $OTPVerifiedDuration,       
        ]);
            return redirect()->route('Admin.Dashboard');
        } else {
            // OTP is incorrect
            return back()->withErrors(['OTPcode' => 'Invalid OTP code. Please try again.']);
        }
        
    } 
}
