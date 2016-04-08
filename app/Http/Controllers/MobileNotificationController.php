<?php

namespace app\Http\Controllers;

use app\Notification;
use app\Services\AndroidPushNotification;
use app\Services\AndroidSmsNotification;
use app\Services\ApplePushNotification;
use app\Services\AppleSmsNotification;
use app\Services\SmsNotification;
use Illuminate\Http\Request;

use app\Http\Requests;
use Illuminate\Support\Facades\App;

class MobileNotificationController extends Controller
{
    //@TODO move this to config file or table
    protected static $MAXRETRY = 4;
    protected $data;

    public function run(){
        //$myconfig = $config = \Config::get('myadapter.organizations.'.$org.".adapter.primary");

        $output = [];
        $this->data = $this->getNotifications();

        if(!$this->data->get()->count()){
            $output['notification'] = [
                'code' => 404,
                'message' => 'No notification is found at this moment'
            ];
            return $output;
        }
        //$sms = $this->triggerChannelSms();
        $push = $this->triggerChannelPush();
        $output['result'] = [
          //'sms' => $sms,
          'push' => $push
        ];
        return $output;
    }

    protected function getNotifications(){
        $data = Notification::where('status','R')
            ->orWhere('status','E')
            ->where('number_retries','<', self::$MAXRETRY);
            return $data;
    }

    protected function triggerChannelSms(){
        $data = $this->data->get()->where('channel','S');
        if(!$data->count()){
            return false;
        }
        //get device_type from users table
        //if SMS get mobile_number from users table
        //if push get the device_token from users table

        foreach($data as $item){
            var_dump($item->users->first()->device_type);
        }

        $sms = new SmsNotification();

        return $updated = $this->updateStatus($data, 'S');
    }

    protected function triggerChannelPush(){
        $data = $this->data->get()->where('channel','P');
        if(!$data->count()){
            return false;
        }
        $android = new AndroidPushNotification();
        $apple = new ApplePushNotification();
        $output = [];
        foreach($data as $notification){
            $user = $notification->users->first();
            self::$MAXRETRY = $user->organization->id;
            if($user->device_type === 'I'){
                if($apple->run($notification, $user)){
                    $notification->status='S';
                }else{
                    $notification->status='E';
                    $notification->number_retries=$notification->number_retries+1;
                }
                $output[$notification->id] = $notification->save();
            }

            if($user->device_type === 'A'){
                if($android->run($data)){
                    $notification->status='S';
                }else{
                    $notification->status='E';
                    $notification->number_retries=$notification->number_retries+1;
                }
                $output[$notification->id] = $notification->save();
            }
        }

        return $output;
    }

    protected function updateStatus($obj, $status){
        return false;
       $output = [];
        foreach ($obj as $num=>$sms){
            $sms->status = $status;
            $sms->number_retries=$sms->number_retries+1;
            $output[] = $sms->save();
            $output[$num] = $sms->id;
        }

        return $output;
    }

    protected function TEST(){
        $data = new Notification();
        $data->cid = 1;
        $data->status = 'X';
        $data->channel = 'cron';
        $data->content = 'this is from cron:'.str_random(10);
        $saved = $data->save();
        return $saved;
    }

}
/*
 * 1) $data = Select * from mobile_notifications where (status='R') OR (status='E' and number_retries <= MAXRETRY)
 *
 * 2) foreach the data{
 * if channel = 'S' {
 * instantiate the SMS class
 * if sms == true then update the table status with 'S'
 * }else{
 *  update table statis ='E' and increment number of retries in the table ++
 * }
 *
 * if channel = 'P'{
 *
 * if device_type = 'I'{
 * instantiate the APNS class
 * if APNS == true then update the table status with 'S'
 * }else{
 *  update table statis ='E' and increment number of retries in the table ++
 * }
 *
 * if device_type = 'A'{
 * instantiate the Google class
 * * if GOOGLE == true then update the table status with 'S'
 * }else{
 *  update table statis ='E' and increment number of retries in the table ++
 * }
 *
 * return error;
 * }
 *
 *
 *
 * }
 *
 */