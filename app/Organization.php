<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Organization extends Model
{
	protected $table = 'organizations';

	protected $fillable = [
		'code'
	];

	public static $groupUpdateRules = array(
		'title[]'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	public function users()
	{
	    return $this->morphToMany('cmwn\User', 'roleable');
	}

	public function groups()
	{
		return $this->hasMany('cmwn\Group');
	}

	public function districts()
	{
		return $this->belongsToMany('cmwn\District');
	}

	public function principals()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.principal');
		return $this->morphToMany('cmwn\User', 'roleable')->wherePivot('role_id',$role_id);
	}

	public function teachers()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.teacher');
		return $this->morphToMany('cmwn\User', 'roleable')->wherePivot('role_id',$role_id);
	}

	public static function updateGroups(Request $request){
		$titles = $request::get('title');
		$ids = $request::get('id');
		$deleteId = $request::get('delete');
		$newtitle = $request::get('newtitle');

		$i=0;
		if ($ids) {
			foreach ($ids as $id) {
				$group = Organization::find($id);
				$group->title = $titles[ $i ];

				if (isset($deleteId[ $i ]) && $deleteId[ $i ] == $id) {
					$group->delete();
				} else {

					$group->save();
				}
				$i++;
			}
		}
		if ($newtitle){
			$group = new Organization();
			$group->title = $newtitle;
			$group->save();
		}
		return true;
	}
}
//@TODO needs softdele added