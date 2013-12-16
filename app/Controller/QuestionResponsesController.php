<?php
App::uses('AppController', 'Controller');
/**
 * QuestionResponses Controller
 *
 * @property QuestionResponse $QuestionResponse
 * @property PaginatorComponent $Paginator
 */
class QuestionResponsesController extends AppController {

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
		$this->QuestionResponse->recursive = 0;
		$this->set('questionResponses', $this->Paginator->paginate());

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
		if (!$this->QuestionResponse->exists($id)) {
			throw new NotFoundException(__('Invalid question response'));
		}
		$options = array('conditions' => array('QuestionResponse.' . $this->QuestionResponse->primaryKey => $id));
		$this->set('questionResponse', $this->QuestionResponse->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->QuestionResponse->create();
			if ($this->QuestionResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The question response has been saved.'));
				//return $this->redirect(array('action' => 'index'));
				return $this->redirect(array('controller'=>'customs','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question response could not be saved. Please, try again.'));
			}
		}
		$questions = $this->QuestionResponse->Question->find('list');
		$responses = $this->QuestionResponse->Response->find('list');
		$this->set(compact('questions', 'responses'));
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


		if (!$this->QuestionResponse->exists($id)) {
			throw new NotFoundException(__('Invalid question response'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->QuestionResponse->save($this->request->data['QuestionResponse'])) {
				$this->update_other_tables();
			} else {
				$this->Session->setFlash(__('The question response could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('QuestionResponse.' . $this->QuestionResponse->primaryKey => $id));
			$this->request->data = $this->QuestionResponse->find('first', $options);
		}
		$questions = $this->QuestionResponse->Question->find('list');
		$responses = $this->QuestionResponse->Response->find('list');
		$this->set(compact('questions', 'responses'));
	}

	public function update_other_tables() {
		$bid = $this->request->data['QuestionResponse']['business_id'];
		$qid = $this->request->data['QuestionResponse']['question_id'];
		$rid = $this->request->data['QuestionResponse']['response_id'];

		App::import('model','BusinessProduct');
		$bp = new BusinessProduct();
		$options = array(
				'conditions' => array('business_id' => $bid, 'question_id'=>$qid,'response_id'=>$rid), //array of conditions
		);
		$bpsource = $bp->find('first',$options);
		$id = settype($bpsource['BusinessProduct']['id'],'integer');
		if ($bp->save($this->request->data['QuestionResponse'])){
			$this->Session->setFlash(__('Successfully updated.'));
			return $this->redirect(array('controller'=>'customs','action' => 'index'));
		}else{
			$this->Session->setFlash(__('Something went wrong'));
			return $this->redirect(array('controller'=>'customs','action' => 'index'));
		}

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
		$this->QuestionResponse->id = $id;
		if (!$this->QuestionResponse->exists()) {
			throw new NotFoundException(__('Invalid question response'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QuestionResponse->delete()) {
			$this->Session->setFlash(__('The question response has been deleted.'));
		} else {
			$this->Session->setFlash(__('The question response could not be deleted. Please, try again.'));
		}
		//return $this->redirect(array('action' => 'index'));
		return $this->redirect(array('controller'=>'customs','action' => 'index'));
	}

	public function getqr($qid = null) {
		$this->layout = 'admin';
		if ($qid==null) {
			return false;
		}
		$options = array('conditions' => array('QuestionResponse.' . $this->QuestionResponse->primaryKey => $qid));
		$output = $this->QuestionResponse->find('first', $options);
		return $output;
	}


	public function wizard() {
		$this->layout = 'admin';

		App::import('model','Business');
		$bs = new Business();

		App::import('model','Question');
		$qs = new Question();

		App::import('model','Response');
		$rs = new Response();

		App::import('model','Product');
		$pr = new Product();

		$this->QuestionResponse->recursive = 0;
		$this->set('questionResponses', $this->Paginator->paginate());
		$this->set('businesses', $bs->find('all', array('conditions'=>array('active'=>1))));
		$this->set('questions', $qs->find('all', array('conditions'=>array('active'=>1))));
		$this->set('responses', $rs->find('all', array('conditions'=>array('active'=>1))));
		$this->set('products', $pr->find('all', array('conditions'=>array('active'=>1))));
	}


	public function getview($qid = null) {
		$this->layout = 'admin';
		if ($qid==null) {
			return false;
		}
		$options = array('conditions' => array('question_id' => $qid));
		return $this->QuestionResponse->find('all', $options);
	}
}