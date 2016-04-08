<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'configs';
    protected static $data;

    public static function run($org){
        self::$data = self::where('orgid',$org)->get();
    }

    public static function key($key){
        $output = self::$data->where('key',$key)->first();
        return $output->value;
    }

}
