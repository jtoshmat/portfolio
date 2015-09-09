<?php namespace Packers\Services\Geocoder;

interface Geocoder
{
    public function geocode($address);
}