<?php

namespace App\Http\Controllers;

use App\Models\patientrecord;
use Illuminate\Support\Facades\Crypt;

class SearchResultViewController extends Controller
{
    public function SearchResultView()
    {
        $patientsBasicInfo = Crypt::decrypt(session('EncryptedpatientsBasicInfo'));
        $Search = session('Search');
        return view('AdminPages.SearchResult', compact('patientsBasicInfo','Search'));
    }
}
