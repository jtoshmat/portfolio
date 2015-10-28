<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function index()
    {
        $query = \Request::get('name') or NULL;

        if ( $query ) {
            $users = User::name($query)->get();
        }else{
            $users = User::take(10)->get();
        }
        return $this->respondWithCollection($users, new UserTransformer);
    }

    public function show($userId)
    {
        $user = User::find($userId);

        if (! $user) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithItem($user, new UserTransformer);
    }

    public function getGroups($userId)
    {
        $user = User::find($userId);

        if (! $user) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithCollection($user->groups, new GroupTransformer);
    }
}
