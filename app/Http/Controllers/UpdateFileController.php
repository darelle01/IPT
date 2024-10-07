<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use Illuminate\Support\Facades\Log;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class UpdateFileController extends Controller
{
    public function UpdateFile(Request $request) {
        $request->validate([
            'PatientNumber' => 'required|string',
            'Consultation' => 'required|string',
            'Remarks' => 'nullable|string',
            'DateOfConsultation' => 'required|date',
            'DateOfUpload' => 'required|date',
            'id' => 'required|numeric',
        ]);
    
        $PatientNumber = $request->input('PatientNumber');
        $id = $request->input('id');
        $MedicalLogs = patientmedicallog::where('PatientNumber', $PatientNumber)
                                        ->where('id', $id)
                                        ->firstOrFail();
        
        $MedicalLogs->Consultation = $request->input('Consultation');
        $MedicalLogs->Remarks = $request->input('Remarks')??'';
        $MedicalLogs->DateOfConsultation = $request->input('DateOfConsultation');
        $MedicalLogs->DateOfUpload = $request->input('DateOfUpload');

        $MedicalLogs->save();


        $ViewFullMedicalLogs = $request->input('PatientNumber');
        $MedicalLogs = patientmedicallog::where('PatientNumber', $ViewFullMedicalLogs)->get();
        $getAllConsultation = ConsultationListModel::all(); 
        $EncryptMedicalLogs = Crypt::encrypt($MedicalLogs);

        session(['EncryptMedicalLogs' => $EncryptMedicalLogs,
                'getAllConsultation' => $getAllConsultation]);
        return redirect()->route('Admin.ViewMedicalLogsRecords')->with('Update','File update success'); 

    }
}    
