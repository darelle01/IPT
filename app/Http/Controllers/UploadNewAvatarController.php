<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadNewAvatarController extends Controller
{
    public function UploadNewAvatar(Request $request){
        $Image = $request->validate([
            'profile_picture' => 'nullable|image|max:4096',
            'targetAcc' => 'required|string',
        ]);
        if ($request->hasFile('profile_picture')) { // Fetch the current user 
            $user = AccountsModel::where('username' , $Image['targetAcc'])->first();
           
            if ($user->profile_pictures) { 
                Storage::disk('public')->delete($user->profile_picture); 
            }
            $file = $request->file('profile_picture');
            $path = $file->store('profile_picture', 'public'); 
            $Image['profile_picture'] = $path;
            
            $user->profile_picture = $path; 
            $user->save(); 
        }
        return redirect()->route('Settings.View');
    }
}
