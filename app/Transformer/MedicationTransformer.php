<?php

namespace app\Transformer;

use app\Http\Controllers\ApiResponseController;
use app\Patient;
use League\Fractal\TransformerAbstract;

class MedicationTransformer extends TransformerAbstract
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
        $response = new ApiResponseController();
        if(isset($data['error'])){
            return $response->errorNotFound($data['error']['message']);
        }

        $output = [
            "detail" => $data["detail"],
            "code" => $data["code"],
            "transid" => $data["transid"],
            "status" => $data["status"],
            "entrycode" => $data["entrycode"],
            "description" => $data["description"],
            "section" => $data["section"],
            "displaydate" => $data["displaydate"],
            "sig" => $data["sig"],
            "medication" => $data["medication_name"],
            "displaydate" => $data["displaydate"],
            "provider" => $data["provider"]
        ];

        return $output;
    }


}