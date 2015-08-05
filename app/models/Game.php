<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Game extends Eloquent implements UserInterface, RemindableInterface {



	public static $updategamerules = array(
		'title'=>'required',

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
	protected $table = 'games';

	public function getAllGames(){
		return Game::all();
	}

	public function getGames(){
		$bid = (int) Request::segment(2);
		return DB::select(DB::raw("
			SELECT
			gm.`bid`, gm.`title`, gm.`gid`,
			(SELECT COUNT(*) FROM games LEFT JOIN bevents ON games.gid=bevents.gid WHERE bevents.gid=gm.gid) AS totalEvents
				FROM games as gm
				LEFT JOIN bevents as bs ON gm.gid=bs.gid
				WHERE gm.bid = $bid
				GROUP BY gm.gid
			"));
	}

	public function getGame($gid){
		return Game::where('gid','=',$gid)->firstOrFail();
	}

	public function editGame(){
		$gid = (int) Request::segment(2);
		$id = Request::get('id');
		$bid = Game::where('gid','=',$gid)->get(array('bid'));
		$bid = json_decode($bid, true);
		$bid = (int) $bid[0]['bid'];
		$Game = Game::where('gid','=',$gid)->update(
			array(
				'title' => Input::get('title'),
			));;
	}

	public function deleteGame(){
		$gid = (int) Request::segment(2);
		return Game::where('gid','=',$gid)->delete();
	}

	public function addGame(){
		$bid = Request::segment(2);
		$insertData = array(
			'uid' => Auth::user()->id,
			'bid' => $bid,
			'title' => Input::get('title'),

		);
		return DB::table('games')->insert($insertData);
	}

}
