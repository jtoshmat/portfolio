<?php
App::uses('AppController', 'Controller');
/**
 * Languages Controller
 *
 * @property Language $Language
 */
class LanguagesController extends AppController {
	//Added by Jon Toshmatov on 2/26
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('fetch_lang');
		$this->Auth->deny('index', 'view','edit','delete','add');
	}



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Language->recursive = 0;
		$this->set('languages', $this->paginate());
		$this->layout = 'admin';
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
		$this->Language->id = $id;
		if (!$this->Language->exists()) {
			throw new NotFoundException(__('Invalid language'));
		}
		$this->set('language', $this->Language->read(null, $id));
	}
	
	
		//Added by Jon Toshmatov on 2/26
		public function fetch_lang(){
		$this->layout = 'ajax';
		$this->Language->recursive = 0;
		$langs = $this->Language->find('all'); 
		return $langs;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->Language->create();
			if ($this->Language->save($this->request->data)) {
				$this->Session->setFlash(__('The language has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The language could not be saved. Please, try again.'));
			}
		}
		$users = $this->Language->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Language->id = $id;
		$this->layout = 'admin';
		if (!$this->Language->exists()) {
			throw new NotFoundException(__('Invalid language'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Language->save($this->request->data)) {
				$this->Session->setFlash(__('The language has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The language could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Language->read(null, $id);
		}
		$users = $this->Language->User->find('list');
		$this->set(compact('users'));
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
		$this->layout = 'admin';
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Language->id = $id;
		if (!$this->Language->exists()) {
			throw new NotFoundException(__('Invalid language'));
		}
		if ($this->Language->delete()) {
			$this->Session->setFlash(__('Language deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Language was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
