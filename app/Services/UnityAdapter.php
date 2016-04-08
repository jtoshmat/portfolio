<?php

namespace app\Services;
use app\Config;
use app\User;
use GuzzleHttp\Client;
use app\Services\AdapterLog;

class UnityAdapter extends AdapterLog
{
    protected static $APITOKENURL;
    protected static $APIURL;
    protected static $APIUSERNAME;
    protected static $APIPASSWORD;
    protected static $APINAME;
    protected static $EHRUSERNAME;
    protected static $GETPATIENT = 'getpatient';
    protected static $GETPATIENTFULL = 'getpatientfull';
    protected static $GETSCHEDULE = "GetEncounterList";
    protected static $GETLISTOFDICTIONARIES = 'getDictionary';
    protected static $GETPROVIDER ='getProvider';
    protected static $GETPROVIDERINFO = 'getProviderInfo';
    protected static $GETCLINICALSUMMARY = 'getClinicalSummary';
    protected static $ENCOUNTERTYPE = 'Appointment';
    protected static $parm;

    public static function getConfig()
    {
        $org = 1;
        $config = Config::run($org);
        $myconfig = \Config::get('myadapter.organizations.'.$org.".adapter");
        self::$APITOKENURL = $myconfig['APITOKENURL'];
        self::$APIURL = $myconfig['APIURL'];
        self::$APIUSERNAME = Config::key('APIUSERNAME');
        self::$APIPASSWORD = Config::key('APIPASSWORD');
        self::$APINAME = $myconfig['APINAME'];
        self::$EHRUSERNAME = Config::key('EHRUSERNAME');
    }

    protected static function userByCid($cid){
        $cid = (int) $cid;
        $output = User::find($cid);
        if ($output) {
            return $output->empid;
        }
        return false;
    }

    public static function processRequest($data){
        self::getConfig();
        self::$parm = $data;

        if ($data['action']!='get' && $data['action']!='create' && $data['action']!='update' && $data['action']!='delete'){
            $error = [
                'error' => 405,
                'message' =>"Method Not Allowed"
            ];
            AdapterLog::log($error['message'] ." at ".__METHOD__.":".__LINE__,'warning');
            exit(json_encode($error));
        }

        $function = strtolower(self::$parm['action']).ucwords(self::$parm['function']);
        if (!method_exists(self::class, $function)){
            $error = [
                'error' => 405,
                'message' =>"Method Does Not Exist"
            ];
            AdapterLog::log($error['message'] ." at ".__METHOD__.":".__LINE__,'warning');
            exit(json_encode($error));
        }

        list(, $caller) = debug_backtrace(false, 2);
        $caller = $caller['class'].'@'.$caller['function'];
        self::log("Requesting ".self::$parm['action']." at ". $caller);
        return self::$function();
    }

    /*
     * Patient functions
     */
    protected static function getPatient(){
        $empid = self::userByCid(self::$parm["cid"]);
        $api_parms = [
            'Action' => self::$GETPATIENT,
            'PatientID' => $empid,
            'Parameter1' => '',
            'Parameter2' => '',
            'Parameter3' => '',
            'Parameter4' => '',
            'Parameter5' => '',
            'Parameter6' => '',
            'Data' => ''
        ];
        return self::getApiData($api_parms);
    }

    protected static function createPatient(){
        return 'create patient';
    }

    protected static function updatePatient(){
        return 'update patient coming soon';
    }

    protected static function deletePatient(){
        return 'delete patient coming soon';
    }

    /*
     * All schedule requests
     */
    public static function getSchedule(){
        $empid = (integer) self::userByCid(self::$parm['cid']);
        $api_parms = [
            'Action' => self::$GETSCHEDULE,
            'PatientID' => $empid,
            'Parameter1' => 'Appointment',
            'Parameter2' => self::$parm['max_to_return'],
            'Parameter3' => self::$parm['days_from_today'],
            'Parameter4' => 'N',
            'Parameter5' => '',
            'Parameter6' => '',
            'Data' => ''
        ];

        return self::getApiData($api_parms);

    }

    public static function createSchedule(){
        return 'create schedule coming soon';
    }

    public static function updateSchedule(){
        return 'update schedule coming soon';
    }

    public static function deleteSchedule(){
        return 'delete schedule coming soon';
    }

    /*
     * Provider functions
     */
    protected static function getProvider(){
        $api_parms = [
            'Action' => self::$GETPROVIDER,
            'Parameter1' => self::$parm['provider_id'],
            'Parameter2' => '',
            'Parameter3' => '',
            'Parameter4' => '',
            'Parameter5' => '',
            'Parameter6' => '',
            'Data' => ''
        ];
        return self::getApiData($api_parms);
    }

    protected static function getProviderInfo($data){
        $api_parms = [
            'Action' => self::$GETPROVIDERINFO,
            'PatientID' => '',
            'Parameter1' => $data['prescribedby'],
            'Parameter2' => '',
            'Parameter3' => '',
            'Parameter4' => '',
            'Parameter5' => '',
            'Parameter6' => '',
            'Data' => ''
        ];
        return self::getApiData($api_parms);
    }

    protected static function createProvider(){
        return 'create provider';
    }

    protected static function updateProvider(){
        return 'update provider coming soon';
    }

    protected static function deleteProvider(){
        return 'delete provider coming soon';
    }

    /*
     * Meidication functions
     */
    protected static function getMedication(){
        $empid = self::userByCid(self::$parm["cid"]);
        $api_parms = [
            'Action' => self::$GETCLINICALSUMMARY,
            'PatientID' => $empid,
            'Parameter1' => 'Medications',
            'Parameter2' => '',
            'Parameter3' => 'Y',
            'Parameter4' => '',
            'Parameter5' => '',
            'Parameter6' => '',
            'Data' => ''
        ];
        $medications = json_decode(self::getApiData($api_parms), true);
        if(empty($medications[0]["getclinicalsummaryinfo"])){
            return ['error' =>
            [
                'code' => "404",
                "message" =>"Medication is not found for this patient"
            ]
            ];
        }

        foreach ($medications as $num=>$medication) {
                $xml = simplexml_load_string($medication["getclinicalsummaryinfo"][$num]["XMLDetail"]);
                $providerName = (string)$xml->prescribedby["value"];
                $sig = (string)$xml->sig["value"];
                $medicationName = (string)$xml->medication["value"];

                $provider = self::getProviderInfo(['prescribedby' => $providerName]);
                $provider = json_decode($provider, true);
                $providerData = [
                    'suffix' => $provider[0]["getproviderinfoinfo"][0]["Suffix"],
                    'first_name' => $provider[0]["getproviderinfoinfo"][0]["FirstName"],
                    'last_name' => $provider[0]["getproviderinfoinfo"][0]["LastName"],
                    'phone' => $provider[0]["getproviderinfoinfo"][0]["Phone"],
                ];
                unset($medication["getclinicalsummaryinfo"][$num]["XMLDetail"]);

                $medication["getclinicalsummaryinfo"][$num]['sig'] = $sig;
                $medication["getclinicalsummaryinfo"][$num]['medication_name'] = $medicationName;
                $Summary = $medication["getclinicalsummaryinfo"][$num];
                $Summary['provider'] = $providerData;
        }

        return $Summary;



        //@TODO if $medication->status == active{ 4/4
        //call the getProviderInfo to get Doctor's infomation
        //}
    }


    protected static function createMedication(){
        return 'create medication';
    }

    protected static function updateMedication(){
        return 'update medication coming soon';
    }

    protected static function deleteMedication(){
        return 'delete medication coming soon';
    }

    /*
     * Get Dictionary
     */

    public static function getPatientsections(){
        return self::getApiData(self::$TEST, self::$parm);
    }

    public static function getMedicationbytransid(){
        return self::getApiData(self::$TEST2, self::$parm);
    }

    protected static function getApiData($api_parms){
        $fullParm = [
            'AppUserID' => self::$EHRUSERNAME,
            'Appname' => self::$APINAME,
            'Token' => self::getToken()
        ];
        $fullParm = array_merge($fullParm, $api_parms);
        $api_service_credentials = json_encode($fullParm);

        $ch = self::callCurl(self::$APIURL, $api_service_credentials);
        if (($output = curl_exec($ch)) === FALSE) {
            list(, $caller) = debug_backtrace(false, 2);
            $caller = $caller['class'].'@'.$caller['function'].":".__LINE__;
            self::log('EHR connection Error:'.curl_error($ch).' at '.$caller, 'emergency');
            return curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }

    protected static function getToken(){
        $api_service_credentials = json_encode(array('Username' => self::$APIUSERNAME, 'Password' => self::$APIPASSWORD));
        $ch = self::callCurl(self::$APITOKENURL, $api_service_credentials);
        if (($output = curl_exec($ch)) === FALSE) {
            list(, $caller) = debug_backtrace(false, 2);
            $caller = $caller['class'].'@'.$caller['function'].":".__LINE__;
            self::log('EHR connection Error:'.curl_error($ch).' at '.$caller, 'emergency');
        }
        curl_close($ch);
        return $output;
    }

    protected static function callCurl($cUrl, $api_service_credentials,$header=['Content-Type: application/json']){
        $ch = curl_init( );
        curl_setopt($ch, CURLOPT_URL, $cUrl);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_service_credentials);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in seconds
        return $ch;
    }

}
