<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';


    public function user()
    {
        return $this->belongsTo('app\User');
    }

    public function Role()
    {
        return $this->belongsTo('app\Role');
    }
}
