<?php

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'username' => 'htoshmatov',
        'password' => Hash::make('business'),
    ));
}

}