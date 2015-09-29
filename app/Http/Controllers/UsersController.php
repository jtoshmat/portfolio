<?php
namespace jontoshmatov\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use jontoshmatov\Http\Requests;
use jontoshmatov\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use jontoshmatov\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Users login
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
	 if (Request::isMethod('post'))
	    {
		    $validator = Validator::make(Input::all(), User::$loginRules);
		    if ($validator->passes()) {
			    //return Hash::make('business');
				return $this->authenticate();

		    }
		    return Redirect::to('users/login')->with('message', 'The following errors occurred')->withErrors
		    ($validator)->withInput();

	    }
	    $loggedin = (Auth::check())?true:false;
	    return view('users/login', compact('loggedin'));
    }

	protected function getLoginCredentials()
	{
		return [
			"email" => Input::get("email"),
			"password" => Input::get("password")
		];
	}

	public function authenticate()
	{
		$credentials = $this->getLoginCredentials();
		$remember = Input::get("remember");

		if (Auth::validate($credentials)) {
			$user = Auth::getLastAttempted();
			//do not login if the membership is expired

			if ($user->id!=1) {
				$dateDiff = $this->compareDates($user->expire_at, date('Y-m-d H:i:s'));
				if (!$dateDiff) {
					//Redirect the member to payment page
					return Redirect::to('users/payment')->with('message', 'The following errors occurred')->withErrors
					('Your membership is expired. Please contact the admin.');
				}
			}
			//Login only if membership is active
			if ($user->active) {
				Auth::login($user, $remember);
				return redirect()->intended('/');
			}else{
				return Redirect::to('users/login')->with('message', 'The following errors occurred')->withErrors
				('Your account has been locked. Please contact the admin.');
			}
		}
		return Redirect::to('users/login')->with('message', 'The following errors occurred')->withErrors
		('Your credentials are not correct');
	}

	protected function compareDates($datetime1a, $datetime2b){
		$todayDate = date('Y-m-d', strtotime($datetime1a));
		$todayDate = strtotime($todayDate);
		$expireDate = date('Y-m-d', strtotime($datetime2b));
		$expireDate = strtotime($expireDate);
		$dayDiff = $todayDate >= $expireDate; //works

		$todayTime = date('H', strtotime($datetime1a));
		$expireTime = date('H', strtotime($datetime2b));
		$timeDiff = $todayTime >= $expireTime;



		if($dayDiff){
			if ($timeDiff) {
				return true; //membership is expired
			}
		}
		 return false;
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
	    return view('users/login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Forget password
     *
     * @param  int  $id
     * @return Response
     */
    public function forgotPassword()
    {
	    if (Request::isMethod('post')) {
		    $validator = Validator::make(Input::all(), User::$forgetRules);
		    if ($validator->passes()) {
				dd('sending your password to your email');
		    }
		    return Redirect::to('users/forgotpassword')->with('message', 'The following errors occurred')->withErrors
		    ($validator)->withInput();
	    }
	    return view("users/forgotpassword");
    }

	protected function retrievePassword(){

	}

	/**
	 * Register a new account
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function register(Request $request)
	{
		if (Request::isMethod('post'))
		{
			$validator = Validator::make(Input::all(), User::$registerRules);
			if ($validator->passes()) {
				$lastInsertedId = User::register($request);
				MailController::send(Input::get('email'), 'register');
				return $this->authenticate();
				return Redirect::to('users/login')->with('message', 'Thanks for registering!');
			} else {
				return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors
				($validator)->withInput();
			}
		}
		return view("users/register");
	}

	/**
	 * Logout user
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();
		return Redirect::to('users/login')->with('message', 'The following errors occurred')->withErrors
		('Your are logged out successfully');
	}

	/*
	 * Profile
	 */
	public function profile(Request $request){
		$path = base_path('public');
		$admin = Auth::user()->role;
		$id = Auth::user()->id;
		if ($admin==1) {
			$id = (int)Request::segment(3);
		}
		$user = User::find($id);
		$data = array(
			'id' => $id,
			'path' => $path
		);
		if(empty($user)){
			return view('errors/404');
		}

		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), User::$updateRules);
			if ($validator->passes()) {
				$output = User::profileUpdate($request, $id);
				return Redirect::route('users/profile', $id)->with('message', 'State saved correctly!!!');
			}else{
				return Redirect::to('users/profile/'.$id)->with('message', 'The following errors occurred')->withErrors
				($validator)->withInput();
			}
		}


		return view('users/profile', compact('user','data'));
	}

	public function profiles(){
		$admin = Auth::user()->role;
		$id = Auth::user()->id;
		if ($admin==1) {
			$users = User::paginate(25);
		}else {
			$users = User::where('id','=',$id)->get();
		}
		return view('users/profiles', compact('users', 'admin'));
	}

	public function activate(){
		$admin = Auth::user()->role;
		$id = (int)Request::segment(3);
		$action = Request::segment(4);

		if ($id==1){
			return Redirect::to('users/profiles');
		}
		if ($admin!==1){
			return Redirect::to('users/profiles');
		}

		$User = new User();
		if ($action=='activate'){
			$User->activate($id, 1);
			return Redirect::to('users/profiles');
		}
		if ($action=='deactivate'){
			$User->activate($id, 0);
			return Redirect::to('users/profiles');
		}
		return false;
	}

	public function activateAdmin(){
		$admin = Auth::user()->role;
		$id = (int)Request::segment(3);
		$action = Request::segment(4);

		if ($id==1){
			return Redirect::to('users/profiles');
		}

		if ($admin!==1){
			return Redirect::to('users/profiles');
		}

		$User = new User();
		if ($action=='admin'){
			$User->activateAdmin($id, 1);
			return Redirect::to('users/profiles');
		}
		if ($action=='nonadmin'){
			$User->activateAdmin($id, 0);
			return Redirect::to('users/profiles');
		}
		return false;
	}

	public function payment(){
		return view('users/payment');
	}

}
