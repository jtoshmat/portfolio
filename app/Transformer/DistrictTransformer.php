<?php

namespace app\Transformer;

use app\District;
use app\Group;
use app\Organization;
use League\Fractal\TransformerAbstract;

class DistrictTransformer extends TransformerAbstract
{
    protected $availableEmbeds = [];

    protected $availableIncludes = [
        'organizations',
        'DistrictByName'

    ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(District $district)
    {
        return [
            'id'            => (int) $district->id,
            'system_id'     => (int) $district->system_id,
            'code'          => $district->code,
            'title'         => $district->title,
            'description'   => $district->description,
            'created_at'    => (string) $district->created_at,
            'csrf_token'    => csrf_token()

        ];
    }

    /**
     * Embed Organizations.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeOrganizations(District $district)
    {
        $organizations = $district->organizations;

        return $this->collection($organizations, new OrganizationTransformer());
    }

}
