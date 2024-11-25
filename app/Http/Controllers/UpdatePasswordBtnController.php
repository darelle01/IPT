<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UpdatePasswordBtnController extends Controller
{
   public function UpdatePasswordBtn(Request $request){
        $PasswordUpdate = $request->validate([
            'UpdatePassword' => 'required|string|min:8|regex:/[0-9]/|regex:/[@$!%*?&#]/|regex:/[A-Z]/',   
            'ReTypePassword' => 'required|string|min:8|regex:/[0-9]/|regex:/[@$!%*?&#]/|regex:/[A-Z]/|same:UpdatePassword',
        ]);

        try {
            $DecryptedUser = Crypt::decrypt(session('EncryptedUser'));
            $user = AccountsModel::where('email', $DecryptedUser)->first();
        } catch (DecryptException $e) {
            return back()->withErrors(['Error' => 'Unable to decrypt data.']);
        }
        if ($user) {
            $user->password = $PasswordUpdate['UpdatePassword'];
            $user->save();   
            Auth::logout();
            return redirect()->route('Login');
        }
        else{
            return back()->withErrors(['Error' => 'Unable to Update Password try again.']);
        }
    }
}