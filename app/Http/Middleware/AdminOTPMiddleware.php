<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOTPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guards = null): Response
    {
        // Checking if its not Authenticated
        if (Auth::check()) {
            $OTPVerified = session('OTPVerified');
            if (Auth::user()->Position !== 'Admin') {
                return redirect()->back();
            }
            if ($OTPVerified === true) {
                $OTPVerifiedDuration = session('OTPVerifiedDuration');
                if ($OTPVerified === true && now()->timestamp < $OTPVerifiedDuration) {
                    $OTPVerifiedDuration = now()->addMinutes(30)->timestamp;
                    session(['OTPVerified' => true,
                    'OTPVerifiedDuration' => $OTPVerifiedDuration]);
                    return $next($request);
                }
                session()->forget(['OTPVerified', 'OTPVerifiedDuration']);
                return redirect()->route('Login')->withErrors(['Session' => 'Session has expired. Please log in again.']);
            }
            return redirect()->route('Login')->withErrors(['UnAuthenticated' => 'You are not authorized to enter, please login to proceed.']);
        }
        return redirect()->route('Login')->withErrors(['UnAuthenticated' => 'You are not authorized to enter, please login to proceed.']);
    }
}
