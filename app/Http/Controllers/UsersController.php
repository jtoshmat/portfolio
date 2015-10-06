<?php

namespace cmwn\Http\Controllers;
use Illuminate\Support\Facades\Request;
use cmwn\RolePermission;
use cmwn\User;
use cmwn\Http\Requests;
use cmwn\Http\Controllers\Controller;
use cmwn\UserRole;
use cmwn\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function members()
    {
        //$roles = Role::All();
        //return view('users/members', compact('roles'));

        $members = User::paginate(10);
        return view('users/members', compact('members'));

    }

    public function member(){
        $id = (int)Request::segment(3);
        $action = Request::segment(4);
        $member = User::find($id);

        if ($member){
            return view('users/member', compact('member'));
        }
        return view('errors/404');
    }

    public function memberUpdate(Request $request){
        $id = (int)Request::segment(3);
        $action = Request::segment(4);

		//Form post data handling
	    if (Request::isMethod('post')) {
		    $validator = Validator::make(Input::all(), User::$memberUpdaRules);
		    if ($validator->passes()) {
				if (User::updateMember($request, $id)){
					return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors
					('Updated successfully')->with('flag', 'success');
				}else{
					return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors
					('Update failed')->with('flag', 'danger');
				}
		    }else{
			    return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors
			    ($validator)->withInput()->with('flag', 'danger');
		    }
	    }
	    //if the form is not submitted
	    $member = User::find($id);
	    $allroles = Role::All();
	    if ($member){
	        return view('users/memberupdate', compact('member','allroles'));
        }
        return view('errors/404');
    }


	public function memberDelete(Request $request)
	{
		$id = (int)Request::segment(3);
		$action = Request::segment(4);

		if (Request::isMethod('get')) {
			$validator = Validator::make(Input::all(), User::$memberDeleteRules);
			if ($validator->passes()) {
				if (User::deleteMember($id)){
					return Redirect::to('users/members')->with('message', 'The following errors occurred')->withErrors
					('Delete successfully')->with('flag', 'success');
				}else{
					return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors
					('Delete failed')->with('flag', 'danger');
				}
			}else{
				return Redirect::to('users/member/'.$id.'/update')->with('message', 'The following errors occurred')->withErrors
				($validator)->withInput()->with('flag', 'danger');
			}
		}

	}

    public function roles()
    {
        $roles = Role::paginate(10);
        return view('users/roles', compact('roles'));
    }




}
