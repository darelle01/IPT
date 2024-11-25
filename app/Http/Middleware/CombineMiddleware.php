<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CombineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $OTPVerified = session('OTPVerified');
            if (Auth::user()->Status === 'Deactivated') {
                return redirect()->route('Login')->withErrors(['Session' => 'Your Account is Deactivated.']);
            }
            if ((Auth::user()->Position !== 'Staff' && Auth::user()->Position !== 'Admin'))
            {
                return redirect()->route('Login')->withErrors(['UnAuthenticated' => 'You are not authorized to access.']);
            }
            $OTPVerifiedDuration = session('OTPVerifiedDuration');
            if (now()->timestamp > $OTPVerifiedDuration) {
                /** @var AccountsModel $user */
                $user = Auth::user(); 
                $user->ActivityStatus = 'Offline';
                $user->save();
            }
            
            if ($OTPVerified === true) {
                $OTPVerifiedDuration = session('OTPVerifiedDuration');
                if ($OTPVerified === true && now()->timestamp < $OTPVerifiedDuration) {
                    $OTPVerifiedDuration = now()->addMinutes(30)->timestamp;
                    session(['OTPVerified' => true,
                    'OTPVerifiedDuration' => $OTPVerifiedDuration]);
                    return $next($request);
                }
                /** @var AccountsModel $user */
                $user = Auth::user(); 
                $user->ActivityStatus = 'Offline';
                $user->save();
                session()->forget(['OTPVerified', 'OTPVerifiedDuration']);
                return redirect()->route('Login')->withErrors(['Session' => 'Session has expired. Please log in again.']);
            }
            return redirect()->route('Login')->withErrors(['UnAuthenticated' => 'You are not authorized to enter, please login to proceed.']);
        }
        return redirect()->route('Login')->withErrors(['UnAuthenticated' => 'You are not authorized to enter, please login to proceed.']);
    }
      
}
