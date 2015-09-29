<?php

namespace jontoshmatov\Http\Controllers;

use Illuminate\Http\Request;
use jontoshmatov\Http\Requests;
use jontoshmatov\Http\Controllers\Controller;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('members/welcome');
    }

}
