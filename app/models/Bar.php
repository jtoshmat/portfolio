<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Bar extends Eloquent implements UserInterface, RemindableInterface {



	public static $rules = array(
		'barname'=>'required',
		'upload'=>'image',
//		'address'=>'required|alpha|min:2',
//		'city'=>'required|alpha|min:2',
//		'zipcode'=>'required|alpha|min:2',
	);

	public static $addrules = array(
		'barname'=>'required',
		'address'=>'required|min:2',
		'city'=>'required|alpha|min:2',
		'zipcode'=>'required|numeric|min:5',
	);

	public static $updatebarrules = array(
		'barname'=>'required',
		'address'=>'required|min:2',
		'city'=>'required|alpha|min:2',
		'zipcode'=>'required|numeric|min:5',
	);

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bars';

	

}
