<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class EmailController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('save');
		$this->Auth->allow('send');
		$this->Auth->allow('send_to_agent');


	}

	public $uid = "";
	public $pwd = "";

	public function send_to_agent(){
		$this->layout = 'json';

			//Modified on 1021/2013 by Jon Toshmatov
			App::import('model','DeviceType');
			$rs = new DeviceType();
			$responsys = $rs->find('all', array('conditions'=>array('DeviceType.id'=>4)));
			$this->uid = $responsys[0]['DeviceType']['device_type_name'];
			$this->pwd = $responsys[0]['DeviceType']['description'];

		$prospect_first_name = $this->request->data['prospect_first_name'];
		$prospect_last_name = $this->request->data['prospect_last_name'];
		$memberemail = $this->request->data['prospect_email'];
		$prospect_agent = $this->request->data['prospect_agent'];
		$responses = $this->request->data['responses'];
		$prospect_phone = $this->request->data['prospect_phone'];
		$prospect_state = $this->request->data['prospect_state'];
		$prospect_zip = $this->request->data['prospect_zip'];
		$prospect_id = $this->request->data['pid'];
		$agent_name = $this->request->data['prospect_agent'];

		$prospect_name = $prospect_first_name ." ". $prospect_last_name;


		$from = "jtoshmat@amfam.com";
		$to = "jtoshmat@amfam.com";
		//$Bcc = "<jtoshmat@amfam.com>";
		$subject = "Quote Request from amfam.com";




		$messagehtml = "Hello <strong> $agent_name </strong>! <br />";
		$messagehtml .= "$prospect_name has requested a quote through amfam.com. Please review the information provided and follow up as soon as possible.<br />";
		$messagehtml .= "$responses <br />";
		$messagehtml .= "Thanks for your quick attention to this request! <br />";
		$messagehtml .= "<br> ";
		$messagehtml .= "The amfam.com Team.";


		//localhost
		if ($_SERVER["SERVER_NAME"]=='localhost'){
		//removed by Jon Toshmatov on 10/21/2013
	}else{//end of if localhost
		// Always set content-type when sending HTML email
		//$to = "jon@toshmatov.us"; // Update the agents email from form
		//$headers = "MIME-Version: 1.0" . "\r\n";
		//$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		/*
		 *

		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset: utf8\r\n";
		// More headers
		$headers .= 'From: <gtarnoff@amfam.com>' . "\r\n";
		$headers .= 'Cc: jtoshmat@amfam.com' . "\r\n";
		mail($to,$subject,$body,$headers);
		*/

		$to = "jtoshmat@amfam.com,ikumar@amfam.com";//change it to Agent email address
		$subject = "Quote Request from amfam.com";
		$from = "QUOTE_REQUESTS@amfam.com";
		$headers = 'From: "QRF" <QUOTE_REQUESTS@amfam.com>'."\n";
		$headers = $headers.'Reply-To: "QRF" <QUOTE_REQUESTS@amfam.com>'."\n";
		$headers = $headers.'MIME-Version: 1.0'."\n";
		$headers = $headers.'Content-type: text/html; charset=utf-8'."\r\n";
		mail($to,$subject,$messagehtml,$headers,'-f jtoshmat@amfam.com');




		}//end of else server==af1dev

	}

	public function save() {
	$this->layout = 'json';
	$prospect_first_name = $this->request->data['prospect_first_name'];
	$prospect_last_name = $this->request->data['prospect_last_name'];
	$memberemail = $this->request->data['prospect_email'];
	$prospect_agent = $this->request->data['prospect_agent'];
	$responses = $this->request->data['responses'];
	$prospect_phone = $this->request->data['prospect_phone'];
	$prospect_state = $this->request->data['prospect_state'];
	$prospect_zip = $this->request->data['prospect_zip'];
	$prospect_id = $this->request->data['pid'];
	$agent_id = $this->request->data['agent_id'];

	define ('Interact2_WSDL','https://ws2.responsys.net/webservices/wsdl/ResponsysWS_Level1.wsdl');
	define ('Interact2_EndPoint','https://ws2.responsys.net/webservices/services/ResponsysWSService');
	define ('Interact_URI','urn:ws.rsys.com');
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
		$myFolderName="Z_Development"; //name of folder to merge records
		$myTableName="TEST_CONTACTS_LIST"; //name of the table/list to merge records
		$reqArgs = new stdClass();
		$reqArgs->list = new stdClass();
		$reqArgs->list->folderName = $myFolderName; //Name of folder the table exists
		$reqArgs->list->objectName = $myTableName;  //Name of table
		$reqArgs->recordData=new stdClass();
		//list of fields to merge
		$reqArgs->recordData->fieldNames = array('CUSTOMER_ID_','FIRST_NAME','LAST_NAME','EMAIL_ADDRESS_','PHONE','ENEWS_LANGUAGE','LEAD_SOURCE','EMAIL_PERMISSION_STATUS_','POSTAL_CODE_','STATE_','QUOTE_LINETYPE','AGENT_ID');
		$fieldValues[]=array("fieldValues"=>array("".$prospect_id."","".$prospect_first_name."","".$prospect_last_name."","".$memberemail."","".$prospect_phone."",'E','DBRSVP','I',"".$prospect_zip."","".$prospect_state."",'AUTO,BUSINESS',"0".$agent_id."")); //records to insert/update
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
			//print('<pre>');
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
}//end of save

public function send() {
	$this->layout = 'json';
	/*
	$membername = isset($_POST["membername"])?$_POST["membername"]:'';
	$prospect_id = isset($_POST["eventid"])?$_POST["eventid"]:'';
	$memberemail = isset($_POST["memberemail"])?$_POST["memberemail"]:'';
	*/
	$prospect_first_name = $this->request->data['prospect_first_name'];
	$prospect_last_name = $this->request->data['prospect_last_name'];
	$memberemail = $this->request->data['prospect_email'];
	$prospect_agent = $this->request->data['prospect_agent'];
	$responses = $this->request->data['responses'];
	$prospect_phone = $this->request->data['prospect_phone'];
	$prospect_state = $this->request->data['prospect_state'];
	$prospect_zip = $this->request->data['prospect_zip'];
	$prospect_id = $this->request->data['pid'];
	$agent_id = $this->request->data['agent_id'];
	$this->request->data['responses'] = preg_replace('/†/', '', $this->request->data['responses']);
	$this->send_to_agent();
	define ('Interact2_WSDL','https://ws2.responsys.net/webservices/wsdl/ResponsysWS_Level1.wsdl');
	define ('Interact2_EndPoint','https://ws2.responsys.net/webservices/services/ResponsysWSService');
	define ('Interact_URI','urn:ws.rsys.com');
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
		$myFolderName="z_Development"; //name of folder where the campaign exists
		//$myCampName="Test_2013_QRFA"; //name of campaign
		$myCampName="Test_2013_QRFC"; //name of campaign 8/9/2013 Jon Toshmatov

		/*************************************************/
		$myFolderName="Z_Development"; //name of folder to merge records

		$reqArgs = new stdClass();
		$reqArgs->campaign = new stdClass();
		$reqArgs->campaign->folderName = $myFolderName; //Name of folder the campaign exists
		$reqArgs->campaign->objectName = $myCampName;  //Name of campaign
		$reqArgs->recipientData=new stdClass();

		//recipient 1 std class
		$recipient1= new stdClass();
		$recipient1->listName=new stdClass();

		/***************************************************/
		$recipient1->listName->folderName='z_Development'; //name of folder the table/list exists
		$recipient1->listName->objectName='TEST_CONTACTS_LIST'; //name of the list/table
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
			//print('<pre>');
			//print retrieve results which are in Standard object. Records can returned can be parsed from it.
			//print_r($response);
			//print('</pre>');
			//print $response;
		}

		catch (SoapFault $err) {
			//print "failedn!\n";
			//print '<pre>';
			//print_r($err);
			//print "triggerCampaignMessage Call Error: ".$err->faultstring."\n";
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
			//print "Logout Error: $err->faultstring\n";
			return "Failed";
		}
	}
	catch (SoapFault $err) {
		//print "failedp!\n";
		//print "Login Error: ".$err->faultString."\n";
		print "Failed";
	}




}//end of send





}//end of main class
