<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use cmwn\User;
use cmwn\Role;

	class UserTableSeeder extends Seeder {

		public function run()
		{
            DB::table('users')->delete();

            User::create(array(
                "name" => "Jon Toshmatov",
                "email" => "jontoshmatov@yahoo.com",
                "password" => Hash::make("business"),
            ));

            DB::table('roles')->delete();

            Role::create(array(
                "title" => "admin",
            ));

			Role::create(array(
				"title" => "principal",
			));

			Role::create(array(
				"title" => "teacher",
			));

			Role::create(array(
				"title" => "student",
			));



		}

	}
