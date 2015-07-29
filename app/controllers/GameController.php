<?php

	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;
	use Illuminate\Http\Response;

	class GameController extends \BaseController {


		public function allgames(){
			$games = Game::all();
			return View::make('games/games')->with('games', $games);
		}

		public function games(){
			$bid = (int) Request::segment(2);
			//$games = Game::where('bid','=', $bid)->get();
			$games = DB::select(DB::raw("
			SELECT
			gm.`bid`, gm.`title`, gm.`gid`,
			(SELECT COUNT(*) FROM games LEFT JOIN bevents ON games.gid=bevents.gid WHERE bevents.gid=gm.gid) AS totalEvents
			FROM games as gm
			LEFT JOIN bevents as bs ON gm.gid=bs.gid
			WHERE gm.bid = $bid
			GROUP BY gm.gid
					 "));
			return View::make('games/games')->with('games', $games);
		}

		public function game(){
			$gid = (int) Request::segment(2);
			//$games = Game::where('bid','=', $bid)->get();
			$game = Game::where('gid','=',$gid)->firstOrFail();
			return View::make('games/game')->with('game', $game);
		}

		public function editGame(){
			$gid = (int) Request::segment(2);
			$method = Request::method();
			if (Request::isMethod('post')) {
				$validator = Validator::make(Input::all(), Game::$updategamerules);
				if ($validator->passes()) {
					$id = Request::get('id');
					$bid = Game::where('gid','=',$gid)->get(array('bid'));
					$bid = json_decode($bid, true);
					$bid = (int) $bid[0]['bid'];

					$Game = Game::where('gid','=',$gid)->update(
						array(
							'title' => Input::get('title'),
						));;

					\Session::flash('mymessage','The game has been updated');
					return Redirect::to('games/'.$bid)->with('message', 'The following errors occurred');
				}else{
					return Redirect::to('editgame/'.$gid)->with('message', 'The following errors occurred')->withErrors
					($validator)->withInput();
				}
			}
			$game = Game::where('gid','=',$gid)->firstOrFail();
			return View::make('games/editgame')->with('game', $game);
		}

		public function deleteGame(){
			$gid = (int) Request::segment(2);
            Game::where('gid','=',$gid)->delete();
			return 'The game has been deleted';

		}

		public function addGame()
		{
			$method = Request::method();
			$bid = Request::segment(2);
			if (Request::isMethod('post'))
			{
				$validator = Validator::make(Input::all(), Game::$updategamerules);
				if ($validator->passes()) {
					$insertData = array(
						'uid' => Auth::user()->id,
						'bid' => $bid,
						'title' => Input::get('title'),

					);
					DB::table('games')->insert($insertData);
					return Redirect::to('games/'.$bid)->with('message', 'Thanks for adding a game');

				}else{
					return Redirect::to('addgame/'.$bid)->with('message', 'The following errors occurred')->withErrors
					($validator)
						->withInput();
				}
				return Redirect::to('games/'.$bid)->with('message', 'Thanks for registering!');

			}
			return View::make('games/addgame')->with('bid',$bid);
		}

	}
