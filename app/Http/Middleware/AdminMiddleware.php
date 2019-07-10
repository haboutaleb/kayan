<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
        if (Auth::check() && auth()->user()->administration_group_id != null) {
            return $next($request);
        }
        return redirect(route('dashboard_login'))->with('class', 'alert alert-warning')->with('message', trans('dash.login_firstly'));
    }
}
