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

    public function roles()
    {
        $roles = Role::paginate(10);
        return view('users/roles', compact('roles'));

    }



}
