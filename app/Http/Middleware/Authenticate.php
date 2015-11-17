<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $segment = $request->segment(1);

        if ($this->auth->guest()) {
            if ($segment == 'admin') {
                return redirect()->guest('auth/login');
            } else {
                return response('Unauthorized', 401);
            }
        }

        return $next($request);
    }
}
