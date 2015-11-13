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
        'groups',
        'roles',
        'children',
        'guardians',
        'blockedfriends',
        'pendingfriends',
        'friendrequests',
        'organizations'
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
            'role'      =>  isset($user->pivot->role_id)?$user->pivot->role_id:'',
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
     * Embed friendrequests.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeFriendRequests(User $user)
    {
        $friendrequests = $user->friendrequests;
        return $this->collection($friendrequests, new UserTransformer());
    }

    /**
     * Embed blockedfriends.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeBlockedFriends(User $user)
    {
        $blockedfriends = $user->blockedfriends;
        return $this->collection($blockedfriends, new UserTransformer());
    }

    /**
     * Embed pendingfriends.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includePendingFriends(User $user)
    {
        $pendingfriends = $user->pendingfriends;
        return $this->collection($pendingfriends, new UserTransformer());
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

    /**
     * Embed Roles.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeRoles(User $user)
    {
        $roles = $user->role;
        return $this->collection($roles, new RoleTransformer());
    }



    /**
     * Embed Guardian.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeGuardians(User $user)
    {
        $guardians = $user->guardians;
        return $this->collection($guardians, new UserTransformer());
    }

    /**
     * Embed Children.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeChildren(User $user)
    {
        $children = $user->children;
        return $this->collection($children, new UserTransformer());
    }

    /**
     * Embed Organizations.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeOrganizations(User $user)
    {
        $organizations = $user->organizations;
        return $this->collection($organizations, new OrganizationTransformer());
    }
}
