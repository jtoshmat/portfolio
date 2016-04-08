<?php

namespace app\Http\Controllers;

use app\Activate;
use app\User;
use Illuminate\Http\Request;

use app\Http\Requests;
use Illuminate\Support\Facades\Validator;
use app\Services\AdapterLog;
use app\Http\Controllers\AdapterController;
use app\Services\MyMail;
use Illuminate\Support\Facades\Hash;
use app\Schedule;

class ScheduleController extends DispatcherController
{
    protected $parms;

    public function schedule(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validator = Validator::make($this->parms[0], [
            'action' => array('required', 'regex:/^(get)$/i'),
        ]);
        if($validator->fails()){
            $message = $validator->errors()->getMessages();
            AdapterLog::log($message['action'][0].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($message['action'][0]);
        }
        $function = $this->parms[0]['action']."Schedule";
        $validator = $this->checkDataInput();
        if (isset($validator['code'])){
            return $this->errorWrongArgs($validator['message']);
        }
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $rules = $this->parms[0]['action']."ScheduleRules";
        $validator = Validator::make($this->parms[0], Schedule::$$rules);
        if (!$validator->passes()) {
            $messages = $validator->errors()->getMessages();
            $msg = null;
            foreach ($messages as $m){
                $msg.=" ".$m[0].";";
            }
            $error = [
                'code' => 500,
                'message' =>"Input validation:".$msg
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $error;
        }
        return true;
    }

    protected function getSchedule($request){
        $this->parms[0]['function'] = "schedule";
        $output = $this->callAdapter($this->parms[0]);
        return $this->responWithApi($output, $this->parms[0]);

    }
}
