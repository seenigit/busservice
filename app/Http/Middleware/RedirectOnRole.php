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
        $user_id = Auth::user()->id;
        $role_id = $role;
        $query   = User::where('id', $user_id)->where('role_id', $role_id)->first();
        if (!$query) {
            Auth::logout();
            if($role_id == 1)
                return redirect('/admin/error403');
            else
                return redirect('/error403');
        }
        return $next($request);
    }
}
