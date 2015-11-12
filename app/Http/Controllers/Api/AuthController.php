<?php

namespace app\Http\Controllers\Api;

use Auth;
use Session;

class AuthController extends ApiController
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        $ha = base64_decode(substr(\Request::header('Authorization'), 6));
        list($email, $password) = explode(':', $ha);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return $this->respondWithArray(array('session_id' => Session::getId()));
        } else {
            return $this->errorUnauthorized();
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
