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
use app\Provider;

class ProviderController extends DispatcherController
{
    protected $parms;

    public function provider(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validator = Validator::make($this->parms[0], [
            'action' => array('required', 'regex:/^(get)$/i'),
        ]);
        if($validator->fails()){
            AdapterLog::log('Action is in incorrect format or missing'.' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs('Action is in incorrect format or missing');
        }
        $orgid = (int) $this->parms[0]['orgid'];
        $adapterName = $config = \Config::get('myadapter.organizations.'.$orgid.".adapter.primary");
        $this->parms['adapter'] = "app\\Services\\".$adapterName;
        $function = $this->parms[0]['action']."Provider";
        $validation = $this->checkDataInput();
        if (isset($validation['code'])){
            return $this->errorWrongArgs($validation['message']);
        }
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $rules = $this->parms[0]['action']."ProviderRules";
        $validator = Validator::make($this->parms[0], Provider::$$rules);
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

    public function getProvider($request){
        $this->parms[0]['function'] = "provider";
        $orgid = $this->parms[0]['orgid'];
        $adapterName  = $this->parms['adapter'];
        $output = $adapterName::processRequest($this->parms[0]);
        $error = strpos($output, "Error");
        if ($error!==false){
            $error = [
                "response" => "error",
                "response content" => $output
            ];
            return $this->errorNotFound($error);
        }
        return $this->responWithApi($output, $this->parms[0]);
    }
}
