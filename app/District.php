<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'districts';
}
