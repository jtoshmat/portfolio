<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;
use Input;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Illuminate\Http\Request;

class UserController extends ApiController
{


    // public function __construct(Manager $fractal)
    // {

    //     parent::__construct($fractal);
    // //
    //     $requestedEmbeds = Input::get('include');

    //     $possibleRelationships = [
    //         'groups' => 'groups',
    //     ];

    //     // Check for potential ORM relationships, and convert from generic "include" names
    //     $this->eagerLoad = array_keys(array_intersect($possibleRelationships, $requestedEmbeds));

    // }


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
        $user = User::with('groups')->find($userId);

        if (! $user) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithCollection($user->groups, new GroupTransformer);
    }

    public function login(){
        return csrf_token();
    }
}
