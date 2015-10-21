<?php

namespace app\cmwn\Services;
use Illuminate\Support\Facades\Mail;

class MyMail
{
	public static function send($mailData){
		// Mail::send($mailData['template'], $mailData, function ($message) {
		// 	$message->from('admin@changemyworldnow.education', 'Jon Toshmatov');
		// 	//$message->cc('jon@ginasink.com', 'Jon at Ginasink');
		// 	$message->replyTo('admin@changemyworldnow.education', 'toshmatovus@gmail.com');
		// 	$message->subject($mailData['subject']);
		// 	$message->priority($mailData['priority']);
		// 	$message->to($mailData['to']);
		// });

		// Mail::send('emails.email', ['user' => 'hi there'], function ($m) {
  //           $m->to('arron.kallenberg@gmail.com', 'Arron Kallenberg')->subject('Your Reminder!');
  //       });
	}
}
