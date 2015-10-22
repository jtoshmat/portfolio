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

	    $friends = User::where('name','like', '%'.$keyword.'%')->get();
	    return view('partials.results',compact('friends'));
    }

	public function friendship(Request $request){
		$action = \Request::segment(4);
		$friend_id = \Request::segment(3);
		switch($action){
			case 'add':
				$this->addFriend($friend_id);
				return redirect()->back()->with('keyword');
				break;
			case 'accept':
				$this->acceptFriend($friend_id);
				return redirect()->back()->with('keyword');
				break;
			case 'delete':
				$this->deleteFriend($friend_id);
				return redirect()->back()->with('keyword');
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
		if (!$duplicate = $user->friends->contains($friend_id)){
			return $user->friends()->attach($ids);
		}
		return false;
	}

	protected function deleteFriend($friend_id){
		$fid = $friend_id;
		$user = User::find($this->myid);
		if ($friend_id == $user->id){
			return false;
		}
		$ids=array($friend_id);
		$ids = ($ids)?$ids:array();
		$user->friends()->detach($ids);
		$update1 = \DB::table('friends')
			->where('user_id', $fid)
			->where('friend_id',$this->myid)
			->delete();
	}

	protected function acceptFriend($friend_id){
		$fid = $friend_id;
		$user = User::find($this->myid);
		if ($friend_id == $user->id){
			return false;
		}
		$ids=array($friend_id);
		$ids = ($ids)?$ids:array();
		$user->friends()->attach($ids);

		$update1 = \DB::table('friends')
			->where('user_id', $this->myid)
			->where('friend_id',$fid)
			->update(['status' => 1]);

		$update2 = \DB::table('friends')
			->where('user_id', $fid)
			->where('friend_id',$this->myid)
			->update(['status' => 1]);
		return true;

	}


}
