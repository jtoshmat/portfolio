<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::dropIfExists("run");
		Schema::dropIfExists("uploads");
		Schema::dropIfExists("bevents");
		Schema::dropIfExists("bars");
		Schema::dropIfExists("games");
		Schema::dropIfExists("roles");
		Schema::dropIfExists("user");
		Schema::dropIfExists("user_types");

		Schema::create("user", function (Blueprint $table)
		{
			$table->increments("id");
			$table->string("username",70)->unique();
			$table->string("password");
			$table->string("email",155);
			$table->boolean('admin', false);
			$table->string("remember_token")->nullable();
			$table->timestamps();
		});

		Schema::create('user_types', function(Blueprint $table)
		{
			$table->increments('utid');
			$table->integer('rid');
			$table->string("title", 255);
			$table->timestamps();
		});

		Schema::create('bars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('uid'); //unassigned
			$table->foreign('uid')->references('id')->on('user')->onDelete('cascade');
			$table->tinyInteger('status'); //tinyint
			$table->string('barname', 155);
			$table->string('address');
			$table->string('address2');
			$table->string('city', 155);
			$table->string('state', 155);
			$table->string('country', 155);
			$table->string('timezone', 155);
			$table->string('phone'); //set the phone format in model validator
			$table->string('website');
			$table->string('owner_email');
			$table->string('zipcode');
			$table->string('description',1000);
			$table->timestamps();
		});
		Schema::create('uploads', function(Blueprint $table)
		{

			$table->increments('uploadid');
			$table->unsignedInteger('bid');
			$table->foreign('bid')->references('id')->on('bars')->onDelete('cascade');
			$table->tinyInteger('uid');
			$table->string('filename');
			$table->timestamps();
		});
		Schema::create('bevents', function(Blueprint $table)
		{

			$table->increments('bid');
			$table->unsignedInteger('barid'); //unassigned
			$table->foreign('barid')->references('id')->on('bars')->onDelete('cascade');
			$table->tinyInteger('gid');
			$table->tinyInteger('userid');
			$table->string("title");
			$table->string('description',1000);
			$table->timestamp('eventtime');
			$table->timestamps();
		});
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('rid');
			$table->tinyInteger('pusertype');
			$table->unsignedInteger('uid');
			$table->foreign('uid')->references('id')->on('user')->onDelete('cascade');
			$table->string('privileges');
			$table->timestamps();
		});
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('gid');
			$table->integer('uid');
			$table->integer('bid');
			$table->string('title');
			$table->string('matchup');
			$table->string('location');
			$table->string('description',1000);
			$table->timestamp('game_time');
			$table->string('tv');
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
		Schema::dropIfExists("run");
		Schema::dropIfExists("uploads");
		Schema::dropIfExists("bevents");
		Schema::dropIfExists("bars");
		Schema::dropIfExists("games");
		Schema::dropIfExists("roles");
		Schema::dropIfExists("user");
		Schema::dropIfExists("user_types");
	}

}
