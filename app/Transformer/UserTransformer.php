<?php

namespace app\Transformer;

use app\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableEmbeds = [
        'groups',
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
     * Embed Checkins.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function embedGroups(User $user)
    {
        $groups = $user->groups;

        return $this->collection($groups, new GroupTransformer());
    }
}
