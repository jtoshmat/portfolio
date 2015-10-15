<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	protected $table = 'permission_role';


	public function role()
	{
		return $this->belongsTo('cmwn\Role');
	}

	public function permission()
	{
		return $this->belongsTo('cmwn\Permission');
	}

}
