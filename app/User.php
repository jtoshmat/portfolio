<?php

namespace cmwn;

use cmwn\UserRole;
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

    /*
     * Register all the form validation rules here for User
     */
    public static $memberUpdaRules = array(
        'name'=>'required|string|min:2',
        //'role[]'=>'required',
        //'role[]'=>'required|regex:/^[0-9]?$/',
    );

	public static $memberDeleteRules = array(
		//'id'=>'required|regex:/^[0-9]?$/',
	);


    public function role()
    {
        //return $this->hasManyThrough('cmwn\Role', 'cmwn\UserRole', 'user_id', 'id');
        return $this->belongsToMany('cmwn\Role');
    }

    public function hasRole(Array $roles)
    {
        foreach ($roles as $role) {
            if($this->role->contains('title', $role)) {
                return true;
            }
        }

        return false;
    }


    public static function updateMember(Request $request, $id){
        $roles = $request::get('role');

		//Delete all the roles for this id
        foreach($roles as $role_id){
            $roleuser = UserRole::where('user_id','=',$id);
	        if($roleuser) {
		        $roleuser->delete();
	        }
        }
	    //Create all the new requested roles for this id
	    foreach($roles as $role_id){
		    $UserRole = new UserRole();
		    $UserRole->user_id = $id;
		    $UserRole->role_id = $role_id;
		    $UserRole->save();
	    }
		//Update the user's information
        $user = User::find($id);
        $user->name = $request::get('name');
        if($user->save()){
            return true;
        }
        return false;
    }

	public static function deleteMember($id){
		$user = User::find($id);
		$user->delete();
		if($user){
			return true;
		}
		return false;

	}


}
