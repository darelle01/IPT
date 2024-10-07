<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class PatientFullInfoController extends Controller
{
    public function ViewFullInfo(){
        $patientsBasicInfo = Crypt::decrypt(session('EncryptedpatientsBasicInfo'));
        $getAllConsultation = ConsultationListModel::all(); 
        return view('AdminPages.PatientFullInformation',compact('patientsBasicInfo'))->with('getAllConsultation', $getAllConsultation);
    }
}
