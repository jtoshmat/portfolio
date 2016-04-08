<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Organizaitons
        $organizations[] = \app\Organization::create(array(
            'beacon_id' => 'F7826DA6-4FA2-4E98-8024-BC5B71E0893E',
            'app_name' => 'GH Mobile Concierge',
            'app_logo' => 1,
            'app_timeout' => 30,
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $organizations[] = \app\Organization::create(array(
            'beacon_id' => '3E4414EE-5234-4AC3-9923-EBCEEEBD55B1',
            'app_name' => 'My Hospital Companion',
            'app_logo' => '',
            'app_timeout' => 15,
            'createdBy' => 2,
            'createdBy' => 2,
        ));
        $this->command->info('Creating Organizations data!');


        //Stations
        $stations[] = \app\Station::create(array(
            'description' => 'Admitting - Roman',
            'org_id' => 1,
            'major' => 49020,
            'minor' => 221,
            'battery_strength' => 'Normal',
            'status' => 'Active',
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $stations[] = \app\Station::create(array(
            'description' => 'Admitting - Scott',
            'org_id' => 1,
            'major' => 56152,
            'minor' => 34123,
            'battery_strength' => 'Normal',
            'status' => 'Active',
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $stations[] = \app\Station::create(array(
            'description' => 'Radiology - Roman',
            'org_id' => 1,
            'major' => 49020,
            'minor' => 222,
            'battery_strength' => 'Normal',
            'status' => 'Active',
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $stations[] = \app\Station::create(array(
            'description' => 'Radiology - Scott',
            'org_id' => 1,
            'major' => 43997,
            'minor' => 52701,
            'battery_strength' => 'Normal',
            'status' => 'Active',
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $stations[] = \app\Station::create(array(
            'description' => 'Cardiology - Roman',
            'org_id' => 1,
            'major' => 49020,
            'minor' => 223,
            'battery_strength' => 'Normal',
            'status' => 'Active',
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $stations[] = \app\Station::create(array(
            'description' => 'Cardiology - Scott',
            'org_id' => 1,
            'major' => 25288,
            'minor' => 23454,
            'battery_strength' => 'Normal',
            'status' => 'Active',
            'createdBy' => 1,
            'createdBy' => 1,
        ));

        $this->command->info('Creating Stations data!');

    }
}
