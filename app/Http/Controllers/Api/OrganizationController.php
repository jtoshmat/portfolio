<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\DistrictTransformer;
use app\Transformer\OrganizationTransformer;
use app\District;
use app\Organization;

class OrganizationController extends ApiController
{
    public function index()
    {
        $organizations =Organization::take(10)->get();

        return $this->respondWithCollection($organizations, new OrganizationTransformer);
    }

    public function show($organizationsId)
    {
        $organization = Organization::find($organizationsId);

        if (! $organization) {
            return $this->errorNotFound('Organization not found');
        }

        return $this->respondWithItem($organization, new OrganizationTransformer);
    }

}
