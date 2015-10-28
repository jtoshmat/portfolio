<?php

namespace app\Transformer;

use app\District;
use League\Fractal\TransformerAbstract;

class DistrictTransformer extends TransformerAbstract
{
    protected $availableEmbeds = [];

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
        ];
    }
}
