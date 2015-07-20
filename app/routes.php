<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::any("/", [
  "as"   => "user/login",
  "uses" => "UserController@login"
]);

Route::any("users/login", [
  "as"   => "user/login",
  "uses" => "UserController@login"
]);

Route::any("users", [
  "as"   => "user/users",
  "uses" => "UserController@users"
]);

Route::any("events", [
  "as"   => "bars/events",
  "uses" => "UserController@events"
]);

Route::group(["before" => "auth"], function() {

  Route::any("/profile", [
    "as"   => "user/profile",
    "uses" => "UserController@profile"
  ]);

Route::any("/bar", [
    "as"   => "bars/bar",
    "uses" => "UserController@viewBar"
  ],function($id){
    return $id;
  });

Route::any("/editbar", [
    "as"   => "bars/editbar",
    "uses" => "UserController@editBar"
  ],function($id){
    return $id;
  });

Route::any("/deletebar", [
    "as"   => "bars/deletebar",
    "uses" => "UserController@deleteBar"
  ],function($id){
    return $id;
  });

Route::post("/updatebar", [
    "as"   => "bars/updatebar",
    "uses" => "UserController@updateBar"
  ],function($id){
    return $id;
  });
 

  Route::any("/logout", [
    "as"   => "user/logout",
    "uses" => "UserController@logout"
  ]);

});

Route::any("/request", [
  "as"   => "user/request",
  "uses" => "UserController@request"
]);

Route::any("/reset/{token}", [
  "as"   => "user/reset",
  "uses" => "UserController@reset"
]);
