<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use app\cmwn\Traits\RoleTrait;

class Organization extends Model
{
    use RoleTrait;

    protected $table = 'organizations';

    protected $fillable = [
        'code',
    ];

    /**
     * [$groupUpdateRules description].
     *
     * @var array
     */
    public static $groupUpdateRules = array(
        'title[]' => 'string',
        //'role[]'=>'required',
        //'role[]'=>'required|regex:/^[0-9]?$/',
    );

    public function groups()
    {
        return $this->hasMany('app\Group');
    }

    public function districts()
    {
        return $this->belongsToMany('app\District');
    }

    public static function updateGroups(Request $request)
    {
        $titles = $request::get('title');
        $ids = $request::get('id');
        $deleteId = $request::get('delete');
        $newtitle = $request::get('newtitle');

        $i = 0;
        if ($ids) {
            foreach ($ids as $id) {
                $group = self::find($id);
                $group->title = $titles[ $i ];

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

    /*
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

