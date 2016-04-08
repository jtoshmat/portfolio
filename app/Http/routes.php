<?php
/*if(env('APP_ENV')=='local') {
    Event::listen('illuminate.query', function ($query) {
        var_dump($query);
    });
}*/
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
Route::post('/user', 'UsersController@user');
Route::get('login', 'UsersController@loginForm');
Route::post('login', 'UsersController@loginPost');
Route::get('csrf_token', 'ApiResponseController@getToken');
Route::post('/auth/login', 'ApiResponseController@authenticate'); //Api login
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@login');
Route::any('/auth/logout', 'Auth\AuthController@logout');
Route::post('/auth/reset', 'Auth\PasswordController@reset');
Route::post('activate', 'ActivateController@processRequest');
Route::post('patient', 'PatientController@patient');
Route::get('cron', 'MobileNotificationController@run');
Route::post('schedule', 'ScheduleController@schedule');
Route::post('provider', 'ProviderController@provider');
Route::post('medication', 'MedicationController@medication');
Route::post('event', 'EventsController@event');
Route::post('eventcategory', 'EventCategoryController@categories');
Route::post('message', 'ParticipantsController@participants');
Route::post('organization', 'OrganizationsController@organization');
Route::post('location', 'LocationsController@location');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
    Route::group(['middleware' => 'auth'], function ($router) {
            Route::group(['middleware' => 'portal'], function ($router) {
                Route::get('chat', 'MessagesController@getChatConversations');
                Route::get('chat/{id}', ['as' => 'chat', 'uses' => 'MessagesController@chat', function ($id) {}]);
                Route::post('chat/{id}', ['as' => 'updateconversation', 'uses' => 'MessagesController@updateConversation', function ($id) {}]);
                Route::get('newchat', ['as' => 'createconversation', 'uses' => 'MessagesController@createChat', function ($id) {}]);
            });
            Route::get('/', function () { return view('welcome');});
    });


});


