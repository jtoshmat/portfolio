<?php

namespace app\Transformer;

use app\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = [
    //     'friends'
    // ];

    protected $availableIncludes = [
        'friends',
        'groups'
    ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'         => (int) $user->id,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'sex'        => $user->sex,
            'dob'        => $user->dob,
            'slug'       => $user->slug,
            'joined'     => (string) $user->created_at,
        ];
    }
    /**
     * Embed Friends.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeFriends(User $user)
    {
        $friends = $user->friends;

        return $this->collection($friends, new UserTransformer());
    }

    /**
     * Embed Groups.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeGroups(User $user)
    {
        $groups = $user->groups;

        return $this->collection($groups, new GroupTransformer());
    }
}
