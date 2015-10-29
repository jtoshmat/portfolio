<?php

namespace app\Transformer;

use app\Organization;
use League\Fractal\TransformerAbstract;

class OrganizationTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'groups'
    ];
    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(Organization $organization)
    {
        return [
            'id'            => (int) $organization->id,
            'code'          => $organization->code,
            'title'         => $organization->title,
            'description'   => $organization->description,
            'created_at'    => (string) $organization->created_at,
        ];
    }

    /**
     * Embed Groups.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeGroups(Organization $organization)
    {
        $groups = $organization->groups;

        return $this->collection($groups, new GroupTransformer());
    }
}
