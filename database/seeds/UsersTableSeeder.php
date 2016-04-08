<?php

use Illuminate\Database\Seeder;
use app\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users')->delete();


        $organizations = \app\Organization::create(array(
         'beacon_id' => 'F7826DA6-4FA2-4E98-8024-BC5B71E0893E',
         'app_name' => 'GH Mobile Concierge',
         'app_logo' => 'https://jobs.bmj.com/getasset/2011c5ae-7da5-4f13-b7c5-f123dd7a2bcf/',
         'app_timeout' => '10',
         'password_format'=>'[A-Za-z0-9]',
         'from_email_address' => 'ghmobileconcierge@gmail.com',
         'from_email_orgname' => 'GH Mobile Concierge',
         'createdBy' => 1,
        ));

        $users[] = User::create(array(
            'org_id' => $organizations ->id,
            'empid' => 29,
            'type' => 1,
            'first_name' =>'Jon',
            'last_name' =>'Toshmatov - Frank Allscript',
            'status' =>'A',
            'activation_code' =>23242342,
            'mobile_number' =>'5634516893',
            'device_token' =>'bb89a5c65d690f2422dcc412392b12f888fc07a4a07502119fc048d4fa582558',
            'device_type' =>'I',
            'email' => 'jontoshmatov@yahoo.com',
            'password' => Hash::make('business'),
        ));

        $users[] = User::create(array(
            'org_id' => $organizations ->id,
            'empid' => 25,
            'type' => 1,
            'first_name' =>'Scott',
            'last_name' =>'Moser - David',
            'status' =>'A',
            'activation_code' =>23412312,
            'mobile_number' =>'5634516894',
            'device_token' =>'bb89a5c65d690f2422dcc412392b12f888fc07a4a07502119fc048d4fa582558',
            'device_type' =>'I',
            'email' => 'scott@caretraxx.com',
            'password' => Hash::make('business'),
        ));

        $users[] = User::create(array(
            'org_id' => $organizations ->id,
            'empid' => 34,
            'type' => 1,
            'first_name' =>'Roman',
            'last_name' =>'Stetsenko - Nathan Allscript',
            'status' =>'A',
            'activation_code' =>90372342,
            'mobile_number' =>'5634516895',
            'device_token' =>'48c32270c1bbfc94ec486e414d178742cda8bb6037614af551c6bb6b11b19cb4',
            'device_type' =>'A',
            'email' => 'evfemist@gmail.com',
            'password' => Hash::make('business'),
        ));

        $this->command->info('Creating Admin user data!');
    }
}
