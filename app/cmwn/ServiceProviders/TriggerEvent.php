<?php

    namespace app\cmwn\ServiceProviders;

    use Illuminate\Support\ServiceProvider;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Bus\SelfHandling;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Support\Facades\Log;
    use app\Jobs\Job;

    class TriggerEvent extends Job implements SelfHandling, ShouldQueue
    {
	    use InteractsWithQueue, SerializesModels;

	    public function __construct()
	    {
		    \Log::info('started the job');
	    }

	    /**
	     * Execute the job.
	     *
	     * @return void
	     */
	    public function handle()
	    {
		    Log::info('Email will be sent');
		    Mail::send();
	    }

	    public function failed()
	    {
		    \Log::critical("Job failed");
	    }
    }



