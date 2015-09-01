<?php

class RefZipDetails extends Eloquent
{
    protected $table = 'ref_zip_details';

    public function getGeoDataByZip($zip) {
        $geoData = $this->select('latitude', 'longitude', 'state_cd')->where('zip', '=', $zip)->first();
        return $geoData;
    }
}
