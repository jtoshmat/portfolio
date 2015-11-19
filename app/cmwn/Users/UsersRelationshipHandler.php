<?php

namespace app\cmwn\Users;

use app\User;
use app\Group;

class UsersRelationshipHandler
{
    const MEMBER_ID = 3;
    const MEMBER_TEACHER_ID = 2;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const MEMBER = 3;

    public static function areWeFriends($user_id, $friend_id)
    {
        return User::whereHas('friends', function ($query) use ($friend_id, $user_id) {
            $query->where('status', 0)->where('friend_id', $friend_id)->where('user_id', $user_id);
        });
    }

    public static function areWeInSameClass($user_id, $friend_id)
    {
        $groups = User::find($user_id)->groups->lists('id');

        return User::find($friend_id)->whereHas('groups', function ($query) use ($groups, $friend_id, $user_id) {
            $query->whereIn('roleable_id', $groups)->whereIn('role_id', array(self::MEMBER_ID))->where('user_id', $friend_id);
        });
    }

    public static function isTeacherInSameClass($admin, $member, $entity = 'groups')
    {
        $admin_entities = $admin->entities($entity, self::ADMIN, self::SUPER_ADMIN)->lists('id')->toArray();
        $member_entites = $member->entities($entity, self::MEMBER)->lists('id')->toArray();

        dd($admin_entities);

        $result = array_intersect($admin_entities, $member_entites);

        dd($result);

        $classes = User::find($teacher_id)->whereHas($entity, function ($query) {
            $query->wherePivot('role_id', 1);
        })->lists('id');

        //whereIn('role_id', [1, 2])->where('user_id', $teacher_id)->lists('id');

        dd('hi there ' . $classes);

        return User::find($student_id)->whereHas('groups', function ($query) use ($classes, $student_id, $teacher_id) {
            $query->whereIn('roleable_id', $classes)->where('user_id', $student_id);
        })->count();
    }

    public static function getUserRoles($user_id)
    {
        $userRoles = User::find($user_id)->role;
        $roles = array();
        if (!$userRoles) {
            return $roles;
        }

        foreach ($userRoles as $role) {
            $roles[] = $role->title;
        }

        return $roles;
    }

    public static function checkUserRole($user_id, $role)
    {
        $userRoles = self::getUserRoles($user_id);
        $userDistricts = User::find($user_id)->districts;
        $userdistricts = array();
        foreach ($userDistricts as $district) {
            $userdistricts[$district->id] = $district->title;
        }

        $allowed = in_array($role, $userRoles);

        //Super Admins overwites all the roles
        if (in_array('super_admin', $userRoles)) {
            $allowed = true;
        }

        return $allowed;
    }

    public static function isTeacherAllowed($teacher_id, $student_id, $role)
    {
        $inTheSameClass = false;

        if (self::checkUserRole($teacher_id, $role)) {
            if (self::isTeacherInSameClass($teacher_id, $student_id) >= 1) {
                $inTheSameClass = true;
            }
        }

        return $inTheSameClass;
    }
}