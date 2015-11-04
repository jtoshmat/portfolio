<?php

use Illuminate\Database\Seeder;
use app\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {

        DB::table('roles')->truncate();

        $super_admin = Role::create(array(
                'title' => 'super_admin',
            ));

        $admin = Role::create(array(
                'title' => 'admin',
            ));

        $member = Role::create(array(
                'title' => 'member',
            ));
    }
}
