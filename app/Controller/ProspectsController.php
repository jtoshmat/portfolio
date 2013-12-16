<?php
App::uses('AppController', 'Controller');
/**
 * Prospects Controller
 *
 * @property Prospect $Prospect
 */
class ProspectsController extends AppController {

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
		$this->layout = 'admin';
		$this->Prospect->recursive = 0;
		$this->set('prospects', $this->paginate());

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
		$this->Prospect->id = $id;
		if (!$this->Prospect->exists()) {
			throw new NotFoundException(__('Invalid prospect'));
		}
		$this->set('prospect', $this->Prospect->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	// public function
	public function add() {
		$this->Prospect->recursive = 2;
		$this->layout = 'admin';
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

	public function createProspect(){
	$this->layout = 'json';
		//Send me JSON from the Tell Us About Yourself Page
		//I'm going to parse this JSON and create a new row in the database
		//I'm going to save the prospect
		$this->Prospect->recursive = 2;



		if($this->request->is('post') && !empty($this->request->data)){
			$this->Prospect->create();
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

					if ($this->Prospect->id!=''){
						echo "Record already exists " .$this->Prospect->id;
						return false;
					}


				//saving the data to db
				if ($this->Prospect->saveAll($this->request->data, array('atomic' => 'false'))){
					$this->set('prospects', $this->Prospect->id);
				}
				else{
					$return = '';
				}

		}
		else {
			$return = '';
		}




		//} else {
		//	$return  = '{"500" : "No Post Made"}';
		//}





		//Then I'll take that ID and create a row for each product in prospect_products by passing the prospect ID and products to prospectproductscontroller
		//When that completes
		//I'm going to return to you JSON containing:
		//new prospect row id
		//products chosen by prospect
		//timestamp created
	}

	public function updateProspect(){

		//Each time the prospect completes a fieldset of product related questions
		//pass me the questions/values in JSON
		//I'll parse it and send it to the prospectresponsescontroller
		//when done, I'll send you a confirmation message

		return 'sdfsdfsdfsdfsdfdsf';
	}

/**
 * edit method++
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = 'admin';
		$this->Prospect->id = $id;
		if (!$this->Prospect->exists()) {
			throw new NotFoundException(__('Invalid prospect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Prospect->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Prospect->read(null, $id);
		}
		$states = $this->Prospect->State->find('list');
		$languages = $this->Prospect->Language->find('list');
		$originTypes = $this->Prospect->OriginType->find('list');
		$deviceTypes = $this->Prospect->DeviceType->find('list');
		$this->set(compact('states', 'languages', 'originTypes', 'deviceTypes'));
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
		$this->Prospect->id = $id;
		if (!$this->Prospect->exists()) {
			throw new NotFoundException(__('Invalid prospect'));
		}
		if ($this->Prospect->delete()) {
			$this->Session->setFlash(__('Prospect deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Prospect was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
