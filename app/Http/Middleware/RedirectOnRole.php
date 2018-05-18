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
        $query   = User::where('id', $user_id)->where('role_id', $role)->first();
        if (!$query) {
            Auth::logout();
            if($role == config('constants.roles.ADMIN'))
                return redirect('/admin/error403');
            else
                return redirect('/error403');
        }
        return $next($request);
    }
}
