<?php

namespace app\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Config;
class VerifyCsrfToken extends BaseVerifier
{
    protected $except_urls = [
        'contact/create',
        'contact/update',
    ];

    public function handle($request, Closure $next)
    {
        $regex = '#' . implode('|', $this->except_urls) . '#';

        if ($this->isReading($request) || $this->tokensMatch($request) || preg_match($regex, $request->path()))
        {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }
}
