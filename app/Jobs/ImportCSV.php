<?php

namespace app\Jobs;

use app\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

//use Illuminate\Support\Facades\Mail;

use app\cmwn\Services\BulkImporter;

class ImportCSV extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       BulkImporter::migratecsv();
    }

    public function failed()
    {
    }
}
