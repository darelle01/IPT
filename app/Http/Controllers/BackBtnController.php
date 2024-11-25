<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class BackBtnController extends Controller
{
    public function BackBtn(Request $request){
        $request->validate([
            'PatientNumber' => 'required|string',
        ]);
        
        $ViewFullMedicalLogs = $request->input('PatientNumber');

        $MedicalLogs = patientmedicallog::where('PatientNumber', $ViewFullMedicalLogs)->get();
        $getAllConsultation = ConsultationListModel::all();
        
        $EncryptViewFullMedicalLogs = Crypt::encrypt($ViewFullMedicalLogs);
        $EncryptMedicalLogs = Crypt::encrypt($MedicalLogs);
        
        session(['EncryptViewFullMedicalLogs' => $EncryptViewFullMedicalLogs,
                'EncryptMedicalLogs' => $EncryptMedicalLogs,
                'getAllConsultation' => $getAllConsultation]);

                return redirect()->route('Admin.ViewMedicalLogsRecords',['data' => urlencode($EncryptMedicalLogs), 'data2' => urlencode($EncryptViewFullMedicalLogs), 'data3' => urlencode($getAllConsultation)]);
        
    }
}
