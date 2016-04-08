<?php

use Illuminate\Database\Seeder;

class StatiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations[0] = \app\Station::create(array(
            'description' => 'Admitting - Roman',
            'org_id' => '1',
            'major' => '49020',
            'minor' => '221',
            'battery_strength' => '',
            'status' => 'A',
            'createdBy' => 1,
        ));
        $stations[1] = \app\Station::create(array(
            'description' => 'Radiology - Roman',
            'org_id' => '1',
            'major' => '49020',
            'minor' => '222',
            'battery_strength' => '',
            'status' => 'A',
            'createdBy' => 1,
        ));
        $stations[2] = \app\Station::create(array(
            'description' => 'Cardiology - Roman',
            'org_id' => '1',
            'major' => '49020',
            'minor' => '223',
            'battery_strength' => '',
            'status' => 'A',
            'createdBy' => 1,
        ));
        $stations[3] = \app\Station::create(array(
            'description' => 'Admitting - Scott',
            'org_id' => '1',
            'major' => '56152',
            'minor' => '34123',
            'battery_strength' => '',
            'status' => 'A',
            'createdBy' => 1,
        ));
        $stations[4] = \app\Station::create(array(
            'description' => 'Radiology - Scott',
            'org_id' => '1',
            'major' => '43997',
            'minor' => '52701',
            'battery_strength' => '',
            'status' => 'A',
            'createdBy' => 1,
        ));
        $stations[5] = \app\Station::create(array(
            'description' => 'Cardiology - Scott',
            'org_id' => '1',
            'major' => '25288',
            'minor' => '23454',
            'battery_strength' => '',
            'status' => 'A',
            'createdBy' => 1,
        ));
    }
}
