<?php

// echo(env('SESSION_DOMAIN'));
// echo(env('ACCESS_CONTROL_ALLOW_ORIGIN'));

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

// Route::option('{all}', function(){
//     return response('',204);
// })->where('all', '.*');

if (env('APP_ENV') == 'local') {
    Event::listen('illuminate.query', function ($query) {
    //var_dump($query);
    });
}

Route::get('/home', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');

// Admin Routes
Route::group(['prefix' => 'admin'], function ($router) {

    Route::post('auth/login', 'Auth\AuthController@postLogin');

    // Authenticated Users Only
    Route::group(['middleware' => 'auth'], function ($router) {
        Route::group(['middleware' => 'role:admin'], function ($router) {
            Route::any('admin/uploadcsv', 'AdminToolsController@uploadcsv');
            Route::any('admin/playground', 'AdminTestController@uploadImage');
        });

        Route::any('users/members', 'UsersController@members');
        Route::any('users/roles', 'UsersController@roles');
        Route::any('search', 'MasterController@search');

        Route::any('users/member/{id}/update', 'UsersController@memberUpdate')->where('id', '[0-9]+');
        Route::any('users/member/{id}/delete', 'UsersController@memberDelete')->where('id', '[0-9]+');
        Route::any('user/{id}/view', 'UsersController@user')->where('id', '[0-9]+');
        Route::any('district/{id}/view', 'DistrictsController@district')->where('id', '[0-9]+');
        Route::any('organizations', 'OrganizationsController@index')->where('id', '[0-9]+');
        Route::any('organization/{id}/view', 'OrganizationsController@organization')->where('id', '[0-9]+');
        Route::any('groups', 'GroupsController@index');
        Route::any('group/{id}/view', 'GroupsController@group')->where('id', '[0-9]+');
        Route::any('guardians', 'UsersController@guardian');

        //Composer for sidebars and user specific contents
        View::composer('partials.sidebar', 'app\cmwn\Users\UserSpecificRepository');
    });
});

##########################################################################
############################# API Requests ###############################
##########################################################################

// Route::group(['middleware' => 'api'], function ($router) {

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

// });
