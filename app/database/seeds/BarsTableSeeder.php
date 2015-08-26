<?php

class BarsTableSeeder extends Seeder
{

public function run()
{
    DB::table('bars')->delete();

    $new = new Bar;
	    $new->uid = 1;
        $new->barname = 'First Bar';
        $new->slug = 'first-bar';
        $new->address = '200 Main Street';
        $new->city = 'Dubuque';
        $new->state = 'IA';
        $new->zipcode = '52001';
        $new->country = 'US';
        $new->timezone = 'US/Central';
        $new->phone = '563-451-6893';
        $new->website = 'http://www.google.com';
        $new->status = 0;
        $new->dst_offset = -5;
        $new->gmt_offset = -4;

        $rzd = new RefZipDetails;
        $geoData = $rzd->getGeoDataByZip(52001);

        $new->latitude = $geoData->latitude;
        $new->longitude = $geoData->longitude;

    $new->save();

}

}