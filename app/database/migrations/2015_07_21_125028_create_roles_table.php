<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('roles')){
			return false;
		};

		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('rid');
			$table->integer('pusertype');
			$table->integer('uid');
			$table->string('privileges');
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
		Schema::drop('roles');
	}

}
