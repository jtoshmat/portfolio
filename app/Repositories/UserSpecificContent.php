<?php

namespace cmwn\Http\Controllers\Auth;
use cmwn\Http\Controllers\Controller;


class UserSpecificContent extends Controller
{

    public function getAll()
    {
        return array('guest', 'two','three');
    }

}
