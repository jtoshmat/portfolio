<?php

class BarsTableSeeder extends Seeder
{

public function run()
{
    DB::table('bars')->delete();

    Bar::create(array(
	    'uid' =>1,
        'barname' => 'First Bar',
        'address' => '200 Main Street',
        'city' => 'Dubuque',
        'state' => 'IA',
        'zipcode' => '52001',
        'country' => 'US',
        'timezone' => 'US/Central',
        'phone' => '563-451-6893',
        'website' => 'www.toshmatov.us',
        'status' => 0,
    ));


}

}