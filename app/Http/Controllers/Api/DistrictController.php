<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\DistrictTransformer;
use app\Transformer\OrganizationTransformer;
use app\District;
use app\Organization;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class DistrictController extends ApiController
{
    public function index()
    {
        $query = \Request::query('name');
        if ( $query ) {
            $districts = District::name($query)->get();
        }else{
            $districts = District::take(10)->get();
        }
        return $this->respondWithCollection($districts, new DistrictTransformer);
    }

    public function update(\Request $request){
        if ($request::isMethod('put')) {
            $validator = Validator::make(Input::all(), District::$apiDistrictUpdate);
            if ($validator->passes()) {
                //@TODO test the district api update wth front end.
                $id = $request::get('id');
                $district = new District();
                dd($district->updateApiDistrict($request));
                return $this->respondWithArray(array('The district has been updated successfully.'));
            }else{
                $messages = print_r($validator->errors()->getMessages(),true);
                return $this->errorInternalError("Input validation error: ".$messages);
            }
        }
        return $this->errorInternalError("Invalid request");
    }

    public function show($districtsId)
    {
        $district = District::find($districtsId);

        if (! $district) {
            return $this->errorNotFound('District not found');
        }

        return $this->respondWithItem($district, new DistrictTransformer);
    }


}
