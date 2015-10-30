<?php

namespace app\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Config;
class VerifyCsrfToken extends BaseVerifier
{
    public $domain;
    public $except_urls;

    public function __construct(){
        $http = "http://";
        if(!empty($_SERVER["HTTPS"])) {
            if ($_SERVER["HTTPS"] !== "off") {
                $http = "https://";
            }
        }
        //A list of pages are excluded from CSRF session token validation are in config/mycustomvars.php
        $this->domain = $http.\Request::server ("SERVER_NAME");
        foreach(Config::get('mycustomvars.no_csrf') as $page){
            $this->except_urls[] = $this->domain.$page;
        }
    }

    public function handle($request, Closure $next)
    {
        $regex = '#' . implode('|', $this->except_urls) . '#';
        if(!$this->tokensMatch($request) && !preg_match($regex, $request->path())){
            return $this->addCookieToResponse($request, $next($request));
        }
        throw new TokenMismatchException;
    }
}
