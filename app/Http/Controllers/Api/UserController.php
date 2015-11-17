<?php

namespace app\Http\Controllers\Api;

use app\cmwn\Image;
use app\Transformer\UserTransformer;
use app\Transformer\GroupTransformer;
use app\User;
use Input;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Auth;
use app\Transformer\ImageTransformer;
use Illuminate\Support\Facades\Validator;

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
        $image = User::find($user_id)->images;
        return $this->respondWithCollection($image, new ImageTransformer());

    }

    public function updateImage($user_id){
        $validator = Validator::make(Input::all(), Image::$imageUpdateRules);
        if ($validator->passes()) {
            $user = User::find($user_id);
            $image = new Image();
            $image->url = "http://www.atilaminates.com/wp-content/uploads/2015/05/nature-wlk.jpeg"; //get the image_url from Frontend
            $image->cloudinary_id = 1;
            if ($user->images()->save($image)){
                return $this->respondWithArray(array('message' => 'The image has been updated sucessfully.'));
            }
        }
            $messages = print_r($validator->errors()->getMessages(), true);
            return $this->errorInternalError('Input validation error: '. $messages);

    }

    public function deleteImage($user_id){
        $validator = Validator::make(Input::all(), Image::$imageUpdateRules);
        if ($validator->passes()) {
            $user = User::find($user_id);
            $image = new Image();
            if ($user->images()->delete()){
                return $this->respondWithArray(array('message' => 'The image has been deleted sucessfully.'));
            }
        }
        $messages = print_r($validator->errors()->getMessages(), true);
        return $this->errorInternalError('Input validation error: '. $messages);

    }
}
