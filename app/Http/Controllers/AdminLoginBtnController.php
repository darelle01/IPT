<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginBtnController extends Controller
{
    public function AdminLoginBtn(Request $request)
    {
        
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            
            $user = Auth::user();

            
            if ($user->Position === 'Admin') {
                $request->session()->regenerate();
                return redirect()->route('Admin.Dashboard')->with('user', $user);
            } else {
                Auth::logout();
                return back()->withErrors([
                    'loginError' => 'You are not authorized to access this page.',
                ])->withInput($request->only('username'));
            }
        } else {
            
            return back()->withErrors([
                'loginError' => 'The username or the password you provide is incorrect.',
            ])->withInput($request->only('username'));
        }
    }
}
