<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Storage;

class DeleteAvatarController extends Controller
{
    public function DeleteAvatar(Request $request){
        $Image = $request->validate([
            'targetAcc' => 'required|string',
        ]);
        $user = AccountsModel::where('username' , $Image['targetAcc'])->first();
        $user->profile_pictures;
        Storage::disk('public')->delete($user->profile_picture);
        return redirect()->route('Settings.View');
    }
}
