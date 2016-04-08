<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class PatientTransformer extends TransformerAbstract
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
        $short = isset($parms['short'])?$parms['short']:null;

        if (!$data){
            return "data is empty";
        }
        $data = json_decode($data, true);

        if ($short=='yes'){
            return [
                'id' => $data[0]["getpatientinfo"][0]["ID"],
                'last name' => '',
                'first name' => $data[0]["getpatientinfo"][0]["LastName"],
                'home phone' => $data[0]["getpatientinfo"][0]["HomePhone"],

            ];
        }

        return [
            'id' => $data[0]["getpatientinfo"][0]["ID"],
            'last name' => '',
            'first name' => $data[0]["getpatientinfo"][0]["LastName"],
            'home phone' => $data[0]["getpatientinfo"][0]["HomePhone"],
            'address1' => $data[0]["getpatientinfo"][0]["Addressline1"],
            'address2' =>$data[0]["getpatientinfo"][0]["AddressLine2"],
            'city' =>$data[0]["getpatientinfo"][0]["City"],
            'state' =>$data[0]["getpatientinfo"][0]["State"],
            'zipcode' =>$data[0]["getpatientinfo"][0]["ZipCode"],
            'Physician Last Name' =>$data[0]["getpatientinfo"][0]["PhysLastName"],
            'Physician First Name' =>$data[0]["getpatientinfo"][0]["PhysFirstName"],
            'Physician UserName' =>$data[0]["getpatientinfo"][0]["PhysUserName"],
            'Physician Phone' =>$data[0]["getpatientinfo"][0]["HomePhone"],
            'email address' =>$data[0]["getpatientinfo"][0]["Email"],
            'cell phone' =>$data[0]["getpatientinfo"][0]["CellPhone"],
            'patient picture' =>''
        ];
    }

}
