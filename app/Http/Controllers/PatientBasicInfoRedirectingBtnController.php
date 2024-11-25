<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class PatientBasicInfoRedirectingBtnController extends Controller
{
    public function RedirectingToUpdatePage(Request $request){
        $request->validate([
            'PatientNumberValue' => 'required|string|max:255',
        ]);
        $getAllConsultation = ConsultationListModel::all();
        $PatientNumberValue = $request->input('PatientNumberValue');
        $EncryptedPatientNumberValue = Crypt::encrypt($PatientNumberValue);
        session(['EncryptedPatientNumberValue' => $EncryptedPatientNumberValue,
                'getAllConsultation' => $getAllConsultation]);
        return redirect()->route('BasicInfo.Update',['data' => urlencode($EncryptedPatientNumberValue), 'data2' => urlencode($getAllConsultation)]);
    }
}
