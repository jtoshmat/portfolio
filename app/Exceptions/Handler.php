<?php

namespace app\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use app\Http\Controllers\ApiResponseController;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //return parent::render($request, $e);
        $msg = $e->getMessage()." on file: ".$e->getFile().":".$e->getLine();
        $error = "
{
  \"response\": {
    \"code\": \"CTX-INTERNAL-ERROR\",
    \"http_code\": 500,
    \"message\": \"{$msg}\"
  }
}
        ";

        return response($error,'404');
        $response  = new ApiResponseController();
        $msg = "Caretraxx System error has occured: \n". $e->getMessage()."\n on file: ".$e->getFile().":".$e->getLine();
        echo $msg;
        return $response->errorInternalError($msg);
        exit;
    }
}
