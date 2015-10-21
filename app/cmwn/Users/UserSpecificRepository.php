<?php

namespace app\cmwn\Users;
use app\Repositories\SideBarItems;
use app\User;
use Illuminate\Support\Facades\Auth;

class UserSpecificRepository
{

    public $tag;

	public function __construct(SideBarItems $tag){
		$this->tag = $tag;
	}

	public function compose($view){

		$friends = array();
		$pendingfriends = array();
		if (Auth::check()) {
			$friends = User::find(Auth::user()->id)->friends;
			$pendingfriends = User::find(Auth::user()->id)->pendingfriends;
		}

		$view->with('tags', $this->tag->getAll())->with('friends', $friends)->with('pendingfriends', $pendingfriends);
	}

}
