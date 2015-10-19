<?php

namespace app\cmwn\ServiceProviders;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MyMail
{
	protected static $data;
	public static function send($mailData){
        self::$data = $mailData;
		$output = Mail::send(self::$data['template'], $mailData, function ($message) {
			$message->from('admin@changemyworldnow.education', 'Jon Toshmatov');
			//$message->cc('jon@ginasink.com', 'Jon at Ginasink');
			$message->replyTo('admin@changemyworldnow.education', 'toshmatovus@gmail.com');
			$message->subject(self::$data['subject']);
			$message->priority(self::$data['priority']);
			$message->to(self::$data['to']);
		});


		if($output>=1){
			Log::info("Your import csv is done");
			return true;
		}

		Log::info("Your import csv has failed");
		return false;
	}
}
