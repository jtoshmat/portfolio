<?php

namespace app\Services;
use PushNotification;

class ApplePushNotification
{
    public function run($data, $user){
        $device_token = $user->device_token;
        $output = PushNotification::app('apple')
            ->to($device_token)
            ->send($data->content);
        var_dump($output);
        return $output;
    }
}
