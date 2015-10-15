<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table = 'permissions';


	public function permission()
	{
		return $this->hasMany('cmwn\Permission');
	}

	public static function hasPermission($data='Permission 1'){
		$output = $db->output = array('Permission 1', 'Permission 2');
		in_array($data, $output);
	}
}
