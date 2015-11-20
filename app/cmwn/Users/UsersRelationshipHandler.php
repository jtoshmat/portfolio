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

    public static function isUserInSameEntity($admin, $member, $entity = 'groups')
    {
        $admin_entities = $admin->entities($entity, self::ADMIN, self::SUPER_ADMIN)->lists('id')->toArray();
        $member_entites = $member->entities($entity, self::MEMBER)->lists('id')->toArray();
        $result = array_intersect($admin_entities, $member_entites);
        if (!empty($result)){
            return true;
        }
        return false;
    }
}
