<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class RedirectOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //Check if requested user have access to this route. if not redirect to the user home page
        if( Auth::user()->role_id != $role ) {
            if( Auth::user()->role_id == config('constants.roles.ADMIN') )
                return redirect('/admin/dashboard');
            return redirect('/');
        }

        return $next($request);
    }
}
