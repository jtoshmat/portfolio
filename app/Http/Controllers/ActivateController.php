<?php

namespace app\Http\Controllers;

use app\Activate;
use app\Services\UnityAdapter;
use app\User;
use Illuminate\Http\Request;

use app\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use app\Services\AdapterLog;
use app\Http\Controllers\AdapterController;
use app\Services\MyMail;
use Illuminate\Support\Facades\Hash;

class ActivateController extends DispatcherController
{
    protected $parms;

    public function processRequest(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        if ($this->parms[0]['action']!='get'
            && $this->parms[0]['action']!='account'
            && $this->parms[0]['action']!='send'
            && $this->parms[0]['action']!='verify'
            && $this->parms[0]['action']!='notme'){
            return $this->errorWrongArgs('Action is not valid');
        }
        $function = $this->parms[0]['action']."ActivationCode";
        $validation = $this->checkDataInput();
        if (isset($validation['code'])){
            return $this->errorWrongArgs($validation['message']);
        }
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $rules = $this->parms[0]['action']."ActivationCodeRules";
        $validator = Validator::make($this->parms[0], Activate::$$rules);
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

    public function getActivationCode($request){
        $cid = (int) $this->parms[0]['cid'];
        $data = User::where('cid','=',$cid)->first(array('first_name','last_name'));
        if (!$data->count()) {
            return $this->errorNotFound('The cid record is not found');
        }
        $this->parms[0]['function'] = 'Activation';
        return $this->responseActivation($data, $this->parms[0]);
    }

    public function sendActivationCode(){
        $cid = (int) $this->parms[0]['cid'];
        $data = User::where('cid','=', $cid)->where('status','I')->first();

        if(!$data){
            $error = [
                'code' => 500,
                'message' =>"No record for this cid is found"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->respondWithError($error['message'],"404");
        }

        $org_mail_settings = [
            'from_email_address' => $data->organization->from_email_address,
            'from_email_orgname' => $data->organization->from_email_orgname
            ];

        $mailData = [
            'cid' => $data->cid,
            'org' => $org_mail_settings,
            'code' => $data->activation_code,
            'subject'=> 'Thanks for Your Interest in the General Hospital Mobile Concierge',
            'priority'  =>'high',
            'template' => 'mail.install',
            'to' => $data->email
        ];


        $mail = MyMail::send($mailData);

        if ($mail==NULL) {
            $data->status = 'IA';
            if ($data->save()){
                return $this->successfullReponse('An activation code is sent to your email');
            }else{
                $error = [
                    'code' => 500,
                    'message' =>"There is an issue with updating the user status"
                ];
                AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
                return $this->respondWithError($error['message'],"501");
            }
        }else{
            $error = [
                'code' => 500,
                'message' =>"There is an issue with mail"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->respondWithError($error['message'],"501");
        }
        $error = [
            'code' => 500,
            'message' =>"There is an issue with updating the user status"
        ];
        AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
        return $this->respondWithError($error['message'],"501");
    }

    public function verifyActivationCode(){
        $cid = (int) $this->parms[0]['cid'];
        $code = $this->parms[0]['code'];
        $found = $data = User::where('cid','=', $cid)->where('activation_code','=',$code)->first();

        if(!$data) {
            $error = [
                'code' => 500,
                'message' => "No record for this cid is found"
            ];
            AdapterLog::log($error['message'] . ' at ' . __METHOD__ . ':' . __LINE__, 'warning');
            return $this->respondWithError($error['message'], "404");
        }

        if(!$found){
            $found = User::where('cid','=', $cid)->first();
            $found->status = 'AF';
            $found->save();
            return $this->errorInternalError('Your activation code could not be verified');
        }

        $data->status = 'A';
        if (!$data->save()){
            $error = [
                'code' => 500,
                'message' =>"There is an issue with updating the user status to A"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->respondWithError($error['message'],"501");
        }

        $org_mail_settings = [
            'from_email_address' => $data->organization->from_email_address,
            'from_email_orgname' => $data->organization->from_email_orgname
        ];

        $mailData = [
            'org' => $org_mail_settings,
            'subject'=> 'Mobile Concierge has been activated!',
            'priority'  =>'high',
            'template' => 'mail.activated',
            'to' => $data->email
        ];

        $mail = MyMail::send($mailData);
        $adapter = 'app\\Services\\'.\Config::get('myadapter.organizations.'.$this->parms[0]['orgid'].".adapter")['primary'];
        $user = Auth::loginUsingId($cid);
        $data['action'] = 'get';
        $data['cid'] = $user->cid;
        $data['function'] = 'patient';
        $allscript = $adapter::processRequest($data);
        $realUser = json_decode($allscript, true);
        unset($user->empid);
        unset($user->created_at);
        unset($user->deleted_at);
        unset($user->updated_at);
        unset($user->activation_code);
        $user->first_name = $realUser[0]["getpatientinfo"][0]["Firstname"];
        $user->last_name = $realUser[0]["getpatientinfo"][0]["LastName"];

        return $this->successfullReponse('User has been activated', $user);
    }

    public function notmeActivationCode(){
        $cid = (int) $this->parms[0]['cid'];
        $data = User::where('cid','=', $cid)->first();
        if ($data){
            $data->status = "IN";
            if(!$data->save()){
                $error = [
                    'code' => 500,
                    'message' =>"There is an issue with updating the user status"
                ];
                AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
                return $this->respondWithError($error['message'],"501");
            }
            return $this->successfullReponse("The user status has been updated to IN");
        }
        $error = [
            'code' => 404,
            'message' =>"No user is found"
        ];
        AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
        return $this->errorNotFound($error['message']);
    }

    public function accountActivationCode(){
        //@TODO make sure only authenticated user can change only his her password and not someone else's 3/24
        $cid = (int) $this->parms[0]['cid'];
        $password = Hash::make($this->parms[0]['password']);
        $user = User::where('cid', $cid)->first();
        if (!$user){
            $error = [
                'code' => 500,
                'message' =>"The cid:$cid is not found"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->respondWithError($error['message'],"404");
        }
        $user->password = $password;
        $output = $user->save();
        if (!$output){
            $error = [
                'code' => 500,
                'message' =>"The password is not saved"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->respondWithError($error['message'],"501");
        }
        return $this->successfullReponse('The password has been saved for this cid');

    }
}
