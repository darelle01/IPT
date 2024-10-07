<?php

namespace App\Http\Controllers;

use App\Models\patientmedicallog;
use Illuminate\Http\Request;

class SaveBtnController extends Controller
{
                public function SaveBtn(Request $request)
            { 
                $SaveMedicalInfo = $request->validate([
                    'PatientNumber' => 'required|string',
                    'Consultation' => 'required|string',
                    'Remarks' => 'nullable|string',
                    'DateOfConsultation' => 'required|date',
                    'DateOfUpload' => 'required|date',
                    'Files.*' => 'nullable|image'
                ]);

                $filePaths = [];

                if ($request->hasFile('Files')) {
                    foreach ($request->file('Files') as $file) {
                        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('uploads', $fileName, 'public');
                        $filePaths[] = $path;
                    }
                }

                
                if (!empty($filePaths)) {
                    $SaveMedicalInfo['Files'] = json_encode($filePaths);
                } else {
                    $SaveMedicalInfo['Files'] = null;
                }

                patientmedicallog::create($SaveMedicalInfo);

                return redirect()->back()->with('success', 'File uploading success.');

                    
                }
}
