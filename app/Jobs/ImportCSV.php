<?php

namespace cmwn\Jobs;

use cmwn\Http\Controllers\BatchController;
use cmwn\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ImportCSV extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
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

	   $job = new BatchController();
	   if($job::run()){
		   Log::info('Import has completed');

	   }

    }

    public function failed()
    {
        \Log::critical("Job failed");
    }
}
