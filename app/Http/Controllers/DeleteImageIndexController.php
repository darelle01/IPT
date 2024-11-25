<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DeleteImageIndexController extends Controller
{
        public function DeleteImageIndex(Request $request){    
        $patientLog = patientmedicallog::where('PatientNumber', $request->PatientNumber)
                                            ->where('id', $request->id)
                                            ->firstOrFail();
    
        $files = json_decode($patientLog->Files, true);
                
        if (isset($files[$request->imageIndex])) {
                
            $imagePath = 'public/' . $files[$request->imageIndex];

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);   
            }

            unset($files[$request->imageIndex]);
            $patientLog->Files = json_encode(array_values($files));
            $patientLog->save();
            }

            $PatientNumber = $request->PatientNumber;
            $id = $request->id;
            $Images = patientmedicallog::where('PatientNumber',$PatientNumber)
            ->where('id',$id)
            ->firstOrFail();

            $filePaths = json_decode($Images->Files, true);
            
            $EncryptfilePaths = Crypt::encrypt($filePaths);
            session(['EncryptfilePaths' => $EncryptfilePaths,
                    'PatientNumber' => $PatientNumber,
                    'id' => $id]);
            return redirect()->route('Admin.ViewMedicalRecords',['data' => urlencode($EncryptfilePaths), 'data2' => urlencode($PatientNumber), 'data3' => urlencode($id)])->with('Delete', 'Images Deleted successfully!');
    }

}
