<?php

namespace Modules\Authentication\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class CountryTenant 
{
   /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Incoming request instance.
     * @param \Closure                 $next    Next middleware in the stack.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
   
        $code = $this->resolveCodeTenant($request);
        Request::macro('countryCode', function ($codeDeafult = "") use(&$code) {
          
            return $code;
        });

        return $next($request);
    }


    /**
     * Resolve the country code .
     
     */
    private function resolveCodeTenant( &$request)
    {
        $code = $request->header('x-tenant-code');
        if($code) return $code;
        return "965" ;
    }

}
