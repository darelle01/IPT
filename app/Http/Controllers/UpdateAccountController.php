<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UpdateAccountController extends Controller
{
    public function UpdateAccount(){
        $Username = Crypt::decrypt(session('EncryptUsername'));

        $Account = AccountsModel::where('username', $Username)->first();


        return view('AdminPages.UpdateAccounts',compact('Account'));
    }
}
