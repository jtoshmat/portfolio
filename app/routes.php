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

Route::any("error", [
  "as"   => "errors/error",
  "uses" => "UserController@error"
]);

Route::any("/", [
  "as"   => "user/login",
  "uses" => "UserController@login"
]);

Route::any("users/login", [
  "as"   => "user/login",
  "uses" => "UserController@login"
]);

  Route::any("register", [
    "as"   => "register",
    "uses" => "UserController@register"
    ]);

Route::any("users", [
  "as"   => "user/users",
  "uses" => "UserController@users"
]);

Route::any("bevents", [
  "as"   => "bars/bevents",
  "uses" => "BarController@bevents"
]);

Route::any("/bevent", [
    "as"   => "bars/bevent",
    "uses" => "BarController@bevent"
  ],function($id){
    return $id;
  });

Route::any("/editbevent", [
    "as"   => "bars/editbevent",
    "uses" => "BarController@editBevent"
  ],function($id){
    return $id;
  });

Route::group(["before" => "auth"], function() {

            Route::any("bars", [
              "as"   => "bars",
              "uses" => "BarController@bars"
            ]);

          Route::any("/bar", [
              "as"   => "bars/bar",
              "uses" => "BarController@bar"
            ],function($id){
              return $id;
            });

          Route::any("addbar", [
              "as"   => "bars/addbar",
              "uses" => "BarController@addBar"
            ],function($id){
              return $id;
            });

          Route::any("upload", [
              "as"   => "bars/upload",
              "uses" => "BarController@uploadImage"
            ],function($id){
              return $id;
            });

          Route::any("/editbar", [
              "as"   => "bars/editbar",
              "uses" => "BarController@editBar"
            ],function($id){
              return $id;
            });

          Route::post("/updatebevent", [
              "as"   => "bars/updatebevent",
              "uses" => "BarController@updateBevent"
            ],function($id){
              return $id;
            });

          Route::any("deletebevent", [
              "as"   => "bars/deletebevent",
              "uses" => "BarController@deleteBevent"
            ],function($id){
              return $id;
            });

          Route::any("/deletebar", [
              "as"   => "bars/deletebar",
              "uses" => "BarController@deleteBar"
            ],function($id){
              return $id;
            });

          Route::post("/updatebar", [
              "as"   => "bars/updatebar",
              "uses" => "BarController@updateBar"
            ],function($id){
              return $id;
            });

//            Route::get("user", [
//                "as"   => "user",
//                "uses" => "UserController@getUser"
//            ],function($id){
//                return $id;
//            });





/*            Route::get('user/{id}', array('as' => 'user', function($id)
            {
                // return our view and Nerd information
                return View::make('users/user') // pulls app/views/nerd-edit.blade.php
                ->with('nerd', User::find($id));
            }));*/

           Route::any('user/{id}', [
	           "as"   => "user",
	           "uses" => "UserController@getUser"
           ],function($id){
	           return $id;
           });

           Route::any('user/delete/{id}', [
	           "as"   => "user/delete",
	           "uses" => "UserController@deleteUser"
           ],function($id){
	           return $id;
           });

			Route::any('user/viewuser/{id}', [
				"as"   => "user/viewuser",
				"uses" => "UserController@viewUser"
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
 
