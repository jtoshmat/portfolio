<?php namespace api\v1;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class BarController extends \api\ApiController {

    protected $bar;

    protected $rzd;

    public function __construct() {
        $this->bar = new \Bar;
        $this->rzd = new \RefZipDetails;
    }

    public function show($name=null) {
        if(!isset($name) || empty($name)) {
            return $this->errorResponse('Must include a bar name', 400);
        }
        else {
            $bar = $this->bar->findByName($name);
            if($bar) {
                return $this->apiVenueResponse($bar);
            }
            else{
                return $this->errorResponse('Bar not found', 404);
            }
        }
    }

    public function search() {
        $inputs = Input::all();

        if(!isset($inputs['ll']) && !isset($inputs['radius']) && !isset($inputs['zipcode'])) {
            return $this->errorResponse('Must provide search parameters', 400);
        }

        if(isset($inputs['ll']) && !isset($inputs['radius']) || !isset($inputs['ll']) && isset($inputs['radius'])) {
            return $this->errorResponse('Must provde both ll and radius');
        }

        if(isset($inputs['zipcode'])) {
            $bars = $this->bar->findAllByZip($inputs['zipcode']);
                return $bars;
            }
            else{
                return $this->errorResponse('No bars found', 404);
            }
    }
    
    private function getBarsByGeoData($ll, $radius) {

    }

    private function getBarsByZip($zip){

    }

    private function transformUpload($object) {
        if($object->upload) {
            $object->logo = $object->upload->filename;
            unset($object->upload);
        }
    }

    private function getGeoDataFromZip($zipcode) {
        $geoData = $this->rzd->getGeoDataByZip($zipcode);
        return !empty($geoData) ? $geoData->toArray() : false;
    }

    public function apiVenueResponse($data) {
        $response = \Response::json(array(
            'status' => 'OK',
            'location' => $data
        ), 200);
        return $response;
    }
}
