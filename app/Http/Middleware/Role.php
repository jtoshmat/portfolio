<?php

namespace cmwn\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

class Role
{

	public function __construct(Guard $auth)
	{
		$this->user = $auth->user();
	}
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next, $role)
	{
		$role = array_values(explode(';',$role));
		dd($role);
		if (!$this->user->hasRole($role)) {
			return Redirect::intended('/users/members');
		}
		return $next($request);
	}
}
