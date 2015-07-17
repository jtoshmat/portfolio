<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('barId', 11);
            $table->string('daysToEvent', 11);
            $table->string('description', 255);
            $table->string('title', 255);
            $table->string('keyName', 255);
            $table->string('scheduledTime', 255);
            $table->string('eventOn', 16);
            $table->string('gameKeyName', 16);
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
		Schema::drop('events');
	}

}
