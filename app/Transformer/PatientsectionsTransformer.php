<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class PatientsectionsTransformer extends TransformerAbstract
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
        $data = json_decode($data, true);

        return $data;
    }

}