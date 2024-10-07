<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNewPatient extends Controller
{
    public function ViewAdminNewPatient(){
        return view('AdminPages.NewPatient');
    }
}
