<?php

namespace app\Http\Controllers\Api;

use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;
use app\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends ApiController
{
    const MEMBER_ID =3;
    protected $userID;

    public function __construct(){
        $this->userID = Auth::user()->id;
    }

    public function show(){
        return User::find($this->userID)->friendrequests->lists('id');
    }

    public function accept(){
        $friend_id = \Request::segment(3);
        return $this->executeRequest($friend_id, 1);
    }

    public function reject(){
        $friend_id = \Request::segment(3);
        return $this->executeRequest($friend_id, -1);
    }

    public function ignore(){
        $friend_id = \Request::segment(3);
        return $this->executeRequest($friend_id, -2);
    }


    public static function areWeFriends($user_id, $friend_id){
        return User::whereHas('friends', function ($query) use ($friend_id, $user_id) {
            $query->where('status', 0)->where('friend_id',$friend_id)->where('user_id',$user_id);
        });
    }

    public static function areWeInSameClass($user_id, $friend_id){
        $groups = User::find($user_id)->groups->lists('id');
        return User::find($friend_id)->whereHas('groups', function ($query) use ($groups,$friend_id,$user_id) {
            $query->whereIn('roleable_id', $groups)->whereIn('role_id', array(self::MEMBER_ID))->where('user_id',$friend_id);
        });
    }

    public function executeRequest($friend_id, $status){
        list(, $caller) = debug_backtrace(false);
        $requestedFunction = $caller['function'];

        $isRequestLegit = self::areWeFriends($this->userID, $friend_id);
        if ($isRequestLegit->count()==0){
            return $this->errorInternalError('No active friend request found.');
        }
        $areWeInTheSameClass = self::areWeInSameClass($this->userID, $friend_id);
        if ($areWeInTheSameClass->count()==0){
            return $this->errorInternalError('Sorry you are not in the same class as a student.');
        }

        if ($requestedFunction == 'ignore'){
            //@TODO: maybe schedule it so it will send a reminder in certain days to the user.
            return $this->respondWithArray(array('message' => 'ignore option has not been discussed.'));
        }

        User::find($friend_id)->friends()->sync(array($this->userID));
        User::find($this->userID)->friends()->updateExistingPivot($friend_id,array('status'=>$status));
        User::find($this->userID)->friendrequests()->updateExistingPivot($friend_id,array('status'=>$status));

        if ($requestedFunction == 'reject'){
            User::find($friend_id)->friends()->detach(array($this->userID));
        }

        return $this->respondWithArray(array('message' => 'friend request has been updated.'));
    }
}
