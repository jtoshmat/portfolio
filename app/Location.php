<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'locations';
    protected $fillable = [];
    protected $parms;
    public static $createLocationRules = array(
        'orgid' => 'required|integer',
        'action' => array('required', 'regex:/^(create)$/i'),
        'station_id' => 'required|exists:stations,id',
        'station_data1' => 'required|integer',
        'station_data2' => 'required|integer',
        'location_datetime' => 'required|string',
        'event' => array('required', 'regex:/^A|D$/i'),
        'visit_id' => 'required_if:event,D|integer',
        'device_id' => 'required|string',


    );


    public function createLocation($data){
        $this->parms = $data;
        $output = new \stdClass();
        $output->error = false;
        $output->message = null;
        $output->data = null;

        //Step 1
/*        $organization = $this->getOrganization();
        if (!$organization){
            $output->error = true;
            $output->message = "Organization is not found";
            return $output;
        }*/

        //Step 2
/*        $station = $this->getStation($organization);
        if(!$station){
            $output->error = true;
            $output->message = "Station is not found";
            return $output;
        }*/

        //Step 3
        $inserted = $this->insertLocation();
        if($inserted["error"]){
            $output->error = true;
            $output->message = "Location creation failed";
            return $output;
        }

        unset($output->message);
        unset($output->data);
        $output->visit_id = $inserted;
        return $output;
    }

    protected function getOrganization(){
        $organization = Organization::where('id', $this->parms['station_id'])->first();
        return $organization;
    }

    protected function getStation($organization){
        return $organization->stations
            ->where('major',$this->parms['station_data1'])
            ->where('minor',$this->parms['station_data2'])
            ->first();
    }

    protected function insertLocation(){
        $output = new \stdClass();
        $output->error = false;
        $output->message = null;
        $output->data = null;

        $this->event = $this->parms['event'];
        $this->station_id = $this->parms['station_id'];

        if($this->parms['event'] =='A') {
            $output->message = "Arrival Error: ";
            $this->visit_id = rand(123456789, 999999999);
        }else{
            $this->visit_id = $this->parms['visit_id'];
            $output->message = "Departure Error:";
        }

        $this->cid = $this->parms['cid'];
        $this->deviceID = $this->parms['device_id'];
        $this->createdBy = $this->parms['cid'];
        $this->created_at = $this->parms['location_datetime'];

        if (!$this->save()){
            $output->error = true;
            $output->message .= " location is not created/updated";
            return $output;
        }
        return $this->visit_id;
    }

    public function user(){
        return $this->belongsTo('app\User');
    }
}