<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugDstOffsetGmtOffsetToBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bars', function(Blueprint $table)
		{
			$table->string('slug')->after('barname');
			$table->integer('dst_offset')->after('timezone');
			$table->integer('gmt_offset')->after('dst_offset');
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
			$table->dropColumn('slug');
			$table->dropColumn('dst_offset');
			$table->dropColumn('gmt_offset');
		});
	}

}
