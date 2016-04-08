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
use app\Medication;

class MedicationController extends DispatcherController
{
    protected $parms;

    public function medication(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        if ($this->parms[0]['action']!='get'){
            return $this->errorWrongArgs('Action is not valid');
        }
        $function = $this->parms[0]['action']."Medication";
        $validation = $this->checkDataInput();
        if (isset($validation['code'])){
            return $this->errorWrongArgs($validation['message']);
        }
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $rules = $this->parms[0]['action']."MedicationRules";
        $validator = Validator::make($this->parms[0], Medication::$$rules);
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

    public function getMedication($request){
        $this->parms[0]['function'] = "medication";
        $output = $this->callAdapter($this->parms[0]);
        return $this->responWithApi($output, $this->parms[0]);
    }
}
