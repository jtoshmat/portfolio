<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\DistrictTransformer;
use app\Transformer\OrganizationTransformer;
use app\District;
use app\Organization;

class DistrictController extends ApiController
{
    public function index()
    {
        $districts = District::take(10)->get();

        return $this->respondWithCollection($districts, new DistrictTransformer);
    }

    public function show($districtsId)
    {
        $district = District::find($districtsId);

        if (! $district) {
            return $this->errorNotFound('District not found');
        }

        return $this->respondWithItem($district, new DistrictTransformer);
    }

    public function getOrganizations($districtsId)
    {
        $district = District::find($districtsId);

        if (! $district) {
            return $this->errorNotFound('User not found');
        }

        return $this->respondWithCollection($district->organizations, new OrganizationTransformer);
    }
}
