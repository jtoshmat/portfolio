<?php

class BeventsTableSeeder extends Seeder
{

public function run()
{

    Bevent::create(array(
    	'barid' => 70,
        'title' => 'Bar name 0',
 
    )); 
    Bevent::create(array(
    	'barid' => 71,
        'title' => 'Bar name 1',
 
    )); 
    Bevent::create(array(
    	'barid' => 72,
        'title' => 'Bar name 2',
 
    )); 
    Bevent::create(array(
    	'barid' => 73,
        'title' => 'Bar name 3',
 
    )); 
    Bevent::create(array(
    	'barid' => 74,
        'title' => 'Bar name 4',
 
    ));    
    


}

}