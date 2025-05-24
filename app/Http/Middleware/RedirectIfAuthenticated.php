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
            if (Auth::user()->can('dashboard_access')) {
                return redirect()->route('dashboard.home');
            }

            if (Auth::user()->can('workers_access')) {
                return redirect()->route('vendor.home');
            }

            return redirect()->intended(route('frontend.home'));
        }

        return $next($request);
    }
}
