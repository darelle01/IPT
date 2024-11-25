<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;

class DeactivateAccountController extends Controller
{
    public function DeactivateAcc(Request $request){
        $DeActivate = $request->validate([
            'Deactivate' => 'required|string',
        ]);
        $user = AccountsModel::where('username', $DeActivate['Deactivate'])->first();

        if($user){
            $Status = 'Deactivated';
            $ActivityStatus = 'Offline';
            $user->Status = $Status;
            $user->ActivityStatus = $ActivityStatus;
            $user->save();
            return redirect()->back();
        }
        return redirect()->back();
    }
}
