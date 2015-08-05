<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Bevent extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;

	protected $table = 'bevents';

	public static $addbevent = array(
		'title'=>'required',
	);

	protected function isAdmin(){
		return \Session::get('pusertype');
	}

	public function getBevents(){
		$id = (int) Request::segment(2);
		if ($this->isAdmin()===1) {
			return Bevent::where('gid', '=', $id)->get();
		}
		if ($this->isAdmin()===2) {
			return Bevent::where('gid', '=', $id)->get();
		}
	}

	public function getBevent(){
		$id = (int) Request::segment(2);
		if ($this->isAdmin()===1) {
			return Bevent::where('barid', '=', $id)->get();
		}
		if ($this->isAdmin()===2) {
			return Bevent::where('barid', '=', $id)->get();
		}
	}

	public function addBevent(){
		$gid = (int) Request::segment(2);
		$bid = Game::where('gid','=',$gid)->get(array('bid'));
		$bid = json_decode($bid, true);
		$bid = (int) $bid[0]['bid'];
		$insertData = array(
			'gid' => $gid,
			'barid' => $bid,
			'title' => Input::get('title'),
		);
		return DB::table('bevents')->insert($insertData);
	}

	public function editBevent(){
		$id = (int) Request::segment(2);
		$bevent = Bevent::where('bid', '=', $id)->firstOrFail();
		return $bevent;
	}

	public function deleteBevent(){
		$id = (int) Request::query('id');
		$Bevent = Bevent::where('bid','=', $id);
		return $Bevent->delete();
	}

}