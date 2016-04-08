<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'conversations';
    protected $fillable = [
        //'title',
        //'description'
    ];

    public static $getConversationRules = array(
        //'id' => 'integer',
    );

    public function participants()
    {
        return $this->belongsToMany('app\Participant');
    }

    public function messages()
    {
        return $this->hasMany('app\Message','conversation_id','id');
    }
}
