<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class ActivationTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = [
    //
    // ];

    protected $availableIncludes = [

    ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public static function transform($data, $parms)
    {
        $output = [
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
        ];

        return $output;
    }

}