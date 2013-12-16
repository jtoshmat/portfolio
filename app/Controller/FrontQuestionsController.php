<?php
App::uses('AppController', 'Controller');
/**
 * FrontQuestions Controller
 *
 * @property FrontQuestion $FrontQuestion
 * @property PaginatorComponent $Paginator
 */
class FrontQuestionsController extends AppController {

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
		$this->Auth->allow('getfacebookagent');
	}


	public function index() {
		$this->layout = 'admin';
		$this->FrontQuestion->recursive = 0;
		$this->set('frontQuestions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout = 'admin';
		if (!$this->FrontQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid front question'));
		}
		$options = array('conditions' => array('FrontQuestion.' . $this->FrontQuestion->primaryKey => $id));
		$this->set('frontQuestion', $this->FrontQuestion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->FrontQuestion->create();
			if ($this->FrontQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The front question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The front question could not be saved. Please, try again.'));
			}
		}
		$businessQuestions = $this->FrontQuestion->BusinessQuestion->find('list');
		$businesses = $this->FrontQuestion->Business->find('list');
		$questions = $this->FrontQuestion->Question->find('list');
		$responses = $this->FrontQuestion->Response->find('list');
		$this->set(compact('businessQuestions', 'businesses', 'questions', 'responses'));


	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = 'admin';
		if (!$this->FrontQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid front question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FrontQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The front question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The front question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FrontQuestion.' . $this->FrontQuestion->primaryKey => $id));
			$this->request->data = $this->FrontQuestion->find('first', $options);
		}
		$businessQuestions = $this->FrontQuestion->BusinessQuestion->find('list');
		$businesses = $this->FrontQuestion->Business->find('list');
		$questions = $this->FrontQuestion->Question->find('list');
		$responses = $this->FrontQuestion->Response->find('list');
		$this->set(compact('businessQuestions', 'businesses', 'questions', 'responses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->layout = 'admin';
		$this->FrontQuestion->id = $id;
		if (!$this->FrontQuestion->exists()) {
			throw new NotFoundException(__('Invalid front question'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FrontQuestion->delete()) {
			$this->Session->setFlash(__('The front question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The front question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function get_questions($bid=null) {
		$this->layout = 'default';
		$this->set('title_for_layout', "aaaaaaaaaaaaaaaa");
		if ($bid==null) {
 			return false;
		}
		//$this->FrontQuestion->primaryKey
		$options = array('conditions' => array('FrontQuestion.business_id' => $bid,'status'=>1));
		$this->set('frontQuestion', $this->FrontQuestion->find('list', $options));
		return $this->FrontQuestion->find('all', $options);
	}

	public function getfacebookagent(){
		$this->layout = 'json';
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
		$server_output = json_decode($server_output, true);
		$server_output = $server_output["items"]["fbid"];
		curl_close ($ch);
	}
	public function getagentbyname() {
		$this->layout = 'json';
		$agent_first_name = (isset($this->request->data['agent_first_name']))?$this->request->data['agent_first_name']:null;
		$agent_last_name = (isset($this->request->data['agent_last_name']))?$this->request->data['agent_last_name']:null;
		$zip = (isset($this->request->data['zip']))?$this->request->data['zip']:null;
		if ($zip=='' || $zip==null){
			$state = (isset($this->request->data['agent_state']))?$this->request->data['agent_state']:null;
			if (!isset($agent_first_name)){return false;}
			if (!isset($agent_last_name)){return false;}
			if (!isset($state)){return false;}
		}




		$method = $this->request->data['method'];

		$data = "http://mobileapps.amfam.com/amfammobilesrv/findagent";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://mobileapps.amfam.com/amfammobilesrv/findagent");
		curl_setopt($ch, CURLOPT_POST, 1);

		//var params = "deviceId=agtloc&version=v1&locateMethod=radius&" +
		//"radius=5&results=5&searchType=locateByZip&zip="+zip;
		if ($method=='locateByZip'){
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		"deviceId=agtloc&version=v1&locateMethod=radius&radius=20&results=20&searchType=locateByZip&zip=".$zip);
		}
		if ($method=='locateByName'){
			curl_setopt($ch, CURLOPT_POSTFIELDS,
			"deviceId=agtloc&version=v1&locateMethod=radius&radius=20&results=50&searchType=".$method."&firstName=".$agent_first_name."&lastName=".$agent_last_name."&state=".$state);
		}

		if ($method==''){
			curl_setopt($ch, CURLOPT_POSTFIELDS,
			"deviceId=agtloc&version=v1&locateMethod=radius&radius=20&results=50&searchType=locateByName&firstName=".$agent_first_name."&lastName=".$agent_last_name."&state=".$state);
		}

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$server_output = curl_exec ($ch);
		//echo $server_output;
		curl_close ($ch);

	}



}
