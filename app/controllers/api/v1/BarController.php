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
                return $this->apiResponseJSONP($bar, 'location');
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

        if(isset($inputs['ll']) && isset($inputs['radius'])) {
            $param = explode(',', $inputs['ll']);
            $lat = $param[0];
            $lng = $param[1];
            $bars = $this->getBarsByGeoData($lat,$lng, $inputs['radius']);
            return $this->apiResponseJSONP($bars, 'locations');
        }

        if(isset($inputs['zipcode'])) {
            $bars = $this->bar->findAllByZip($inputs['zipcode']);
                return $this->apiResponseJSONP($bars, 'locations');
            }
            else{
                return $this->errorResponse('No bars found', 404);
            }
    }

    private function getBarsByGeoData($ll, $ln, $radius) {
         $bar = $this->bar->findByGeo($ll, $ln, $radius);          
         return $bar;
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

    public function createBar(){
        $method = \Request::method();
        if (\Request::isMethod('post'))
        {
            $validator = \Validator::make(\Input::all(), \Bar::$addbarrulesapi);
                $User = new \User();
                $Bar = new \Bar();
                $BarController = new \BarController;

            if ($validator->passes()) {

                $email = \Input::get('email');
                $isUser = $User->verifyUsernameApi($email);
                $userExists = isset($isUser[0])?true:false;

                if (!$userExists){
                    $uid = $User->createUserApi($email);
                }else{
                    $uid = $isUser[0]->id;
                }
                //create a new bar here
                $bid = $Bar->createBarApi($uid);

                //Upload logo
                $uploadedFileName = null;
                if (\Input::hasFile('logo')){
                    $uploadedFileName = $BarController->uploadLogoApi($bid,$uid);
                }
                return $this->apiResponse(array('message' => 'success'), 200);

            }
            return $this->errorResponse($validator->errors()->all(), 404);
        }
        return $this->errorResponse('This is an invalid request', 404);
    }

    public function createBarForm(){
            return \View::make('bars/addbarapi');
    }

    public function apiVenueResponse($data) {
        $response = \Response::json(array(
            'status' => 'OK',
            'location' => $data
        ), 200);
        return $response;
    }

}
