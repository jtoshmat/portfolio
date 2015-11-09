<?php

namespace app\cmwn\Traits;

trait RoleTrait
{
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

    public function isSuperAdmin(User $user)
    {
        return ($this->superAdmins()->where('user_id', $user_id)->count() > 0);
    }

    public function isAdmin(User $user)
    {
        return ($this->admin()->where('user_id', $user_id)->count() > 0);
    }

    public function isMember(User $user)
    {
        return ($this->members()->where('user_id', $user->id)->count() > 0);
    }
}
