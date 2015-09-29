<?php

namespace cmwn;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


	public static $loginRules = array(

		'email'=>'required|email',
		'password'=>'required',
	);

	public static $registerRules = array(
		'email'=>'required|email|unique:users|min:2',
		'password'=>'required|alpha_num|min:6,25|confirmed',
		'password_confirmation'=>'required|alpha_num|between:6,25',
	);

	public static $forgetRules = array(
		'email'=>'required|email|min:5',
	);
	public static $updateRules = array(
		'email'=>'required|email|min:2',
		'name'=>'required|string|min:5',
		'avatar'=>'image',
	);

	public function loginUser(Request $request){
		return $request::get('email');
	}

	public static function register(Request $request){
		$user = new User;
		$user->email = $request::get('email');
		$user->password = Hash::make($request::get('password'));
		if($user->save()){
			$LastInsertId = $user->id;
			return $LastInsertId;
		}
		return false;
	}

	public static function profileUpdate(Request $request, $id){
		$user = User::find($id);
		$user->name = $request::get('name');
		$user->expire_at = $request::get('expire_at');
		//$user->avatar = $request::get('avatar');
		if($user->save()){
			return 'updated';
		}
		return false;
	}

	public function activate($id, $action = 0){
		$User = User::find($id);
		$User->active = $action;
		$output = $User->save();
		return $output;
	}

	public function activateAdmin($id, $action = 0){
		$User = User::find($id);
		$User->role = $action;
		$output = $User->save();
		return $output;
	}
}
