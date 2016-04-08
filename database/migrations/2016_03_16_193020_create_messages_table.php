<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('participants');
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('messages');

        /*
         * a participant hasMany conversations
         * a conversation belogsToMany participants
         *
         * a conversation has Many messages
         * a message belongsTo a conversation
         *
         * a message also belongsTo a participant
         * a particicpant hasMany messages
         * get and create
         */


        //Create Participants table
        Schema::create('participants', function (Blueprint $table) {
            //$table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('conversation_id')->unsigned();
            $table->unsignedInteger('cid')->unsigned();
            $table->string('status');
            $table->foreign('cid')->references('cid')->on('users');
            //$table->foreign('conversation_id')->references('id')->on('conversations');
            $table->timestamps();
        });

        //Create Conversation table
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_date');
            $table->string('status');
            $table->integer('orgid');

            //$table->unsignedInteger('cid')->unsigned();
           // $table->foreign('cid')->references('id')->on('participants')->onDelete('cascade');
            $table->timestamps();
        });

        //Create Messages table
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->string('content');
            $table->integer('created_by');
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
        Schema::dropIfExists('participants');
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('messages');
    }
}
