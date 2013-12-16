<?php
App::uses('AppController', 'Controller');
/**
 * Businesses Controller
 *
 * @property Business $Business
 * @property PaginatorComponent $Paginator
 */
class BusinessesController extends AppController {




	public function beforeFilter() {
		$this->set('current_user',$this->Auth->user());
		$this->set('is_user_loggedin',$this->Auth->loggedIn());
		$current_id = $this->Auth->user();
		$current_id = parent::get_user();
		$this->Auth->allow();
		$this->Auth->allow(array('pages'=>'index'));

		/* 		if ($current_id['group_id']!=1){
		 $this->Auth->deny(array('settings'=>'index'));
		$this->Auth->deny(array('settings'=>'view'));
		$this->Auth->deny(array('settings'=>'edit'));
		$this->Auth->deny(array('settings'=>'delete'));
		} */

		if (!$this->Auth->loggedIn()){
			if ($current_id['group_id']!=1){
				$this->Auth->deny(array('businesses'=>'index'));
				$this->Auth->deny(array('businesses'=>'view'));
				$this->Auth->deny(array('businesses'=>'edit'));
				$this->Auth->deny(array('businesses'=>'delete'));
			}
		}



	}

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
	public function index() {
		$this->layout = 'admin';
		$this->Business->recursive = 2;
		$this->set('businesses', $this->Paginator->paginate());
		return $this->Paginator->paginate();
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
		if (!$this->Business->exists($id)) {
			throw new NotFoundException(__('Invalid business'));
		}
		$options = array('conditions' => array('Business.' . $this->Business->primaryKey => $id));
		$this->set('business', $this->Business->find('first', $options));


	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->Business->create();
			if ($this->Business->save($this->request->data)) {
				$this->Session->setFlash(__('The business has been saved.'));
				//return $this->redirect(array('action' => 'index'));
				return $this->redirect(array('controller'=>'customs','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business could not be saved. Please, try again.'));
			}
		}
		$users = $this->Business->User->find('list');
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
		$this->layout = 'admin';
		if (!$this->Business->exists($id)) {
			throw new NotFoundException(__('Invalid business'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Business->save($this->request->data)) {
				$this->Session->setFlash(__('The business has been saved.'));
				//return $this->redirect(array('action' => 'index'));
				return $this->redirect(array('controller'=>'customs','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Business.' . $this->Business->primaryKey => $id));
			$this->request->data = $this->Business->find('first', $options);
		}
		$users = $this->Business->User->find('list');
		$this->set(compact('users'));
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
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Business->delete()) {
			$this->Session->setFlash(__('The business has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business could not be deleted. Please, try again.'));
		}
		//return $this->redirect(array('action' => 'index'));
		return $this->redirect(array('controller'=>'customs','action' => 'index'));
	}}
