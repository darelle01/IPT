<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientrecord;
use App\Models\patientmedicallog;
use App\Models\ConsultationListModel;

class PatientListFilterController extends Controller
{
    public function PatientListFilter(Request $request){
        $ApplyBtn = $request->validate([
            'FilterConsultationValue' => 'string|nullable',
            'SortByValue' => 'string|nullable',
            'FilterByGender' => 'string|nullable',
            'AgeBracket' => 'string|nullable',
        ]);
        $getAllConsultation = ConsultationListModel::all(); 
        $FilterConsultationValue = $request->query('FilterConsultationValue', null);
        $SortByValue = $request->query('SortByValue', null);
        $FilterByGender = $request->query('FilterByGender', null);
        $AgeBracket = $request->query('AgeBracket', null);


       
        $PatientRecordQuery = patientrecord::query();
     

        if($FilterByGender === 'Male' || $FilterByGender === 'Female'){
            $PatientRecordQuery->where('Gender',$FilterByGender);
        }
        if($SortByValue === 'Alphabetical'){
            $PatientRecordQuery->orderBy('LastName', 'asc');
        }
        if($SortByValue === 'PatientNumber'){
            $PatientRecordQuery->orderBy('PatientID', 'asc');
        }
        if($SortByValue === 'Age'){
            $PatientRecordQuery->orderBy('Age', 'asc');
        }

        if ($AgeBracket) {
            if ($AgeBracket === 'Senior') {
                $PatientRecordQuery->where('Age', '>=', 65);
            } elseif ($AgeBracket === 'Adult') {
                $PatientRecordQuery->whereBetween('Age', [20, 64]);
            } elseif ($AgeBracket === 'Teen') {
                $PatientRecordQuery->whereBetween('Age', [13, 19]);
            } elseif ($AgeBracket === 'Children') {
                $PatientRecordQuery->where('Age', '<', 13);
            }
        }
        if ($FilterConsultationValue) {
            $PatientRecordQuery->whereHas('medicalLogs', function ($query) use ($FilterConsultationValue) {
                $query->where('Consultation', 'like', "%{$FilterConsultationValue}%");
            });
        }

        $patients=$PatientRecordQuery->get();

        $NoDataFound = $patients->isEmpty();
        
        return view('AdminPages.PatientList', [
            'patients' => $patients,
            'NoDataFound' => $NoDataFound,
            'getAllConsultation' => $getAllConsultation
        ]);
        
    }
}
