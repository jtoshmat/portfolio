<?php

namespace app\Http\Controllers;

use app\Event;
use app\Message;
use app\Participant;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\Services\AdapterLog;
use Illuminate\Support\Facades\Validator;

class ParticipantsController extends DispatcherController
{
    protected $parms;

    public function participants(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validator = Validator::make($this->parms[0], [
            'action' => array('required', 'regex:/^(get|create)$/i'),
        ]);
        if($validator->fails()){
            AdapterLog::log($validator->errors()->getMessages().' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($validator->errors()->getMessages());
        }
        $validation = $this->checkDataInput();
        if(isset($validation['code'])){
            return $this->errorForbidden($validation['message']);
        }
        $function = $this->parms[0]['action']."Participant";
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $action = isset($this->parms[0]['action'])?$this->parms[0]['action']:null;
        if ($action!='get' && $action!='create'){
            $error = [
                'code' => 500,
                'message' =>"bad action method"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }

        if (isset($this->parms[0]['participants'])) {
            $cid = $this->parms[0]['cid'];
            $participants = $this->parms[0]['participants'];
            $checkCid = in_array($cid, $participants);

            if (!$checkCid) {
                $error = [
                    'code' => 500,
                    'message' => "cid is not a participant"
                ];
                AdapterLog::log($error['message'] . ' at ' . __METHOD__ . ':' . __LINE__, 'warning');
                return $error;
            }
        }

//        if (!isset($this->parms[0]['participants']) && !isset($this->parms[0]['conversation_id'])){
//            $error = [
//                'code' => 500,
//                'message' => "must have either conversation_id or participants"
//            ];
//            AdapterLog::log($error['message'] . ' at ' . __METHOD__ . ':' . __LINE__, 'warning');
//            return $error;
//        }

    }

    protected function getParticipant(){
        $error = "No conversation found for this participant";
        if (isset($this->parms[0]['conversation_id'])){
            $error = "No message is found for this conversation";
            $data = Participant::where('conversation_id',$this->parms[0]['conversation_id'])->get();
        }else{
            $data = Participant::where('cid',$this->parms[0]['cid'])->get();
        }
        //ApiController::logDB();
        if(!$data->count()){
            return $this->errorNotFound($error);
        }

        $this->parms[0]['function'] = 'Participant';
        return $this->responWithLocal($data, $this->parms[0]);
    }

    protected function createParticipant(){
        $participant = new Participant();
        $rules = "createMessageRules";
        if (isset($this->parms[0]['conversation_id'])){
            $rules = "updateMessageRules";
        }

        $validator = Validator::make($this->parms[0], Participant::$$rules);
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
        $output = $participant->insertParticipant($this->parms[0]);

        if($output->error){
            return $this->errorInternalError($output->message);
        }

        $succees = [
            'code' => 200,
            'message' =>"A message has been created"
        ];
        return $this->successfullReponse($succees['message']);
    }

}
