<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use Illuminate\Support\Facades\Log;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DeleteFileController extends Controller
{
    public function DeleteFile(Request $request){
        $request ->validate([
            'PatientNumber' => 'required|string',
            'id' => 'required|numeric',
        ]);

        $deleteRecord = patientmedicallog::where('PatientNumber', $request -> PatientNumber)
                                        ->where('id', $request -> id)
                                        ->firstOrFail();

        if ($deleteRecord->Images) {
                    $ImagesPaths = json_decode($deleteRecord->Images, true);

                    foreach ($ImagesPaths as $ImagesPath) {
                        Storage::disk('public')->exists($ImagesPath);
                            Storage::disk('public')->delete($ImagesPath);
                            Log::info("Deleted file: $ImagesPath");
     
                    }
                }

                $deleteRecord->delete();
        $ViewFullMedicalLogs = $request->input('PatientNumber');
        $MedicalLogs = patientmedicallog::where('PatientNumber', $ViewFullMedicalLogs)->get();
        $getAllConsultation = ConsultationListModel::all(); 
        $EncryptMedicalLogs = Crypt::encrypt($MedicalLogs);

        session(['EncryptMedicalLogs' => $EncryptMedicalLogs,
                'getAllConsultation' => $getAllConsultation]);
        return redirect()->route('Admin.ViewMedicalLogsRecords')->with('delete', 'Images Deleted successfully!');                

    }
}
