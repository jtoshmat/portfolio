<?php

namespace app\cmwn\ServiceProviders;
use app\cmwn\ServiceProviders\TriggerEvent;
use app\Http\Controllers\Controller;

class Notifier extends Controller
{

	public function __construct($to='',$subject='',$body=''){
	}

	public function send(){
		$job = (new TriggerEvent());
		return 'output: '.$this->dispatch($job);
    }



}
