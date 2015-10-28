<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Group extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'groups';
	protected $fillable = array('organization_id', 'title');

	public static $groupUpdateRules = array(
		'title[]'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	public function users()
	{
	    return $this->morphToMany('app\User', 'roleable');
	}

	public function students()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.student');
		return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id',$role_id);

	}

	public function teachers()
	{
		$role_id = (int) \Config::get('mycustomvars.roles.teacher');
		return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id',$role_id);
	}


	public function organization()
	{
		return $this->belongsTo('app\Organization');
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


    /**
     * Scope a query to only include users of a given type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query, $val)
    {
        return $query->where('title', $val);
    }
}
