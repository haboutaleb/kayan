<?php

namespace App\Http\Middleware;

use Closure;

class DashboardCheckPerms
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
        if (auth()->user()->admin_group->permissions == "") {
            abort(401);
        }
        if (auth()->user()->admin_group->permissions == "*" || in_array($perms, json_decode(auth()->user()->admin_group->permissions))) {
            return $next($request);
        }
        abort(401);
    }
}
