<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNavigationController extends Controller
{
    public function ViewAdminNavigation(){
        
        return view('components.AdminNavigation');
    }
}
