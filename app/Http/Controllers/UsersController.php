<?php

namespace cmwn\Http\Controllers;

use cmwn\RolePermission;
use cmwn\User;
use Illuminate\Http\Request;
use cmwn\Http\Requests;
use cmwn\Http\Controllers\Controller;
use cmwn\UserRole;
use cmwn\Role;

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

    public function roles()
    {
        $roles = Role::paginate(10);
        return view('users/roles', compact('roles'));

    }

}
