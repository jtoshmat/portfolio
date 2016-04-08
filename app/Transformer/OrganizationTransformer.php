<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class OrganizationTransformer extends TransformerAbstract
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
        $alldata = [];
        foreach($data as $num=>$data2){
                $alldata[$num] = [
                    "beaconID" => $data2->beacon_id,
                    "appName" => $data2->app_name,
                    "appLogo" => $data2->app_logo,
                    "appTimeOut" => $data2->app_timeout,
                    "passwordFormat" => $data2->password_format,
                    "createdBy" => $data2->userByCid($data2->createdBy),
                    "updatedBy" => $data2->userByCid($data2->updatedBy),
                    "appTimeOut" => $data2->app_timeout,
                ];

            foreach($data2->stations as $num2=>$station){
                $alldata[$num]['stations'][$num2] =[
                    'description' => $station->description,
                    'major' => $station->major,
                    'minor' => $station->minor,
                    'id' => $station->id,
                    //"createdBy" => $station->userByCid($station->createdBy),
                    //"updatedBy" => $station->userByCid($station->updatedBy),
                ];

   /*             foreach($station->locations as $num3=>$location){
                    $alldata[$num]['stations'][$num2]['locations'][$num3] =[
                        'locationID' =>$location->id,
                        'deviceID' =>$location->deviceID,
                        'event' =>$location->event
                    ];
                }*/
            }
        }
        return $alldata;

    }
}