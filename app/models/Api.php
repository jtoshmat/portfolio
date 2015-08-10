<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Api extends Eloquent implements UserInterface, RemindableInterface {



	public static $search = array(
		'barname'=>'required regex:[0-9]',
//		'address'=>'required|alpha|min:2',
//		'city'=>'required|alpha|min:2',
//		'zipcode'=>'required|alpha|min:2',
	);



	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bars';




	public function globalSearch(){
		return "Global search";
	}


}
