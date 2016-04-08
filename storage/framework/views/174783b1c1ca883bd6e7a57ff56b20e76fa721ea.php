<?php
phpinfo();
?>
<html>
<head><title>UnityHelloWorld.php</title></head>
<body>

<h1>UnityHelloWorld.php</h1>

<?php

/*******************************************************************************************************
 * NAME:        UnityHelloWorld.php
 *
 * DESCRIPTION: Example PHP code to illustrate basic usage of Unity with Allscripts
 *              TouchWorks/Professional EHR.
 *
 * Unpublished (c) 2016 Allscripts Healthcare Solutions, Inc. and/or its affiliates. All Rights Reserved.
 *
 * This software has been provided pursuant to a License Agreement, with Allscripts Healthcare Solutions,
 * Inc. and/or its affiliates, containing restrictions on its use. This software contains valuable trade
 * secrets and proprietary information of Allscripts Healthcare Solutions, Inc. and/or its affiliates
 * and is protected by trade secret and copyright law. This software may not be copied or distributed
 * in any form or medium, disclosed to any third parties, or used in any manner not provided for in
 * said License Agreement except with prior written authorization from Allscripts Healthcare Solutions,
 * Inc. and/or its affiliates. Notice to U.S. Government Users: This software is "Commercial Computer
 * Software."
 * 
 * This is example code, not meant for production use.
 *******************************************************************************************************/

$url = 'http://tw151ga-azure.unitysandbox.com';

// your Unity appname here
$appname = 'CareTraxx.caretraxx.TestApp';

// your Unity username and password
$svc_username = 'CareT-65d1-caretraxx-test';
$svc_password = 'C@r3tr@xxC2r%tr9xxT%sTepPd51f2';

$ehr_username = 'jmedici';

// change this to desired patient ID
$patientid = '39';

function magic_action($action, $userid, $appname, $patientid, $token, $param1='', $param2='', $param3='', $param4='', $param5='', $param6='', $data='')
{
  global $url;

  // build Magic action JSON string
  $magicjson = json_encode(array('Action' => $action, 'AppUserID' => $userid, 'Appname' => $appname, 'PatientID' => $patientid,
  'Token' => $token,
    'Parameter1' => $param1, 'Parameter2' => $param2, 'Parameter3' => $param3,
    'Parameter4' => $param4, 'Parameter5' => $param5, 'Parameter6' => $param6,
    'Data' => $data));

  // build the cURL session
  $ch = curl_init( );
  curl_setopt($ch, CURLOPT_URL, "http://tw151ga-azure.unitysandbox.com/Unity/unityservice.svc/json/MagicJson");
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $magicjson);

  // post action JSON to MagicJson endpoint, get JSON in return
  if (($out = curl_exec($ch)) === FALSE) {
    die('cURL error: ' . curl_error($ch) . "<br />\n");
  }

  curl_close($ch);

  return $out;
}

// get Unity security token from GetToken endpoint
function get_token($username, $password)
{
  global $url;

  // build {"Username":"un", "Password":"pw"} string
  $json_service_credentials = json_encode(array('Username' => $username, 'Password' => $password));

  // Build the cURL session
  $ch = curl_init( );
  curl_setopt($ch, CURLOPT_URL, "http://tw151ga-azure.unitysandbox.com/Unity/unityservice.svc/json/GetToken");
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_service_credentials);

  // send credentials to GetToken endpoint, get token UUID in return
  if (($unity_token = curl_exec($ch)) === FALSE) {
    die('cURL error: ' . curl_error($ch) . "<br />\n");
  }
  curl_close($ch);

  return $unity_token;

}


// Get Unity security token
$token = get_token($svc_username, $svc_password);


echo "<p><strong>Using Unity token:</strong> " . htmlspecialchars($token) . "</p>";

// Call GetServerInfo Magic action; patient ID, Parameter1-6, and data not used
$getserverinfooutput = magic_action('GetServerInfo', $ehr_username, $appname, '', $token);

echo "<p><strong>Output from GetServerInfo:</strong> <pre>" .
htmlspecialchars(json_encode(json_decode($getserverinfooutput), JSON_PRETTY_PRINT)) . "</pre></p>";

// Call GetPatient Magic action; Parameter1-6 and data not used
$param1 = 'Medications';
$getpatientoutput = magic_action('GetClinicalSummary', $ehr_username, $appname, $patientid, $token, $param1);

echo "<p><strong>Output from GetPatient [" . $patientid . "]:</strong> <pre>" .
htmlspecialchars(json_encode(json_decode($getpatientoutput), JSON_PRETTY_PRINT)) . "</pre></p>";

?>
</body>
</html>
