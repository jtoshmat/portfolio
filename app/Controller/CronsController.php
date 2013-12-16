<?php
App::uses('AppController', 'Controller');
/**
 * Crons Controller
 *
 * @property Cron $Cron
 * @property PaginatorComponent $Paginator
 */
class CronsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');

	}
	public $prospect_first_name = "Jon";
	public $prospect_last_name = "Tosh";
	public $prospect_name = "Jon Test";
	public $memberemail = "jontoshmatov@yahoo.com";
	public $prospect_agent = "Doug Agent";
	public $responses = null;
	public $prospect_phone = "5634516893";
	public $prospect_state = "IA";
	public $prospect_zip = "52001";
	public $prospect_id = "";
	public $agentid = null;
	public $agent_name = "Doug B";
	public $prospect_address = "200 Main Street";
	public $prospect_address2 = "";
	public $prospect_city = "Dubuque";
	public $prospect_email = "jontoshmatov@yahoo.com";
	public $prospect_lang = 1;
	public $callme = 0;
	public $bestimetocall = "";
	public $agent_facebook = 0;
	public $html = [];
	public $uid = "";
	public $pwd = "";

	public function index() {
		$this->Cron->recursive = 0;
		$this->sql_query();
	}

	public function sql_query(){
		$this->Cron->recursive = 0;
		App::import('model','SiteSetting');
		$rs = new SiteSetting();
		$settings= $rs->find('first', array('conditions'=>array('SiteSetting.id'=>1)));
		$cred = explode(";",$settings['SiteSetting']['value1']);
		$this->uid = $cred[0];
		$this->pwd = $cred[1];
		$mydata = $this->Cron->find('all');
		$pid = [];
		foreach ($mydata as $emails){
			if (!in_array($emails['Cron']['id'], $pid)) {
				$pid[] =  $emails['Cron']['id'];
			}
		}
		foreach ($pid as $id){
			if (is_numeric($id)==false){return false;}
			$this->build_html($id);//get prospect ids and build html
		}

	}
	public function build_html($id){
			$emails = $this->Cron->find('all', array('conditions'=>array('Cron.id'=>$id)));
			unset($this->html);
			for ($i=0;$i<count($emails);$i++){
				$id = $emails[$i]['Cron']['id'];
				$this->prospect_name = $emails[$i]['Cron']['first_name'];
	 			$this->agent_name = $emails[$i]['Cron']['agent'];
	 			$this->prospect_first_name = $emails[$i]['Cron']['first_name'];
	 			$this->prospect_last_name = $emails[$i]['Cron']['last_name'];
	 			$this->memberemail = $emails[$i]['Cron']['email'];
	 			$this->prospect_phone = $emails[$i]['Cron']['phone'];
	 			$this->prospect_zip = $emails[$i]['Cron']['zip_code'];
	 			$this->prospect_state = $emails[$i]['Cron']['state_id'];
	 			$this->agentid = $emails[$i]['Cron']['agent'];
				$this->html .= $emails[$i]['Cron']['question']."<br />";

			}
			$this->format_email_html();
		}
		public function format_email_html(){
			echo "formating";
		}
		public function prepare_email(){
			echo $this->memberemail;
			echo "<br />";
			echo $this->html;
			echo "<br />";
		}


}