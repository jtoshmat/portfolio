<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();


		$this->call('UserTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('BarsTableSeeder');
		$this->call('GamesTableSeeder');
		$this->call('RefZipDetailsSeeder');
	}

}
