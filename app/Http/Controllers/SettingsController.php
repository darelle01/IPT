<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SettingsController extends Controller
{
    public function SettingsView(){
        $User = Crypt::decrypt(session('EncryptUser'));
        $User = AccountsModel::where('username', $User->username)->first();
        return view('AdminPages.Settings', compact('User'));
    }
}
