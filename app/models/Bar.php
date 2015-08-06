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

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bars';

	protected function isAdmin(){
		return \Session::get('pusertype');
	}

	public function getBars(){
		$id = Auth::user()->id;
		if ($this->isAdmin()===1) {
			return DB::select(DB::raw('
				SELECT *, (SELECT count(*) FROM bars LEFT JOIN games ON bars.id=games.bid WHERE games.bid=b.id) as
				totalGames,b.id as id, b.uid as uid
				FROM bars AS b
				LEFT JOIN games AS g
				ON b.id = g.bid
				LEFT JOIN uploads ON b.id = uploads.bid
				GROUP BY b.id
					 '));
		}
		if ($this->isAdmin()===2) {
			return DB::select(DB::raw('
				SELECT *, (SELECT count(*) FROM bars LEFT JOIN games ON bars.id=games.bid WHERE games.bid=b.id) as
				totalGames,b.id as id, b.uid as uid
				FROM bars AS b
				LEFT JOIN games AS g
				ON b.id = g.bid
				LEFT JOIN uploads ON b.id = uploads.bid
				WHERE b.uid = '.$id.'
				GROUP BY b.id
					 '));
		}
		return false;
	}

	public function getBar(){
		$id = (int) Request::segment(2);
		if ($this->isAdmin()===1) {
			return Bar::where('id', '=', $id)->firstOrFail();
		}
		if ($this->isAdmin()===2) {
			return Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
		}
		return false;
	}

	public function approveBar(){
		$val = (int) Request::get('val');
		$bid = (int) Request::segment(4);
		$bar =Bar::find($bid);
		$bar->status = $val;
		$bar->save();
		return true;
	}

	public function addBar(){
		$insertData = array(
			'uid' => Auth::user()->id,
			'barname' => Input::get('barname'),
			'address' => Input::get('address'),
			'city' => Input::get('city'),
			'state' => Input::get('state'),
			'zipcode' => Input::get('zipcode'),
			'phone' => Input::get('phone'),
			'website' => Input::get('website'),
			'description' => Input::get('description'),
		);

		DB::table('bars')->insert($insertData);
	}

	public function updateBar(){
		$id = Request::get('id');
		$Bar = Bar::find($id);
		$Bar->barname = Input::get('barname');
		$Bar->address = Input::get('address');
		$Bar->city = Input::get('city');
		$Bar->state = Input::get('state');
		$Bar->zipcode = Input::get('zipcode');
		$Bar->phone = Input::get('phone');
		$Bar->website = Input::get('website');
		$Bar->description = Input::get('description');
		$Bar->status = Input::get('approved');
		$Bar->save();
		return $Bar;
	}

	public function deleteBar(){
		$id = (int) Request::query('id');
		return Bar::find($id)->delete();
	}



}
