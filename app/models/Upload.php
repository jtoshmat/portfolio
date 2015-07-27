<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Upload extends Eloquent implements UserInterface, RemindableInterface {

	public static $uploadrules = array(
		'avatar'=>'image',
		'bid'=> 'required|numeric|min:1',

	);

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'uploads';

	

}
