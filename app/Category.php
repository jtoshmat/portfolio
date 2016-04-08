<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = [];

    protected $primaryKey = 'category_id';

    public static $registerEventsRules = array(
//        'event_id' => 'required|Between:3,64|Email',
//        'title'=>'integer|required',
    );

    public function eventcategories()
    {
        return $this->hasOne('app\EventCategory');
    }
}
