<?php

namespace app;

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

    /**
     * Scope a query to only include users of a given type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query, $val)
    {
        return $query->where('title', $val);
    }

}
