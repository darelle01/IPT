<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Crypt;

class RedirectToSettingsUpdateController extends Controller
{
    public function RedirectToUpdateSettings(Request $request){
    $CheckUser = $request->validate([
            'find' => 'required|string'
    ]);
        $User = AccountsModel::where('username' , $CheckUser['find'])->first();
        $EncryptUser = Crypt::encrypt($User);
        session(['EncryptUser' => $EncryptUser]);

        return redirect()->route('Settings.Update' , ['data' => urlencode($EncryptUser)]);
    }
}
