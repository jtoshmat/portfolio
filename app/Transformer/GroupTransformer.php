<?php

namespace app\Transformer;

use app\Group;
use League\Fractal\TransformerAbstract;

class GroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = [ 'users' ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(Group $group)
    {
        return [
            'id'            => (int) $group->id,
            'title'         => $group->title,
            'description'   => $group->description,
            'created_at'    => (string) $group->created_at,
        ];
    }

    /**
     * Embed Friends.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeUsers(Group $group)
    {
        $users = $group->users;

        return $this->collection($users, new UserTransformer());
    }
}
