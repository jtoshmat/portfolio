<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class ProviderTransformer extends TransformerAbstract
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
        $alldata = [];
        foreach($data as $num=>$data2){
            $output[$num] = $data[$num]["getproviderinfo"];
            foreach ($output[$num] as $num2=>$data3){
                $alldata[$num][$num2] = [
                    'LastName' => $data3["LastName"],
                    'MiddleName' => $data3["MiddleName"],
                    'FirstName' => $data3["FirstName"],
                    'SuffixName' => $data3["SuffixName"],
                    'PrefixName' => $data3["PrefixName"],
                    'TitleName' => $data3["TitleName"],
                    'AddressLine1' => $data3["AddressLine1"],
                    'AddressLine2' => $data3["AddressLine2"],
                    'City' => $data3["City"],
                    'State' => $data3["State"],
                    'ZipCode' => $data3["ZipCode"],
                    'Phone' => $data3["Phone"],
                    'Fax' => $data3["Fax"],
                    'Specialty' => $data3["Specialty"],
                ];
            }
        }
        return $alldata;
    }

}