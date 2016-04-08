<?php

namespace app\Services;
use GuzzleHttp\Client;
use app\Services\AdapterLog;

class Ehr2Adapter extends AdapterLog
{
    const APITOKENURL = 'http://tw151ga-azure.unitysandbox.com/Unity/unityservice.svc/json/GetToken';
    const APIURL = 'http://tw151ga-azure.unitysandbox.com/Unity/unityservice.svc/json/MagicJson';
    const APIUSERNAME = 'CareT-65d1-caretraxx-test';
    const APIPASSWORD = 'C@r3tr@xxC2r%tr9xxT%sTepPd51f2';
    const APINAME = 'CareTraxx.caretraxx.TestApp';
    const EHRUSERNAME = 'jmedici';

    public static function getData($action, $patientid, $parms=null){
        list(, $caller) = debug_backtrace(false, 2);
        $caller = $caller['class'].'@'.$caller['function'];
        self::log("Requesting {$action} at ". $caller);
        return self::getApiData($action, $patientid);
    }

    protected static function getApiData($action, $patientid=null, $parms=null){
        $api_service_credentials = json_encode(array('Action' => $action, 'AppUserID' => self::EHRUSERNAME, 'Appname' => self::APINAME, 'PatientID' => $patientid,
            'Token' => self::getToken(),
            'Parameter1' => '', 'Parameter2' => '', 'Parameter3' => '',
            'Parameter4' => '', 'Parameter5' => '', 'Parameter6' => '',
            'Data' => ''));

        $ch = self::callCurl(self::APIURL, $api_service_credentials);
        if (($output = curl_exec($ch)) === FALSE) {
            list(, $caller) = debug_backtrace(false, 2);
            $caller = $caller['class'].'@'.$caller['function'];
            self::log('EHR connection Error:'.curl_error($ch).' at '.$caller, 'emergency');
            return curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }

    protected static function getToken(){
        $api_service_credentials = json_encode(array('Username' => self::APIUSERNAME, 'Password' => self::APIPASSWORD));
        $ch = self::callCurl(self::APITOKENURL, $api_service_credentials);
        if (($output = curl_exec($ch)) === FALSE) {
            list(, $caller) = debug_backtrace(false, 2);
            $caller = $caller['class'].'@'.$caller['function'];
            self::log('EHR connection Error:'.curl_error($ch).' at '.$caller, 'emergency');
        }
        curl_close($ch);
        return $output;
    }

    protected static function callCurl($cUrl, $json_service_credentials,$header=['Content-Type: application/json']){
        $ch = curl_init( );
        curl_setopt($ch, CURLOPT_URL, $cUrl);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_service_credentials);
        return $ch;
    }

}
