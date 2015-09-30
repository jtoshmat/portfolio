<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';






	public function permission()
	{
		//return $this->hasManyThrough('cmwn\Role', 'cmwn\UserRole', 'user_id', 'id');
		return $this->belongsToMany('cmwn\Permission');
	}


}
