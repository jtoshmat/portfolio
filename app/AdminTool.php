<?php

namespace cmwn;

use Illuminate\Database\Eloquent\Model;

class AdminTool extends Model
{
	public static $uploadCsvRules = array(
		'yourcsv'=>'required|regex:/.csv?$/',
	);
}
