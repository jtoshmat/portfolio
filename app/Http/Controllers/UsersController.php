<?php

namespace cmwn\Http\Controllers;

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
        $roles = User::all();
        if (!$roles){
            return 'No record found';
        }
         foreach($roles as $role){
             $data = $role->role;
             return view('users/members')->with('members', $data);
         }
        return '';



        return view('users/members')->with('members', $data);

    }

}
