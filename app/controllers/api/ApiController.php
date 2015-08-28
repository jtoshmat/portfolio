<?php namespace api;

use Illuminate\Support\Facades\Response;

abstract class ApiController extends \BaseController
{
    public function errorResponse($error, $code) {
        $response = Response::json(array(
            'status' => 'error',
            'error' => $error
        ), $code);
        return $response;
    }
}