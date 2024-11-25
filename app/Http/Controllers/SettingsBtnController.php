<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Crypt;

class SettingsBtnController extends Controller
{
    public function ToSettingPage(Request $request){
        $Username = $request->validate([
            'SettingsPage' => 'required|string',
        ]);
        
        $User = AccountsModel::where('username', $Username['SettingsPage'])->first();
        
        $EncryptUser = Crypt::encrypt($User);
        session(['EncryptUser' => $EncryptUser]);
        return redirect()->route('Settings.View',['data' => urlencode($EncryptUser)]);
    }
}
