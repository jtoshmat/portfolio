<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists("bevents");

		Schema::create('bevents', function(Blueprint $table)
		{
			
			$table->increments('bid');
			$table->integer('barid');
			$table->integer('gid');
			$table->integer('userid');
			$table->string("title");
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
		Schema::drop('bevents');
	}

}
