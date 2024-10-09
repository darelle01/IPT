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
    public function handle(Request $request, Closure $next, string $Position): Response
    {
        if (Auth::check()) 
        {
            if (Auth::user()->Position === $Position) 
            {
                return $next($request);
            }
            else{
                return redirect()->route('Login')->withErrors(['Not-Authorized' => 'You are not authorize to access this.']);
            }
        }
        else
        {   
            return redirect()->route('Login');
        }
        
    }
}
