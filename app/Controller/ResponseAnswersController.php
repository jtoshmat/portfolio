<?php
App::uses('AppController', 'Controller');
/**
 * ResponseAnswers Controller
 *
 * @property ResponseAnswer $ResponseAnswer
 * @property PaginatorComponent $Paginator
 */
class ResponseAnswersController extends AppController {

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
		$this->ResponseAnswer->recursive = 0;
		$this->set('responseAnswers', $this->Paginator->paginate());
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
		if (!$this->ResponseAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid response answer'));
		}
		$options = array('conditions' => array('ResponseAnswer.' . $this->ResponseAnswer->primaryKey => $id));
		$this->set('responseAnswer', $this->ResponseAnswer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->ResponseAnswer->create();
			if ($this->ResponseAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The response answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response answer could not be saved. Please, try again.'));
			}
		}
		$users = $this->ResponseAnswer->User->find('list');
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
		if (!$this->ResponseAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid response answer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ResponseAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The response answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response answer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ResponseAnswer.' . $this->ResponseAnswer->primaryKey => $id));
			$this->request->data = $this->ResponseAnswer->find('first', $options);
		}
		$users = $this->ResponseAnswer->User->find('list');
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
		$this->ResponseAnswer->id = $id;
		if (!$this->ResponseAnswer->exists()) {
			throw new NotFoundException(__('Invalid response answer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ResponseAnswer->delete()) {
			$this->Session->setFlash(__('The response answer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The response answer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
