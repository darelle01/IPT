<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class navigationbarController extends Controller
{
   public function NavView(){
    return view('components.AdminNavigation');
   }
}
