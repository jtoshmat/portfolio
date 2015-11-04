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
        'super_admin' =>   1,
        'admin' =>   2,
        'member' =>   3,
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
