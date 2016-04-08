<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'organizations';
    protected $fillable = [];
    protected $parms;
    public static $getOrganizationRules = array(
        //'sessionToken' => 'required|string',
        'action' => array('required', 'regex:/^(get)$/i'),
        'orgid' => 'required|integer',
        //'org_parms' => 'up for discussion',
    );


    public function stations(){
        return $this->hasMany('app\Station','org_id');
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

    public function getOrganization($data){
        $data = $this::where('id',$data['orgid'])->get();
        return $data;
    }

}
