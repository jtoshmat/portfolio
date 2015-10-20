<?php

    namespace app\cmwn\Services;

    use Illuminate\Support\ServiceProvider;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Bus\SelfHandling;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Support\Facades\Log;
    use app\Jobs\Job;
    use app\cmwn\ServiceProviders\Sms;

    class TriggerNotifierEvent extends Job implements SelfHandling, ShouldQueue
    {
	    use InteractsWithQueue, SerializesModels;

	    protected $data;
	    public function __construct(array $data)
	    {
		    $this->data = $data;
		    $this->data['mailType'] = isset($this->data['mailType'])?$this->data['mailType']:'email';
		    $this->data['from'] = 'admin@changemyworldnow.education';
		    $this->data['subject'] = isset($this->data['subject'])?$this->data['subject']:'Default email template';
		    $this->data['priority'] = isset($this->data['priority'])?$this->data['priority']:'Normal';
		    $this->data['template'] = isset($this->data['template'])?$this->data['template']:'email';
	    }

	    /**
	     * Execute the job.
	     *
	     * @return void
	     */
	    public function handle()
	    {
		    if ($this->data['mailType']=='sms'){
			    return Sms::send($this->data);
		    }
		    //else send SMS
		    return MyMail::send($this->data);
	    }

	    public function failed()
	    {
		    Log::info('TriggerEvent:failed()');
		    return 'Failed';
	    }
    }



