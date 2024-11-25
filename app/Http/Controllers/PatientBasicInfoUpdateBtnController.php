<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientrecord;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class PatientBasicInfoUpdateBtnController extends Controller
{
    public function UpdatePatientInfo(Request $request){
        $UpdatePatientInfo = $request->validate([
            'PatientID' => 'string|max:255',
            'LastName' => 'string|max:255',
            'FirstName' => 'string|max:255',
            'MiddleName' => 'string|max:255',
            'Birthdate' => 'date|before:today',
            'Age' => 'integer|min:0',
            'Gender' => 'string',
            'HouseNumber' => 'string|max:255',
            'Street' => 'string|max:255',
            'Barangay' => 'string|max:255',
            'Municipality' => 'string|max:255',
            'Province' => 'string|max:255',
            'ContactNumber' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'PhilhealthNumber' => 'nullable|string',
        ]);
        $Prefix = '+63';
        $UpdatePatientInfo['ContactNumber'] = $Prefix . ltrim($UpdatePatientInfo['ContactNumber'], '0');
        $PatientID = $UpdatePatientInfo['PatientID'];
        $PBasicInfoUpdate = patientrecord::where('PatientID', $PatientID)->first();
       
        if ($PBasicInfoUpdate) {
            $PBasicInfoUpdate->LastName = $request->input('LastName');
            $PBasicInfoUpdate->FirstName = $request->input('FirstName');
            $PBasicInfoUpdate->MiddleName = $request->input('MiddleName');

            $PBasicInfoUpdate->Birthdate = $request->input('Birthdate');
            $PBasicInfoUpdate->Age = $request->input('Age');
            $PBasicInfoUpdate->Gender = $request->input('Gender');

            $PBasicInfoUpdate->HouseNumber = $request->input('HouseNumber');
            $PBasicInfoUpdate->Street = $request->input('Street');
            $PBasicInfoUpdate->Barangay = $request->input('Barangay');
            $PBasicInfoUpdate->Municipality = $request->input('Municipality');
            $PBasicInfoUpdate->Province = $request->input('Province');

            $PBasicInfoUpdate->ContactNumber = $request->input('ContactNumber');
            $PBasicInfoUpdate->email = $request->input('email');
            $PBasicInfoUpdate->PhilhealthNumber = $request->input('PhilhealthNumber');

            $PBasicInfoUpdate->save();


            $patientsBasicInfo = patientrecord::where('PatientID', 'like', "%$PatientID%")->get();
            $getAllConsultation = ConsultationListModel::all(); 
            $EncryptedpatientsBasicInfo = Crypt::encrypt($patientsBasicInfo);
            session(['EncryptedpatientsBasicInfo' => $EncryptedpatientsBasicInfo]);

            return redirect()->route('Admin.patientFullView',['data' => urlencode($EncryptedpatientsBasicInfo)])->with('getAllConsultation', $getAllConsultation);
        } 
        else{
            return redirect()->back();
        }
    }
}
