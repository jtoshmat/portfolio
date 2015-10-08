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
	    Schema::dropIfExists("group_user");
	    Schema::dropIfExists("child_guardian");
	    Schema::dropIfExists("organization_user");
	    Schema::dropIfExists("district_organization");
	    Schema::dropIfExists("districts");
	    Schema::dropIfExists("organizations");
	    Schema::dropIfExists("group_user");
	    Schema::dropIfExists("groups");

	    Schema::dropIfExists("role_user");
	    //Schema::dropIfExists("role_permissions");
	    //Schema::dropIfExists("permissions");
	    Schema::dropIfExists("roles");

        Schema::dropIfExists("users");



        Schema::create("users", function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('slug')->unique();
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

	    Schema::create('districts', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->string('title');
		    $table->string('description');
		    $table->timestamps();
		    $table->softDeletes();
	    });

	    Schema::create('organizations', function(Blueprint $table)
	    {
		    $table->increments('id');
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
		    $table->string('description');
		    $table->timestamps();
		    $table->softDeletes();
	    });

	    Schema::create('group_user', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('user_id')->unsigned();
		    $table->unsignedInteger('group_id')->unsigned();
		    $table->unsignedInteger('role_id')->unsigned();
		    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		    $table->timestamps();
	    });

	    Schema::create('organization_user', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('user_id')->unsigned();
		    $table->unsignedInteger('organization_id')->unsigned();
		    $table->unsignedInteger('role_id')->unsigned();
		    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		    $table->timestamps();
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







	    /*
		 * Commented out because permission table is not being used - 10/02 JT
		Schema::create('role_permissions', function(Blueprint $table)
		{
			return false;
			$table->increments('id');
			$table->unsignedInteger('role_id')->unsigned();
			$table->unsignedInteger('permission_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('permissions', function(Blueprint $table)
		{
			return false;
			$table->increments('id');
			$table->string('title');
			$table->timestamps();
		});
		*/

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
