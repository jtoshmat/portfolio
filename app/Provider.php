<?php

namespace app;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    public static $getProviderRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^(get)$/i'),
        'provider_id' => 'required|integer',
        //'patientid' => 'required|integer',
        //'cid' => 'required|integer|exists:users,cid,type,1'
    );
}
