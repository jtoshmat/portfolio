<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use GuzzleHttp;

class AdapterController extends ApiResponseController
{
    public $client;
    public $conn;
    protected $data;

    //@TODO make these look like all other controller that follows the standard 3/30
//    public function patient(Request $request){
//        $request->request->add(['function'=>__FUNCTION__]);
//        $output = $this->processRequest($request);
//        return $output;
//    }

//    public function schedule(Request $request){
//        //@TODO make schedule input normalized to schedule endpoint, make it like the others for example Allscripts or Green Way 3/30
//        $request->request->add(['function'=>__FUNCTION__]);
//        $output = $this->processRequest($request);
//        return $output;
//    }

//    public function provider(Request $request){
//        $request->request->add(['function'=>__FUNCTION__]);
//        $output = $this->processRequest($request);
//        return $output;
//    }

//    public function medication(Request $request){
//        $request->request->add(['function'=>__FUNCTION__]);
//        $output = $this->processRequest($request);
//        return $output;
//    }

}
