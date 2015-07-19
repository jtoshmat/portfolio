<?php

class UserTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $users = [
      [
        "username" => "jontoshmatov@yahoo.com",
        "password" => Hash::make("business"),
        "email"    => "jontoshmatov@yahoo.com"
      ],
      [
        "username" => "test@test.com",
        "password" => Hash::make("business"),
        "email"    => "test@test.com"
      ],
      [
        "username" => "admin@admin.com",
        "password" => Hash::make("business"),
        "email"    => "admin@admin.com"
      ],            
      [
        "username" => "bar@bar.com",
        "password" => Hash::make("business"),
        "email"    => "bar@bar.com"
      ],
      [
        "username" => "demo@demo.com",
        "password" => Hash::make("business"),
        "email"    => "demo@demo.com"
      ],      
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
