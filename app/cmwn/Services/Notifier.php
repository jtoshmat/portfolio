<?php

namespace app\cmwn\Services;

use app\Jobs\Notify;
use app\cmwn\Services\TriggerNotifierEvent;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Notifier
{
	use DispatchesJobs;

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
		$this->dispatch(new Notify($this->data));
	}

	public function attachData(array $data){
		$this->data = array_merge($this->data, $data);
	}
}
