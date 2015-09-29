<?php

namespace cmwn\Http\Controllers;

use Illuminate\Http\Request;
use cmwn\Http\Requests;
use cmwn\Http\Controllers\Controller;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "public";
    }

}
