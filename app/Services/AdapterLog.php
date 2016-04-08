<?php

namespace app\Services;
use Illuminate\Support\Facades\Log;
use app\Services\MyMail;

class AdapterLog
{

    public static function log($error, $status='info'){
        $env = env('LOG_LEVEL','low');
        if ($env=='off'){
            return false;
        }

        $org_mail_settings = [
            'from_email_address' => 'ghmobileconcierge@gmail.com', //@TODO add an organization email in config
            'from_email_orgname' => 'Caretraxx Development Team' //@TODO add an organization email in config
        ];

        $mailData = [
            'org' => $org_mail_settings,
            'subject'=> 'System Alert',
            'priority'  =>'high',
            'template' => 'mail.tickets',
            'to' => 'jontoshmatov@yahoo.com' //@TODO add an organization email in config
        ];

        switch($status){
            case 'emergency':
                Log::emergency($error);
                $mailData['priority'] = $status;
                $mailData['subject'] = 'System Alert: '.$status;
                MyMail::send($mailData);
                break;
            case 'alert':
                Log::alert($error);
                break;
            case 'critical':
                Log::critical($error);
                break;
            case 'error':
                Log::error($error);
                break;
            case 'warning':
                Log::warning($error);
                break;
            case 'notice':
                Log::notice($error);
                break;
            case 'debug':
                Log::debug($error);
                break;
            default:
                Log::info($error);
                break;
        }

    }
}
