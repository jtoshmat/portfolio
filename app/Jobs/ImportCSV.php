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
     * Execute the job.
     *
     * @return void
     */
    protected $importType;

    public function __construct($importType='allusers'){
        $this->importType = $importType;

    }

    public function handle()
    {



        if ($this->importType == 'allusers'){
           return BulkImporter::migratecsv();
       }
        if($this->importType == 'teachers'){
           return BulkImporter::migrateTeachers();
       }
        if($this->importType == 'classes'){
            return BulkImporter::migrateClasses();
        }
           return false;
    }

    public function failed()
    {
    }
}
