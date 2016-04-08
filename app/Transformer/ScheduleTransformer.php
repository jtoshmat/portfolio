<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
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
            $output[$num] = $data[$num]["getencounterlistinfo"];
            foreach ($output[$num] as $num2=>$data3){
                $alldata[$num][$num2] = [
                'patientID' => $data3["patientid"],
                'encounterID' => $data3['ID'],
                'encounterDateTime' => $data3["DTTM"],
                'visitID' => $data3["VisitID"],
                'performingProviderID' => $data3["PerformingProviderID"],
                'performingProviderName' => $data3["PerformingProviderName"],
                'appointmentComments' => $data3["ApptComment"],
                'EncounterType' => $data3["EncounterType"]
                ];
            }
        }
       return $alldata;
    }

}