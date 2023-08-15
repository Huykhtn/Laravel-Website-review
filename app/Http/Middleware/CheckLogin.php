<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::check()){
        //     return $next($request);
        // }
       
            // dd(Auth::check());
        if (Auth::check()) {
            
            return $next($request);
        }

        return redirect()->route('auth.view-login');

        
    }

    
}
