<?php

namespace app\Services;
use app\Services\UnityAdapter;

class Api
{
    public static function getData($org, $action, $patientid=null){
        $adapter = $config = \Config::get('myadapter.organizations.'.$org.".adapter.primary");
        $adapter = "app\\Services\\".$adapter;
        return $adapter::getData($action, $patientid);
    }
}
