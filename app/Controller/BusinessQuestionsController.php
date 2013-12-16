<?php
App::uses('AppController', 'Controller');
/**
 * BusinessQuestions Controller
 *
 * @property BusinessQuestion $BusinessQuestion
 * @property PaginatorComponent $Paginator
 */
class BusinessQuestionsController extends AppController {

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
		$this->BusinessQuestion->recursive = 0;
		$this->set('businessQuestions', $this->Paginator->paginate());
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
		if (!$this->BusinessQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid business question'));
		}
		$options = array('conditions' => array('BusinessQuestion.' . $this->BusinessQuestion->primaryKey => $id));
		$this->set('businessQuestion', $this->BusinessQuestion->find('first', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->BusinessQuestion->create();


			if ($this->BusinessQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The business question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business question could not be saved. Please, try again.'));
			}
		}
		$businesses = $this->BusinessQuestion->Business->find('list');
		$questions = $this->BusinessQuestion->Question->find('list');
		$responses = $this->BusinessQuestion->Response->find('list');
		$this->set(compact('businesses', 'questions', 'responses'));
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
		if (!$this->BusinessQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid business question'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$pid = implode(";",$this->request->data['BusinessQuestion']['products']);



			$this->request->data['BusinessQuestion']['products'] = $pid;
			if ($this->BusinessQuestion->save($this->request->data['BusinessQuestion'])) {
				$this->Session->setFlash(__('The business question has been saved.'));
				return $this->redirect(array('controller'=>'customs','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BusinessQuestion.' . $this->BusinessQuestion->primaryKey => $id));
			$this->request->data = $this->BusinessQuestion->find('first', $options);
		}
		$businessquestions = $this->BusinessQuestion->find('first', $options);

		$options = array('fields' => array('short_name'));
		$businesses = $this->BusinessQuestion->Business->find('list',$options);
		$questions = $this->BusinessQuestion->Question->find('list',$options);
		$responses = $this->BusinessQuestion->Response->find('list',$options);

		App::import('model','Product');
		$pr = new Product();
		$products = $pr->find('list',$options);
		$this->set(compact('businesses', 'questions', 'responses','products','businessquestions'));
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
		$this->BusinessQuestion->id = $id;
		if (!$this->BusinessQuestion->exists()) {
			throw new NotFoundException(__('Invalid business question'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BusinessQuestion->delete()) {
			$this->Session->setFlash(__('The business question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
