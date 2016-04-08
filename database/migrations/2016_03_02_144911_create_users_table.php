<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('organizations');

        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('beacon_id',36);
            $table->string('app_name')->nullable();
            $table->string('app_logo')->nullable();
            $table->integer('app_timeout');
            $table->string('password_format')->default("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d).{6,}$");
            $table->string('passwordNotValidText')->nullable();
            $table->string('from_email_address');
            $table->string('from_email_orgname');
            $table->integer('createdBy');
            $table->integer('updatedBy');
            $table->timestamps();
        });


        Schema::create('users', function (Blueprint $table) {
            $table->increments('cid');
            $table->integer('enteredby');
            $table->unsignedInteger('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('organizations');
            $table->string('empid')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->string('device_token');
            $table->char('device_type',1);
            $table->string('type')->default(0);
            $table->string('activation_code',8);
            $table->string('image')->nullable();
            $table->string('status');
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('organizations');
    }
}
