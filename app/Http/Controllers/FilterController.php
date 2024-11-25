<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientmedicallog;
use App\Models\ConsultationListModel;
use Illuminate\Support\Facades\Crypt;

class FilterController extends Controller
{
    public function Filter(Request $request) {
        $Go = $request->validate([
            'PatientNumber' => 'required|string',
            'FilterByConsultation' => 'string|nullable',
            'AscOrDesc' => 'string|nullable',
        ]);
        
        $PatientNumber = $request->query('PatientNumber');
        $FilterByConsultation = $request->query('FilterByConsultation', null);
        $AscOrDesc = $request->query('AscOrDesc', null);

        $Find = patientmedicallog::where('PatientNumber', $PatientNumber);
        $getAllConsultation = ConsultationListModel::all(); 

        if ($FilterByConsultation) {
            $Find->where('Consultation', 'like', "%$FilterByConsultation%");
        }

        if ($AscOrDesc === 'asc') {
            $Find->orderBy('DateOfConsultation', 'asc');
        } elseif ($AscOrDesc === 'desc') {
            $Find->orderBy('DateOfConsultation', 'desc');
        }
        $MedicalLogs = $Find->get();

        if ($MedicalLogs->isEmpty()) {
            return redirect()->back()->with('no_data', 'No data found.');
        } 
        
        $EncryptMedicalLogs = Crypt::encrypt($MedicalLogs);
        session(['EncryptMedicalLogs' => $EncryptMedicalLogs,
                'FilterByConsultation',$FilterByConsultation]);

        
        return redirect()->route('Admin.ViewMedicalLogsRecords',['data' => urlencode($EncryptMedicalLogs), 'data2' => urlencode($FilterByConsultation), 'data3' => urlencode($getAllConsultation)]);
    }
}
