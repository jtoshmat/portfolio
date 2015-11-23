<?php

namespace app\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GameController extends ApiController
{
    public function index(){
        return "index";
    }

    public function show(){
        return "show";
    }

    public function update(){
        return "update";
    }
    public function delete(){
        return "delete";
    }
}
