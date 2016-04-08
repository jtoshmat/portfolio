<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobilenotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mobile_notifications');
        Schema::create('mobile_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid');
            $table->char('channel');
            $table->string('content');
            $table->char('status');
            $table->string('status_description')->nullable();
            $table->integer('number_retries',0);
            $table->integer('created_by');
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_notifications');
    }
}
