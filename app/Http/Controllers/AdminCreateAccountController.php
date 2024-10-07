<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCreateAccountController extends Controller
{
    public function ViewAdminCreateAccount(){
        return view('AdminPages.CreateAccount');
    }
}