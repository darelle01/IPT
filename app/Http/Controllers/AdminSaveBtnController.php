<?php

namespace App\Http\Controllers;

use App\Models\patientrecord;
use Illuminate\Http\Request;

class AdminSaveBtnController extends Controller
{
    public function AdminSaveBtn(Request $request){
        $validatedPatientInfo = $request->validate([
            'PatientID' => 'required|string|max:255|unique:patientrecord,PatientID,',
            'LastName' => 'required|string|max:255',
            'FirstName' => 'required|string|max:255',
            'MiddleName' => 'required|string|max:255',
            'Birthdate' => 'required|date|before:today',
            'Age' => 'required|integer|min:0',
            'Gender' => 'required|string',
            'HouseNumber' => 'required|string|max:255',
            'Street' => 'required|string|max:255',
            'Barangay' => 'required|string|max:255',
            'Municipality' => 'required|string|max:255',
            'Province' => 'required|string|max:255',
            'ContactNumber' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:patientrecord,email,',
            'PhilhealthNumber' => 'nullable|string|unique:patientrecord,PhilhealthNumber,',
        ]);
        
        patientrecord::create($validatedPatientInfo);
            
        return redirect()->route('Admin.New')->with('Update','Adding New Patient Record Success!');

    }
}
