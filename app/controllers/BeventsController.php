<?php

class BeventsController extends \BaseController {

	public $Bevent;
	protected function isNotAuthorized(){
		if (!Auth::user()){
			return 'user/403';
		}
	}

	protected function isAdmin(){
		return Auth::user()->admin;
	}

	public function __construct(){
		$this->Bevent = new Bevent();
	}

	/**
	 * Display a listing of the Bar Events.
	 *
	 * @return Response
	 */
	public function bevents()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$barid = (int) Request::segment(2);
		$bevents = $this->Bevent->getBevents();

		if (empty($bevents)){
			return Redirect::to('addbevent/'.$barid);
		}


		$barname = Bar::where('id','=',$barid)->get(array('barname'));
		$barslug = Bar::where('id','=',$barid)->get(array('slug'));
		$bartimezone = Bar::where('id','=',$barid)->get(array('timezone'));

		if ($bevents){
			return View::make('bevents/bevents')->with('bevents', $bevents)->with('barid', $barid)->with('barname', $barname)->with('bartimezone', $bartimezone)->with('barslug', $barslug);
		}
		$bevents = null;

		return View::make('bevents/bevents')->with('bevents', $bevents)->with('barid', $barid)->with('barname', $barname)->with('bartimezone', $bartimezone)->with('barslug', $barslug);
	}

	public function editBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		 $bid = (int) Request::segment(2);
		 $gid = (int) Request::query('gid');

		 $barid = DB::select(DB::raw('select barid from bevents where bid='.$bid.''));
		 $barid= $barid[0]->barid;
		 $barname = DB::select(DB::raw('select barname from bars where id='.$barid.''));
		 $barslug = DB::select(DB::raw('select slug from bars where id='.$barid.''));

		 $bartimezone = Bar::where('id','=',$barid)->get(array('timezone'));
		 $method = Request::method();

		if (Request::isMethod('post'))
		{
			$validator = Validator::make(Input::all(), Bevent::$editbevent);
			if ($validator->passes()) {

				$datetime = Input::get('datetime');
				$game_time = null;
				$gid = (int) Request::query('gid');
				if ($gid && $gid != 0){
					$game_time = DB::select(DB::raw('select game_time from games where gid='.$gid.''));

					$game_time = strtotime($game_time[0]->game_time);
					$datetime = strtotime($datetime);

					$game_dt = new DateTime(date('Y-m-d', $game_time));
					$input_dt = new DateTime(date('Y-m-d', $datetime));

					 
				 	if(date('Y-m-d', $game_time) != date('Y-m-d', $datetime)){
						return Redirect::to('editbevent/'.$bid.'?gid='.$gid)->with('message', 'The following errors occurred')->withErrors
						('The event date must match the game date');				
				 	}
				}

				$this->Bevent->updateBevent();
				$barid = Bevent::where('bid','=',$bid)->get(array('barid'));
				$barid = json_decode($barid, true);
				$barid = (int) $barid[0]['barid'];
				return Redirect::to('bevents/'.$barid)->with('message', 'The following errors occurred')->withErrors
				('The event # '.$bid.' has been updated');

			}else{
				$id = Input::get('id');
				return Redirect::to('editbevent/'.$bid)->with('message', 'The following errors occurred')->withErrors
				($validator)
					->withInput();
			}
			return Redirect::to('editbevent/'.$bid)->with('message', 'Thanks for up!');

		}

		$bevent = $this->Bevent->getBevent();
		return View::make('bevents/editbevent')->with('barname', $barname)->with('bevent', $bevent)->with('bartimezone', $bartimezone)->with('barid', $barid)->with('gid', $gid)->with('barslug', $barslug);

	}

	public function addBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$barid = (int) Request::segment(2);
		$barname = Bar::where('id','=',$barid)->get(array('barname'));
		$barslug = Bar::where('id','=',$barid)->get(array('slug'));
		$bartimezone = Bar::where('id','=',$barid)->get(array('timezone'));
		$gid = (int) Request::query('gid');
		$gamematchup = null;
		$gametime = null;
		if ($gid && $gid != 0){
			$gameData = Game::where('gid','=',$gid)->firstOrFail();
			$gamematchup = $gameData['matchup'];
			$gametime = $gameData['game_time'];
 		}
		$method = Request::method();
		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), Bevent::$addbevent);

			if ($validator->passes()) {
				$datetimeInput = Input::get('datetime');
				$today_dt = new DateTime(date('Y-m-d'));
				$Input_dt = new DateTime($datetimeInput);

			if ($Input_dt < $today_dt) { 
					return Redirect::to('addbevent/'.$barid.'?gid='.$gid)->with('message', 'The following errors occurred')->withErrors
					('Events can only be created in the future')->withInput();
			}
				if($gid && $gid != 0) {
					$datetimeInput = date('Y-m-d', strtotime($datetimeInput));
					$gametimeOutput = date('Y-m-d', strtotime($gametime));

					if ($datetimeInput != $gametimeOutput) {
						return Redirect::to('addbevent/' . $barid . '?gid=' . $gid)->with('message', 'The following errors occurred')->withErrors
						('The event date must match the game date')->withInput();
					}
				}

				$bevents = $this->Bevent->addBevent();
				return Redirect::to('bevents/'.$barid);
			}else{
				return Redirect::to('addbevent/'.$barid)->with('message', 'The following errors occurred')->withErrors
				($validator)->withInput();
			}
		}
		return View::make('bevents/addbevent')->with('barid', $barid)->with('gid', $gid)->with('barname', $barname)->with('bartimezone', $bartimezone)->with('gamematchup', $gamematchup)->with('gametime', $gametime)->with('barslug', $barslug);
	}

	public function bevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$bevents = $this->bevents->getBevent();
		if ($bevents){
			return View::make('bevents/bevents')->with('bevents', $bevents);
		}
		return View::make('user/403');
	}

	public function deleteBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$Bevent = new Bevent();
		$bevents = $Bevent->deleteBevent();
		return 'The event has been deleted';
	}

}
