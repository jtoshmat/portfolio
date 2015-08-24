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
		return View::make('bars/addbar')->with('username',Auth::user()->username)->with('admin', $this->isAdmin());
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
				$bid = Request::get('id');
				$uid = Request::get('uid');

				$validator = Validator::make(Input::all(), Bar::$updatebarrules);
				if ($validator->passes()) {
					if (Input::hasFile('logo')){
						$this->uploadLogo($bid);
					}
					$email = Request::get('owner_email');
					$isUserEmailValid = User::where('username','=',$email)->get(array('username'));
					foreach ($isUserEmailValid as $em){

					}
					if (empty($em)){
						$user = new User;
						$user->username = $email;
						$user->email = $email;
						$user->password = Hash::make(Input::get('abc123'));
						$user->save();
						$uid = $bid = $LastInsertId = $user->id;
						$insertData = array('uid' => $LastInsertId,'pusertype' => 6, 'privileges'=>6);
						DB::table('roles')->insert($insertData);

					}else{
						$userdata = User::where('username','=',$email)->get(array('id'));
						foreach ($userdata as $usd){}
						$uid = $usd->id;
					}	


					$Bar = new Bar();

					$output = $Bar->updateBar($bid, $uid);

					if ($output!==1){
						return "The bar is not updated";
					}	
					return Redirect::to('bars')->with('message', 'Thanks for updaing your bar');

				}else{

					return Redirect::to('editbar/'.$bid)->with('message', 'The following errors occurred')->withErrors
					($validator)
						->withInput();
				}
				return Redirect::to('bars')->with('message', 'Thanks for up!');

			}

	 
		$bars = DB::select(DB::raw('select * from bars as b left join uploads as upl on b.id=upl.bid where b.id='.$id.' group by b.id'));
 
		if ($bars){
			return View::make('bars/editbar')->with('bars', $bars)->with('username',Auth::user()->username)->with
			('admin', $this->isAdmin());
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
				$lastInsertedBarId = $this->bars->addBar();
				if (Input::hasFile('logo')){
					$this->uploadLogo($lastInsertedBarId);
				}
				return Redirect::to('bars')->with('message', 'Thanks for registering your bar');

			}else{
				return Redirect::to('addbar')->with('message', 'The following errors occurred')->withErrors($validator)
					->withInput();
			}
		}
		return View::make('bars/addbar')->with('username',Auth::user()->username)->with('admin', $this->isAdmin());
	}

	protected function uploadLogo($bid){
		$output = null;
		$uid = Auth::user()->id;
		$file = Input::file('logo');
		$daten = date('m').date('d').date('Y');
		$path = $file->getRealPath();
		$newFileName = 'logo_'.$daten."_".$uid."_".$bid.".png";
		$size = (int) $file->getSize();
		list($width, $height) = getimagesize($file);
		$file->move('img/uploads', $newFileName);
		$image = Image::make(sprintf('img/uploads/%s', $newFileName))->resize(250, 250)->save();
		$Upload = new Upload();
		$Upload->addUploadedImage($newFileName, $bid);
		return 1;
	}

}
