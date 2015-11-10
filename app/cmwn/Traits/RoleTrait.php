<?php

namespace app\cmwn\Traits;

trait RoleTrait
{
    public static function limitToUser($user_id)
    {
        return self::whereHas('users', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        });
    }

    public function users()
    {
        return $this->morphToMany('app\User', 'roleable');
    }

    public function superAdmins()
    {
        $role_id = (int) \Config::get('mycustomvars.roles.super_admin');

        return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id', $role_id);
    }

    public function admins()
    {
        $role_id = (int) \Config::get('mycustomvars.roles.admin');

        return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id', $role_id);
    }

    public function members()
    {
        $role_id = (int) \Config::get('mycustomvars.roles.member');

        return $this->morphToMany('app\User', 'roleable')->wherePivot('role_id', $role_id);
    }

    public function isUser($user_id)
    {
        return ($this->users()->where('user_id', $user_id)->count() > 0);
    }

    public function isSuperAdmin($user_id)
    {
        return ($this->superAdmins()->where('user_id', $user_id)->count() > 0);
    }

    public function isAdmin($user_id)
    {
        return ($this->admin()->where('user_id', $user_id)->count() > 0);
    }

    public function isMember($user_id)
    {
        return ($this->members()->where('user_id', $user_id)->count() > 0);
    }

    public function canUpdate($user_id)
    {
        return ($this->users()->where('user_id', $user_id)->where('role_id', '>', 1)->count() > 0);
    }
}
