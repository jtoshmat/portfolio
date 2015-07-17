<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		return false;
		Schema::create('bars', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('contactFirstName', 16);
            $table->string('contactLastName', 16);
            $table->string('name', 16);
            $table->string('address', 16);
            $table->string('address2', 16);
            $table->string('city', 16);
            $table->string('state', 16);
            $table->string('zipCode', 16);
            $table->string('County', 16);
            $table->string('Country', 16);
            $table->string('telephone', 16);
            $table->string('email', 55);
            $table->string('website', 255);
            $table->string('timezone', 16);
            $table->string('logoBlob', 255);
            $table->string('nextEvent', 255);
            $table->string('promo', 255);
            $table->string('weeklyEvent', 255);
            $table->string('lat', 255);
            $table->string('long', 255);
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
		Schema::drop('bars');
	}

}
