<?php namespace Packers\Services\Geocoder;

use Guzzle\Http\Client;

class GoogleGeocoder implements Geocoder
{
    public function __construct() {
        $this->client = new Client;
        $this->geoUrl = 'https://maps.googleapis.com/maps/api/geocode/json';
        $this->tzUrl = 'https://maps.googleapis.com/maps/api/timezone/json';
        $this->apiKey = 'AIzaSyA7zUXTQwmidEA6i9Fqd-48EPMmom5yf-Q';
    }

    public function geocode($address) {
        $req = $this->client->get(
            $this->geoUrl . "?address=" . urlencode($address) . '&key=' . $this->apiKey
        )->send();
        $resp = $req->json();
        if(!empty($resp['results'])) {
            $geoData = array(
                'latitude' => $resp['results'][0]['geometry']['location']['lat'],
                'longitude' => $resp['results'][0]['geometry']['location']['lng'],
            );
        }
        else {
            $geoData = false;
        }
        return $geoData;
    }

    public function getTimezone($lat, $lng) {
        $req = $this->client->get(
            $this->tzUrl . "?location=" . $lat .',' . $lng . '&timestamp=' . time() . '&key=' . $this->apiKey
        )->send();
        $resp = $req->json();
        if($resp['status'] == 'OK') {
            $timezone = $resp['timeZoneId'];
        }
        else {
            $timezone = null;
        }
        return $timezone;
    }
}