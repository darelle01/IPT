<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Hash;

class AdminCreateAccountBtnController extends Controller
{
    public function createAccountBtn(Request $request)
    {
        // Validate incoming request data
        $AccountDetails = $request->validate([
            'LastName' => 'required|string',
            'FirstName' => 'required|string',
            'MiddleName' => 'required|string',
            'Birthdate' => 'required|date',
            'Age' => 'required|integer',
            'Gender' => 'required|string',
            'HouseNumber' => 'required|string',
            'Street' => 'required|string',
            'Barangay' => 'required|string',
            'Municipality' => 'required|string',
            'Province' => 'required|string',
            'email' => 'required|email|unique:accounts,email',
            'ContactNumber' => 'required|string|regex:/^\d{10}$/',
            'username' => 'required|string|unique:accounts,username',
            'password' => 'required|string|min:8|regex:/[0-9]/|regex:/[@$!%*?&#]/|regex:/[A-Z]/',       
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Handle file upload if present
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $AccountDetails['profile_picture'] = $path;
        }

        if (strpos($AccountDetails['ContactNumber'], '817') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '895') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '896') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '897') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '898') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '905') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '906') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '907') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '908') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '909') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '910') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '912') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '915') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '916') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '917') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '918') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '919') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '920') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '921') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '922') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '923') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '924') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '925') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '926') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '927') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '928') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '929') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '930') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '931') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '932') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '933') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '934') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '935') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '936') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '937') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '938') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '939') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '940') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '941') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '942') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '943') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '945') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '946') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '947') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '948') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '949') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '950') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '951') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '953') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '954') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '955') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '956') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '961') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '965') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '966') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '967') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '973') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '974') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '975') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '976') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '977') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '978') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '979') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '991') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '992') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '993') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '994') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '995') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '996') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '997') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '998') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '999') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9173') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9175') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9176') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9178') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9253') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9255') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9256') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9257') !== 0 &&
            strpos($AccountDetails['ContactNumber'], '9258') !== 0 ) {
                return redirect()->route('Admin.Create')->withErrors(['ContactNumber' => 'Invalid number']);
        }
        
        $AccountDetails['Status'] = 'Active';
        $AccountDetails['Position'] = 'Staff';
        $Prefix = 63;
        $AccountDetails['ContactNumber'] = $Prefix . $AccountDetails['ContactNumber'];
        AccountsModel::create($AccountDetails);

         
        return redirect()->route('Admin.Create')->with('Create',' Creating a new account successfully!');

    }
}
