<?php
App::uses('AppController', 'Controller');
/**
 * HtmlInputs Controller
 *
 * @property HtmlInput $HtmlInput
 * @property PaginatorComponent $Paginator
 */
class HtmlInputsController extends AppController {

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
		$this->HtmlInput->recursive = 0;
		$this->set('htmlInputs', $this->Paginator->paginate());
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
		if (!$this->HtmlInput->exists($id)) {
			throw new NotFoundException(__('Invalid html input'));
		}
		$options = array('conditions' => array('HtmlInput.' . $this->HtmlInput->primaryKey => $id));
		$this->set('htmlInput', $this->HtmlInput->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->HtmlInput->create();
			if ($this->HtmlInput->save($this->request->data)) {
				$this->Session->setFlash(__('The html input has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The html input could not be saved. Please, try again.'));
			}
		}
		$users = $this->HtmlInput->User->find('list');
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
		if (!$this->HtmlInput->exists($id)) {
			throw new NotFoundException(__('Invalid html input'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HtmlInput->save($this->request->data)) {
				$this->Session->setFlash(__('The html input has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The html input could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('HtmlInput.' . $this->HtmlInput->primaryKey => $id));
			$this->request->data = $this->HtmlInput->find('first', $options);
		}
		$users = $this->HtmlInput->User->find('list');
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
		$this->HtmlInput->id = $id;
		if (!$this->HtmlInput->exists()) {
			throw new NotFoundException(__('Invalid html input'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->HtmlInput->delete()) {
			$this->Session->setFlash(__('The html input has been deleted.'));
		} else {
			$this->Session->setFlash(__('The html input could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
