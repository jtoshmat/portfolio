<?php

use Illuminate\Database\Seeder;
use app\User;
use app\Role;
use app\Group;
use app\Organization;
use app\District;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->delete();
        DB::table('child_guardian')->delete();

        for ($i = 1; $i < 5; ++$i) {
            $districts[] = District::create(array(
                    'title' => $faker->company,
                    'description' => 'District:'.$i.$faker->paragraph(1),
                ));
        }
        for ($i = 1; $i < 20; ++$i) {
            $organizations[$i] = Organization::create(array(
                    'title' => $faker->company,
                    'description' => 'Group:'.$i.$faker->paragraph(1),
                ));
        }

        // DB::table('district_organization')->insert([
        //         'district_id' => $district->id,
        //         'organization_id' => $organization->id,
        //     ]);

        for ($i = 1; $i < 100; ++$i) {
            $groups[$i] = Group::create(array(
                    'organization_id' => $organizations[rand(1, 19)]->id,
                    'title' => $faker->company,
                    'description' => 'Class:'.$i.$faker->paragraph(1),
                ));
        }

        // Create Users

        $users[] = User::create(array(
                'first_name' => 'Jon',
                'last_name' => 'Toshmatov',
                'email' => 'jontoshmatov@yahoo.com',
                'password' => Hash::make('business'),
                'slug' => 'jon_slug',
                'student_id' => 'jontoshmatov@yahoo.com',
            ));

        $users[] = User::create(array(
                'first_name' => 'Arron',
                'last_name' => 'Kallenberg',
                'email' => 'arron.kallenberg@gmail.com',
                'password' => Hash::make('business'),
                'slug' => 'arron-kallenberg',
                'student_id' => 'arron.kallenberg@gmail.com',
            ));

        for ($i = 0; $i < 500; ++$i) {
            $frist_name = $faker->firstName;
            $last_name = $faker->lastName;

            $email = strtolower($frist_name.'.'.$last_name.'@'.$faker->safeEmailDomain);

            $users[$i] = User::create(array(
                    'first_name' => $frist_name,
                    'last_name' => $last_name,
                    'gender' => rand(0, 1) ? 'male' : 'female',
                    'birthdate' => $faker->dateTimeBetween('-40 years', '-8 years'),
                    'email' => $email,
                    'password' => Hash::make('business'),
                    'slug' => $faker->uuid,
                    'student_id' => $faker->uuid,
                ));

            $users[$i]->groups()->save($groups[rand(1, 99)]);
        }

        // // Create 5 Guardians
        // for ($i = 1; $i < 5; ++$i) {
        //     $guardian = User::create(array(
        //         'email' => 'jontoshmatov@yahoo.com'.$i,
        //         'password' => Hash::make('business'),
        //         'slug' => 'parent_slug'.$i,
        //         'student_id' => 'guardian_id'.$i,
        //     ));
        // }

        // // Create 5 Children
        // for ($i = 1; $i < 5; ++$i) {
        //     $child = User::create(array(
        //         'name' => 'child'.$i,
        //         'email' => 'child@child.com'.$i,
        //         'password' => Hash::make('business'),
        //         'slug' => 'child_slug'.$i,
        //         'student_id' => 'child_id'.$i,
        //     ));
        // }

        //$jon->role()->sync(1);
        //$arron->role()->sync(1);


//        DB::table('friends')->insert([
//                'user_id' => 1,
//                'friend_id' => 2,
//            ]);
//
//        DB::table('child_guardian')->insert([
//                'guardian_id' => $guardian->id,
//                'child_id' => $child->id,
//            ]);
    }
}
