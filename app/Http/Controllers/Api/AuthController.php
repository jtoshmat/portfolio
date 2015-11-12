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
        $header = $this->getCredentialsFromHeader();
        $email = $header['email'];
        $password = $header['password'];

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
