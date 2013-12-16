<?php
App::uses('AppController', 'Controller');
/**
 * Prospects Controller
 *
 * @property Prospect $Prospect
 * @property PaginatorComponent $Paginator
 */
class ProspectsController extends AppController {

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
		$this->Auth->allow('add');
		$this->Auth->allow('edit');
		$this->Auth->allow('index');
		$this->Auth->allow('process');
		$this->Auth->allow('processbyname');
		}

	public function index() {
		$this->layout = 'admin';
		$this->Prospect->recursive = 0;
		$this->set('prospects', $this->Paginator->paginate());
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
		if (!$this->Prospect->exists($id)) {
			throw new NotFoundException(__('Invalid prospect'));
		}
		$options = array('conditions' => array('Prospect.' . $this->Prospect->primaryKey => $id));
		$this->set('prospect', $this->Prospect->find('first', $options));
		return $this->Prospect->find('first', $options);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'default';
		$prospect_id = null;
		if ($this->request->is('post')) {
			$this->Prospect->create();
			if ($this->Prospect->save($this->request->data)) {
				$prospect_id = $this->Prospect->getInsertID();
				$comefrom = $this->request->data['Prospect']['comefrom'];
				$this->Session->destroy();
				$this->Session->write('CNA.uid', $prospect_id);
				$this->Session->write('CNA.comefrom', $comefrom);
				//$this->Session->setFlash(__('The prospect has been saved: '.$prospect_id));
				return $this->redirect(array('controller'=>'pages','action' => 'display','questions'));
			} else {
				//$this->Session->setFlash(__('The prospect could not be saved. Please, try again.'));
				//return $this->redirect(array('controller'=>'pages','action' => 'display'));
				echo "<script>alert('go back'); window.history.back();</script>";
			}
		}
		$states = $this->Prospect->State->find('list');
		$this->set(compact('states','prospect_id'));
		echo $prospect_id;
		return $states;
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = 'default';

		/*
		if (!$this->Prospect->exists($id)) {
			throw new NotFoundException(__('Invalid prospect'));
		}
		*/

		if ($this->request->is(array('post', 'put'))) {
			$url = (isset($this->request->data['Prospect']['url']))?$this->request->data['Prospect']['url']:'questions';
			$flag = (isset($this->request->data['Prospect']['url']))?false:true;
			unset($this->request->data['Prospect']['url']);
			if ($this->Prospect->save($this->request->data,$validate = $flag)) {
				//$this->Session->setFlash(__('The prospect has been saved.'));
				return $this->redirect(array('controller'=>'pages','action' => 'display',$url));
			} else {
				$this->Session->setFlash(__('The prospect could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Prospect.' . $this->Prospect->primaryKey => $id));
			$this->request->data = $this->Prospect->find('first', $options);
		}
		$states = $this->Prospect->State->find('list');
		$this->set(compact('states'));
		$pros = $this->Prospect->find('first', $options);
		if (isset($pros)){return $pros;}else{$this->Session->delete('CNA.uid');return false;}

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
		$this->Prospect->id = $id;
		if (!$this->Prospect->exists()) {
			throw new NotFoundException(__('Invalid prospect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Prospect->delete()) {
			$this->Session->setFlash(__('The prospect has been deleted.'));
		} else {
			$this->Session->setFlash(__('The prospect could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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

}
