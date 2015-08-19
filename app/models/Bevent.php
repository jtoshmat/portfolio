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

	public static $editbevent = array(
		'title'=>'required',
	);

	protected function isAdmin(){
		return \Session::get('pusertype');
	}

	public function getBevents(){
		$id = (int) Request::segment(2);
		if ($this->isAdmin()===1) {
			return DB::select('select
				bev.bid, bev.title as btitle,bev.barid as bbarid, bev.eventtime as beventtime, bev.gid as bgid,
				gm.gid as ggid, gm.title as gtitle, gm.matchup as gmatchup, gm.location as glocation, gm.description as
				gdescription, gm
				.game_time as ggame_time, gm.tv as gtv
				from bevents as bev right join games as gm on bev.gid=gm.gid
				');
		}
		if ($this->isAdmin()===2) {
			return DB::select('select
				bev.bid, bev.title as btitle,bev.barid as bbarid, bev.eventtime as beventtime, bev.gid as bgid,
				gm.gid as ggid, gm.title as gtitle, gm.matchup as gmatchup, gm.location as glocation, gm.description as
				gdescription, gm
				.game_time as ggame_time, gm.tv as gtv
				from bevents as bev left join games as gm on bev.gid=gm.gid
				');
		}
	}

	public function getBevent(){
		$bid = (int) Request::segment(2);
		if ($this->isAdmin()===1) {
			return Bevent::where('bid', '=', $bid)->firstOrFail();
		}
		if ($this->isAdmin()===2) {
			return Bevent::where('bid', '=', $bid)->firstOrFail();
		}
	}

	public function addBevent(){
		$bid = (int) Request::segment(2);
		$gid = (int) Request::query('gid');

		$eventtime = Input::get('datetime');
		$eventtime = date_parse_from_format('m/d/Y g:i A', $eventtime);
		$tz = Input::get('timezone');

		$insertData = array(
			'barid' => $bid,
			'gid' => $gid,
			'title' => Input::get('title'),
			'description' => Input::get('description'),
			'eventtime' => \Carbon\Carbon::create($eventtime['year'], $eventtime['month'], $eventtime['day'], $eventtime['hour'], $eventtime['minute'], 0, $tz),
		);
		return DB::table('bevents')->insert($insertData);
	}

	public function editBevent(){
		$id = (int) Request::segment(2);
		$bevent = Bevent::where('bid', '=', $id)->firstOrFail();
		return $bevent;
	}

	public function updateBevent(){
		$bid = (int) Request::segment(2);
		$bid = Request::get('bid');
		$eventtime = Input::get('datetime');
		$eventtime = date_parse_from_format('m/d/Y g:i A', $eventtime);
		$tz = Input::get('timezone');
		$fillable = array(
			'title' => Input::get('title'),
			'description' => Input::get('description'),
			'eventtime' => \Carbon\Carbon::create($eventtime['year'], $eventtime['month'], $eventtime['day'], $eventtime['hour'], $eventtime['minute'], 0, $tz),
		);
		Bevent::where('bid', '=', $bid)->update($fillable);
		return 1;
	}

	public function deleteBevent(){
		$id = (int) Request::query('id');
		$Bevent = Bevent::where('bid','=', $id);
		return $Bevent->delete();
	}

}