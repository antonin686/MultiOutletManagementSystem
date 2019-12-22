<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            
            if (auth()->user()->role == 1) {
                return redirect('/admin/home');
            } else if (auth()->user()->role == 2) {
                return redirect('/manager/home');
            } else if (auth()->user()->role == 3){
                return redirect('/seller/home');
            }
        }

        return $next($request);
    }
}
