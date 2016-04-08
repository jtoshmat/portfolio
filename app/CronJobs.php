<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class CronJobs extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'cron_jobs';
}
