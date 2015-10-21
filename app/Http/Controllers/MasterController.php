<?php

namespace app\Http\Controllers;

use app\User;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $myid;

	public function __construct(){
	    $this->myid = Auth::user()->id;
    }

	public function search(Request $request)
    {
	    $keyword = $request->get('keyword');
	    if ($keyword==''){
	        return array();
        }

	    $users = User::where('name','like', '%'.$keyword.'%')->get();
	    return view('partials.results',compact('users'));
    }

	public function friendship(Request $request){
		$action = \Request::segment(4);
		$friend_id = \Request::segment(3);
		switch($action){
			case 'add':
				dd($this->addFriend($friend_id));
				break;
			default:
				break;
		}
	}


	protected function addFriend($friend_id){
        $user = User::find($this->myid);
		if ($friend_id == $user->id){
			return false;
		}
		$ids=array($friend_id);
		$ids = ($ids)?$ids:array();
		return $user->friends()->sync($ids);
	}


}
