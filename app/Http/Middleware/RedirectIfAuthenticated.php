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
            if(Auth::user()->type == 'admin'){
                return redirect('/admin');
            }
            if(Auth::user()->type == 'sellers'){
                return redirect('/seller');
            }
            if(Auth::user()->type == 'clients'){
                return redirect('/client');
            }
        }

        return $next($request);
    }
}
