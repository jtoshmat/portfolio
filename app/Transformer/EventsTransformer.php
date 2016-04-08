<?php

namespace app\Transformer;

use app\Patient;
use League\Fractal\TransformerAbstract;

class EventsTransformer extends TransformerAbstract
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

        return $data;
        if(!count($data)){
            return "No event is found";
        }
        if(count($data)>1){
            $categories = [];
                foreach($data as $num=>$data2){
                        $output[$num] = [
                            'id' => $data2->id,
                            'datetime' => $data2->datetime,
                            'description' => $data2->description,
                            'location' => $data2->location,
                            'registration_required' => ($data2->registration_required)?'Yes':'No',
                            'image' => $data2->image,
                            'categories' => '',
                        ];

                        if ($data->show) {
                            if (isset($data2->notifications->id)){
                                $output[$num]['user_notified'] = true;
                            }
                            if (isset($data2->registrations->id)) {
                                $output[$num]['user_registered'] = true;
                            }
                        }
                    }
                    return $output;
                }

          $output = [
                    'id' => $data->id,
                    'datetime' => $data->datetime,
                    'description' => $data->description,
                    'location' => $data->location,
                    'registration_required' => ($data->registration_required)?'Yes':'No',
                    'image' => $data->image,
                    'categories' => '',
                ];

        if ($data->show && isset($parms['user_id'])) {
            if (isset($data->notifications->id)){
                $output['user_notified'] = true;
            }
            if (isset($data->registrations->id)) {
                $output['user_registered'] = true;
            }
        }
        return $output;
    }

}