<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class EventCategories extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'events_categories';
    protected $fillable = [];



    public function events()
    {
        return $this->hasMany('app\Event','event_id','id');
    }
}
