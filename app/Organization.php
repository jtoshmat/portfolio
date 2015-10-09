<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Organization extends Model
{
	protected $table = 'organizations';

	public static $groupUpdateRules = array(
		'title[]'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	public function users()
	{
	    return $this->belongsToMany('cmwn\User');
	}

	public function groups()
	{
		return $this->hasMany('cmwn\Group');
	}

	public function principals()
	{
		return $this->belongsToMany('cmwn\User')->wherePivot('role_id',2);
	}

	public function teachers()
	{
		return $this->belongsToMany('cmwn\User')->wherePivot('role_id',3);
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