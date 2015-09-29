<?php

namespace jontoshmatov\Http\Controllers;

use Illuminate\Http\Request;
use jontoshmatov\Http\Requests;
use jontoshmatov\Http\Controllers\Controller;
use Illuminate\Mail\Transport\MailgunTransport;

class MailController extends Controller
{
    /**
     * Send mail
     *
     * @return \Illuminate\Http\Response
     */
    public static function send($to, $subject)
    {

//	    Mail::send('members.welcome', ['key' => 'value'], function($message)
//	    {
//		    $message->to('jontoshmatov@yahoo.com', 'Jon Toshmatov')->subject('Welcome!');
//	    });
	    return 'Sending email to '. $to;
    }

}
