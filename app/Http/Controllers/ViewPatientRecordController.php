<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientrecord;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class ViewPatientRecordController extends Controller
{
    public function ViewMore(Request $request){
        $request->validate([
            'View' => 'required|string',
        ]);

        $View = $request->query();
        
        $patientsBasicInfo = patientrecord::where('PatientID',  $View)->get();
        $getAllConsultation = ConsultationListModel::all(); 
        if ($patientsBasicInfo->isEmpty()) {
            return redirect()->back()->with('status', 'No records found.');
        }
        $EncryptedpatientsBasicInfo = Crypt::encrypt($patientsBasicInfo);
        session(['EncryptedpatientsBasicInfo' => $EncryptedpatientsBasicInfo]);
        return redirect()->route('Admin.patientFullView', ['data' => urlencode($EncryptedpatientsBasicInfo), 'data2' => urlencode($getAllConsultation)]);
    }
}
