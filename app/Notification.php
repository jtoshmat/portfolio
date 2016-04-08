<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'mobile_notifications';


    public function users(){
        return $this->hasMany('app\User','cid','cid');
    }

}
