<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Bar extends Eloquent implements UserInterface, RemindableInterface {



	public static $rules = array(
		'barname'=>'required regex:[0-9]',
//		'address'=>'required|alpha|min:2',
//		'city'=>'required|alpha|min:2',
//		'zipcode'=>'required|alpha|min:2',
	);

	public static $addrules = array(
		'barname'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'address'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'city'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'state'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Z]{2}+$)+/'
		),
		'zipcode'=>array(
			'required',
			'min:5',
			'regex:/(^[0-9 ]{5,5}$)+/'
		),
		'website'=>'active_url|min:7',
	);

	public static $updatebarrules = array(
		'barname'=>'required',
		'website'=>'active_url',
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
