<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFromApiToBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bars', function(Blueprint $table)
		{
			$table->tinyInteger('from_api')->default(0)->after('longitude');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bars', function(Blueprint $table)
		{
			$table->dropColumn('from_api');
		});
	}

}
