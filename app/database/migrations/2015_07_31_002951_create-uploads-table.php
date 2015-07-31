<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
	 {
		Schema::drop('uploads');
		Schema::create('uploads', function(Blueprint $table)
			{

$table->increments('uploadid');
$table->integer('uid');
$table->integer('bid');
$table->string('filename');
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
