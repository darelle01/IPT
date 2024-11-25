<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class ViewMedicalLogsController extends Controller
{
    public function ViewMedicalLogs(Request $request){
        $request->validate([
            'RedirectToPatientNo' => 'required|string',
        ]);
        $ViewFullMedicalLogs = $request->input('RedirectToPatientNo');
        $getAllConsultation = ConsultationListModel::all(); 
        $MedicalLogs = patientmedicallog::where('PatientNumber', $ViewFullMedicalLogs)->get();

        $EncryptViewFullMedicalLogs = Crypt::encrypt($ViewFullMedicalLogs);
        $EncryptMedicalLogs = Crypt::encrypt($MedicalLogs);

        $PatientConsultation = $MedicalLogs->collect()->unique('Consultation');

        session(['EncryptViewFullMedicalLogs' => $EncryptViewFullMedicalLogs,
                'EncryptMedicalLogs' => $EncryptMedicalLogs,
                'getAllConsultation' => $getAllConsultation,
                'PatientConsultation' => $PatientConsultation]);

        return redirect()->route('Admin.ViewMedicalLogsRecords',[
            'data' => urlencode($EncryptMedicalLogs), 
            'data2' => urlencode($getAllConsultation),
            'data3' => urlencode($PatientConsultation)]);
    }
}
