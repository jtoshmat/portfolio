<?php
App::uses('AppController', 'Controller');
define ('Interact2_WSDL','https://ws2.responsys.net/webservices/wsdl/ResponsysWS_Level1.wsdl');
define ('Interact2_EndPoint','https://ws2.responsys.net/webservices/services/ResponsysWSService');
define ('Interact_URI','urn:ws.rsys.com');
ini_set('display_errors', '0');
ini_set("max_execution_time",45 );
/**
 * Users Controller
 *
 * @property User $User
 */
class EmailliveController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('initemail');
		$this->Auth->allow('getquestions');
		$this->Auth->allow('getproduct');

	}

	public $prospect_first_name = "";
	public $prospect_last_name = "";
	public $prospect_name = "";
	public $memberemail = "";
	public $prospect_agent = "";
	public $responses = "";
	public $prospect_phone = "";
	public $prospect_state = "";
	public $prospect_zip = "";
	public $prospect_id = "";
	public $agentid = "";
	public $agent_name = "";
	public $prospect_address = "";
	public $prospect_address2 = "";
	public $prospect_city = "";
	public $prospect_email = "";
	public $prospect_lang = 1;
	public $callme = 0;
	public $bestimetocall = "";
	public $agent_facebook = 0;
	public $html = "";
	public $uid = "";
	public $pwd = "";
	public $myFolderName="!MasterData";
	public $myTableName="CONTACTS_LIST";
	public $myCampName="2013_QRFC";



	public function initemail(){
		$this->layout = 'json';
		//Modified on 1021/2013 by Jon Toshmatov
		App::import('model','DeviceType');
		$rs = new DeviceType();
		$responsys = $rs->find('all', array('conditions'=>array('DeviceType.id'=>4)));
		$this->uid = $responsys[0]['DeviceType']['device_type_name'];
		$this->pwd = $responsys[0]['DeviceType']['description'];

		$pid = $this->request->data['prospect_id'];
		$this->html .="<br /><br/>Reference Number: <i>QRF".$pid."</i><br />";

		if ($pid=='' || $pid==null){return false;}

		$prospect = $this->Emaillive->find('all', array(
				'conditions'=>array('Emaillive.id'=>$pid),
				'limit' => 1
				));
		$i=0;
		$this->prospect_first_name =  $prospect[$i]['Emaillive']['first_name'];
		$this->prospect_last_name = $prospect[$i]['Emaillive']['last_name'];
		$this->memberemail = $prospect[$i]['Emaillive']['email_address'];
		$this->prospect_agent = $prospect[$i]['Emaillive']['agentid'];
		$this->prospect_phone = $prospect[$i]['Emaillive']['phone_number'];
		$this->prospect_state = $prospect[$i]['Emaillive']['state_id'];
		$this->prospect_zip = $prospect[$i]['Emaillive']['zipcode'];
		$this->prospect_id = $prospect[$i]['Emaillive']['id'];
		$this->agent_name = $prospect[$i]['Emaillive']['agentname'];
		$this->agentid = $prospect[$i]['Emaillive']['agentid'];
		$this->prospect_address = $prospect[$i]['Emaillive']['address'];
		$this->prospect_address2 = $prospect[$i]['Emaillive']['address2'];
		$this->prospect_city = $prospect[$i]['Emaillive']['city'];
		$this->prospect_lang = $prospect[$i]['Emaillive']['language_id'];
		$this->prospect_name = $this->prospect_first_name ." ". $this->prospect_last_name;
		$this->bestimetocall = $prospect[$i]['Emaillive']['bestimetocall'];
		$this->callme = $prospect[$i]['Emaillive']['callme'];
		$this->agent_facebook = $prospect[$i]['Emaillive']['agent_facebook'];

      //Localhost campaign test
/*
                if (strpos($_SERVER['SERVER_NAME'],'localhost')>=0){
            			$this->myFolderName="!MasterData";
                		$this->myTableName="CONTACTS_LIST";
                		$this->myCampName="2013_QRFC";
                        echo "this is localhost \n";

                }
                //Af1dev campaign test
                else if (strpos($_SERVER['SERVER_NAME'],'af1dev.com')>=0){
            			$this->myFolderName="!MasterData";
                		$this->myTableName="CONTACTS_LIST";
                		$this->myCampName="2013_QRFC";
                        echo "this is af1dev \n";
                }
                //qrf.amfam.com campaign test
                else if (strpos($_SERVER['SERVER_NAME'],'amfam.com')>=0){
                		$this->myFolderName="!MasterData";
                		$this->myTableName="CONTACTS_LIST";
                		$this->myCampName="2013_QRFC";
                		echo "this is qrf.amfam.com \n";

                }
                //latino
                else if (strpos($_SERVER['HTTP_VIA'],'amfamlatino.com')>=0){
                		$this->myFolderName="!MasterData";
                		$this->myTableName="TEST_CONTACTS_LIST";
                		$this->myCampName="Test_2013_QRFC_Esp";
                		echo "this is amfamlatino.com \n";

                }

                echo "myCampName: ".$this->myCampName."| http_via: ".$_SERVER['HTTP_VIA']."| server name: ".$_SERVER['SERVER_NAME'];
*/
                if (isset($_SERVER['HTTP_X_LANGUAGE']) && isset($_SERVER['HTTP_X_FORWARDED_HOST'])){
                		$this->myFolderName="!MasterData";
                		$this->myTableName="TEST_CONTACTS_LIST";
                		$this->myCampName="Test_2013_QRFC_Esp";
                		echo "this is amfamlatino.com \n";

                } else {
                		$this->myFolderName="!MasterData";
                		$this->myTableName="CONTACTS_LIST";
                		$this->myCampName="2013_QRFC";
                		echo "this is qrf.amfam.com \n";				
				}

		$this->getquestions();
	}

	//get
	public function getquestions(){
		$this->layout = 'json';
		$this->Emaillive->recursive = -1;
		App::import('model','Emailprospectresponse');
		$qs = new Emailprospectresponse();

		$this->html .= "Prospect Name: ".$this->prospect_name."<br />";
		$this->html .= "Address: ".$this->prospect_address."<br />";
		if ($this->prospect_address2!=''){
			$this->html .= "Address 2: ".$this->prospect_address2."<br />";
		}
		$this->html .= "City: ".$this->prospect_city."<br />";
		if ($this->prospect_state!=0){
		$this->html .= "State: ".$this->getstate($this->prospect_state)."<br />";
		}
		$this->html .= "ZIP Code: ".$this->prospect_zip."<br />";
		$this->html .= "Phone: ".$this->prospect_phone."<br />";
		if ($this->callme==1){
			$this->html .= "Call Me: Yes <br />";
			if ($this->bestimetocall!=''){
				$this->html .= "Best time to call: ".$this->bestimetocall."<br />";
			}
		}
		$this->html .= "E-mail: ".$this->memberemail."<br />";
		$lang = ($this->prospect_lang==1)?"English":"Spanish";
		$this->html .= "Language: ".$lang."<br />";
		$questions = $qs->find('all', array(
				'conditions'=>array('prospect_id'=>$this->prospect_id),
				//'fields' => array('question_id','prospect_id','id','response_value','question_text'),
				'order' => array('product_id ASC'),
				));
		$temp = "";
		$html = "";
		for ($i=0; $i<count($questions);$i++){
				$qid = $questions[$i]['Question']['id'];
				$prod = $this->getproduct($qid);
				if ($temp ==""){
					$this->html .= "<br />".$prod . "<br />";
					$temp = $prod;
				}else{
					if ($temp!=$prod){
						$this->html .= "<br />".$prod . "<br />";
						$temp = $prod;
					}
				}
				$response_value = nl2br(h($questions[$i]['Emailprospectresponse']['response_value']));
				$response_value = str_replace("\\n", "<br />", $response_value);
				$this->html .= "".$questions[$i]['Question']['question_text'].": " .$response_value."<br />";
		}
		$this->html .= "<hr />";
		//Sending Email
		$this->html = nl2br($this->html);
		$this->save();
		$this->send();
	}
	//get product name
	public function getproduct($qid){
		$this->layout = 'json';
		$this->Emaillive->recursive = -1;
		App::import('model','Emailproduct');
		$ps = new Emailproduct();
		$product = $ps->find('all', array(
				'conditions'=>array('Emailproduct.id'=>$qid),
				//'fields' => array('Product.long_name','Product.id'),
				'limit' => 1
		));
		return $product[0]['Product']['long_name'];

	}

	//get State
	public function getstate($sid){
		$this->layout = 'json';
		if ($sid==0){return false;}
		$this->Emaillive->recursive = -1;
		App::import('model','State');
		$st = new State();
		$state = $st->find('all', array(
				'conditions'=>array('State.id'=>$sid,'footprint'=>1),
				'fields' => array('id','abbreviation'),
				'limit' => 1
		));

			return $state[0]['State']['abbreviation'];

	}

	public function send_to_agent(){
		$this->layout = 'json';
		$from = "jtoshmat@amfam.com";
		$to = "jtoshmat@amfam.com";
		//$Bcc = "<jtoshmat@amfam.com>";
		$subject = "Quote Request from amfam.com";




		$messagehtml = "Hello  ".$this->agent_name.", <br />";
		$messagehtml .= "".$this->prospect_name." has completed a Quote Request Form on amfam.com and selected you as their agent.<br /> Please review the information the prospect provided below and follow up with them as soon as possible.<br />";
		$messagehtml .= "".$this->html." <br />";
		$messagehtml .= "Thanks for your quick attention to this request! <br />";
		$messagehtml .= "<br /> ";
		$messagehtml .= "The Amfam.com Team.";


		//localhost
		if ($_SERVER["SERVER_NAME"]=='localhost'){
		echo "Jon Toshmatov removed mail function for test on 10/17/2013 at 10:30 AM";
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

			$to = "ikumar@amfam.com,from_universal@hotmail.com";//change it to Agent email address
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
			$myFolderName= $this->myFolderName; //name of folder to merge records
			$myTableName=$this->myTableName; //name of the table/list to merge records
			$reqArgs = new stdClass();
			$reqArgs->list = new stdClass();
			$reqArgs->list->folderName = $myFolderName; //Name of folder the table exists
			$reqArgs->list->objectName = $myTableName;  //Name of table
			$reqArgs->recordData=new stdClass();
			//list of fields to merge
			$reqArgs->recordData->fieldNames = array('CUSTOMER_ID_','FIRST_NAME','LAST_NAME','EMAIL_ADDRESS_','PHONE','ENEWS_LANGUAGE','LEAD_SOURCE','EMAIL_PERMISSION_STATUS_','POSTAL_CODE_','STATE_','QUOTE_LINETYPE','AGENT_ID');
			$fieldValues[]=array("fieldValues"=>array("QRF".$this->prospect_id."","".$this->prospect_first_name."","".$this->prospect_last_name."","".$this->memberemail."","".$this->prospect_phone."",'E','DBRSVP','I',"".$this->prospect_zip."","".$this->prospect_state."",'AUTO,BUSINESS',"".$this->agentid."")); //records to insert/update
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
				print('</pre>');
				return $response;
			}
			catch (SoapFault $err) {
				print "failed!\n";
				print "MergeListMembers Call Error: ".$err->detail->ListFault->exceptionMessage."\n".__LINE__;;
				print "Failed";

			}

			try {
				//print "<br>Logging Out: ";
				$client->logout(array());
				//print "Success!";

				print "Responsys is saved  ";
				$this->set(compact('output', 'saved')).__LINE__;;


			}
			catch (SoapFault $err) {
				//print "failed!";
				print "Logout Error: $err->faultstring\n".__LINE__;;
				print "Failed";
			}
		}
		catch (SoapFault $err) {
			//print "failed!\n";
			print "Login Error: ".$err->faultString."\n".__LINE__;;
			print "Failed";

		}
	}//end of save

	public function send() {
		$this->layout = 'json';
		$this->send_to_agent();

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
			//$myCampName="Test_2013_QRFA"; //name of campaign
			$myCampName=$this->myCampName; //name of campaign 8/9/2013 Jon Toshmatov

			/*************************************************/
			$myFolderName=$this->myFolderName; //name of folder to merge records

			$reqArgs = new stdClass();
			$reqArgs->campaign = new stdClass();
			$reqArgs->campaign->folderName = $myFolderName; //Name of folder the campaign exists
			$reqArgs->campaign->objectName = $myCampName;  //Name of campaign
			$reqArgs->recipientData=new stdClass();

			//recipient 1 std class
			$recipient1= new stdClass();
			$recipient1->listName=new stdClass();

			/***************************************************/
			$recipient1->listName->folderName=$this->myFolderName; //name of folder the table/list exists
			$recipient1->listName->objectName=$this->myTableName; //name of the list/table
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
				print('<pre>');
				//print retrieve results which are in Standard object. Records can returned can be parsed from it.
				print_r($response).__LINE__;;
				print('</pre>');
				print $response;
			}

			catch (SoapFault $err) {
				//print "failedn!\n";
				print '<pre>';
				print_r($err);
				print "triggerCampaignMessage Call Error: ".$err->faultstring."\n".__LINE__;;
				print "Failed";
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
				print "Logout Error: $err->faultstring\n  ".__LINE__;
				return "Failed";
			}
		}
		catch (SoapFault $err) {
			//print "failedp!\n";
			print "Login Error: ".$err->faultString."\n".__LINE__;;
			print "Failed";
		}




	}//end of send





}//end of main class



