<?php
App::uses('AppController', 'Controller');
/**
 * Customs Controller
 *
 * @property Custom $Custom
 * @property PaginatorComponent $Paginator
 */
class CustomsController extends AppController {

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
		$this->Custom->recursive = 1;

		$this->Paginator->settings = array(
							'limit' => 10000
		);

		$this->set('customs', $this->Paginator->paginate());



		$message = "";
		if ($this->request->is('post')) {
			$bid = $this->request->data['Custom']['business_id'];
			$qid = $this->request->data['Custom']['question_id'];
			$rid = $this->request->data['Custom']['response_id'];

			if (is_numeric($bid)==false || is_numeric($qid)==false || is_numeric($rid)==false){
				$this->Session->setFlash("Please select Business, Questions and Response");
				return false;
			}

			//Save Business Question
			App::import('model','BusinessQuestion');
			$bq = new BusinessQuestion();

			$options = array(
		    'conditions' => array('business_id' => $bid, 'question_id'=>$qid,'response_id'=>$rid), //array of conditions
			);
			$unique = $bq->find('first',$options);
			$flag = false;
			$flag = isset($unique['BusinessQuestion']['id'])?true:false;


			if ($flag){
				$this->Session->setFlash("A duplicate question for the Business");
				return $this->redirect(array('controller'=>'customs','action' => 'index'));
				return false;
			}

			if ($this->request->data['Custom']['products']!=''){
				$pid = implode(";",$this->request->data['Custom']['products']);
				$this->request->data['Custom']['products'] = $pid;
			}
			if ($bq->save($this->request->data['Custom'])) {
				$message .= "Business Questions is saved<br />";
			}
			return $this->redirect(array('controller'=>'customs','action' => 'index'));
			return false;

		}


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
		if (!$this->Custom->exists($id)) {
			throw new NotFoundException(__('Invalid custom'));
		}
		$options = array('conditions' => array('Custom.' . $this->Custom->primaryKey => $id));
		$this->set('custom', $this->Custom->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->Custom->create();
			if ($this->Custom->save($this->request->data)) {
				$this->Session->setFlash(__('The custom has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The custom could not be saved. Please, try again.'));
			}
		}
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
		if (!$this->Custom->exists($id)) {
			throw new NotFoundException(__('Invalid custom'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Custom->save($this->request->data)) {
				$this->Session->setFlash(__('The custom has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The custom could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Custom.' . $this->Custom->primaryKey => $id));
			$this->request->data = $this->Custom->find('first', $options);
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
		$this->Custom->id = $id;
		if (!$this->Custom->exists()) {
			throw new NotFoundException(__('Invalid custom'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Custom->delete()) {
			$this->Session->setFlash(__('The custom has been deleted.'));
		} else {
			$this->Session->setFlash(__('The custom could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


}
