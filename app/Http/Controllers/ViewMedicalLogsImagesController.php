<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use Illuminate\Support\Facades\Crypt;

class ViewMedicalLogsImagesController extends Controller
{
    public function ViewMedicalLogsImages($PatientNumber, $id)
    {
        $Images = patientmedicallog::where('PatientNumber',$PatientNumber)
        ->where('id',$id)
        ->firstOrFail();

        $filePaths = json_decode($Images->Files, true);
        
        $EncryptfilePaths = Crypt::encrypt($filePaths);
        session(['EncryptfilePaths' => $EncryptfilePaths,
                'PatientNumber' => $PatientNumber,
                'id' => $id]);
        return redirect()->route('Admin.ViewMedicalRecords', ['data' => urlencode($EncryptfilePaths), 'data2' => urlencode($PatientNumber), 'data3' => urlencode($id)]);
    }
    
}
