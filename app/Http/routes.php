<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
##########################################################################
##########################################################################
##########################################################################
######################### All Routes Lists ###############################
##########################################################################

if (env('APP_ENV') == 'local') {
    Event::listen('illuminate.query', function ($query) {
    //var_dump($query);
    });
}

##########################################################################
######################### Public Routes ##################################
##########################################################################

Route::get('/home', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

##########################################################################
################### Authenticated Users Only #############################
##########################################################################

Route::group(['middleware' => 'auth'], function ($router) {
    Route::any('users/members', 'UsersController@members');
    Route::any('users/roles', 'UsersController@roles');
    Route::any('search', 'MasterController@search');

    Route::group(['middleware' => 'role:'.Config::get('myroutes.routes.role')], function ($router) {

        Route::get('users/member/{id}/{action}', [
            'as' => 'users/member',
            'uses' => 'UsersController@member',
        ], function ($id, $action) {
            return $id;
        })->where('id', '[0-9]+')->where('action', 'view');

        Route::get('users/friendship/{friend_id}/{action}', [
            'as' => 'users/friendhsip',
            'uses' => 'MasterController@friendship',
        ], function ($id, $action) {
            return $id;
        })->where('id', '[0-9]+')->where('action', 'add|delete|block|accept|reject|message|poke');

        Route::get('profile/{id}/{action}', [
            'as' => 'users/profile',
            'uses' => 'ProfileController@profile',
        ], function ($id, $action) {
            return $id;
        })->where('id', '[0-9]+')->where('action', 'view|edit|delete|deactivate');

    });

########################## Admins Only ####################################
    Route::group(['middleware' => 'role:admin'], function ($router) {
        Route::any('admin/uploadcsv', 'AdminToolsController@uploadcsv');

        Route::any('admin/playground', 'AdminTestController@uploadImage');
    });
########################## Misc Auth users ################################
    Route::any('users/member/{id}/update', 'UsersController@memberUpdate')->where('id', '[0-9]+');
    Route::any('users/member/{id}/delete', 'UsersController@memberDelete')->where('id', '[0-9]+');
    Route::any('user/{id}/view', 'UsersController@user')->where('id', '[0-9]+');
    //Route::any('districts', 'DistrictsController@index');
    Route::any('district/{id}/view', 'DistrictsController@district')->where('id', '[0-9]+');
    Route::any('organizations', 'OrganizationsController@index')->where('id', '[0-9]+');
    Route::any('organization/{id}/view', 'OrganizationsController@organization')->where('id', '[0-9]+');
    Route::any('groups', 'GroupsController@index');
    Route::any('group/{id}/view', 'GroupsController@group')->where('id', '[0-9]+');
    Route::any('guardians', 'UsersController@guardian');

    //Composer for sidebars and user specific contents
    View::composer('partials.sidebar', 'app\cmwn\Users\UserSpecificRepository');

});

##########################################################################
######################## API Requests Only ###############################
##########################################################################

Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
    Route::get('/csrf_token', function () {
        return csrf_token();
    });

    Route::post('/auth/login', 'Api\AuthController@authenticate');

    Route::group(['middleware' => 'auth'], function ($router) {

        Route::get('/parms/{parm_name}', function ($parm_name) {
            return \Config::get('mycustomvars.'.$parm_name);
        })->where('parm_name', '[a-z]+');

        Route::get('/sidebar', 'Api\MasterController@sidebar');
        Route::get('/friends', 'Api\MasterController@friends');

        Route::get('/auth/logout', 'Api\AuthController@logout');

        Route::get('/users', 'Api\UserController@index');
        Route::get('/users/{id}', 'Api\UserController@show');
        Route::get('/users/{id}/groups', 'Api\UserController@getGroups');
        Route::get('/suggestedfriends', 'Api\SuggestedController@show');

        //Get Groups
        Route::get('/groups', 'Api\GroupController@index');
        Route::get('/groups/{id}', 'Api\GroupController@show');
        Route::get('/groups/{id}/users', 'Api\GroupController@getUsers');

        //Put Groups
        Route::post('/groups/{id}', ['uses' => 'Api\GroupController@update']);

        //Get Districts
        Route::get('/districts', 'Api\DistrictController@index');
        Route::get('/districts/{id}', 'Api\DistrictController@show');
        Route::get('/districts/{id}/organizations', 'Api\DistrictController@getOrganizations');

        //Put Districts
        Route::post('/districts/{id}', ['uses' => 'Api\DistrictController@update']);

        //Get Organizations
        Route::get('/organizations', 'Api\OrganizationController@index');
        Route::get('/organizations/{id}', 'Api\OrganizationController@show');

        //Put Organizations
        Route::post('/organizations/{id}', ['uses' => 'Api\OrganizationController@update']);

        Route::get('/roles', 'Api\RoleController@index');
        Route::get('/roles/{id}', 'Api\RoleController@show');

        //Admin tasks: Import Excel files and update the DB.
        Route::post('/admin/importexcel', ['uses' => 'Api\MasterController@importExcel']);

    });
});

Route::any('{catchall}', function ($page) {
    return File::get(public_path().'/index.html');
})->where('catchall', '(.*)');
