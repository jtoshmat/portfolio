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

	Route::get('bar_test', function() {
		$bars = Bar::all();
		return $bars;
	});

	Route::get('env_test', function() {
		dd(App::environment());
	});

	Route::any("error", [
		"as"   => "errors/error",
		"uses" => "UserController@error"
	]);

	Route::any("search", [
		"as"   => "api/search",
		"uses" => "ApiController@search"
	]);

	Route::any("/", [
		"as"   => "user/login",
		"uses" => "UserController@login"
	]);

	Route::any("users/login", [
		"as"   => "user/login",
		"uses" => "UserController@login"
	]);

	Route::any("users/verifyusername", [
		"as"   => "user/verifyusername",
		"uses" => "UserController@verifyusername"
	]);

	Route::any("register", [
		"as"   => "register",
		"uses" => "UserController@register"
	]);

	Route::any("forgotpassword", [
		"as"   => "forgotpassword",
		"uses" => "UserController@forgotpassword"
	]);

	Route::any("users", [
		"as"   => "user/users",
		"uses" => "UserController@users"
	]);

	Route::any("bevents/{id}", [
		"as"   => "bevents/bevents",
		"uses" => "BeventsController@bevents"
	],function($bid){
		return $bid;
	});

	Route::any("bevent/{bid}", [
		"as"   => "bevent/bevent",
		"uses" => "BeventsController@bevent"
	],function($bid){
		return $bid;
	});

	Route::any("editbevent/{bid}", [
		"as"   => "bevents/editbevent",
		"uses" => "BeventsController@editBevent"
	],function($bid){
		return $bid;
	});




	Route::get("allgames", [
		"as"   => "games/allgames",
		"uses" => "GameController@allgames"
	],function($id){
		return $id;
	});


	Route::get("games/{bid}", [
		"as"   => "games/games",
		"uses" => "GameController@games"
	],function($bid){
		return $bid;
	});

	Route::get("game/{bid}", [
		"as"   => "games/game",
		"uses" => "GameController@game"
	],function($bid){
		return $bid;
	});

	Route::any("editgame/{gid}", [
		"as"   => "games/editgame",
		"uses" => "GameController@editGame"
	],function($gid){
		return $gid;
	});

	Route::post("deletegame/{gid}", [
		"as"   => "games/deletegame",
		"uses" => "GameController@deleteGame"
	],function($gid){
		return $gid;
	});

	Route::any("/addgame/{bid}", [
		"as"   => "games/addgame",
		"uses" => "GameController@addGame"
	],function($bid){
		return $bid;
	});


	Route::group(["before" => "auth"], function() {
		Route::any("/", function() {
			return Redirect::to("bars");
		});

		Route::any("bars", [
			"as"   => "bars",
			"uses" => "BarController@bars"
		]);

		Route::any("bar/{id}", [
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

		Route::any("upload/{id}", [
			"as"   => "bars/upload",
			"uses" => "BarController@uploadImage"
		],function($id){
			return $id;
		});

		Route::any("editbar/{id}", [
			"as"   => "bars/editbar",
			"uses" => "BarController@editBar"
		],function($id){
			return $id;
		});

		Route::post("/updatebevent", [
			"as"   => "bevent/updatebevent",
			"uses" => "BeventsController@updateBevent"
		],function($id){
			return $id;
		});

		Route::any("deletebevent", [
			"as"   => "bevent/deletebevent",
			"uses" => "BeventsController@deleteBevent"
		],function($id){
			return $id;
		});

		Route::any("addbevent/{bid}", [
			"as"   => "bevents/addbevent",
			"uses" => "BeventsController@addBevent"
		],function($bid){
			return $bid;
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


		Route::any("admin/bars/approve/{id}", [
			"as"   => "admin/bars/appprove",
			"uses" => "BarController@approveBar"
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

		Route::any("uploadcsv", [
			"as"   => "admin/uploadcsv",
			"uses" => "UserController@uploadcsv"
		]);


	});

	Route::group(array('prefix' => 'api'), function () {
		Route::get('venues', 'api\v1\BarController@show');
		Route::get('venues/search', 'api\v1\BarController@search');
	});

	Route::any("/request", [
		"as"   => "user/request",
		"uses" => "UserController@request"
	]);

	Route::any("/reset/{token}", [
		"as"   => "user/reset",
		"uses" => "UserController@reset"
	]);

