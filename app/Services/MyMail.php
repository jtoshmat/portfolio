<?php

namespace app\Services;

use Illuminate\Support\Facades\Mail;

class MyMail
{
    public static function send($mailData)
    {

        if(!isset($mailData["org"]["from_email_address"]) || !isset($mailData["org"]["from_email_orgname"])){
            AdapterLog::log('from email address or from email orgname is missing');
            exit("from email address or from email orgname is missing");
        }

        Mail::send($mailData['template'], $mailData, function ($message) use ($mailData) {
            $message->from($mailData["org"]["from_email_address"], $mailData["org"]["from_email_orgname"]);
            $message->replyTo($mailData["org"]["from_email_address"]);
            $message->subject($mailData['subject']);
            $message->priority($mailData['priority']);
            $message->to($mailData['to']);
        });
    }
}
