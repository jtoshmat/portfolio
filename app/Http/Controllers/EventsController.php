<?php

namespace app\Http\Controllers;

use app\Event;
use app\EventCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use app\Http\Requests;
use app\Services\AdapterLog;
use Illuminate\Support\Facades\Validator;

class EventsController extends DispatcherController
{
    protected $parms;

    public function event(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validator = $this->checkDataInput();

        if (isset($validator['code'])){
            return $this->errorWrongArgs($validator['message']);
        }

        $function = $this->parms[0]['action']."Request";
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $action = isset($this->parms[0]['action'])?$this->parms[0]['action']:null;
        $rule = $action."EventRules";
        $validator = Validator::make($this->parms[0], Event::$$rule);
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
            return $error;
        }
    }

    protected function error($code='501', $message='', $status='warning'){
        $error = [
            'code' => $code,
            'message' =>"An error occured: ".$message
        ];
        AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,$status);
        $this->errorNotFound($error['message']);
        exit(json_encode($error));
    }

    protected function getRequest(Request $request){
        $this->parms[0]['function'] = 'events';

        if(isset($this->parms[0]['id'])){
            $data = Event::find($this->parms[0]['id']);

            if (!$data){
                return $this->errorNotFound("The event is not found");
            }

            if (isset($this->parms[0]['user_id'])) {
                $data->where('user_id','=',$this->parms[0]['user_id']);
                $data->show = true;
            }else{
                $data->show = false;
            }
            return $this->responWithLocal($data, $this->parms[0]);
        }



        if(isset($this->parms[0]['user_id'])){
            $data = Event::where('user_id', $this->parms[0]['user_id'])->get();
            $data->show = true;
            return $this->responWithLocal($data, $this->parms[0]);
        }



        if(!isset($this->parms[0]['user_id']) && !isset($this->parms[0]['id']) && isset($this->parms[0]['category_id'])){

            $data = Event::where('orgid', $this->parms[0]['orgid'])
                ->whereHas('eventcategories', function ($query){
                    $query->where('events_categories.category_id', $this->parms[0]['category_id']);
                })->get();

            $data->show = false;
            return $this->responWithLocal($data, $this->parms[0]);
        }

        if(isset($this->parms[0]['orgid'])){
            $data = Event::where('orgid', $this->parms[0]['orgid'])->get();

            if (!$data){
                return $this->errorNotFound("The event is not found");
            }
            return $this->responWithLocal($data, $this->parms[0]);
        }



        return 'None of the event search criteria is met';
    }

    protected function createRequest(){
        $event = new Event();
        $output = $event->insertEvent($this->parms[0]);
        if (!$output){
            $this->error(null, 'Event is not created');
        }
        $succees = [
            'code' => 200,
            'message' =>"An event has been created"
        ];
        return $this->successfullReponse($succees['message']);
    }

    protected function updateRequest(){
        $event = new Event();
        $output = $event->updateEvent($this->parms[0]);
        if (!$output){
            $this->error('501','The event is not updated');
        }
        $succees = [
            'code' => 200,
            'message' =>"The event has been updated"
        ];
        return $this->successfullReponse($succees['message']);
    }

    protected function deleteRequest(){
        $event = new Event();
        $output = $event->deleteEvent($this->parms[0]);
        if (!$output){
            $this->error('501', 'The event is not deleted');
        }
        $succees = [
            'code' => 200,
            'message' =>"The event has been deleted"
        ];
        return $this->successfullReponse($succees['message']);
    }
}
