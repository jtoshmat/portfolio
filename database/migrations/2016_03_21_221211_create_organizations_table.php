<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('locations');
        Schema::dropIfExists('stations');
        //Schema::dropIfExists('organizations');

/*        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('beacon_id',36);
            $table->string('app_name')->nullable();
            $table->string('app_logo')->nullable();
            $table->integer('app_timeout');
            $table->string('password_format')->nullable();
            $table->string('from_email_address');
            $table->string('from_email_orgname');
            $table->integer('createdBy');
            $table->integer('updatedBy');
            $table->timestamps();
        });*/

        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->unsignedInteger('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('organizations');
            $table->integer('major');
            $table->integer('minor');
            $table->string('battery_strength');
            $table->string('status');
            $table->integer('createdBy');
            $table->integer('updatedBy');
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('event',1);
            $table->integer('visit_id');
            $table->unsignedInteger('station_id')->unsigned();
            $table->foreign('station_id')->references('id')->on('stations');
            $table->unsignedInteger('cid')->unsigned();
            $table->foreign('cid')->references('cid')->on('users');
            $table->string('deviceID');
            $table->integer('createdBy');
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
        Schema::dropIfExists('locations');
        Schema::dropIfExists('stations');
       // Schema::dropIfExists('organizations');
    }
}
