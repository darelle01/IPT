<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffOTPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Checking if its not Authenticated
        if (!Auth::check()) {
            return redirect()->route('Login')->withErrors(['UnAuthenticated' => 'You are not authorized to enter, please login to proceed.']);
        }
        if (Auth::user()->Status === 'Deactivated') {
            return redirect()->route('Login')->withErrors(['Not-Authorized' => 'Your Account is Deactivated..']);
        }
        if (Auth::user()->Position !== 'Staff') {
            return redirect()->back();
        }
        // if its Authenticated check if its already verified
        if (session('OTPVerified') === true) {
            
            // if Authenticated but the Verification duration is expired logout the user 
            if (now()->greaterThan(session('OTPVerifiedDuration'))) {
                /** @var AccountsModel $user */
                session()->forget(['OTPVerified', 'OTPVerifiedDuration']);
                $ActivityStatus = 'Offline';
                $user->ActivityStatus = $ActivityStatus; 
                $user->save();
                return redirect()->route('Login')->withErrors(['Session' => 'Session has expired. Please log in again.']);
            }
            // if  Authenticated and Verification is still valid redirect to Dashboard
            return redirect()->route('Admin.Dashboard');
        }
        // if  Authenticated and not verified yet redirect to Staff Verification Page
        return redirect()->route('StaffOTP.Page');
    }
}