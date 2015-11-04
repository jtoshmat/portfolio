<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Organization extends Model
{
	protected $table = 'organizations';

	protected $fillable = [
		'code'
	];

	/**
	 * [$groupUpdateRules description]
	 * @var array
	 */
	public static $groupUpdateRules = array(
		'title[]'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	/**
	 * @return [type]
	 */
	public function users()
	{
	    return $this->morphToMany('app\User', 'roleable');
	}

	public function groups()
	{
		return $this->hasMany('app\Group');
	}

	public function districts()
	{
		return $this->belongsToMany('app\District');
	}

	public function principals()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.principal');
		return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id',$role_id);
	}

	public function teachers()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.teacher');
		return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id',$role_id);
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

    /**
     * Scope a query to only include users of a given type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function scopeName($query, $val)
    // {
    //     return $query->where('title', $val);
    // }


}
//@TODO needs softdele added
