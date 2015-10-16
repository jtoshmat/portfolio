<?php

namespace app\cmwn\ServiceProviders;
use Illuminate\Support\Facades\Log;

class Mail
{
	//this is where postmatk class will be instantiated
	public static function send(){
		Log::info('Email ahs been sent');
		return "sending";
	}
}
