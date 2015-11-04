<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use app\cmwn\Traits\RoleTrait;

class District extends Model
{
    use RoleTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'districts';

    protected $fillable = [
        'code',
    ];

    /*
     * Api rules
     */

    public static $apiDistrictUpdate = array(
        'title' => 'string',
        //'role[]'=>'required',
        //'role[]'=>'required|regex:/^[0-9]?$/',
    );

    public static $groupUpdateRules = array(
        'title' => 'string',
        //'role[]'=>'required',
        //'role[]'=>'required|regex:/^[0-9]?$/',
    );

    public function organizations()
    {
        return $this->belongsToMany('app\Organization');
    }

    public static function updateGroups(Request $request)
    {
        $titles = $request::get('title');
        $ids = $request::get('id');
        $deleteId = $request::get('delete');
        $newtitle = $request::get('newtitle');
        $organizations = $request::get('organizations');

        $i = 0;
        if ($ids) {
            foreach ($ids as $id) {
                $group = self::find($id);
                $group->title = $titles[ $i ];
                if (!empty($organizations[$id])) {
                    $group->organization()->sync($organizations[ $id ]);
                }
                if (isset($deleteId[ $i ]) && $deleteId[ $i ] == $id) {
                    $group->delete();
                } else {
                    $group->save();
                }
                ++$i;
            }
        }

        if ($newtitle) {
            $group = new self();
            $group->title = $newtitle;
            $group->save();
        }

        return true;
    }

    public function updateApiDistrict(\Request $request)
    {
        //@TODO once the frontend sends request, get them and plug them in here  - JT 10/3
        $district = self::firstOrCreate(array('id' => 1));
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
