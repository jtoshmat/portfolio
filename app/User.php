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
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;
	protected $dates = ['deleted_at'];

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
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'slug',
        'password'
    ];

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
        'first_name'=>'required|string|min:2',
        'middle_name'=>'required|string|min:2',
        'last_name'=>'required|string|min:2',
        'email'=>'required|email|min:2',
        'slug'=>'required|string|unique:users|min:2',
        //'role[]'=>'required',
        //'role[]'=>'required|regex:/^[0-9]?$/',
    );

	public static $memberDeleteRules = array(
		//'id'=>'required|regex:/^[0-9]?$/',
	);

    public static function boot()
    {
        parent::boot();

        User::creating(function ($user) {
            echo('creating ');
        });
        
        // Attach event handler, on deleting of the user
        User::deleting(function($user)
        {   
            //@TODO Finish this up
            echo('deleting ');
            $user->groups()->detach();
            $user->organizations()->detach();
        });
    }

    public function role()
    {
        return $this->belongsToMany('cmwn\Role');
    }

    public function groups()
    {
         return $this->belongsToMany('cmwn\Group');
    }

    public function organizations()
    {
         return $this->belongsToMany('cmwn\Organization');
    }

    public function children()
    {
        return $this->belongsToMany('cmwn\User', 'child_guardian', 'guardian_id', 'child_id');
    }

    public function guardians()
    {
        return $this->belongsToMany('cmwn\User', 'child_guardian', 'child_id', 'guardian_id');
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
	    $roles = ($roles)?$roles:array();
	    $user = User::find($id);
	    $user->role()->sync($roles);
        $user->name = $request::get('name');
        if($user->save()){
            return true;
        }
        return false;
    }

	public static function deleteMember($id){
		$user = User::find($id);
		if(!$user->role()->detach()){
			$user->delete();
		}

		if($user){
			return true;
		}
		return false;

	}


}
