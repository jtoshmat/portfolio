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
        // $header = $this->getCredentialsFromHeader();
        // $email = $header['email'];
        // $password = $header['password'];

        $ha = base64_decode(substr(\Request::header('Authorization'), 6));
        list($email, $password) = explode(':', $ha);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return $this->respondWithArray(['message' => 'Welcome!']);
        } else {
            return $this->errorUnauthorized();
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
