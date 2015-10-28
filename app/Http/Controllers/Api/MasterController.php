<?php

namespace app\Http\Controllers\Api;

use app\Http\Controllers\Api\ApiController;
use app\Transformer\RoleTransformer;
use app\Transformer\MasterTransformer;
use app\Repositories\SideBarItems;

class MasterController extends ApiController
{
    public function sidebar()
    {
        $userspecific = new SideBarItems();
        $sidebar = $userspecific->getAll();
        $sidebar = array('tags'=>$sidebar);
        return $this->respondWithCollection($sidebar, new MasterTransformer);
    }
}
