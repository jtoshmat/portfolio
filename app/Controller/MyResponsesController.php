<?php
App::uses('AppController', 'Controller');
/**
 * Responses Controller
 *
 * @property Response $Response
 */
class MyResponsesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('createResponse');
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}
	
	public function index() {
		$this->layout = 'admin';
		$this->MyResponse->recursive = 0;
		$this->set('responses', $this->paginate());
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
		$this->MyResponse->id = $id;
		if (!$this->MyResponse->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		$this->set('response', $this->MyResponse->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		$this->MyResponse->recursive = 0;
		if ($this->request->is('post')) {
			$this->MyResponse->create();
			if ($this->MyResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response could not be saved. Please, try again.'));
			}
		}
		$users = $this->MyResponse->User->find('list');
		$questions = $this->MyResponse->Question->find('all');
		
		$this->set(compact('users', 'questions'));
	}

/**
 * Save responses method
 * Created by Jon Toshmatov
 * 3/7/2013
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	public function createResponse(){
		$this->layout = 'json';
		$this->MyResponse->recursive = 2;		
		if($this->request->is('post') && !empty($this->request->data)){		 
			$this->MyResponse->create();
			
			
			
			           /*
             * Acceptable format for products: Jon Toshmatov 03/02/2013
             $this->request->data['ProspectProduct']=array("product[0]" => "1", "product[1]" => "2", "product[2]" => "3");
				[ProspectProduct] => Array
			        (
			            [product[0]] => 1
			            [product[1]] => 2
			            [product[2]] => 3
			        )
             */
				//saving the data to db	
	
				
				//$this->request->data['Response']['id']=1;
				
				$this->request->data['MyResponse']['question_id']=99;//working	
				$this->request->data['MyResponse']['response_text']='Default Response';//working
				$this->request->data['ProspectResponse']['0'] = array("question[0]" => "1", "question[1]" => "2", "question[2]" => "3");//working
				
				$this->request->data['ProspectResponse']=array("response_value[0]" => "1", "response_value[1]" => "2", "response_value[2]" => "3");//not working
			
				
				
				$this->MyResponse->saveAll($this->request->data, array('atomic' => 'true'));
				$this->set('responses', $this->MyResponse->id);	

				echo "<pre>";
				 print_r($this->request->data);

			
			//Jon's test area starts
/*			$this->set('responses', 99);
			return 999999;	
			echo "<pre>";
			print_r($this->request->data);*/
			
			//Jon's test area ends
				 
		}
		else {
			$return = 'Requets must be in a post method';
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
		$this->MyResponse->recursive = 0;
		$this->MyResponse->id = $id;
		if (!$this->MyResponse->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MyResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->MyResponse->read(null, $id);
		}
		$users = $this->MyResponse->User->find('list');
		$questions = $this->MyResponse->Question->find('all');
		
		$this->set(compact('users', 'questions'));
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
		$this->MyResponse->id = $id;
		if (!$this->MyResponse->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		if ($this->MyResponse->delete()) {
			$this->Session->setFlash(__('Response deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Response was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
