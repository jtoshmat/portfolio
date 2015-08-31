<?php

class UserController
extends Controller
{
	public $User;

	public function __construct(){
	\Session::flash('mymessage','');
	$this->beforeFilter('csrf', array('on'=>'post'));
	$this->User = new User();
	}

	protected function isNotAuthorized(){
	//    if (\Session::get('privileges')==0){
	//        return 'user/403';
	//     }

	}

	protected function isAdmin(){
	return \Session::get('pusertype');
	}

	public function login()
	{
	if ($this->isPostRequest()) {
	  $validator = $this->getLoginValidator();

	  if ($validator->passes()) {
	    $credentials = $this->getLoginCredentials();

	    if (Auth::attempt($credentials)) {
	      /*
	      To represent rwx triplet use 4+2+1=7 | can do everything
	      To represent rw- triplet use 4+2+0=6 | read and write
	      To represent r-- triplet use 4+0+0=4 | read only
	      To represent --- triplet use 0 |  nothing
	      */
	      $uid = Auth::user()->id;
	        //$roleModel = new Role();
	        //$role = $roleModel->getRole($uid);
	        //$rid = $role->get(array('rid'));
	        //$rid = json_decode($rid, true);
	        //$rid = (int) $rid[0]['rid'];
	        //\Session::put('privileges', $role->privileges);
	        //\Session::put('pusertype', $role->pusertype);
	        \Session::flash('mymessage','You are logged in');
	      return Redirect::route("bars");
	    }

	    return Redirect::back()->withErrors([
	      "password" => ["Your email or password are incorrect."]
	    ]);
	  } else {
	    return Redirect::back()
	      ->withInput()
	      ->withErrors($validator);
	  }
	}

	return View::make("user/login");
	}

	protected function isPostRequest()
	{
	return Input::server("REQUEST_METHOD") == "POST";
	}

	protected function getLoginValidator()
	{
	return Validator::make(Input::all(), [
	  "username" => "required",
	  "password" => "required"
	]);
	}

	protected function getLoginCredentials()
	{
	return [
	  "username" => Input::get("username"),
	  "password" => Input::get("password")
	];
	}

	public function users()
	{
	if ($this->isNotAuthorized()){
	  return View::make($this->isNotAuthorized());
	}
	  $users = $this->User->getAllUsers();
	  $message = Request::query('action');
	 return View::make('user/users')->with('users', $users)->with('message',$message);
	}

	public function viewUser(){
	  $id = (int) Request::segment(3);
	  $user = $this->User->viewUser($id);
	  return View::make('user/viewuser')->with('user', $user);
	}

	public function request()
	{
	if ($this->isPostRequest()) {
	  $response = $this->getPasswordRemindResponse();

	  if ($this->isInvalidUser($response)) {
	    return Redirect::back()
	      ->withInput()
	      ->with("error", Lang::get($response));
	  }

	  return Redirect::back()
	    ->with("status", Lang::get($response));
	}

	return View::make("user/request");
	}

	protected function getPasswordRemindResponse()
	{
	return Password::remind(Input::only("email"));
	}

	protected function isInvalidUser($response)
	{
	return $response === Password::INVALID_USER;
	}

	public function reset($token)
	{
	if ($this->isPostRequest()) {
	  $credentials = Input::only(
	    "email",
	    "password",
	    "password_confirmation"
	  ) + compact("token");

	  $response = $this->resetPassword($credentials);

	  if ($response === Password::PASSWORD_RESET) {
	    return Redirect::route("bars");
	  }

	  return Redirect::back()
	    ->withInput()
	    ->with("error", Lang::get($response));
	}

	return View::make("user/reset", compact("token"));
	}

	public function register()
	{
	  if ($this->isNotAuthorized()){
	      return View::make($this->isNotAuthorized());
	  }

	  $method = Request::method();
	  if (Request::isMethod('post'))
	  {
	    $validator = Validator::make(Input::all(), User::$rules);
	    if ($validator->passes()) {
		    $this->User->registerUser();
	        return Redirect::to('users/login')->with('message', 'Thanks for registering!');
	    } else {
	        return Redirect::to('register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
	    }

	  }
	  $roles = array();
	  $privileges = array();
	  if ($this->isAdmin()==1){
	      $roles[1]='Super Admin';
	      $privileges[7] = 'All Privieleges';
	  }
	  $roles[2]='Bar Admin';
	  $privileges[6] = 'Read and Write';
	  $privileges[4] = 'Read Only';

	  if ($this->isAdmin()==0){
	      $roles=NULL;
	  }

	  return View::make("user/register")->with('roles',$roles)->with('privileges', $privileges);
	}

	public function forgotpassword()
	{
		$method = Request::method();
		$secretquestion = null;
		$username = null;
		$password = null;
		$secretanswer = null;
		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), User::$forgotpasswordrules);
			if ($validator->passes()) {
				/*
				 * Checking the security question and answer
				 */
				$secret = Request::get('secret');
				$User = new User();
				if($secret) {
					$password = $User->forgotPassword($secret);
					if (isset($password['secretanswer'])){
						$secretanswer = $password['secretanswer'];
						$secretquestion = 'dsdcsdcsdc';
						$username = 'sdcsdc';
					}
				}
				$response = $User->forgotPassword();
				if ($response){
					$secretquestion = $response['secretquestion'];
					$username = $response['username'];
					$secretanswer = $response['secretanswer'];
				}else{
					return Redirect::back()->with('message', 'The following errors occurred')->withErrors('Your email was not found')->withInput();
				}
			}else{
				return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
			}
		}
		if (isset($password['error'])){
			$password['error']='Your answer is incorrect';
		}

		return View::make("user/forgotpassword")->with('secretquestion', $secretquestion)->with('username',
			$username)->with('password', $password)->with('secretanswer', $secretanswer);
	}

	public function getUser(){
	  if ($this->isNotAuthorized()){
	      return View::make($this->isNotAuthorized());
	  }
	  //$id = (int) Request::query('id');
	  $id = (int) Request::segment(2);





	  //$users = DB::select(DB::raw('select * from user where parentid='.Auth::user()->id.' or id='.Auth::user()->id));
	  //$users = DB::select(DB::raw('select * from user left join roles on user.id=roles.uid where id='.$id))->get();
	  $users = User::find($id);


	  $roles = array();
	  $privileges = array();
	  if ($this->isAdmin()==1){
	      $roles[1]='Super Admin';
	      $privileges[7] = 'All Privieleges';
	  }

	  $roles[2]='Bar Admin';


	  $privileges[6] = 'Read and Write';
	  $privileges[4] = 'Read Only';

	  if ($this->isAdmin()==0){
	      $roles=NULL;
	  }
	  $users = $this->User->getUser($id);
	  $method = Request::method();
	  if (Request::isMethod('post'))
	  {

		  $validator = Validator::make(Input::all(), User::$rules2);
		  $roles = Input::get('roles');
		  $id = Input::get('id');

		  if ($validator->passes()) {
			  $id = Input::get('id');

			  $fillable = array(
				  'email' => Input::get('email'),
				  'password' => Hash::make(Input::get('password')),
				  'secretquestion' => Input::get('secretquestion'),
				  'secretanswer' => Input::get('secretanswer'),
			  );
			  $user = User::where('id', '=', $id)->update($fillable);

			  $fillable = array(
				  'pusertype' => Input::get('roles'),
			  );
			  $role = Role::where('uid', '=', $id)->update($fillable);

			  return Redirect::to('user/'.$id)->withErrors('Updated');

		  } else {
			  return Redirect::to('user/'.$id)->with('message', 'The following errors occurred')->withErrors
			  ($validator)
				  ->withInput();
		  }
		}

	  return View::make("user/user")->with('users', $users)->with('roles',$roles)->with('privileges',$privileges);
	}

	public function deleteUser(){
	  if ($this->isNotAuthorized()){
		  return 'Unauthorized Access';
	  }
	  $id = (int) Request::segment(3);

		$method = Request::method();
		if (Request::isMethod('post'))
		{
			$validator = Validator::make(Input::all(), Bar::$deleteUser);
			if ($validator->passes()) {
				\Session::flash('mymessage','The User has been deleted');
				return 'The user id: '.$id.' has been deleted';
			}else{
				\Session::flash('mymessage','The User can not been deleted');
				return 'The user id: '.$id.' can not been deleted';
			}
		}
		\Session::flash('mymessage','Validation failed');
		return 'Validation failed';

	}

	public function userUpdate()
	{
		if ($this->isNotAuthorized()){
			return View::make($this->isNotAuthorized());
		}

		$method = Request::method();
		if (Request::isMethod('post'))
		{
			$validator = Validator::make(Input::all(), User::$rules2);
			$roles = Input::get('roles');
			$id = Input::get('id');

			if ($validator->passes()) {
				$this->User->updateUser();
				return route('user', array('id' => $id))->with('message', 'Thanks for updating!');
			} else {
				return Redirect::to('user/'.$id)->with('message', 'The following errors occurred')->withErrors
				($validator)
					->withInput();
			}

			return route('user', array('id' => $id))->with('message', 'Thanks for updating!');
		}
		return Redirect::to('/profile');
	}

	protected function resetPassword($credentials)
	{
	return Password::reset($credentials, function($user, $pass) {
	  $user->password = Hash::make($pass);
	  $user->save();
	});
	}

	public function logout()
	{
	\Session::forget('pusertype');
	\Session::forget('privileges');
	\Session::put('pusertype',0);
	\Session::put('privileges',0);

	Auth::logout();

	return Redirect::route("user/login");
	}

	public function error()
	{
	return View::make('errors/error');

	}

	public function uploadcsv(){
	  /*
	   * This feature is in a lower priority
	   * It will be implemented later or in the next upgrade.
	   */
	  if (Input::hasFile('csvfile'))
	  {
		  return View::make("admin/uploadcsv")->withErrors('This feature is coming soon.');

	  }
	  return View::make("admin/uploadcsv");
	}

	public function verifyUsername(){
		$method = Request::method();
		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), User::$verifyusernamerules);
			if ($validator->passes()) {
				$User = new User();
				$output = $User->verifyUsername();
				return json_encode($output);
			}
		}
		return 'get email';
	}
}