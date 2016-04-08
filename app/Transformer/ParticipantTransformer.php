<?php

namespace app\Transformer;

use app\Conversation;
use app\Message;
use app\Patient;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Facades\DB;

class ParticipantTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = [
    //
    // ];

    protected $availableIncludes = [

    ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    protected static $data;
    protected static $parms;
    protected static $Participants;

    public static function transform($data, $parms)
    {
        self::$data = $data;
        self::$parms = $parms;
        if (isset($parms["conversation_id"])){
            return self::getDetail();
        }
            return self::getSummary();
    }

    protected static function getSummary(){
        $output = [];
        $allParticipants = [];
        foreach(self::$data as $p){
            $allParticipants = $p->allParticipants($p->conversation_id);

            foreach($p->conversations as $num=>$conversations) {
                $messages = $conversations->messages->where('conversation_id', $conversations->id);
                    $output[] = [
                        'conversation_id' => $conversations->id,
                        'latest_message' => $messages->last()['content'],
                        'participants' => $allParticipants
                    ];
           }

        }
        return $output;
    }

    protected static function getDetail(){
        $output = [];
        foreach(self::$data as $participant){
            foreach($participant->conversations as $conversation){
                foreach($conversation->messages as $message){
                    $user = $participant::userByCid($message->created_by);
                    $output[] =[
                        'message_id' => $message->id,
                        'content' => $message->content,
                        'created_at' => $message->created_at,
                        'created_by' => $message->created_by,
                        'created_by_firstname' => $user['first_name'],
                        'created_by_lastname' => $user['last_name'],
                    ];
                }
            }
            return $output;
        }
    }

}