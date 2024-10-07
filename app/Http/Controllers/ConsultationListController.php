<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ConsultationListModel;
use Illuminate\Http\Request;


class ConsultationListController extends Controller
{
    public function ConsultationListPage(){
        return view('AdminPages.ConsultationList');
    }
    public function FetchConsultationList(){
        $getAllConsultation = ConsultationListModel::all();
        return view('AdminPages.ConsultationList', compact('getAllConsultation'));
    }
    public function ConsultationList(Request $request){
        $AddProgram = $request->validate([
            'ConsultationList' => 'required|string|unique:consultationlist,ConsultationList'
        ]);
        ConsultationListModel::create($AddProgram);
        return redirect()->route('Admin.AddProgram')->with('Add','Adding New Program Success!');
    }
}
