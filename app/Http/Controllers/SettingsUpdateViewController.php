<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Crypt;

class SettingsUpdateViewController extends Controller
{
    public function SettingsUpdateView(Request $request){
        $Username = Crypt::decrypt(session('EncryptUser'));
        $User = AccountsModel::where('username' , $Username->username)->first();
        return view('AdminPages.SettingsUpdate', compact('User'));
    }
}
