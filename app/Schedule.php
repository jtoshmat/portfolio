<?php

namespace app;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Schedule extends Authenticatable
{
    public static $getScheduleRules = array(
        'orgid' => 'required|integer|exists:organizations,id',
        'action' => array('required', 'regex:/^(get)$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
        'days_from_today' =>'required|integer',
        'max_to_return' =>'required|integer'
    );


}
