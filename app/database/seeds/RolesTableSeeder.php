<?php

class RolesTableSeeder extends Seeder
{

public function run()
{
    DB::table('roles')->delete();


		Role::create(array(
        'uid' => 1,
<<<<<<< HEAD
		    'pusertype' => 1,
        'privileges' => 1
    ));

=======
	    'pusertype' => 1,
        'privileges' => 7
    ));    
    
>>>>>>> master


}

}