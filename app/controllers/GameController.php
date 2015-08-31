<?php

	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;
	use Illuminate\Http\Response;

	class GameController extends \BaseController {

		public $games;

		public function __construct(){
			$this->games = new Game();
		}
		
		protected function isAdmin(){
			return Auth::user()->admin;
		}

		public function allgames(){
			$games = $this->games->getAllGames();
			return View::make('games/games')->with('games', $games)->with('isAdmin', $this->isAdmin());
		}

		public function games(){
			$games = $this->games->getGames();
			return View::make('games/games')->with('games', $games);
		}

		public function game(){
			$gid = (int) Request::segment(2);
			$game = $this->games->getGame($gid);
			return View::make('games/game')->with('game', $game);
		}

		public function editGame(){
			if (!$this->isAdmin()){
				return Redirect::to('allgames/')->with('message', 'The following errors occurred')->withErrors
					('You are not authorized to edit the game schedule')->withInput();
			}


			$gid = (int) Request::segment(2);
			$method = Request::method();
			if (Request::isMethod('post')) {
				$validator = Validator::make(Input::all(), Game::$updategamerules);
				if ($validator->passes()) {
					$gid = (int) Request::segment(2);
					$id = Request::get('id');
					$bid = $this->games->getGame($gid)->get(array('bid'));
					$bid = json_decode($bid, true);
					$bid = (int) $bid[0]['bid'];
					$game = $this->games->editGame();
					\Session::flash('mymessage','The game has been updated');
					return Redirect::to('allgames')->with('message', 'The following errors occurred');
				}else{
					return Redirect::to('editgame/'.$gid)->with('message', 'The following errors occurred')->withErrors
					($validator)->withInput();
				}
			}
			$game = $this->games->getGame($gid);
			return View::make('games/editgame')->with('game', $game);
		}

		public function deleteGame(){
			$game = $this->games->deleteGame();
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
					$game = $this->games->addGame();
					return Redirect::to('allgames')->with('message', 'Thanks for adding a game');
				}else{
					return Redirect::to('addgame/'.$bid)->with('message', 'The following errors occurred')->withErrors
					($validator)
						->withInput();
				}
				return Redirect::to('allgames')->with('message', 'Thanks for registering!');

			}
			return View::make('games/addgame')->with('bid',$bid);
		}

	}
