<?php

	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;
	use Illuminate\Http\Response;

class BarController extends \BaseController {

	protected function isNotAuthorized(){
		if (\Session::get('privileges')==0){
			return 'user/403';
		}

	}

	protected function isAdmin(){
		return \Session::get('pusertype');
	}

	public function bars()
	{

		$action = (int) Request::query('action');
		if ($action){
			\Session::flash('mymessage','The record has been '.$action)->get();
		}

		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}

		$id = Auth::user()->id;


		switch ($this->isAdmin()){
			case 1: //Super Admin
				$bars = DB::select(DB::raw('select * from bars as b left join bevents as ev on b.id=ev.barid group by b.id'));
				break;

			case 2: //Bar Admin
				$bars = DB::select(DB::raw('select * from bars as b left join bevents as ev on b.id=ev.barid where b.uid = '.$id.' group by b.id'));
				break;

			case 3: //Bar Admin
				$bars = DB::select(DB::raw('select * from bars as b left join bevents as ev on b.id=ev.barid where b.uid = '.$id.' group by b.id'));
				break;

			default: //Anybody else
				$bars = NULL;
				break;
		}


		if ($bars){
			return View::make('bars/bars')->with('bars', $bars);
		}
		return View::make('bars/addbar');

	}

	public function bar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = (int) Request::query('id');

		switch ($this->isAdmin()){
			case 1: //Super Admin
				$bars = Bar::where('id', '=', $id)->firstOrFail();
				break;

			case 2: //Bar Admin
				$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;

			case 3: //Bar Admin
				$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;

			default: //Anybody else
				$bars = NULL;
				break;
		}

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
		$id = (int) Request::query('id');

		$method = Request::method();
		if (Request::isMethod('post'))
		{
			$validator = Validator::make(Input::all(), Bar::$updatebarrules);
			if ($validator->passes()) {
				$insertData = array(
					'uid' => Auth::user()->id,
					'barname' => Input::get('barname'),
					'address' => Input::get('address'),
					'city' => Input::get('city'),
					'state' => Input::get('state'),
					'zipcode' => Input::get('zipcode'),
			);

				DB::table('bars')->insert($insertData);
				return Redirect::to('bars')->with('message', 'Thanks for updaing your bar');

			}else{
				$id = Input::get('id');
				return Redirect::to('editbar?id='.$id)->with('message', 'The following errors occurred')->withErrors
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
				$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;

			case 3: //Bar Admin
				$bars = Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
				break;

			default: //Anybody else
				$bars = NULL;
				break;
		}

		if ($bars){
			return View::make('bars/editbar')->with('bars', $bars);
		}
		return $bars;
		return View::make('user/403');


	}

	public function deleteBar()
	{
		if ($this->isNotAuthorized()){
			return 'Unauthorized Access';
		}
		$id = (int) Request::query('id');

		Bar::find($id)->delete();
		Upload::where('bid','=', $id)->delete();
		Bevent::where('barid','=', $id)->delete();
	
		\Session::flash('mymessage','The bar has been deleted');
		return 'The bar has been deleted';

	}

	public function updateBar()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = Request::get('id');
		$Bar = Bar::find($id);
		$Bar->promo = Input::get('promo');
		$Bar->address = Input::get('address');
		$Bar->city = Input::get('city');
		$Bar->zipCode = Input::get('zipcode');
		$Bar->save();
		\Session::flash('mymessage','The bar has been updated');
		return View::make('bars/editbar')->with('bars', $Bar);


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
				$insertData = array(
					'uid' => Auth::user()->id,
					'barname' => Input::get('barname'),
					'address' => Input::get('address'),
					'city' => Input::get('city'),
					'state' => Input::get('state'),
					'zipcode' => Input::get('zipcode'),

				);

				DB::table('bars')->insert($insertData);
				return Redirect::to('bars')->with('message', 'Thanks for registering your bar');

			}else{
				return Redirect::to('addbar')->with('message', 'The following errors occurred')->withErrors($validator)
					->withInput();
			}
				return Redirect::to('addbar')->with('message', 'Thanks for registering!');

		}
		return View::make('bars/addbar');
	}

	public function bevents()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = (int) Request::query('id');

		switch ($this->isAdmin()){
			case 1: //Super Admin
				$bevents = Bevent::where('barid', '=', $id)->get();
				break;

			case 2: //Bar Admin
				$bevents = Bevent::where('barid', '=', $id)->where('userid','=', Auth::user()->id)->get();
				break;

			default: //Anybody else
				$bars = NULL;
				break;
		}

		if ($bevents){
			return View::make('bars/bevents')->with('bevents', $bevents);
		}
		return View::make('user/403');



	}

	public function bevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = (int) Request::query('id');

		switch ($this->isAdmin()){
			case 1: //Super Admin
				$bevents = Bevent::where('barid', '=', $id)->get();
				break;

			case 2: //Bar Admin
				$bevents = Bevent::where('barid', '=', $id)->where('userid','=', Auth::user()->id)->get();
				break;

			default: //Anybody else
				$bars = NULL;
				break;
		}

		if ($bevents){
			return View::make('bars/bevents')->with('bevents', $bevents);
		}
		return View::make('user/403');


	}

	public function editBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = (int) Request::query('id');
		$bevent = Bevent::where('bid', '=', $id)->firstOrFail();
		return View::make('bars/editBevent')->with('bevent', $bevent);

	}

	public function updateBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = Request::get('id');
		$Bevent = Bevent::find($id);
		$Bevent->title = Input::get('title');
		$Bevent->save();
		\Session::flash('mymessage','The bar has been updated');
		return View::make('bars/editbevent')->with('bevent', $Bevent);


	}

	public function deleteBevent()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}
		$id = (int) Request::query('id');
		$Bevent = Bevent::where('bid','=', $id);
		$Bevent->delete();
		\Session::flash('mymessage','The event has been deleted');
		return 'The event has been deleted';

	}

	public function uploadImage()
	{


			$uid = Auth::user()->id;
			$action = Request::query('action');
			$bid = (int) Request::query('bid');
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

				echo "<div style='text-align: center'><img src='img/uploads/".$newFileName."'> </div>";

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
