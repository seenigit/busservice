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
            //if user is admin, redirect to the dashboard page
            if(Auth::user()->role_id == config('constants.roles.ADMIN'))
                return redirect('/admin/dashboard');
            return redirect('/');
        }

        return $next($request);
    }
}
