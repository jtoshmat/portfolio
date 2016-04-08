<?php

namespace app;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Medication extends Authenticatable
{
    public static $getMedicationRules = array(
        'orgid' => 'required|integer|exists:organizations,id',
        'action' => array('required', 'regex:/^(get)$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
    );
}
