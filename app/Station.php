<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'stations';
    protected $fillable = [];
    public static $createStationRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^(get)|(create)$/i'),
    );

    public function organizations(){
        return $this->belongsTo('app\organization','id','org_id');
    }

    public function locations(){
        return $this->hasMany('app\Location');
    }

    public static function userByCid($cid){
        $cid = (int) $cid;
        $user = new User();
        $output = $user->where('cid','=', $cid)->first();
        if ($output) {
            $data = json_decode($output, true);
            $output = [
                'cid' => $data['cid'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name']
            ];
            return $output;
        }
        return false;
    }

}
