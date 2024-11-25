<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;

class ActivateAccountController extends Controller
{
    public function ActivateAcc(Request $request){
        $Activate = $request->validate([
            'Activate' => 'required|string',
        ]);
        $user = AccountsModel::where('username', $Activate['Activate'])->first();

        if($user){
            $Status = 'Active';
            $user->Status = $Status;
            $user->save();
            return redirect()->back();
        }
        return redirect()->back();
    }
}
