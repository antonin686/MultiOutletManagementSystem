<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Manager
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
        if (Auth::check()) {

            if (Auth::user()->role == 2) {
                return $next($request);
            }else if(Auth::user()->role == 1){
                return redirect('/admin/home');
            }else if(Auth::user()->role == 3){
                return redirect('/seller/home');
            }
        }

        return redirect('/');
    }
}
