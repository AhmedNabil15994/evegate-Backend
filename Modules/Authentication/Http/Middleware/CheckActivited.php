<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActivited
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        
        if(auth()->check() && auth()->user()->is_active){
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => __("authentication::api.verified.not_active"),
            ], 405);
        }
        return redirect()->route("frontend.home")->withError(__("authentication::api.verified.not_active"));

       
    }
}
