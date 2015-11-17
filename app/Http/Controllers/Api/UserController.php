<?php

namespace app\Http\Controllers\Api;

use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;
use Input;
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

    public function update($userId)
    {
        if ($userId ==  'me') {
            $user = Auth::user();
        } else {
            $user = User::find($userId);
        }

        if ($user->updateMember(Input::all())) {
            return $this->respondWithItem($user, new UserTransformer());
        } else {
            return $this->errorInternalError('Could not save user.');
        }

        // $validator = Validator::make(Input::all(), User::$memberUpdaRules);
        // if ($validator->passes()) {
        //     if (User::updateMember($request, $id)) {
        //         return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors('Updated successfully')->with('flag', 'success');
        //     } else {
        //         return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors('Update failed')->with('flag', 'danger');
        //     }
        // } else {
        //     return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors($validator)->withInput()->with('flag', 'danger');
        // }
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

    public function showImage($user_id)
    {
        $image = User::find(1)->images;

        return $this->respondWithCollection($image, new ImageTransformer());
    }

    public function updateImage()
    {
        return 'updating image';
    }

    public function deleteImage()
    {
        return 'deleting image';
    }
}
