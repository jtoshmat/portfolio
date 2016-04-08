<?php

namespace app\Console\Commands;

use app\CronJobs;
use app\Http\Controllers\MobileNotificationController;
use app\Services\AdapterLog;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Cron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Caretraxx background batch';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notifications = new MobileNotificationController();
        $output = $notifications->run();
        var_dump($output);
        $message = 'Console Cron job has been executed at '. time();
        AdapterLog::log($message);
    }

    public function getArguments()
    {
        return parent::getArguments();
    }
}
