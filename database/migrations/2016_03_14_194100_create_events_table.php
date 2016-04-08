<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Delete the tables if they exist
        Schema::dropIfExists('events');
        Schema::dropIfExists('events_user_notifications');
        Schema::dropIfExists('events_user_registrations');
        Schema::dropIfExists('events_categories');
        Schema::dropIfExists('categories');

        //Create Events table
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orgid');
            $table->dateTime('datetime');
            $table->string('title');
            $table->string('description', 1000);
            $table->boolean('registration_required',0);
            $table->string('image')->nullable();
            $table->string('status',0);
            $table->string('location')->nullable();
            //$table->unique(array('event_id', 'title'));
            $table->unsignedInteger('user_id')->unsigned();
            $table->timestamps();
        });

        //Create Events User Notify table
        Schema::create('events_user_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->unsigned();
            $table->unsignedInteger('user_id')->unsigned();
            $table->string('channel');
            $table->dateTime('last_notified');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });

        //Create Events User Registration table
        Schema::create('events_user_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->unsigned();
            $table->unsignedInteger('user_id')->unsigned();
            $table->dateTime('registered_datetime');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });

        //Create EventsCategory table
        Schema::create('events_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->unsigned();
            $table->unsignedInteger('category_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });

        //Create Category table
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->unsignedInteger('orgid')->unsigned();
            $table->foreign('orgid')->references('id')->on('organizations');
            $table->string('description');
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('events');
        Schema::dropIfExists('events_user_notifications');
        Schema::dropIfExists('events_user_registrations');
        Schema::dropIfExists('events_categories');
        Schema::dropIfExists('categories');
    }
}
