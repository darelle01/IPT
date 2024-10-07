<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patientrecord;
use Illuminate\Support\Facades\Crypt;

class SearchResultController extends Controller
{
    public function SearchResult(Request $request)
    {
       
        $validated = $request->validate([
            'Search' => 'nullable|string',
        ]);

        
        $Search = $validated['Search'] ?? '';
        if (empty($Search)) {
           
            $patientsBasicInfo = ['message' => 'No results found.'];
        } else {
            
            $patientsBasicInfo = patientrecord::where('LastName', 'like', "%$Search%")
                ->orWhere('FirstName', 'like', "%$Search%")
                ->orWhere('PatientID', 'like', "%$Search%")
                ->orWhere('PhilHealthNumber', 'like', "%$Search%")
                ->get();
    
            
            if ($patientsBasicInfo->isEmpty()) {
                $patientsBasicInfo = ['message' => 'No results found.'];
            }
        }
        $EncryptedpatientsBasicInfo = Crypt::encrypt($patientsBasicInfo);
        session(['EncryptedpatientsBasicInfo' => $EncryptedpatientsBasicInfo,'Search' => $Search]);
        return redirect()->route('Admin.SearchResult');
    }
}
