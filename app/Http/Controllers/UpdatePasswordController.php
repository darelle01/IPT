<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdatePasswordController extends Controller
{
    public function UpdatePasswordView(){
        return view('LoginFolder.ChangePassword');
    }
}
