<?php

class BeventsController extends \BaseController {

	public $Bevent;
	protected function isNotAuthorized(){
		if (\Session::get('privileges')==0){
			return 'user/403';
		}

	}

	protected function isAdmin(){
		return \Session::get('pusertype');
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
		$barname = Bar::where('id','=',$barid)->get(array('barname'));
		$bartimezone = Bar::where('id','=',$barid)->get(array('timezone'));

		if ($bevents){
			return View::make('bevents/bevents')->with('bevents', $bevents)->with('barid', $barid)->with('barname',
				$barname);
		}
		$bevents = null;

		return View::make('bevents/bevents')->with('bevents', $bevents)->with('barid', $barid)->with('barname', $barname)->with('timezone', $bartimzone);
	}

	public function editBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$bid = (int) Request::segment(2);
		$method = Request::method();
		if (Request::isMethod('post'))
		{
			$validator = Validator::make(Input::all(), Bevent::$editbevent);
			if ($validator->passes()) {
				$Bevent = new Bevent();
				$Bevent->updateBevent();
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
		return View::make('bevents/editbevent')->with('bevent', $bevent);

	}

	public function addBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$barid = (int) Request::segment(2);
		$gid = (int) Request::query('gid');
		$barname = Bar::where('id','=', $barid)->get(array('barname'));

		$method = Request::method();
		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), Bevent::$addbevent);
			if ($validator->passes()) {
				$bevents = $this->Bevent->addBevent();
				return Redirect::to('bevents/'.$barid);

			}else{
				return Redirect::to('addbevent/'.$barid)->with('message', 'The following errors occurred')->withErrors
				($validator)->withInput();
			}
		}
		return View::make('bevents/addbevent')->with('barid', $barid)->with('gid', $gid)->with('barname', $barname);
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
		$bevents = $this->bevents->deleteBevent();
		return 'The event has been deleted';
	}

}
