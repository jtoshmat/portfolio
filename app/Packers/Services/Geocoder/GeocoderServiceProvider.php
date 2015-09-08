<?php namespace Packers\Services\Geocoder;

use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind(
            'Packers\Services\Geocoder\Geocoder',
            'Packers\Services\Geocoder\GoogleGeocoder'
        );
    }
}