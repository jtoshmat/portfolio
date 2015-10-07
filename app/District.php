<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class District extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'districts';

	public static $groupUpdateRules = array(
		'title[]'=>'string',
		//'role[]'=>'required',
		//'role[]'=>'required|regex:/^[0-9]?$/',
	);

	public function organization()
	{
		return $this->belongsToMany('cmwn\Organization');
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
				$group->organization()->sync($organizations[$id]);

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
}
