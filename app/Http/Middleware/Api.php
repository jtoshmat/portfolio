<?php

namespace app\Http\Middleware;

use Closure;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ACCESS_CONTROL_ALLOW_ORIGIN = env('ACCESS_CONTROL_ALLOW_ORIGIN') ? env('ACCESS_CONTROL_ALLOW_ORIGIN') : '*';

        return $next($request); //->header('Access-Control-Allow-Origin', $ACCESS_CONTROL_ALLOW_ORIGIN)
            // ->header('Access-Control-Allow-Credentials', 'true')
            // ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
            // ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With')
            // ->header('Access-Control-Max-Age', '28800');
    }
}
