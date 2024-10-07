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
        if (strpos($validatedPatientInfo['ContactNumber'], '817') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '895') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '896') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '897') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '898') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '905') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '906') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '907') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '908') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '909') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '910') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '912') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '915') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '916') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '917') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '918') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '919') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '920') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '921') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '922') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '923') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '924') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '925') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '926') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '927') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '928') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '929') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '930') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '931') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '932') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '933') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '934') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '935') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '936') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '937') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '938') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '939') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '940') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '941') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '942') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '943') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '945') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '946') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '947') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '948') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '949') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '950') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '951') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '953') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '954') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '955') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '956') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '961') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '965') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '966') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '967') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '973') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '974') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '975') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '976') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '977') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '978') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '979') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '991') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '992') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '993') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '994') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '995') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '996') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '997') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '998') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '999') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9173') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9175') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9176') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9178') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9253') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9255') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9256') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9257') !== 0 &&
            strpos($validatedPatientInfo['ContactNumber'], '9258') !== 0 ) {
                return redirect()->route('Admin.Create')->withErrors(['ContactNumber' => 'Invalid number']);
        }
        $Prefix = 63;
        $validatedPatientInfo['ContactNumber'] = $Prefix . $validatedPatientInfo['ContactNumber'];
        patientrecord::create($validatedPatientInfo);
            
        return redirect()->route('Admin.New')->with('Update','Adding New Patient Record Success!');

    }
}
