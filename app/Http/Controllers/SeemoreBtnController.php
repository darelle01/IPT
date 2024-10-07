<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientrecord;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class SeemoreBtnController extends Controller
{
     public function SeemoreBtn(Request $request){
        $request->validate([
            'Seemore' => 'required|string|max:255',
        ]);

        $Seemore = $request->input('Seemore');
        $getAllConsultation = ConsultationListModel::all(); 
        $patientsBasicInfo = patientrecord::where('PatientID', 'like', "%$Seemore%")->get();

        if ($patientsBasicInfo->isEmpty()) {
            return redirect()->back()->with('status', 'No records found.');
        }
        $EncryptedpatientsBasicInfo = Crypt::encrypt($patientsBasicInfo);
        session(['EncryptedpatientsBasicInfo' => $EncryptedpatientsBasicInfo]);
        return redirect()->route('Admin.patientFullView')->with('getAllConsultation', $getAllConsultation);
    }
}
