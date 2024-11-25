<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientrecord;
use Illuminate\Support\Facades\Crypt;

class PatientFullInformationUpdateViewController extends Controller
{
    public function ViewUpdatePage(){
        $DecryptedPatientNumberValue = Crypt::decrypt(session('EncryptedPatientNumberValue'));
        $getAllConsultation = session('getAllConsultation');
        $patientsBasicInfo = patientrecord::where('PatientID', 'like', "%$DecryptedPatientNumberValue%")->get();
        return view('AdminPages.PatientFullInformationUpdate', compact('getAllConsultation', 'patientsBasicInfo','DecryptedPatientNumberValue'));
    }
}
