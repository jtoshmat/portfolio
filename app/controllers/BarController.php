<?php

	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;
	use Illuminate\Http\Response;

class BarController extends \BaseController {

	public $bars;

	protected function isNotAuthorized(){
		if (\Session::get('privileges')==0){
			return 'user/403';
		}

	}

	protected function isAdmin(){
		return \Session::get('pusertype');
	}

	public function __construct(){
		$this->bars = new Bar();
		$this->bevents = new Bevent();
	}

	public function bars()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$bars = $this->bars->getBars();
		if ($bars){
			return View::make('bars/bars')->with('bars', $bars);
		}
		return View::make('bars/addbar');
	}

	public function approveBar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$bars = $this->bars->approveBar();
		return 'The bar status has been updated';
	}

	public function bar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$bars = $this->bars->getBar();
		if ($bars){
			return View::make('bars/bar')->with('bars', $bars);
		}
		return View::make('user/403');
	}

	public function editBar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = (int) Request::segment(2);



			$method = Request::method();
			if (Request::isMethod('post'))
			{
				$validator = Validator::make(Input::all(), Bar::$updatebarrules);
				if ($validator->passes()) {
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
					$Bar->status = Input::get('status');
					$Bar->save();

					\Session::flash('mymessage','The bar has been updated');
					return Redirect::to('bars')->with('message', 'Thanks for updaing your bar');

				}else{
					$id = Input::get('id');
					return Redirect::to('editbar/'.$id)->with('message', 'The following errors occurred')->withErrors
					($validator)
						->withInput();
				}
				return Redirect::to('bars')->with('message', 'Thanks for up!');

			}

		switch ($this->isAdmin()){
			case 1: //Super Admin
				//$bars = Bar::where('id', '=', $id)->firstOrFail();
				$bars = DB::select(DB::raw('select * from bars as b left join uploads as upl on b.id=upl.bid where b
				.id='.$id.' group by b.id'));

				//$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;

			case 2: //Bar Admin
				$bars = DB::select(DB::raw('select * from bars as b left join uploads as upl on b.id=upl.bid where b
				.id='.$id.''));
				break;

			case 3: //Bar Admin
				$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;

			default: //Anybody else
				$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;
		}

		if ($bars){
			return View::make('bars/editbar')->with('bars', $bars)->with('username',Auth::user()->username);
		}
		return $bars;
		return View::make('user/403');


	}

	public function deleteBar()
	{
		if ($this->isNotAuthorized()){
			return 'Unauthorized Access';
		}
		$bar = $this->bars->deleteBar();
		return 'The bar has been deleted';
	}

	public function updateBar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}

		$bar = $this->bars->updateBar();
		return View::make('bars/editbar')->with('bars', $bar);


	}

	public function addBar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}

		$method = Request::method();
		if (Request::isMethod('post'))
		{
		$validator = Validator::make(Input::all(), Bar::$addrules);
			if ($validator->passes()) {
				$bars = $this->bars->addBar();
				return Redirect::to('bars')->with('message', 'Thanks for registering your bar');

			}else{
				return Redirect::to('addbar')->with('message', 'The following errors occurred')->withErrors($validator)
					->withInput();
			}
		}
		return View::make('bars/addbar')->with('username',Auth::user()->username);
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

	public function addBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$gid = (int) Request::segment(2);
		$method = Request::method();
		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), Bevent::$addbevent);
			if ($validator->passes()) {
				$bevents = $this->bevents->addBevent();
				return Redirect::to('bevents/'.$gid);
			}else{
				return Redirect::to('addbevent/'.$gid)->with('message', 'The following errors occurred')->withErrors
				($validator)->withInput();
			}
		}
		return View::make('bars/addbevent')->with('gid', $gid);
	}

	public function deleteBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$bevents = $this->bevents->deleteBevent();
		return 'The event has been deleted';
	}

	public function uploadImage()
	{
			$uid = Auth::user()->id;
			$action = Request::query('action');
			$bid = (int) Request::segment(2);
			$newFileName = null;

			if (Input::hasFile('avatar'))
			{
				$bid = Input::get('bid');
				$file = Input::file('avatar');
				$daten = date('m').date('d').date('Y');
				$newFileName = 'logo_'.$daten."_".$uid."_".$bid.".png";
				$size = (int) $file->getSize();
				$path = $file->getRealPath();
				echo "
				<script type='text/javascript' src='/js/jquery-git2.min.js'></script>\n
				<script type='text/javascript' src='/js/main.js'></script>
				";
				echo "<div style='text-align: center'><img width='250px' height='220px' src='/img/uploads/".$newFileName."'> </div>";

				$validator = Validator::make(Input::all(), Upload::$uploadrules);
				if ($validator->passes()) {
						if ($size>=100024){
							echo "<div style='text-align: center;'><h2>Your logo image must be 400 px by 400px </h2>";
							return "<button onclick='window.history.back();'>Go Back</button></div>";

						}
						$file->move('img/uploads', $newFileName);
						$duplicateFound = DB::table('uploads')->where('filename','=',$newFileName)
							->where('bid','=',$bid)->count();
						if ($duplicateFound==0) {
							$uploaded = DB::table('uploads')->insert(
								[
									'filename' => $newFileName,
									'uid'      => $uid,
									'bid'      => $bid,
								]
							);
						}else{
							$output = Upload::where('bid', '=',$bid)->where('filename','=', $newFileName)->update(
								['filename' => $newFileName]
							);
						}
					}else{
						return Redirect::to('upload')->with('message', 'The following errors occurred')->withErrors
						($validator)
							->withInput();
					}
			 echo "uploaded";
			}
		return View::make('bars/upload')->with('action', $action)->with('filename', $newFileName)->with('bid', $bid);
	}
}
