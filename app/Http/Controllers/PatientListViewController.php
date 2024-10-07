<?php

namespace App\Http\Controllers;

use App\Models\patientrecord;
use Illuminate\Http\Request;

class PatientListViewController extends Controller
{
    public function PatientListView(Request $request)
    {
        $patients = patientrecord::all();
        return view('AdminPages.PatientList', compact('patients'));
    }
}
