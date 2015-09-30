<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';


    public function role()
    {
        return $this->hasMany('cmwn\UserRole');
    }
/*
	public function permission()
	{
		return $this->hasMany('cmwn\RolePermission');
	}
*/
	public function permission()
	{
		//return $this->hasManyThrough('cmwn\Role', 'cmwn\RolePermission');
		return $this->belongsToMany('cmwn\RolePermission');
	}


}
