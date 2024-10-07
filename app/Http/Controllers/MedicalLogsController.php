<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

class MedicalLogsController extends Controller
{
    public function ViewMedicalLogsRecords(){
        $ViewFullMedicalLogs = Crypt::decrypt(session('EncryptViewFullMedicalLogs'));
        $MedicalLogs = Crypt::decrypt(session('EncryptMedicalLogs'));
        $getAllConsultation = session('getAllConsultation');

        return view('AdminPages.MedicalLogs', compact('ViewFullMedicalLogs','MedicalLogs','getAllConsultation',));
    }
}
