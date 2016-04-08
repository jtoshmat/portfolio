<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'messages';
    protected $fillable = [
        //'title',
        //'description'
    ];

    public static $getMessageRules = array(
        'orgid' => 'required|integer|exists:organizations,id',
        'action' => array('required', 'regex:/^(create)$/i'),
        'cid' => 'required|integer|exists:users,cid,type,1',
    );
    public static $createMessageRules = array(
        'orgid' => 'required|integer|exists:organizations,id',
        'action' => array('required', 'regex:/^(create)$/i'),
        //'cid' => 'required|integer|exists:users,cid,type,1',
        'conversation_id' => 'required|integer|exists:conversations,id',
        'content' =>'required|string'
    );

    public function conversations()
    {
        return $this->belongsTo('app\Conversation');
    }

    public function participants()
    {
        return $this->belongsTo('app\Participant');
    }
}
