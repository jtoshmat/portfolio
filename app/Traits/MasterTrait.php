<?php

namespace app\Traits;

use app\User;

trait MasterTrait
{

    public function users($cid){
        $user = new User();
        $output = $user->where('cid','=', $cid)->first();
        if ($output) {
            return $output;
        }
        return false;
    }

}
