<?php

namespace app\Transformer;

use app\Organization;
use League\Fractal\TransformerAbstract;

class OrganizationTransformer extends TransformerAbstract
{
    protected $availableEmbeds = [];

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
}
