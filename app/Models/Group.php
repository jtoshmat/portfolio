<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Group extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'groups';

	public static $groupUpdateRules = array(
		'title[]'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	public function users()
	{
	    return $this->morphToMany('cmwn\User', 'roleable');
	}

	public function students()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.student');
		return $this->morphToMany('cmwn\User', 'roleable')->wherePivot('role_id',$role_id);

	}

	public function teachers()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.teacher');
		return $this->morphToMany('cmwn\User', 'roleable')->wherePivot('role_id',$role_id);
	}


	public function organization()
	{
		return $this->belongsTo('cmwn\Organization');
	}

	public static function updateGroups(Request $request){
		$titles = $request::get('title');
		$ids = $request::get('id');

		$deleteId = $request::get('delete');
		$newtitle = $request::get('newtitle');

		$i=0;
		if ($ids) {
			foreach ($ids as $id) {
				$group = Group::find($id);
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
			$group = new Group();
			$group->title = $newtitle;
			$group->save();
		}

		return true;
	}
}
