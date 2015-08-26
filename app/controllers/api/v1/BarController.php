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

    public function show() {
        $inputs = Input::all();

        if(!isset($inputs['name'])) {
            return $this->errorResponse('Must include a bar name', 500);
        }
        else {
            $bar = $this->bar->findByName($inputs['name']);
            if($bar) {
                return $this->apiResponse($bar);
            }
            else{
                return $this->errorResponse('Bar not found', 404);
            }
        }
    }

    //@todo finish this!
    public function search() {
        $inputs = Input::all();

        if(!isset($inputs['ll']) && !isset($inputs['radius']) && !isset($inputs['zipcode'])) {
            return $this->errorResponse('Must provide search parameters', 500);
        }

        if(isset($inputs['ll']) && !isset($inputs['radius']) || !isset($inputs['ll']) && isset($inputs['radius'])) {
            return $this->errorResponse('Must provde both ll and radius');
        }

        if(isset($inputs['zipcode'])) {
            $bars = $this->bar->findByZip($inputs['zipcode']);
            if($bars->count() > 0) {
//                $bars->each(function($bar){
//                    $bar = $this->transform($bar);
//                });
                dd($bars->toArray());
            }
            else{
                dd('no bars!');
            }
        }
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
}
