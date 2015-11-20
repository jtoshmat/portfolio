<?php

namespace app\Http\Controllers\Api;

use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use app\User;
use Illuminate\Support\Facades\Hash;

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

    public function updatePassword(){
        $curent_user_id = (int) Input::get('current_user_id');
        if(!$this->currentUser->canUpdate($this->currentUser) && $curent_user_id !== $this->currentUser->id){
            return $this->errorUnauthorized();
        }
        $validator = Validator::make($data = Input::all(), User::$passwordUpdateRules);
        if ($validator->fails())
        {
            $messages = print_r($validator->errors()->getMessages(), true);
            return $this->errorInternalError('Input validation error: '. $messages);
        }
        $updating_user_id = (int) Input::get('updating_user_id');
        $user = User::findFromInput($updating_user_id);

        if($user->updatePassword($user, $data['password_confirmation'])) {
            return $this->respondWithArray(array('message' => 'The password has been updated successfully.'));
        }
        return $this->errorInternalError('Something went wrong, please try again.');
    }

    public function logout()
    {
        Auth::logout();
    }
}
