<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class District extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'districts';

	protected $fillable = [
		'code'
	];


    /*
     * Api rules
     */

    public static $apiDistrictUpdate = array(
        'title'=>'string',
        //'role[]'=>'required',
        //'role[]'=>'required|regex:/^[0-9]?$/',
    );

	public static $groupUpdateRules = array(
		'title'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	public function organizations()
	{
		return $this->belongsToMany('app\Organization');
	}

	public function users()
	{
		return $this->morphToMany('app\User', 'roleable');
	}

	public function role()
	{
		return Role::getRole($this->pivot->role_id);
	}

	public static function updateGroups(Request $request){
		$titles = $request::get('title');
		$ids = $request::get('id');
		$deleteId = $request::get('delete');
		$newtitle = $request::get('newtitle');
		$organizations = $request::get('organizations');

		$i=0;
		if ($ids) {
			foreach ($ids as $id) {
				$group = District::find($id);
				$group->title = $titles[ $i ];
				if (!empty($organizations[$id])) {
					$group->organization()->sync($organizations[ $id ]);
				}
				if (isset($deleteId[ $i ]) && $deleteId[ $i ] == $id) {
					$group->delete();
				} else {

					$group->save();
				}
				$i++;
			}

		}

		if ($newtitle){
			$group = new District();
			$group->title = $newtitle;
			$group->save();
		}
		return true;
	}

    public function updateApiDistrict(\Request $request){
        //@TODO once the frontend sends request, get them and plug them in here  - JT 10/3
        $district = District::firstOrCreate(array('id'=>1));
        $district->title = 'Distict title';
        $district->description = 'Distict description';
        $district->organization()->sync(array(1));
        return $district->save();
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
