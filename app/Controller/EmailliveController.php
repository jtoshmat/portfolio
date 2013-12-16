<?php
App::uses('AppController', 'Controller');
define ('Interact2_WSDL','https://ws2.responsys.net/webservices/wsdl/ResponsysWS_Level1.wsdl');
define ('Interact2_EndPoint','https://ws2.responsys.net/webservices/services/ResponsysWSService');
define ('Interact_URI','urn:ws.rsys.com');
ini_set('display_errors', '0');
ini_set("max_execution_time",45 );

/**
 * Widgets Controller
 *
 * @property Widget $Widget
 * @property PaginatorComponent $Paginator
 */
class EmailliveController extends AppController {

	public $prospect_first_name = "Jon";
	public $prospect_last_name = "Tosh";
	public $prospect_name = "Jon Test";
	public $memberemail = "jontoshmatov@yahoo.com";
	public $prospect_agent = "Doug Agent";
	public $responses = "";
	public $prospect_phone = "5634516893";
	public $prospect_state = "IA";
	public $prospect_zip = "52001";
	public $prospect_id = "";
	public $agentid = "";
	public $agent_name = "Doug B";
	public $prospect_address = "200 Main Street";
	public $prospect_address2 = "";
	public $prospect_city = "Dubuque";
	public $prospect_email = "jontoshmatov@yahoo.com";
	public $prospect_lang = 1;
	public $callme = 0;
	public $bestimetocall = "";
	public $agent_facebook = 0;
	public $html = "";
	public $uid = "";
	public $pwd = "";


	public function index() {

		if (!$this->request->is('post') && !$this->request->is('put')) {
			exit;return false;
		}
		$id = (isset($this->request->pass[0]))?$this->request->pass[0]:null;
		$id = (($this->request->pass[0]!=''))?$this->request->pass[0]:null;
		if ($id==''){exit; return false;}

		App::import('model','ProspectResponse');
		$ps = new ProspectResponse();

		$options = array(
				'conditions' => array('prospect_id' => $id), //array of conditions
		);
		$p = $ps->find('first',$options);

		$this->prospect_id = 1;

		 $this->initemail();
		return false;
	}

		public function initemail(){

			//Modified on 1021/2013 by Jon Toshmatov
			App::import('model','SiteSetting');
			$rs = new SiteSetting();
			$settings= $rs->find('first', array('conditions'=>array('SiteSetting.id'=>1)));
			$cred = explode(";",$settings['SiteSetting']['value1']);
			$this->uid = $cred[0];
			$this->pwd = $cred[1];
			$pid = 5634516893;
			$this->html .="<br /><br/>Reference Number: <i>CNA".$pid."</i><br />";
			//$this->send_to_agent();
			$this->save();
			$this->send();
			}


		public function send_to_agent(){
			$from = "jtoshmat@amfam.com";
			$to = "jtoshmat@amfam.com";
			//$Bcc = "<jtoshmat@amfam.com>";
			$subject = "CNA Request from amfam.com";
			$messagehtml = "Hello  ".$this->agent_name.", <br />";
			$messagehtml .= "".$this->prospect_name." has completed a Quote Request Form on amfam.com and selected you as their agent.<br /> Please review the information the prospect provided below and follow up with them as soon as possible.<br />";
			$messagehtml .= "".$this->html." <br />";
			$messagehtml .= "Thanks for your quick attention to this request! <br />";
			$messagehtml .= "<br> ";
			$messagehtml .= "The Amfam.com Team.";
			$to = "jtoshmat@amfam.com,ikumar@amfam.com";//change it to Agent email address
			$subject = "Quote Request from amfam.com";
			$from = "QUOTE_REQUESTS@amfam.com";
			$headers = 'From: "QRF" <QUOTE_REQUESTS@amfam.com>'."\n";
			$headers = $headers.'Reply-To: "QRF" <QUOTE_REQUESTS@amfam.com>'."\n";
			$headers = $headers.'MIME-Version: 1.0'."\n";
			$headers = $headers.'Content-type: text/html; charset=utf-8'."\r\n";
			mail($to,$subject,$messagehtml,$headers,'-f jtoshmat@amfam.com');
		}

		public function save() {
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
				$myFolderName="!MasterData"; //name of folder to merge records
				$myTableName="CONTACTS_LIST"; //name of the table/list to merge records
				$reqArgs = new stdClass();
				$reqArgs->list = new stdClass();
				$reqArgs->list->folderName = $myFolderName; //Name of folder the table exists
				$reqArgs->list->objectName = $myTableName;  //Name of table
				$reqArgs->recordData=new stdClass();
				//list of fields to merge
				$reqArgs->recordData->fieldNames = array('CUSTOMER_ID_','FIRST_NAME','LAST_NAME','EMAIL_ADDRESS_','PHONE','ENEWS_LANGUAGE','LEAD_SOURCE','EMAIL_PERMISSION_STATUS_','POSTAL_CODE_','STATE_','QUOTE_LINETYPE','AGENT_ID');
				//$fieldValues[]=array("fieldValues"=>array("QRF".$this->prospect_id."","".$this->prospect_first_name."","".$this->prospect_last_name."","".$this->memberemail."","".$this->prospect_phone."",'E','DBRSVP','I',"".$this->prospect_zip."","".$this->prospect_state."",'AUTO,BUSINESS',"".$this->agentid."")); //records to insert/update
				$fieldValues[]=array("fieldValues"=>array('5634516893','Jon','Toshmatov','jtoshmat@amfam.com','5634516893','E','DBRSVP','I')); //Jon Toshmatov is testing 6/5/2013
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
					print('</pre>');
					return $response;
				}
				catch (SoapFault $err) {
					print "failed!\n";
					print "MergeListMembers Call Error: ".$err->detail->ListFault->exceptionMessage."\n";
					print "Failed";

				}

				try {
					//print "<br>Logging Out: ";
					$client->logout(array());
					print "Success!";

					print "Responsys is saved  ";
					$this->set(compact('output', 'saved'));


				}
				catch (SoapFault $err) {
					//print "failed!";
					print "Logout Error: $err->faultstring\n";
					print "Failed";
				}
			}
			catch (SoapFault $err) {
				//print "failed!\n";
				print "Login Error: ".$err->faultString."\n";
				print "Failed";

			}


		}//end of save

		public function send() {
			//$this->send_to_agent();

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
				$myFolderName="!MasterData"; //name of folder where the campaign exists
				//$myCampName="Test_2013_QRFA"; //name of campaign
				$myCampName="2013_QRFC"; //name of campaign 8/9/2013 Jon Toshmatov

				/*************************************************/
				$myFolderName="!MasterData"; //name of folder to merge records

				$reqArgs = new stdClass();
				$reqArgs->campaign = new stdClass();
				$reqArgs->campaign->folderName = $myFolderName; //Name of folder the campaign exists
				$reqArgs->campaign->objectName = $myCampName;  //Name of campaign
				$reqArgs->recipientData=new stdClass();

				//recipient 1 std class
				$recipient1= new stdClass();
				$recipient1->listName=new stdClass();

				/***************************************************/
				$recipient1->listName->folderName='!MasterData'; //name of folder the table/list exists
				$recipient1->listName->objectName='CONTACTS_LIST'; //name of the list/table
				$recipient1->customerId="QRF".$this->prospect_id.""; //email of recipient 1
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
					//print "Failed";
				}

				try {

					//print "<br>Logging Out: ";
					$client->logout(array());
					print "| Responsys is sent ";
					$this->set(compact('output', 'sent'));
					//return "Success";
				}

				catch (SoapFault $err) {
					//print "failedo!";
					//print "Logout Error: $err->faultstring\n";
					//return "Failed";
				}
			}
			catch (SoapFault $err) {
				//print "failedp!\n";
				//print "Login Error: ".$err->faultString."\n";
				//print "Failed";
			}
		}//end of send

}//end of Emaillive controller
