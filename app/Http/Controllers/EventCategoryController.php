<?php

namespace app\Http\Controllers;
use app\EventCategory;
use app\Transformer\EventCategoryTransformer;
use Illuminate\Http\Request;
use app\Http\Requests;
use Illuminate\Support\Facades\Validator;
use app\Services\AdapterLog;
use app\Http\Controllers\AdapterController;
use app\Services\MyMail;
use Illuminate\Support\Facades\Hash;
class EventCategoryController extends DispatcherController
{

    protected $parms;

    public function categories(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validator = Validator::make($this->parms[0], [
            'action' => array('required', 'regex:/^(get)$/i'),
        ]);
        if($validator->fails()){
            $message = $validator->errors()->getMessages();
            AdapterLog::log($message['action'][0].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($message['action'][0]);
        }
        $function = $this->parms[0]['action']."Category";
        $validator = $this->checkDataInput();

        if (isset($validator['code'])){
            return $this->errorWrongArgs($validator['message']);
        }
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $rules = $this->parms[0]['action']."CategoriesRules";
        $validator = Validator::make($this->parms[0], EventCategory::$$rules);
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

    protected function getCategory(){
        $orgid = $this->parms[0]['orgid'];
        $data = EventCategory::where('orgid', $orgid)->get();
        return EventCategoryTransformer::transform($data, $this->parms[0]);
    }
}
