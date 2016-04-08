<?php

namespace app\Http\Controllers;
use app\Location;
use Illuminate\Http\Request;
use app\Http\Requests;
use Illuminate\Support\Facades\Validator;
use app\Services\AdapterLog;

class LocationsController extends DispatcherController
{

    protected $parms;

    public function location(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $this->checkDataInput();
        $function = $this->parms[0]['action']."Location";
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $action = isset($this->parms[0]['action'])?$this->parms[0]['action']:null;
        if (!$action){
            $error = [
                'response' => 500,
                'message' =>"action is missing"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            $this->errorNotFound($error['message']);
            exit(json_encode($error));
        }

        if ($action!='create'){
            $error = [
                'response' => 500,
                'message' =>"bad action method"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }
    }

    protected function createLocation(){
        $validator = Validator::make($this->parms[0], Location::$createLocationRules);
        if (!$validator->passes()) {
            $messages = $validator->errors()->getMessages();
            $msg = null;
            foreach ($messages as $m){
                $msg.=" ".$m[0];
            }
            $error = [
                'response' => 500,
                'message' =>"Input validation:".$msg
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }
        $location = new Location();
        $output = $location->createLocation($this->parms[0]);

        if ($output->error){
            $error = [
                'response' => 500,
                'message' =>$output->message
            ];
            return $this->errorInternalError($error['message']);

        }
        return $this->successfullReponse('Your location has been created', ['visit_id' => $output->visit_id]);
    }
}
