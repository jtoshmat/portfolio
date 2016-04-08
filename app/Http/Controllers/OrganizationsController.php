<?php

namespace app\Http\Controllers;
use app\Location;
use app\Organization;
use Illuminate\Http\Request;
use app\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use app\Services\AdapterLog;

class OrganizationsController extends DispatcherController
{

    protected $parms;

    public function organization(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validator = Validator::make($this->parms[0], [
            'action' => array('required', 'regex:/^(get|create)$/i'),
        ]);
        if($validator->fails()){
            AdapterLog::log($validator->errors()->getMessages().' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($validator->errors()->getMessages());
        }
        $function = $this->parms[0]['action']."Organization";
        return $this->$function($request);
    }

    protected function checkDataInput(){
        return false;
    }

    protected function getOrganization(){
        $validator = Validator::make($this->parms[0], Organization::$getOrganizationRules);
        if (!$validator->passes()) {
            $messages = $validator->errors()->getMessages();
            $msg = null;
            foreach ($messages as $m){
                $msg.=" ".$m[0];
            }
            $error = [
                'code' => 500,
                'message' =>"Input validation:".$msg
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }
        $organization = new Organization();
        $data = $organization->getOrganization($this->parms[0]);

        $query = DB::getQueryLog();
                    $lastQuery = end($query);
                    AdapterLog::log($lastQuery);

        if(!$data){
            return [
                'code' => '500',
                'message' => 'Internal error: no organization is found'
            ];
        }
        $this->parms[0]['function'] = 'organization';
        return $this->responWithLocal($data, $this->parms[0]);
    }
}
