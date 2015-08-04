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
	Schema::dropIfExists("bars");

	Schema::create('bars', function(Blueprint $table)
		{
				$table->increments('id');
				$table->integer('uid');
				$table->integer('active');
				$table->integer('approved');
				$table->string('barname');
				$table->string('address');
				$table->string('address2');
				$table->string('city');
				$table->string('state');
				$table->string('phone');
				$table->string('website');
				$table->string('zipcode');
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
		//
	}

}
