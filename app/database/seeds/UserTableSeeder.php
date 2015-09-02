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
      [
          "username" => "testAdmin@packerseverywhere.com",
          "password" => Hash::make("gopackgo"),
          "email"    => "testAdmin@packerseverywhere.com",
          "admin"    => 1
      ],
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
