<?php

class UserTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
	  //DB::table('user')->truncate();

	  $users = [
      [
        "username" => "admin@bluestatedigital.com",
        "password" => Hash::make("business"),
        "email"    => "admin@bluestatedigital.com",
        "admin"    => 1
      ],
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
