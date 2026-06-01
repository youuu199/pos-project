<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(auth()->check() && auth()->user()->role === 'user') {
         if(Route::currentRouteName() === 'login' || Route::currentRouteName() === 'register') {
                return back()->with('error', 'You are already logged in as an user.');
            }
            return $next($request);
        }

        return back()->with('error', 'You do not have permission to access this page.');
    }
}
