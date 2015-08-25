<?php namespace api;

use Illuminate\Support\Facades\Response;

class ApiController extends \BaseController
{
    public function errorResponse($error, $code) {
        $response = Response::json(array(
            'status' => 'error',
            'error' => $error
        ), $code);
        return $response;
    }

    public function apiResponse($data) {
        $data['status'] = 'OK';
        $response = Response::json($data, 200);
        return $response;
    }
}