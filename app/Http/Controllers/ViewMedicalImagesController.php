<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ViewMedicalImagesController extends Controller
{
    public function ViewMedicalRecords(Request $request) {
        $filePaths = Crypt::decrypt(session('EncryptfilePaths'));
        $PatientNumber = session('PatientNumber');
        $id = session('id');


        return view('AdminPages.PatientViewImages', compact('id', 'PatientNumber', 'filePaths'));
    }
}
    