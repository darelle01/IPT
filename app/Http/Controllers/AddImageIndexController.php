<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use Illuminate\Support\Facades\Crypt;

class AddImageIndexController extends Controller
{
            public function AddImageIndex(Request $request)
        {
            $request->validate([
                'Files.*' => 'nullable|image',
                'PatientNumber' => 'required|string',
                'id' => 'required|numeric',
            ]);
            
            
            $PatientNumber = $request->input('PatientNumber');
            $id = $request->input('id');
            

            $medicalLog = patientmedicallog::where('PatientNumber', $PatientNumber)
                                            ->where('id', $id)
                                            ->firstOrFail();
            

            $existingFiles = json_decode($medicalLog->Files, true) ?? [];

            if ($request->hasFile('Files')) {
                foreach ($request->file('Files') as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('uploads', $fileName, 'public');
                    $existingFiles[] = $path;
                }
            }

        
            $medicalLog->Files = json_encode($existingFiles);
            $medicalLog->save();


            $Images = patientmedicallog::where('PatientNumber',$PatientNumber)
            ->where('id',$id)
            ->firstOrFail();

            $filePaths = json_decode($Images->Files, true);
            
            $EncryptfilePaths = Crypt::encrypt($filePaths);
            session(['EncryptfilePaths' => $EncryptfilePaths,
                    'PatientNumber' => $PatientNumber,
                    'id' => $id]);
            return redirect()->route('Admin.ViewMedicalRecords',['data' => urlencode($EncryptfilePaths), 'data2' => urlencode($PatientNumber), 'data3' => urlencode($id)])->with('Upload', 'Images uploaded successfully!');
            }
}
