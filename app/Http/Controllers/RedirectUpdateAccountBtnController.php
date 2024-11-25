<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RedirectUpdateAccountBtnController extends Controller
{
    public function RedirectToUpdateAccount(Request $request){
        $request->validate([ 
            'username' => 'required|string', 
        ]); 
        $username = $request->input('username');

        $EncryptUsername = Crypt::encrypt($username);
        session(['EncryptUsername' => $EncryptUsername]);
        return redirect()->route('Update.Account', ['data' => urlencode($EncryptUsername)]);
    }
}
