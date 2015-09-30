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
                "email" => "jontoshmatov@yahoo.com",
                "password" => Hash::make("business"),
            ));

            DB::table('roles')->delete();
            Role::create(array(
                "permissions" => "Coming soon",
            ));
            Role::create(array(
                "permissions" => "Coming soon 2",
            ));
            Role::create(array(
                "permissions" => "Coming soon 3",
            ));


		}

	}
