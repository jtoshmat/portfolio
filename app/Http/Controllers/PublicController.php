<?php

namespace jontoshmatov\Http\Controllers;

use Illuminate\Http\Request;
use jontoshmatov\Http\Requests;
use jontoshmatov\Http\Controllers\Controller;

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
