<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        error_log('dadada');
        
        if (Auth::check()) {

            if (Auth::user()->role == 1) {
                return $next($request);
            }else if(Auth::user()->role == 2){
                return redirect('/manager/home');
            }else if(Auth::user()->role == 3){
                return redirect('/seller/home');
            }
        }

        return redirect('/');
    }
}
