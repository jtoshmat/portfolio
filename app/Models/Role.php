<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public static function getRole($role_id)
    {
    	//TODO let's not call the DB here.
    	//return self::find($role_id);

    	$roles = (array) \Config::get('mycustomvars.roles');

    	return array_search($role_id, $roles);
    }

}
