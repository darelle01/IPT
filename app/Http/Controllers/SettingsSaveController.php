<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class SettingsSaveController extends Controller
{
    public function SaveAccountUpdate(Request $request){
        $AccountUpdate = $request->validate([
            'LastName' => 'string',
            'FirstName' => 'string',
            'MiddleName' => 'string',

            'Birthdate' => 'date',
            'Age' => 'integer',
            'Gender' => 'string',

            'HouseNumber' => 'string',
            'Street' => 'string',
            'Barangay' => 'string',
            'Municipality' => 'string',
            'Province' => 'string',

            'email' => 'email',
            'ContactNumber' => 'string|regex:/^\d{10}$/',

            'username' => 'nullable|string',
            'password' => 'nullable|string|min:8|regex:/[0-9]/|regex:/[@$!%*?&#]/|regex:/[A-Z]/',      
        ]);

        if (empty($AccountUpdate['username']) && filled($AccountUpdate['password'])) {
            $AccountUpdate['username'] = Auth::user()->username;
            $Update = AccountsModel::where('username', $AccountUpdate['username'])->first();

            if ($Update) {
                $Update->update([
                    'LastName' => $AccountUpdate['LastName'],
                    'FirstName' => $AccountUpdate['FirstName'],
                    'MiddleName' => $AccountUpdate['MiddleName'],
                    'Birthdate' => $AccountUpdate['Birthdate'],
                    'Age' => $AccountUpdate['Age'],
                    'Gender' => $AccountUpdate['Gender'],
                    'HouseNumber' => $AccountUpdate['HouseNumber'],
                    'Street' => $AccountUpdate['Street'],
                    'Barangay' => $AccountUpdate['Barangay'],
                    'Municipality' => $AccountUpdate['Municipality'],
                    'Province' => $AccountUpdate['Province'],
                    'email' => $AccountUpdate['email'],
                    'ContactNumber' => $AccountUpdate['ContactNumber'],
                    'password' => $AccountUpdate['password'],
                ]);
                $Update->ActivityStatus = 'Offline'; 
                $Update->save();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('Login');
            }
        } elseif (filled($AccountUpdate['username']) && empty($AccountUpdate['password'])) {
            $AccountUpdate['password'] = Auth::user()->password;

            $Update = AccountsModel::where('username', Auth::user()->username)->first();
            if ($Update) {
                $Update->update([
                    'LastName' => $AccountUpdate['LastName'],
                    'FirstName' => $AccountUpdate['FirstName'],
                    'MiddleName' => $AccountUpdate['MiddleName'],
                    'Birthdate' => $AccountUpdate['Birthdate'],
                    'Age' => $AccountUpdate['Age'],
                    'Gender' => $AccountUpdate['Gender'],
                    'HouseNumber' => $AccountUpdate['HouseNumber'],
                    'Street' => $AccountUpdate['Street'],
                    'Barangay' => $AccountUpdate['Barangay'],
                    'Municipality' => $AccountUpdate['Municipality'],
                    'Province' => $AccountUpdate['Province'],
                    'email' => $AccountUpdate['email'],
                    'ContactNumber' => $AccountUpdate['ContactNumber'],
                    'username' => $AccountUpdate['username'],
                ]);
                $Update->ActivityStatus = 'Offline'; 
                $Update->save();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('Login');
            }
        } elseif (filled($AccountUpdate['username']) && filled($AccountUpdate['password'])) {
            $OldUsername = Auth::user()->username;
            $Update = AccountsModel::where('username', $OldUsername)->first();
            if ($Update) {
                $Update->update([
                    'LastName' => $AccountUpdate['LastName'],
                    'FirstName' => $AccountUpdate['FirstName'],
                    'MiddleName' => $AccountUpdate['MiddleName'],
                    'Birthdate' => $AccountUpdate['Birthdate'],
                    'Age' => $AccountUpdate['Age'],
                    'Gender' => $AccountUpdate['Gender'],
                    'HouseNumber' => $AccountUpdate['HouseNumber'],
                    'Street' => $AccountUpdate['Street'],
                    'Barangay' => $AccountUpdate['Barangay'],
                    'Municipality' => $AccountUpdate['Municipality'],
                    'Province' => $AccountUpdate['Province'],
                    'email' => $AccountUpdate['email'],
                    'ContactNumber' => $AccountUpdate['ContactNumber'],
                    'username' => $AccountUpdate['username'],
                    'password' => $AccountUpdate['password'],
                ]);
                $Update->ActivityStatus = 'Offline'; 
                $Update->save();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('Login');
            }
        } else {
            $Update = AccountsModel::where('username', Auth::user()->username)->first();

            if ($Update) {
                $Update->update([
                    'LastName' => $AccountUpdate['LastName'],
                    'FirstName' => $AccountUpdate['FirstName'],
                    'MiddleName' => $AccountUpdate['MiddleName'],
                    'Birthdate' => $AccountUpdate['Birthdate'],
                    'Age' => $AccountUpdate['Age'],
                    'Gender' => $AccountUpdate['Gender'],
                    'HouseNumber' => $AccountUpdate['HouseNumber'],
                    'Street' => $AccountUpdate['Street'],
                    'Barangay' => $AccountUpdate['Barangay'],
                    'Municipality' => $AccountUpdate['Municipality'],
                    'Province' => $AccountUpdate['Province'],
                    'email' => $AccountUpdate['email'],
                    'ContactNumber' => $AccountUpdate['ContactNumber'],
                ]);
                return redirect()->route('Settings.View'); 
            }
        }  
    }
}
