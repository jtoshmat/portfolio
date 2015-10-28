<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;

class UserController extends ApiController
{
    public function index()
    {
        $users = User::take(10)->get();

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
