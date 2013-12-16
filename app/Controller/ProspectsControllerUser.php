<?php
App::uses('AppController', 'Controller');
/**
 * Prospects Controller
 *
 * @property Prospect $Prospect
 */
class ProspectsControllerUser extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow();
	    // $this->Auth->deny('index', 'view','edit','delete','add');
	}
	public function index() {
		$this->layout = 'user';
		$this->Prospect->recursive = 0;
		$this->set('prospects', $this->paginate());
	}
 
 

/**
 * add method
 *
 * @return void
 */
	// public function 
	public function add() {
		$this->Prospect->recursive = 2;
		$this->layout = 'user';
		if ($this->request->is('post')) {
			$this->Prospect->create();
			if ($this->Prospect->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect could not be saved. Please, try again.'));
			}
		}
		$states = $this->Prospect->State->find('list');
		$languages = $this->Prospect->Language->find('list');
		$originTypes = $this->Prospect->OriginType->find('list');
		$deviceTypes = $this->Prospect->DeviceType->find('list');
		$this->set(compact('states', 'languages', 'originTypes', 'deviceTypes'));
	}
 
}
