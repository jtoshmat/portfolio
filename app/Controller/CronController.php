<?php
App::uses('AppController', 'Controller');
define ('Interact2_WSDL','https://ws2.responsys.net/webservices/wsdl/ResponsysWS_Level1.wsdl');
define ('Interact2_EndPoint','https://ws2.responsys.net/webservices/services/ResponsysWSService');
define ('Interact_URI','urn:ws.rsys.com');
ini_set('display_errors', '0');
ini_set("max_execution_time",10000);
/**
 * Users Controller
 *
 * @property User $User
 */
class CronController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('sql_query');
		$this->Auth->allow('send_prospect_email');
		$this->Auth->allow('send_agent_email');
		$this->Auth->allow('update_status');
		$this->Auth->allow('come_from_agent');
		$this->Auth->allow('come_from_facebook');
		$this->Auth->allow('come_from_facebook_agentid');
	}

	public function index(){}

	public $prospect_first_name = "";
	public $prospect_last_name = "";
	public $prospect_email = "";
	public $prospect_agent = "";
	public $prospect_phone = "";
	public $prospect_state = "";
	public $prospect_zip = "";
	public $prospect_id = "";
	public $agent_id = "";
	public $agentname = "";
	public $agent_email_address = "";
	public $status = "";
	public $prospect_name = "";
	public $agent_facebook = "";
	public $pid = "";
	public $agent_first_name = "";
	public $agent_last_name = "";
	public $agent_state = "";
	public $ref = "";
	public $uid = "";
	public $pwd = "";
	public $myFolderName="!MasterData";
	public $myTableName="CONTACTS_LIST";
	public $myCampName="2013_QRFA";
	public $lang = 1;

	//search for incomplete requests
	public function sql_query(){
		//Modified on 1021/2013 by Jon Toshmatov
		App::import('model','DeviceType');
		$rs = new DeviceType();
		$responsys = $rs->find('all', array('conditions'=>array('DeviceType.id'=>4)));
		$this->uid = $responsys[0]['DeviceType']['device_type_name'];
		$this->pwd = $responsys[0]['DeviceType']['description'];
		$this->layout = 'json';
		$mydata = $this->Cron->find('all', array('conditions'=>array('status'=>0,'modified <=' => date('Y-m-d H:i:s', strtotime('-15 minutes')))));
		$prospect=""; $total = 0; $prospect_name = "";
		for ($i=0; $i<count($mydata);$i++){
			$this->prospect_first_name = $mydata[$i]['Cron']['first_name'];
			$this->prospect_last_name = $mydata[$i]['Cron']['last_name'];
			$this->prospect_email = $mydata[$i]['Cron']['email_address'];
			$this->prospect_agent = $mydata[$i]['Cron']['agentname'];
			$this->prospect_phone = $mydata[$i]['Cron']['phone_number'];
			$this->prospect_state = $mydata[$i]['Cron']['state_id'];
			$this->prospect_zip = $mydata[$i]['Cron']['zipcode'];
			$this->prospect_id = $mydata[$i]['Cron']['id'];
			$this->agent_id = $mydata[$i]['Cron']['agentid'];
			$this->agentname = $mydata[$i]['Cron']['agentname'];
			$this->agent_email_address = $mydata[$i]['Cron']['agent_email_address'];
			$this->status = $mydata[$i]['Cron']['status'];
			$this->prospect_name = $this->prospect_first_name ." ".$this->prospect_last_name;
			$this->agent_facebook = $mydata[$i]['Cron']['agent_facebook'];
			$this->agent_first_name = $mydata[$i]['Cron']['agent_first_name'];
			$this->agent_last_name = $mydata[$i]['Cron']['agent_last_name'];
			$this->agent_state = $mydata[$i]['Cron']['agent_state'];
			$this->ref = $mydata[$i]['Cron']['ref'];
			$this->lang = $mydata[$i]['Cron']['device_type_id'];
			$total++;
			if ($total>0){
				$this->pid = "QRF".$this->prospect_id;
				if ($this->ref == 'agent'){
					$from_agent = $this->come_from_agent($this->agent_first_name, $this->agent_last_name,$this->agent_state);
					$data = explode(";", $from_agent);
					$aid = ($data[0]!=0)?$data[0]:$this->agent_id;
					$this->agent_id = sprintf("%06s", $aid);
					$this->pid = "QRF".$this->prospect_id;
					$this->agent_email_address = ($data[1]!='')?$data[1]:$this->agent_email_address;
				}
				if ($this->ref == 'facebook'){
					$data = explode(" ", $this->agentname);
					$this->agent_first_name = $data[0];
					$this->agent_last_name = $data[1];
					$this->pid = "QRF".$this->prospect_id;
				}
				if ($this->lang==2){
/*
					if ($this->agent_id=='' || strlen($this->agent_id)<4){
						$this->myFolderName="!MasterData";
						$this->myTableName="TEST_CONTACTS_LIST";
						$this->myCampName="2013_QRFA_Esp";
						echo "this is amfamlatino.com \n";
					}else{
*/
						$this->myFolderName="!MasterData";
						$this->myTableName="CONTACTS_LIST";
						$this->myCampName="QRFA_Esp";
						echo "this is amfamlatino.com \n";
/*
					}
*/

				} else {
					$this->myFolderName="!MasterData";
					$this->myTableName="CONTACTS_LIST";
					$this->myCampName="2013_QRFA";
					echo "this is qrf.amfam.com \n";
				}
				$save = $this->save_prospect_email();
				$send = $this->send_agent_email(); //09/12/2013 Jon Toshmatov
				$update = $this->update_status();
				echo $this->agent_email_address ." ". $this->agent_id ."<br />";
				echo "Before sleep: ".date('h:i:s') . "<br>";
				sleep(3);
				echo "After sleep: ".date('h:i:s') . "<br>";

			}
		}
		if ($total==0){
 			return "No new abandoned QRF prospect found to send email to. ".date('Y-m-d H:i:s', strtotime('-15 minutes'));
		}else{
			return  "Total of ".$total." email sent successfully.";
		}
	}

	//once email sent out, update their status from 'I' to 'C'
	public function update_status(){
		$this->layout = 'json';
		$this->Cron->recursive = 2;
		$this->Cron->id = $this->prospect_id;
		$this->request->data[0]['Cron']['id'] = $this->prospect_id;
		$this->request->data[0]['Cron']['agentid'] = $this->agent_id;
		$this->request->data[0]['Cron']['status'] = 1;
		if ($this->Cron->saveAll($this->request->data, array('atomic' => 'false'))){
					$this->set('prospects', $this->Cron->id);
				}
				else{
					$return = '';
				}

	}

	//send email to all the prospects
	public function send_agent_email(){
		$this->layout = 'json';
		$messagehtml = "Hello <strong> $this->agentname </strong>! <br />";
		$messagehtml .= "$this->prospect_name has requested a quote through amfam.com. Please review the information provided and follow up as soon as possible.<br />";
		$messagehtml .= "Thanks for your quick attention to this request! <br />";
		$messagehtml .= "<br> ";
		$messagehtml .= "The amfam.com Team.";
		$to = "from_universal@hotmail.com";//change it to Agent email address
		$subject = "Incomplete Quote Request from amfam.com";
		$from = "QUOTE_REQUESTS@amfam.com";
		$headers = 'From: "QRF" <QUOTE_REQUESTS@amfam.com>'."\n";
		$headers = $headers.'Reply-To: "QRF" <QUOTE_REQUESTS@amfam.com>'."\n";
		$headers = $headers.'MIME-Version: 1.0'."\n";
		$headers = $headers.'Content-type: text/html; charset=utf-8'."\r\n";
		mail($to,$subject,$messagehtml,$headers,'-f jtoshmat@amfam.com');
	}

	public function save_prospect_email(){
	$this->layout = 'json';

	//note: If account is in Interact 5, change the host name of the WSDL and EndPoint urls from ws2.responsys.net to ws5.responsys.net

	$client = new SoapClient(Interact2_WSDL,array(
			'location' => Interact2_EndPoint,
			'uri' => Interact_URI,
			'trace' => TRUE,
	));

	$myusername=$this->uid;
	$mypassword=$this->pwd;

	try
	{
		$user=$myusername;
		$pass=$mypassword;

		/* //parameters passed as std class
		 $login_parameters = new StdClass();
		$login_parameters->username = $myusername;
		$login_parameters->password = $mypassword;
		$loginResult = $client->login($login_parameters);
		*/
		//parameters passed as array
		$loginResult = $client->login(array("username"=>"$user", "password"=>"$pass")); //session ID and jsession returned from this call
		//print "<br>Logging In: Success!. <br>";
		//print "<br>The session id is {$loginResult->result->sessionId}<br>";
		//---Set Session header and jsession----
		$sessionId = array('sessionId'=>new SoapVar($loginResult->result->sessionId, XSD_STRING, null, null, null, 'ws.rsys.com'));
		$sessionHeader = new SoapVar($sessionId,SOAP_ENC_OBJECT);
		$header = new SoapHeader('ws.rsys.com', 'SessionHeader', $sessionHeader);  //how you set the sessionID in the header
		$client->__setSoapHeaders(array($header));
		$jsessionID=$client->_cookies["JSESSIONID"][0]; //how you can retrieve the JSESSIONID
		$client->__setCookie("JSESSIONID",$jsessionID); //how you set the cookie to use jsessionID
		//-------------------------------------------
		$myFolderName=$this->myFolderName; //name of folder to merge records
		$myTableName=$this->myTableName;//name of the table/list to merge records
		$reqArgs = new stdClass();
		$reqArgs->list = new stdClass();
		$reqArgs->list->folderName = $myFolderName; //Name of folder the table exists
		$reqArgs->list->objectName = $myTableName;  //Name of table
		$reqArgs->recordData=new stdClass();
		//list of fields to merge
		$reqArgs->recordData->fieldNames = array('CUSTOMER_ID_','FIRST_NAME','LAST_NAME','EMAIL_ADDRESS_','PHONE','ENEWS_LANGUAGE','LEAD_SOURCE','EMAIL_PERMISSION_STATUS_','POSTAL_CODE_','STATE_','QUOTE_LINETYPE','AGENT_ID');
		$fieldValues[]=array("fieldValues"=>array("".$this->pid."","".$this->prospect_first_name."","".$this->prospect_last_name."","".$this->prospect_email."","".$this->prospect_phone."",'E','DBRSVP','I',"".$this->prospect_zip."","".$this->prospect_state."",'AUTO',"".$this->agent_id."")); //records to insert/update
		//$fieldValues[]=array("fieldValues"=>array('5634516893','Jon','Toshmatov','jtoshmat@amfam.com','5634516893','E','DBRSVP','I')); //Jon Toshmatov is testing 6/5/2013
		$reqArgs->recordData->records=new stdClass();
		$reqArgs->recordData->records=$fieldValues;
		//List Merge Rules
		$reqArgs->mergeRule = new stdClass();
		$reqArgs->mergeRule->insertOnNoMatch=True;
		$reqArgs->mergeRule->updateOnMatch='REPLACE_ALL';
		$reqArgs->mergeRule->matchColumnName1='CUSTOMER_ID_';  //column to match
		$reqArgs->mergeRule->matchOperator='NONE';
		$reqArgs->mergeRule->optinValue='I';
		$reqArgs->mergeRule->optoutValue='O';
		$reqArgs->mergeRule->htmlValue='H';
		$reqArgs->mergeRule->textValue='T';
		$reqArgs->mergeRule->rejectRecordIfChannelEmpty='E';
		try {
			$response = $client->mergeListMembers($reqArgs); //mergeListMembers call
			print('<pre>');
			//print retrieve results which are in Standard object. Records can returned can be parsed from it.
			//print_r($response);
			//print('</pre>');
			//return $response;
		}
		catch (SoapFault $err) {
			print "failed!\n";
			//print "MergeListMembers Call Error: ".$err->detail->ListFault->exceptionMessage."\n";
			print "Failed";

		}

		try {
			//print "<br>Logging Out: ";
			$client->logout(array());
			//print "Success!";
			//call the send function Jon Toshmatov 9/4/2013
			$this->send_prospect_email($this->pid);
			print "saved";
			$this->set(compact('output', 'saved'));


		}
		catch (SoapFault $err) {
			//print "failed!";
			//print "Logout Error: $err->faultstring\n";
			print "Failed";
		}
	}
	catch (SoapFault $err) {
		//print "failed!\n";
		//print "Login Error: ".$err->faultString."\n";
		print "Failed";

	}
	}//end of save_prospect_email

	public function send_prospect_email($prospect_id){
	$this->layout = 'json';
	//note: If account is in Interact 5, change the host name of the WSDL and EndPoint urls from ws2.responsys.net to ws5.responsys.net

	$client = new SoapClient(Interact2_WSDL,array(
			'location' => Interact2_EndPoint,
			'uri' => Interact_URI,
			'trace' => TRUE,
	));

	$myusername=$this->uid;
	$mypassword=$this->pwd;

	try
	{
		$user=$myusername;
		$pass=$mypassword;


		$loginResult = $client->login(array("username"=>"$user", "password"=>"$pass")); //session ID and jsession returned from this call

		//print "<br>Logging In: Success!. <br>";
		//print "<br>The session id is {$loginResult->result->sessionId}<br>";

		//---Set Session header and jsession----
		$sessionId = array('sessionId'=>new SoapVar($loginResult->result->sessionId, XSD_STRING, null, null, null, 'ws.rsys.com'));
		$sessionHeader = new SoapVar($sessionId,SOAP_ENC_OBJECT);
		$header = new SoapHeader('ws.rsys.com', 'SessionHeader', $sessionHeader);  //how you set the sessionID in the header
		$client->__setSoapHeaders(array($header));
		$jsessionID=$client->_cookies["JSESSIONID"][0]; //how you can retrieve the JSESSIONID
		$client->__setCookie("JSESSIONID",$jsessionID); //how you set the cookie to use jsessionID

		//-------------------------------------------


		/**************************************************/
		$myFolderName=$this->myFolderName; //name of folder where the campaign exists
		//$myCampName="Test_2013_QRFC"; //name of campaign
		$myCampName=$this->myCampName; //name of campaign 8/9/2013 Jon Toshmatov

		/*************************************************/
		$myFolderName=$this->myFolderName; //name of folder to merge records

		$reqArgs = new stdClass();
		$reqArgs->campaign = new stdClass();
		$reqArgs->campaign->folderName = $myFolderName; //Name of folder the campaign exists
		$reqArgs->campaign->objectName = $this->myCampName;  //Name of campaign
		$reqArgs->recipientData=new stdClass();

		//recipient 1 std class
		$recipient1= new stdClass();
		$recipient1->listName=new stdClass();

		/***************************************************/
		$recipient1->listName->folderName=$this->myFolderName; //name of folder the table/list exists
		$recipient1->listName->objectName=$this->myTableName; //name of the list/table
		$recipient1->customerId="".$prospect_id.""; //email of recipient 1
		/**************************************************/

		//recipient 1 optional data
		$optionalData1=new stdClass();
		$optionalData1->name="";
		$optionalData1->value="";

		$recDataValues[]=array("recipient"=>$recipient1,"optionalData"=>$optionalData1);

		//pass recDataValues array which contains recipient 1,2,3 data into the recipientData parameter.
		$reqArgs->recipientData=$recDataValues;

		//print '<pre>';
		//print_r($reqArgs);
		try {

			$response = $client->triggerCampaignMessage($reqArgs); //triggerCampaignMessage call
			print('<pre>');
			//print retrieve results which are in Standard object. Records can returned can be parsed from it.
			print_r($response);
			//print('</pre>');
			//print $response;
		}

		catch (SoapFault $err) {
			//print "failedn!\n";
			//print '<pre>';
			//print_r($err);
			print "triggerCampaignMessage Call Error: ".$err->faultstring."\n";
			print "Failed";
		}

		try {

			//print "<br>Logging Out: ";
			$client->logout(array());

			print "sent";
			$this->set(compact('output', 'sent'));
			//return "Success";
		}

		catch (SoapFault $err) {
			//print "failedo!";
			print "Logout Error: $err->faultstring\n";
			return "Failed";
		}
	}
	catch (SoapFault $err) {
		//print "failedp!\n";
		print "Login Error: ".$err->faultString."\n";
		print "Failed";
	}
	}

	//Get Agent information if prospect comes from facebook
	public function come_from_agent($agent_first_name, $agent_last_name,$agent_state){
		//return '012983';//agent site
		$this->layout = 'json';
		$data = "http://mobileapps.amfam.com/amfammobilesrv/findagent";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://mobileapps.amfam.com/amfammobilesrv/findagent");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		"deviceId=agtloc&version=v1&results=1&searchType=locateByName&firstName=".$agent_first_name."&lastName=".$agent_last_name."&state=".$agent_state);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$xml = simplexml_load_string($result);
		$json = json_encode($xml);
		$agent_data=json_decode($json,true);
		if (isset($agent_data)){
		return $agent_data['agents']['agent']['agentId'].";".$agent_data['agents']['agent']['email'];
		}
		curl_close ($ch);
	}
	//Get Agent information if prospect comes from facebook
	public function come_from_facebook(){
		return '999999';
	}
	//Get agentId from amfam
	public function come_from_facebook_agentid(){
		return '999999';
	}

}//end of main class
