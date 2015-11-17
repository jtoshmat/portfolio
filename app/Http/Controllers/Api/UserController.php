<?php

namespace app\Http\Controllers\Api;

use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;
use Input;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Auth;

use app\Transformer\ImageTransformer;

class UserController extends ApiController
{
    public function index()
    {
        $query = \Request::get('name') or null;

        if ($query) {
            $users = User::name($query)->get();
        } else {
            $users = User::take(10)->get();
        }

        return $this->respondWithCollection($users, new UserTransformer());
    }

    public function show($userId)
    {
        if ($userId ==  'me') {
            $user = Auth::user();
        } else {
            $user = User::find($userId);
        }

        if (!$user) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithItem($user, new UserTransformer());
    }

    public function getGroups($userId)
    {
        $user = User::with('groups')->find($userId);

        if (!$user) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithCollection($user->groups, new GroupTransformer());
    }

    public function login()
    {
        return csrf_token();
    }


    public function showImage($user_id){
        $image = User::find(1)->images;
        return $this->respondWithCollection($image, new ImageTransformer());

    }

    public function updateImage(){
        return "updating image";

    }

    public function deleteImage(){
        return "deleting image";
    }
}
