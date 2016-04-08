<?php

namespace app\Http\Controllers;
use app\Patient;
use app\Services\AdapterLog;
use app\Services\UnityAdapter;
use app\Services\MyMail;
use app\Transformer\PatientTransformer;
use Illuminate\Http\Request;
use app\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use app\Services\Api;
use app\Http\Controllers\DispatcherController;

class PatientController extends DispatcherController
{

    public $adapter;
    public $parms;
    public $rtype = 'api';

    public function patient(Request $request){
        $apiForm = $request->all();
        if(isset($apiForm['_token'])){
            $this->rtype = 'portal';
            $this->parms = $request->all();
        }else{
            $this->parms = json_decode($request->getContent(), true);
            $this->parms = $this->parms[0];
        }

        $validation = $this->checkDataInput();
        if(isset($validation['code'])){
            return $this->errorWrongArgs($validation['message']);
            exit;
        }
        $function = $this->parms['action']."Patient";
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $action = isset($this->parms['action'])?$this->parms['action']:null;
        $rule = $action."PatientRules";
        $validator = Validator::make($this->parms, Patient::$$rule);
 
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
            $this->errorNotFound($error['message']);
            return $error;
        }
    }

    public function getPatient(Request $request){
        $this->parms['function'] = "patient";
        $output = $this->callAdapter($this->parms);
        return $this->responWithApi($output, $this->parms);
    }

    protected function getPatientEmp(){
        $cid = (int) $this->parms['cid'];
        $data = Patient::where('cid','=',$cid)->first(array('empid'));
        if (!$data->count()) {
            return $this->errorNotFound('The patient record is not found');
        }
        return $data;
    }

    public function createPatient(){
        $patient = new Patient();
        $output = $patient->createPatient($this->parms);

        if($this->rtype=='portal'){
            return $output['message'];
        }

        if($output['error']){
            return $this->errorInternalError($output['message']);
        }
        $mailOutput = $this->sendInvitation($output);
        return $this->successfullReponse($output['message']);
    }

    public function updatePatient(){
        $patient = new Patient();
        if($this->rtype=='portal' && $this->parms =='create') {
            $this->parms['empid'] = $this->getPatientEmp();
        }
        $output = $patient->updatePatient($this->parms);

        if($this->rtype=='portal'){
            return $output['message'];
        }

        if($output['error']){
            return $this->errorInternalError($output['message']);
        }
        //$mailOutput = $this->sendInvitation($output);
        return $this->successfullReponse($output['message']);
    }

    public function sendInvitation($data){
        $org_mail_settings = [
            'from_email_address' => $data["from_email_address"],
            'from_email_orgname' => $data["from_email_orgname"]
        ];

        $mailData = [
            'org' => $org_mail_settings,
            'cid' => $data['cid'],
            'subject'=> 'Thanks for Your Interest in the General Hospital Mobile Concierge',
            'priority'  =>'high',
            'template' => ['html'=>'mail.invitation'],
            'to' => $data['email']
        ];

        return MyMail::send($mailData);
    }


}
