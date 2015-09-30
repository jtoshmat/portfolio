<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';


    public function role()
    {
        return $this->hasMany('cmwn\UserRole');
    }


}
