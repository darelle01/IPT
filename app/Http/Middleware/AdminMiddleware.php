<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$guards): Response
    {
        
        if (Auth::check()) {
            if (Auth::user()->Position === 'Admin') {
                return $next($request);
            }
            elseif (Auth::user()->Position === 'Staff') {
                return redirect()->back()->withErrors(['Not-Authorized' => 'Use the right login form.']);
            }
            else{
                return redirect()->route('Login')->withErrors(['Not-Authorized' => 'You are not authorize to access this.']);
            }
        }
        elseif (!Auth::guard($guards)->check()) {
            return redirect()->route('Login');
        }
        else
        {
            return redirect()->route('Login');
        }
        
    }
}
