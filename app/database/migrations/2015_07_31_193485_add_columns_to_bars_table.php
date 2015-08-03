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
		if (!Schema::hasTable('roles')){
			return false;
		};
		
		Schema::table('bars', function(Blueprint $table)
		{
			$table->string('phone', 20)->after('zipcode');
			$table->dropColumn('phone');
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
