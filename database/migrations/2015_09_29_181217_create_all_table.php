<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists("roles");
        Schema::dropIfExists("user_roles");
        Schema::dropIfExists("users");

        Schema::create("users", function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('parent_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_roles', function(Blueprint $table)
        {
            $table->increments('urid');
            $table->unsignedInteger('uid')->unsigned();
            $table->unsignedInteger('rid')->unsigned();
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->string('permissions');
            $table->timestamps();
        });

        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('rid');
            $table->string('permissions');
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
        Schema::dropIfExists("roles");
        Schema::dropIfExists("users");

    }

}
