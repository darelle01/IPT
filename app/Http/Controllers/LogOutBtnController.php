<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Container\Attributes\Log;
use Illuminate\Contracts\Encryption\DecryptException;

class LogOutBtnController extends Controller
{
    public function LogoutBtn(Request $request){
        try {
            $DecryptedUsername = Crypt::decrypt(session('EncryptUsername'));
            $user = AccountsModel::where('username', $DecryptedUsername)->first();
        } catch (DecryptException $e) {
            return back()->withErrors(['OTPcode' => 'Unable to decrypt the OTP.']);
        }
        Auth::logout();
        $ActivityStatus = 'offline';
        $user->ActivityStatus = $ActivityStatus;
        $user->save(); 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
        $ActivityStatus = 'offline';
        return redirect()->route('Login');
    }
}
