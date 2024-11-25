<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
   public function ForgotPasswordPageView(){
    return view('LoginFolder.ForgotPassword');
   }
}
