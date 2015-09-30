<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';

    public function user()
    {
        return $this->belongsTo('cmwn\User');
    }

    public function Role()
    {
        return $this->belongsTo('cmwn\Role');
    }
}
