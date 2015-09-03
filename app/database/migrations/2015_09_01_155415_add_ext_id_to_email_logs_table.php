<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtIdToEmailLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('email_logs', function(Blueprint $table)
		{
			$table->integer('ext_id')->after('type')->unsigned()->index()->nullable();
			$table->string('ext_type', 12)->after('ext_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('email_logs', function(Blueprint $table)
		{
			$table->dropColumn('ext_id');
			$table->dropColumn('ext_type');
		});
	}

}
