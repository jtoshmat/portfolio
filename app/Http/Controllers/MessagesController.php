<?php

namespace app\Http\Controllers;

use app\Conversation;
use app\Message;
use app\Participant;
use app\Services\AdapterLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Redirect;

class MessagesController extends DispatcherController
{
    protected $parms;

    public function message(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $this->checkDataInput();
        $function = $this->parms[0]['action']."Participant";
        return $this->$function($request);
    }

    protected function checkDataInput(){
        $action = isset($this->parms[0]['action'])?$this->parms[0]['action']:null;
        $cid = isset($this->parms[0]['cid'])?$this->parms[0]['cid']:null;
        if (!$action){
            $error = [
                'code' => 500,
                'message' =>"action is missing"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }
        if (!$cid){
            $error = [
                'code' => 500,
                'message' =>"cid is missing"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }

        if ($action!='get' && $action!='create' && $action!='update' && $action!='delete' ){
            $error = [
                'code' => 500,
                'message' =>"bad action method"
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $this->errorWrongArgs($error['message']);
        }
    }

    protected function getParticipant(){
        $data = Participant::where('cid','=',$this->parms[0]['cid'])->get();
        $this->parms[0]['function'] = 'Participant';
        return $this->responWithLocal($data, $this->parms[0]);
    }

    protected function createMessage(){
        return __FUNCTION__;
    }

    protected function updateMessage(){
        return __FUNCTION__;
    }

    protected function deleteMessage(){
        return __FUNCTION__;
    }

    public function getChatConversations(){
        $participants = Participant::where('cid',Auth::user()->cid)->get();
//        $chats = [];
//        foreach($participants as $num=>$participant){
//            $allParticipants = $participant->allParticipants($participant->conversation_id);
//            foreach($participant->conversations as $num2=>$conversation){
//            $chats[$num]['conversations'] = $conversation;
//            $chats[$num]['conversations']['allParticipant'] = $allParticipants;
//            $chats[$num]['conversations']['messages'] = $conversation->messages->last()['content'];
//            }
//        }
        return view('communication.chatconversations', compact('participants'));
    }
    public function chat($id){
            $conversation = Conversation::find($id);
            $cid = Auth::user()->cid;
            $chat = [];
            $header = [];
            $window = 'left';

            foreach ($conversation->messages as $num=>$message){
                $user = Participant::userByCid($message->created_by);
                $window = ($cid==$message->created_by)?'left':'right';
                $chat[$window][$message->id]['id'] = $message->id;
                $chat[$window][$message->id]['message'] = $message->content;
                $chat[$window][$message->id]['created_by'] = $user['first_name']." ". $user['last_name'];
                $chat[$window][$message->id]['created_at'] = $message->created_at;
                $header[$window]['creator'] = $user['first_name']." ". $user['last_name'];
                $header['conversation'] = $conversation->id;
            }

        return view('communication.chat', compact('chat','header'));
        }

    public function updateConversation(Request $request){
        $validator = \Validator::make(Input::all(), Message::$createMessageRules);
        $conversation_id = (int) Request::segment(2);
        if (!$validator->passes()) {
            return Redirect::to('/chat/'.$conversation_id)
                ->with('message', 'The following errors occurred')
                ->withErrors($validator)->withInput()->with('flag', 'danger');
        }
        $user = Auth::user();
        $conversation_id = Input::get('conversation_id');
        $content = Input::get('content');
        if (Input::get('cid')!=$user->cid){
            return Redirect::to('/chat/'.$conversation_id)
                ->with('message', 'The following errors occurred')
                ->withErrors('cid is invalid')->with('flag', 'danger');
        }
        $message = new Message();
        $message->conversation_id = $conversation_id;
        $message->content = $content;
        $message->created_by = $user->cid;

        if(!$message->save()){
            return Redirect::to('/chat/'.$conversation_id)
                ->with('message', 'The following errors occurred')
                ->withErrors('Opps, something went wrong, please try again')->with('flag', 'danger');
        }

        return Redirect::to('/chat/'.$conversation_id);
    }

    public function createChat(){
        return view('communication.newchat');
    }

}
