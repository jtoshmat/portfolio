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

    public function apiResponse($data) {
        $response = \Response::json(array(
            'status' => 'OK',
            'data' => $data
        ), 200);
        return $response;
    }

    public function apiResponseJSONP($data) {
        $response = \Response::json(array(
            'status' => 'OK',
            'data' => $data
        ), 200)->setCallback(\Input::get('callback'));
        return $response;
    }

}