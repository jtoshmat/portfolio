<?php

namespace app\cmwn\Services;
use app\cmwn\Services\TriggerNotifierEvent;
use app\Http\Controllers\Controller;

class Notifier extends Controller
{
	public $data = [];
	public $email;
	public $template;
	public $subject;
	public $priority = 'High';

	public function prepData(){
		$this->data['to'] = $this->to;
		$this->data['subject'] = $this->subject;
		$this->data['priority'] = $this->priority;
		$this->data['template'] = $this->template;
	}

	public function send(){
		$this->prepData();
		$job = (new TriggerNotifierEvent($this->data));
		if ($this->dispatch($job)){
			return 'it failed';
		}
		return 'success';
	}


	public function attachData(array $data){
		$this->data = array_merge($this->data, $data);
	}



}
