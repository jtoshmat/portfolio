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
        $response = $next($request);

        // Set the default headers for cors If you only want this for OPTION method put this in the if below
        $response->headers->set('Access-Control-Allow-Origin', 'http://dev.changemyworldnow.com');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, OPTIONS, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, Authorization');
        $response->headers->set('Access-Control-Allow-Credentials', true);

        // Set the allowed methods for the specific uri if the request method is OPTION
        if ($request->isMethod('options')) {
            $response->headers->set('Access-Control-Allow-Methods', $response->headers->get('Allow');
        }

        return $response;
    }
}
