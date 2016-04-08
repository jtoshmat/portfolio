<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use GuzzleHttp;

class DispatcherController extends ApiResponseController
{
    protected static $appname;

    public function __construct()
    {
        self::$appname = \Config::get('app.appname');
    }
    
    public function callAdapter($parms){
        $orgid = $parms['orgid'];
        $adapterName  = "app\\Services\\".\Config::get('myadapter.organizations.'.$orgid.".adapter")["primary"];
        $output = $adapterName::processRequest($parms);
        return $output;
    }
}
