<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class EventCategoryTransformer extends TransformerAbstract
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
        $ouput = [];
        foreach ($data as $num=>$categories){
            $ouput[] = [
                'orgid' => $categories['orgid'],
                'category_id' => $categories['category_id'],
                'description' => $categories['description'],
                'icon' => $categories['icon'],
            ];
        }
        return $ouput;
    }

}