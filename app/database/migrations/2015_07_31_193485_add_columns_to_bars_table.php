<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bars', function(Blueprint $table)
		{
			$table->string('phone', 20)->after('zipcode');
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
			$table->dropColumn('phone');
		});
	}

}
