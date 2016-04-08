<?php

namespace app;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $primaryKey = 'cid';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $loginUserRules = array(
        'orgid' => 'required|integer|exists:organizations,id',
        'action' => array('required', 'regex:/^(login)$/i'),
        'email' => 'required|email',
        'password'=>'string|required',
    );

    public static $logoutUserRules = array(
        'action' => array('required', 'regex:/^(logout)$/i'),
    );

    public static $getUserRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^(get|create|update|delete)$/i'),
    );


//    public static function login($data){
//        $user = self::where('email','=',$data["email"])->get(array('email','password'));
//        return $user;
//    }

    public function participants(){
        return $this->hasOne('app\Participant','id');
    }

    public function locations(){
        return $this->hasOne('app\Location','cid');
    }

    public function organization(){
        return $this->belongsTo('app\Organization','org_id');
    }
    


}
