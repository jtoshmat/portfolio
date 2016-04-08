<?php

namespace app\Http\Controllers;

use app\Services\AdapterLog;
use Illuminate\Http\Request;

use app\Http\Requests;

class TestController extends ApiResponseController
{
    public function patientsections(Request $request){
        $request->request->add(['function'=>__FUNCTION__]);
        $output = $this->processRequest($request);
        foreach($output as $num=>$data){
            $data2 = $data["getpatientsectionsinfo"];
            foreach($data2 as $num2=>$data3){
                $transid = (integer) preg_replace( '/[^0-9]/', '', $data3["Transid"] ); //17312400001
                //echo $data3["Transid"]."\n";
                //echo $transid."\n";
                $request->request->add(['transid'=>$transid]);
                $output2 = $this->medicationbytransid($request);
                //var_dump($output2);
            }
        }
        return $output;
    }

    public function medicationbytransid(Request $request){
        $request->request->add(['function'=>__FUNCTION__]);
        $request->request->add([
            0 => ['transid'=>$request->get('transid')]
        ]
        );
        $output = $this->processRequest($request);
        return $output;
    }


    public function cron(){
        $message = 'Cron job has been executed at '. date('Y-m-d h:m:s');
        AdapterLog::log($message);
        return $message;

    }
}

/*
 * Alternate method to retrieve patient meds:

(1)  call GetPatientSections (patientID, parm1=12, parm2=‘Medications’)
(returns)
list of meds containing transid for each med

(2) foreach row from above
{
call GetMedicationByTransID(parm1 = $transid)
return drugname, SIG, quantity, refills, ExpectedAction, ResponsibleProviderID, ResponsibleProvider)
}
 */