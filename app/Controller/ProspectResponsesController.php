<?php
App::uses('AppController', 'Controller');
/**
 * ProspectResponses Controller
 *
 * @property ProspectResponse $ProspectResponse
 */
class ProspectResponsesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('createResponse');
	    $this->Auth->allow('saveResponse');
	    $this->Auth->allow('process');
	    $this->Auth->allow('processbyname');
	    $this->Auth->allow('buildemail');
	    $this->Auth->allow('submitomniture');
	    $this->Auth->allow('getfacebookagent');
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}


	public function index() {
		$this->ProspectResponse->recursive = 0;
		$this->set('prospectResponses', $this->paginate());

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ProspectResponse->id = $id;
		if (!$this->ProspectResponse->exists()) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		$this->set('prospectResponse', $this->ProspectResponse->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProspectResponse->create();

			if ($this->ProspectResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect response could not be saved. Please, try again.'));
			}
		}
		$prospects = $this->ProspectResponse->Prospect->find('list');
		$questions = $this->ProspectResponse->Question->find('list');
		$this->set(compact('prospects', 'questions'));
	}



	/**
 * Save responses method
 * Created by Jon Toshmatov
 * 3/11/2013
 */


	public function createResponse(){
	 $this->layout = 'json';

		if ($this->request->is('post')) {


		/*
		 * Search for a duplicate record
		 * if a record found, get the id of it and assign it to request->data for update
		 */
		$pid = array(); //prospect id
		$qui = array(); //question id
		//assigning prospect and question id to array, a format that find functions accepts
		for ($i=1; $i<=100; $i++){
			if (isset($this->request->data[$i]['question_id'])){
				$pid[$i] = $this->request->data[$i]['prospect_id'];
				$qid[$i] = $this->request->data[$i]['question_id'];
			}
		}
			$condition = array('prospect_id' =>$pid, 'question_id' =>$qid);
			$get_update_id = $this->ProspectResponse->ProspectResponse->find('list',
				array('conditions'=>$condition,'fields' => array('question_id','id'))
			);

		/*
		 * if a record is already inserted in the table, then update it by providing id for each question.
		 * else, insert a new record.
		 */
		if ($get_update_id){//updating

			//assigning model ids to simple array
			$uids = array();
			for ($i=0; $i<100;$i++){
				if (isset($this->request->data[$i]['uid'])){
					$uids[$i] = $this->request->data[$i]['uid'];
				}
			}
			//assigning found records ids to simple array
			$ids = array();
			for ($v=0; $v<100; $v++){
				if (isset($get_update_id[$v])){
					$ids[$v] = $get_update_id[$v];
				}
			}
			//finally, assigning ids to request->data for update
			foreach ($uids as $id){
				$question_id = $this->request->data[$id]['question_id'];
				if (array_key_exists($question_id, $get_update_id)) {
					$myid = $ids[$question_id];
    					 $this->request->data[$id]['id'] = $myid;
					}
			}

			$validate = true;

			echo "Status: updating";
			$this->ProspectResponse->saveAll($this->request->data, array('validate' => 'first','validate' => true, 'deep' => true));
		}else{//inserting
			echo "Status: inserting";
			$this->ProspectResponse->saveAll($this->request->data, array('validate' => 'first','validate' => true, 'deep' => true));
		}//end of else get_update_id

		echo "<pre>";
		//print_r($this->request->data);

		}//end of if is post
	}//end of function


	/**
 * Save responses method
 * Created by Jon Toshmatov
 * 4/12/2013
 */


		public function saveResponse(){
	 	$this->layout = 'json';
	 	//print_r($this->request->data);

		if ($this->request->is('post')) {
		//cleaning up the data and getting rid of unnecessary fields that are not being saved

		unset($this->request->data['total_vehicles']);
		unset($this->request->data['medical54']);
		unset($this->request->data['travel52']);
		unset($this->request->data['umbrella61']);
		unset($this->request->data['life_insurance']);
		unset($this->request->data['universal_life_insurance']);
		unset($this->request->data['whole_life_insurance']);
		unset($this->request->data['autoresponse14options']);
		unset($this->request->data['autoresponse15options']);
		unset($this->request->data[0]);

		for ($i=0;$i<50;$i++){
    		unset($this->request->data["year_$i"]);
    		unset($this->request->data["make_$i"]);
    		unset($this->request->data["model_$i"]);
		}
		/*
		 * Search for a duplicate record
		 * if a record found, get the id of it and assign it to request->data for update
		 */
		$pid = array(); //prospect id
		$qui = array(); //question id
		//assigning prospect and question id to array, a format that find functions accepts




		for ($i=0; $i<=100; $i++){
			if (isset($this->request->data[$i]['question_id'])){
				$pid[$i] = $this->request->data[$i]['prospect_id'];
				$qid[$i] = $this->request->data[$i]['question_id'];
			}
		}
			$condition = array('prospect_id' =>$pid, 'question_id' =>$qid);
			$get_update_id = $this->ProspectResponse->ProspectResponse->find('list',
				array('conditions'=>$condition,'fields' => array('question_id','id'))
			);

		/*
		 * if a record is already inserted in the table, then update it by providing id for each question.
		 * else, insert a new record.
		 */
		if ($get_update_id){//updating

			//assigning model ids to simple array
			$uids = array();
			for ($i=0; $i<100;$i++){
				if (isset($this->request->data[$i]['uid'])){
					//$uids[$i] = $this->request->data[$i]['uid'];
					$uids[$i] = $i;
				}
			}
			//assigning found records ids to simple array
			$ids = array();
			for ($v=0; $v<100; $v++){
				if (isset($get_update_id[$v])){
					$ids[$v] = $get_update_id[$v];
				}
			}
			//finally, assigning ids to request->data for update
			foreach ($uids as $id){
				$question_id = $this->request->data[$id]['question_id'];
				if (array_key_exists($question_id, $get_update_id)) {
					$myid = $ids[$question_id];
    					 $this->request->data[$id]['id'] = $myid;

					}
			}


		$this->ProspectResponse->saveAll($this->request->data, array('validate' => 'first','validate' => true, 'deep' => true));
		}else{//inserting
		 $this->ProspectResponse->saveAll($this->request->data, array('validate' => 'first','validate' => true, 'deep' => true));
		}//end of else get_update_id
		}//end of if is post
	}//end of function




    /**
 * Save responses method
 * Created by Jon Toshmatov
 * 4/12/2013
 */


        public function submitomniture(){
        $this->layout = 'json';
       // echo "<script src=\"http://www.amfam.com/site-assets/js/s_code.js\" type=\"text/javascript\" language=\"JavaScript\">";


        }

	/**
 * get questions for email
 *
 * @param string $id
 * @return void
 */

		public function buildemail(){
			$qid = $this->request->data['qid'];
			$pid = $this->request->data['pid'];
			if ($qid=='' || $pid==''){return false;}

			$qid = 19;
			$pid = 13;
			$this->layout = 'json';
			$this->ProspectResponse->recursive = -1;


			App::import('model','QuestionEmail');
			$attr = new QuestionEmail();
			$question =$attr->find('all', array(
			'fields' => array('question_text'),
			'conditions'=>array(
			'id'=>$qid),
	   		'limit' => 1)
			);

			App::import('model','ResponseEmail');
			$attr = new ResponseEmail();
			$response =$attr->find('all', array(
			'fields' => array('response_value'),
			'conditions'=>array(
			'question_id'=>$qid,
			'prospect_id' =>$pid,
			),
	   		'limit' => 1)
			);
			$questions = $question[0]['questions']['question_text'];
			$responses = $response[0]['prospect_responses']['response_value'];
			$result = $questions .":".$responses;
			$this->set('result',$result);
			return $result;



			}


	/**
 * load the google map method
 *
 * @param string $id
 * @return void
 */
public function getfacebookagent() {
		$this->layout = 'json';
		//https://amfamsocial.com/agentjson/?fbid=184861494981206&key=hEzHBQV1Ic
		$fbid = $this->request->data['fbid'];
		$data = "https://amfamsocial.com/agentjson";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://amfamsocial.com/agentjson/?fbid=".$fbid."&key=hEzHBQV1Ic");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            "fbid=".$fbid."&key=hEzHBQV1Ic");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$server_output = curl_exec ($ch);
		//echo $server_output;
		curl_close ($ch);
}

public function process() {
		$this->layout = 'json';

		if (!isset($this->request->data['zip'])){
			echo "ZIP Code is not provided.";
			return false;
		}

		$data = "http://mobileapps.amfam.com/amfammobilesrv/findagent";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://mobileapps.amfam.com/amfammobilesrv/findagent");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            "deviceId=agtloc&version=v1&locateMethod=radius&radius=5&results=5&searchType=locateByZip&zip=".$this->request->data['zip']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$server_output = curl_exec ($ch);
		echo $server_output;
		curl_close ($ch);
}
public function processbyname() {
	/*
	 * 	var params = "deviceId=agtloc&version=v1&results=5&searchType=locateByName&firstName="+firstName+"&lastName="+lastName;
	 */
		$this->layout = 'json';
		$agent_first_name = $this->request->data['firstName'];
		$agent_last_name = $this->request->data['lastName'];
		$state = $this->request->data['state'];
		$data = "http://mobileapps.amfam.com/amfammobilesrv/findagent";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://mobileapps.amfam.com/amfammobilesrv/findagent");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
 		"deviceId=agtloc&version=v1&results=1&searchType=locateByName&firstName=".$agent_first_name."&lastName=".$agent_last_name."&state=".$state);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$server_output = curl_exec ($ch);
		echo $server_output;
		curl_close ($ch);
}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ProspectResponse->id = $id;
		if (!$this->ProspectResponse->exists()) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProspectResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ProspectResponse->read(null, $id);
		}
		$prospects = $this->ProspectResponse->Prospect->find('list');
		$questions = $this->ProspectResponse->Question->find('list');
		$this->set(compact('prospects', 'questions'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ProspectResponse->id = $id;
		if (!$this->ProspectResponse->exists()) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		if ($this->ProspectResponse->delete()) {
			$this->Session->setFlash(__('Prospect response deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Prospect response was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
