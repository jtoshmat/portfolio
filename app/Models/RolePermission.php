<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	protected $table = 'permission_role';


	public function role()
	{
		return $this->belongsTo('app\Role');
	}

	public function permission()
	{
		return $this->belongsTo('app\Permission');
	}

}
