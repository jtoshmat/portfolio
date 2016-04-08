<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'events';
    protected $fillable = [
        'title',
        'description'
    ];
    public static $getEventRules = array(
        'orgid' => 'required|exists:categories,orgid',
        'id' => 'sometimes|exists:events,id',
        'user_id' => 'sometimes|exists:events,user_id',
        //'category_id' => 'required_without:user_id|required_without:id|exists:categories,category_id',
        'category_id' => 'sometimes|exists:categories,category_id',
    );
    public static $createEventRules = array(
        'orgid' => 'required|integer',
        'datetime' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
        'location' => 'required|string',
        'categories' => 'required|exists:categories,category_id',
        'user_id' => 'required|integer'
    );
    public static $updateEventRules = array(
        'orgid' => 'required|integer',
        'id' => 'sometimes|integer',
        'channel' => 'required_if:notification,true',
        //'status' => 'required_if:notification,true|required_if:registration,true',
        'user_id' => 'required_if:notification,true|required_if:registration,true',
    );
    public static $deleteEventRules = array(
        'id' => 'required|integer',
        'orgid' => 'required|integer',
    );
    public function insertEvent($data){
        $this->orgid = $data['orgid'];
        if (isset($data['datetime'])) {
            $this->datetime = $data['datetime'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['location'])) {
            $this->location = $data['location'];
        }
        if (isset($data['registration_required'])) {
            $this->registration_required = $data['registration_required'];
        }
        if (isset($data['image'])) {
            $this->image = $data['image'];
        }
        $this->user_id = $data['user_id'];

        $output = $this->save();
        $id = $this->id;
        foreach($data['categories'] as $category){
            $this->eventcategories()->attach([['category_id' =>$category, 'event_id' =>$id,]]);

        }
        return $output;
    }

    public function updateEvent($data){
        $event = Event::find($data['id']);
        $event->orgid = $data['orgid'];
        $event->datetime = $data['datetime'];
        if (isset($data['title'])){
            $event->title = $data['title'];
        }
        if (isset($data['description'])){
            $event->description = $data['description'];
        }
        if (isset($data['location'])){
            $event->location = $data['location'];
        }
        if (isset($data['image'])){
            $event->image = $data['image'];
        }
        if (isset($data['registration_required'])){
            $event->registration_required = $data['registration_required'];
        }
        $output = $event->save();
        $id = $event->id;
        if($data['notification'] && isset($data['channel']) && isset($data['user_id'])){
            $note = $event->notifications()->sync([
                [
                    'user_id' =>$data['user_id'],
                    'event_id' =>$data['id'],
                    'channel' =>$data['channel']
                ]
            ]);
        }
        if(!$data['notification']){
            $note = $event->notifications()->sync([]);
        }
        if($data['registration'] && isset($data['user_id'])){
            $note = $event->registrations()->sync([
                [
                    'user_id' =>$data['user_id'],
                    'event_id' =>$data['id'],
                    'registered_datetime' =>$data['datetime'],
                ]
            ]);
        }
        if(!$data['registration']){
            $note = $event->registrations()->sync([]);
        }
        if(isset($data['categories'])){
            $event->eventcategories()->sync([]);
            foreach($data['categories'] as $category){
                $new = $this->eventcategories()->sync([['category_id' =>$category, 'event_id' =>$id,]]);
            }
        }
        return $output;
    }

    public function deleteEvent($data){
        $event = Event::find($data['id']);
        return $event->delete();
    }

    public function notifications()
    {
        return $this->belongsToMany('app\EventUserNofication','events_user_notifications','event_id','id');
    }

    public function registrations()
    {
        return $this->belongsToMany('app\EventUserRegistration','events_user_registrations','event_id','id');
    }

    public function eventcategories()
    {
        return $this->belongsToMany('app\EventCategory','events_categories','event_id','category_id');
    }


}