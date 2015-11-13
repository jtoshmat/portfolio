<?php

namespace app\Http\Middleware;

use Closure;
use Response;

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
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');

        if (Request::getMethod() == 'OPTIONS') {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            $headers = [
                'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization',
            ];

            return Response::make('You are connected to the API', 200, $headers);
        }
    }
}
