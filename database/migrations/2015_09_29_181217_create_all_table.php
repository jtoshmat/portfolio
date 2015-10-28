<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::dropIfExists("sessions");
	    Schema::dropIfExists("friends");
	    Schema::dropIfExists("child_guardian");
	    Schema::dropIfExists("district_organization");
	    Schema::dropIfExists("districts");
	    Schema::dropIfExists("organizations");
	    Schema::dropIfExists("groups");
	    Schema::dropIfExists("roleables");
	    Schema::dropIfExists("imageables");

	    Schema::dropIfExists("role_user");
	    //Schema::dropIfExists("role_permissions");
	    //Schema::dropIfExists("permissions");
	    Schema::dropIfExists("roles");

        Schema::dropIfExists("users");



        Schema::create("users", function (Blueprint $table)
        {
            $table->increments('id');
	        $table->string('student_id')->unique();
	        $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
	        $table->string('name');
            $table->string('email');
            $table->string('slug');
	        $table->char('sex', 4);
	        $table->date('dob');
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
	        $table->softDeletes();
        });

        Schema::create('role_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unsigned();
            $table->unsignedInteger('role_id')->unsigned();
	        $table->unique(array('user_id', 'role_id'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
	        $table->softDeletes();
        });

        Schema::create('roleables', function(Blueprint $table)
        {
    	    $table->increments('id');
    	    $table->unsignedInteger('user_id')->unsigned();
    	    $table->unsignedInteger('roleable_id')->unsigned();
    	    $table->string('roleable_type');
    	    $table->unsignedInteger('role_id')->unsigned();
    	    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    	    $table->timestamps();
        });

	    Schema::create('imageables', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('user_id')->unsigned();
		    $table->unsignedInteger('roleable_id')->unsigned();
		    $table->string('roleable_type');
		    $table->unsignedInteger('role_id')->unsigned();
		    //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		    $table->timestamps();
	    });

	    Schema::create('districts', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->integer('system_id');
		    $table->string('code');
		    $table->string('title');
		    $table->string('description');
		    $table->timestamps();
		    $table->softDeletes();
	    });

	    Schema::create('organizations', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->string('code');
		    $table->string('title');
		    $table->string('description');
		    $table->timestamps();
		    $table->softDeletes();
	    });


	    Schema::create('district_organization', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('district_id')->unsigned();
		    $table->unsignedInteger('organization_id')->unsigned();
		    $table->foreign('district_id')->references('id')->on('districts');
		    $table->timestamps();
	    });

	    Schema::create('groups', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('organization_id')->unsigned();
		    $table->string('title');
		    $table->unique(array('organization_id', 'title'));
		    $table->string('description');
		    $table->timestamps();
		    $table->softDeletes();
	    });


	    Schema::create('child_guardian', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('guardian_id')->unsigned();
		    $table->unsignedInteger('child_id')->unsigned();
		    $table->foreign('child_id')->references('id')->on('users')->onDelete('cascade');
		    $table->foreign('guardian_id')->references('id')->on('users')->onDelete('cascade');
		    $table->timestamps();
	    });

	    Schema::create('friends', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('user_id')->unsigned();
		    $table->unsignedInteger('friend_id')->unsigned();
		    $table->unique(array('user_id', 'friend_id'));
		    $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
		    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		    $table->integer('status');
		    $table->timestamp('accepted_date');
		    $table->timestamp('rejected_date');
		    $table->timestamp('blocked_date');
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
        Schema::dropIfExists("roles");
        Schema::dropIfExists("users");
        Schema::dropIfExists("role_user");
        Schema::dropIfExists("permissions");
        Schema::dropIfExists("role_permissions");

    }

}
