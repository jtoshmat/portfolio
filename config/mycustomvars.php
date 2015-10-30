<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom vars list
    |--------------------------------------------------------------------------
    |
    | This is where we store all the custom vars list
    | Jon Toshmatov
    | more to come
    |
    */
    'roles' => [

        /*
         * All custom roles
         */
        'admin' =>   1,
        'principal' =>   2,
        'teacher' =>   3,
        'student' =>   4,
        'parent' =>   5,

    ],

    'no_csrf' => [
        /*
         * All excluded pages from CSRF session token validation
         */
        '/api/',
        '/api/districts/',
        '/api/organizations/',
        '/api/groups/',
        '/api/users/',
    ],
];
