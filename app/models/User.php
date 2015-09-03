<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User
  extends Eloquent
  implements UserInterface, RemindableInterface
{
	protected $table = "user";
	protected $hidden = ["password"];
	protected $fillable = ["username", "password", "email", "admin", "imported"];

	public static $rules = array(
	'username'=>'required|unique:user|min:2',
	'password'=>'required|alpha_num|min:6,12|confirmed',
	'password_confirmation'=>'required|alpha_num|between:6,12',
	'secretquestion'=>'required',
	'secretanswer'=>'required',
	);

	public static $forgotpasswordrules = array(
	'email'=>'required|email',
	);
	public static $resetpasswordrules = array(
	'email'=>'required|email',
	);

	public static $rules2 = array(
	'username'=>'required|email|min:4',

	);

	public static $userSelfUpdate = array(
		'username'=>'required|email|min:4',
		'password'=>'alpha_num|min:6,12|confirmed',
		'password_confirmation'=>'required_with:password|same:password|alpha_num|between:6,12',
	);

	public static $deleteUser = array(
		//'email'=>'required|email|min:4',

	);
	public static $verifyusernamerules = array(
		'email'=>'required|email|min:4',
	);

	public function uploads() {
		return $this->hasMany('Upload', 'uid');
	}

	public function bars() {
		return $this->hasMany('Bar', 'uid');
	}

	protected function isAdmin(){
		return Auth::user()->admin;
		//return \Session::get('pusertype');
	}

	public function getAuthIdentifier()
	{
	return $this->getKey();
	}

	public function getAuthPassword()
	{
	return $this->password;
	}

	public function getRememberToken()
	{
	return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	return "remember_token";
	}

	public function getReminderEmail()
	{
	return $this->email;
	}

	public function getAllUsers(){

		if ($this->isAdmin()==1){
			return User::all();
		}

		if ($this->isAdmin()==2){
			return DB::select(DB::raw('select * from user where parentid='.Auth::user()->id.' or id='.Auth::user()->id));
		}

		return User::where('id', '=', Auth::user()->id)->get();

	}

	public function index() {
		return User::all();
	}

	public function findById($id) {
		try {
			$user = $this->where('id', '=', $id)->firstOrFail();
			return $user;
		}
		catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return false;
		}
	}

	public function viewUser($id){
		return User::find($id);
	}

	public function getUser($id){
		return User::where('id', '=', $id)->firstOrFail();

	}

	public function registerUser(){
		$roles = Input::get('roles');
		$privileges = 6;
		$user = new User;
		$user->admin = 0;
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->email = Input::get('username');
		$user->secretquestion = Input::get('secretquestion');
		$user->secretanswer = Input::get('secretanswer');
		$user->save();
		$LastInsertId = $user->id;
		$insertData = array('uid' => $LastInsertId,'pusertype' => $roles, 'privileges'=>$privileges);

		return $LastInsertId;
	}

	public function deleteUser(){
		$id = (int) Request::segment(3);
		if ($id === Auth::user()->id){
			return "You can not delete your own account";
		}
		$Role = Role::where('uid','=',$id);
		$Role->delete();

		$User = User::find($id);
		return $User->delete();
	}

	public function updateUser(){
		$privileges = 6;
		$user = new User;
		$id = Input::get('id');

		if ($this->isAdmin()===2){
			$user->parentid = Auth::user()->id;
			if ($roles==1){
				$roles = 2;
			}
		}
		if ($this->isAdmin()!==2 && $this->isAdmin()!==1){
			$roles = 0;
		}

		$fillable = array(
			'email' => Input::get('email'),
			'password' => Hash::make(Input::get('password')),
		);

		$user = User::where('id', '=', $id)->update($fillable);

		$LastInsertId = $user->id;
		$insertData = array('uid' => $LastInsertId,'pusertype' => $roles, 'privileges'=>$privileges);

		if ($this->isAdmin()===2){
			$insertData = array('uid' => $LastInsertId,'pusertype' => $roles, 'privileges'=>$privileges);
		}

		$fillable = array(
			'pusertype' => Input::get('roles'),
		);

		$role = Role::where('uid', '=', $id)->update($fillable);
	}

	public function forgotPassword($secret=null){
		$email = Input::get('email');
		$secretanswer = Input::get('secretanswer');
		$found = User::where('username','=', $email)->get();
		$found = json_decode($found, true);

		$output = null;
		if (!empty($found[0]['username'])){
			$email = $found[0]['username'];

			$output = array(
				'username'=>$found[0]['username'],
				'secretquestion'=>$found[0]['secretquestion'],
				'secretanswer'=>$found[0]['secretanswer'],

				);
			$output['secrectanswer'] = null;

			if ($secret){
				if ($secretanswer===$found[0]['secretanswer']){
					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$";
					$newPassword = substr(str_shuffle($chars),0,8);
					$fillable = array(
						'password' => Hash::make($newPassword),
					);
					$response = User::where('username', '=', $email)->update($fillable);
					if ($response){
						return $newPassword;
					}
				}else{
					$output = array();
					$output['error'] = 'answer is incorrect';

				}
			}
		}
		return $output;
	}

	public function verifyUsername(){
		$username = Request::get('username');
		$output = User::where('username','=',$username)->get(array('username'));
		return $output;
	}

	public function createProfile($email){
		//Add a new user
		$user = new \User;
		$user->username = $email;
		$user->email = $email;
		$user->password = Hash::make('gopackgo');
		$user->save();
		$uid = $user->id;

		//Add a new role
		$role = new \Role;
		$role->uid = $uid;
		$role->pusertype = 6;
		$role->privileges = 6;
		$role->save();
		return $uid;
	}


	public function verifyUsernameApi($email){
		$output = User::where('username','=',$email)->get(array('username','id'));
		return $output;
	}

	public function createUserApi($email){
		//Add a new user
		$user = new \User;
		$user->username = $email;
		$user->email = $email;
		$user->password = Hash::make('gopackgo');
		$user->save();
		$uid = $user->id;

		//Add a new role
		$role = new \Role;
		$role->uid = $uid;
		$role->pusertype = 6;
		$role->privileges = 6;
		$role->save();
		return $uid;
	}
}
