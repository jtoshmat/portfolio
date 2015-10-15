<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';


    public function user()
    {
        return $this->belongsTo('cmwn\User');
    }

    public function Role()
    {
        return $this->belongsTo('cmwn\Role');
    }
}
