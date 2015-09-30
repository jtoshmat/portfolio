<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
	protected $table = 'permissions';


	public function permission()
	{
		return $this->hasMany('cmwn\RolePermission');
	}
}
