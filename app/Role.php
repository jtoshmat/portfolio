<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    /*
    public function user() {
        return $this->belongsTo('User', 'uid');
    }
    */

}
