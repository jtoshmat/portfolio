<?php

namespace app\cmwn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use app\cmwn\Traits\RoleTrait;

class Image extends Model
{

    public function imageable()
    {
        return $this->morphTo();
    }

}
