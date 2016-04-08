<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class EventUserRegistration extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'events_user_registrations';
    protected $fillable = [];

    public static $registerEventsRules = array(
//        'event_id' => 'required|Between:3,64|Email',
//        'title'=>'integer|required',
    );


    public function events()
    {
        return $this->belongsTo('app\Event');
    }
}