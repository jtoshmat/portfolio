<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Model::unguard();


        $this->call(RoleSeeder::class);
        $this->command->info('Roles seeded!');

        $this->call(UserTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(GameTableSeeder::class);
        $this->command->info('Game table seeded!');

        $this->call(FlipTableSeeder::class);
        $this->command->info('Flip table seeded!');




        Model::reguard();
    }
}
