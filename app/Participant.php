<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $parms;
    protected $dates = ['deleted_at'];
    protected $table = 'participants';
    protected $fillable = [
        'conversation_d',
        'cid',
        'status'
    ];

    protected $primaryKey = 'cid';

    public static $getMessageRules = array(
        'orgid' => 'required|integer|exists:organizations,id',
        'action' => array('required', 'regex:/^(get)$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
        'conversation_id' => 'sometimes|integer|exists:conversations,id',
    );

    public static $createMessageRules = array(
        'orgid' => 'required|string',
        'message' => 'required|string',
        'conversation_id' => 'sometimes|integer',
        //'participants' => 'required_without:conversation_id|exists:users,id',
        'cid' => 'required|integer|exists:users,cid,type,1',
    );

    public static $updateMessageRules = array(
        'orgid' => 'required|string',
        'message' => 'required|string',
        'conversation_id' => 'sometimes|integer',
    );


    public function users(){
        return $this->hasMany('app\User','id','id');
    }

    public function conversations()
    {
        return $this->hasMany('app\Conversation','id','conversation_id');
    }

    public static function userByCid($cid){
        $cid = (int) $cid;
        $output = User::find($cid);
        if ($output) {
            $output = json_decode($output, true);
            return $output;
        }
        return false;
    }

    public function allParticipants($conversation_id){
        $participants = $this::where('conversation_id',$conversation_id)->get();
        $output[] = [];
        foreach($participants as $num=>$participant){
            $user = self::userByCid($participant->cid);
            $output[$num]['cid'] = $user['cid'];
            $output[$num]['first_name'] = $user['first_name'];
            $output[$num]['last_name'] = $user['last_name'];
        }
        return $output;
    }

    public function insertParticipant($data){
        $this->parms = $data;
        if(isset($data['conversation_id'])){
            return $this->addToExistingConversation();
        }
        if(isset($data['participants'])){
            return $this->createNewConversation();
        }
        return false;
    }

    protected function addToExistingConversation(){
        $output = new \stdClass();
        $output->error = false;
        $output->message = null;
        $output->data = null;

        $participant = Participant::where('conversation_id', $this->parms['conversation_id'])
            ->where('cid', $this->parms['cid'])->first();

        if (!$participant) {
            $output->error = true;
            $output->message = "Conversation is not found or the cid is not a participant";
            return $output;
        }

        $data = [];
        $msg = new Message();
        $msg->conversation_id = $this->parms['conversation_id'];
        $msg->content = $this->parms['message'];
        $msg->created_by = $this->parms['cid'];
        $data[] = $msg->save();
        $output->error = false;
        $output->message = "The conversation has been updated";
        return $output;
    }

    protected function createNewConversation(){
        $participants = $this->parms['participants'];
        $output = new \stdClass();
        $output->error = false;
        $output->message = null;
        $output->data = null;

        //Adding a new conversation
        $conversation = new Conversation();
        $conversation->start_date = '2016-01-01 12:00:00';
        $conversation->status = 'Active';
        $conversation->orgid = 1;
        if(!$conversation->save()){
            $output->error = true;
            $output->message = "Conversation is not created";
            return $output;
        }
        $conversation_id = $conversation->id;

        //Adding a message
        $message = new Message();
        $message->conversation_id = $conversation_id;
        $message->content = $this->parms['message'];
        $message->created_by = 1;

        if(!$message->save()){
            $output->error = true;
            $output->message = "Message is not created";
            return $output;
        }
        $message_id = $message->id;

        //Adding participants
        $error = [];
        $dataArray = [];
        foreach($participants as $cid){
            $dataArray[$cid] = [
                'conversation_id' => $conversation_id,
                'cid' => $cid,
            ];
        }
        if(!Participant::insert($dataArray)){
            $output->error = true;
            $output->message = "A conversation has not been created";
            return $output;
        }
        $output->error = false;
        $output->message = "A conversation has been created";
        return $output;
    }

}
