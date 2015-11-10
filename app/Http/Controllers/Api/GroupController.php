<?php

namespace app\Http\Controllers\Api;

use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;
use app\Group;

class GroupController extends ApiController
{
    public function index()
    {
        $groups = Group::take(10)->get();

        return $this->respondWithCollection($groups, new GroupTransformer());
    }

    public function show($groupId)
    {
        $group = Group::find($groupId);

        if (!$group) {
            return $this->errorNotFound('Group not found');
        }

        if ($group->isUser(Auth::user()->id)) {
            return $this->respondWithItem($group, new GroupTransformer());
        } else {
            return $this->errorUnauthorized();
        }
    }

    public function getUsers($groupId)
    {
        $group = Group::find($groupId);

        if (!$group) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithCollection($group->users, new UserTransformer());
    }
}
