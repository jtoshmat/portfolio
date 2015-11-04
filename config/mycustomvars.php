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
        'superintendent' =>   2,
        'principal' =>   3,
        'teacher' =>   4,
        'student' =>   5,
        'parent' =>   6,
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
