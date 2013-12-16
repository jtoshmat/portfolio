<?php
App::uses('AppController', 'Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
 	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('getProductsTotal');
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}
	
	public function index() {
		$this->layout = 'admin';
		$this->Question->recursive = 0;
		$this->set('questions', $this->paginate());
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
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

	
	
/**
 * get production total method
 * created by Jon Toshmatov
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function getProductsTotal($id){
		$myid = explode(',', $id);
		$this->layout = 'json';
		$this->Question->recursive = -1;	
		$options = $this->Question->find('all', array(
		'fields' => array('id'),
		'conditions'=>array('id'=>$myid,'active' =>1))
		);	
		$options = sizeof($options);
		$this->set('questions_total',$options);
		return $options;		 
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
	$this->layout = 'admin';
		$this->Question->recursive = 0;
		if ($this->request->is('post')) {
			$this->Question->create();
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		}
		$users = $this->Question->User->find('list');
		$products = $this->Question->Product->find('all');
		$answerTypes = $this->Question->AnswerType->find('all');

		$this->set(compact('users', 'products', 'answerTypes'));
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
		$this->Question->recursive = 0;
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Question->read(null, $id);
		}
		$users = $this->Question->User->find('list');
		$products = $this->Question->Product->find('all');
		$answerTypes = $this->Question->AnswerType->find('all');
		$this->set(compact('users', 'products', 'answerTypes'));
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
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->Question->delete()) {
			$this->Session->setFlash(__('Question deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Question was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
