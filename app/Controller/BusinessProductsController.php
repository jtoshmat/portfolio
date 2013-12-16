<?php
App::uses('AppController', 'Controller');
/**
 * BusinessProducts Controller
 *
 * @property BusinessProduct $BusinessProduct
 * @property PaginatorComponent $Paginator
 */
class BusinessProductsController extends AppController {

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
		$this->BusinessProduct->recursive = 0;
		$this->set('businessProducts', $this->Paginator->paginate());
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
		if (!$this->BusinessProduct->exists($id)) {
			throw new NotFoundException(__('Invalid business product'));
		}
		$options = array('conditions' => array('BusinessProduct.' . $this->BusinessProduct->primaryKey => $id));
		$this->set('businessProduct', $this->BusinessProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$bid = $this->request->data['BusinessProduct']['business_id'];
			$qid = $this->request->data['BusinessProduct']['question_id'];
			$rid = $this->request->data['BusinessProduct']['response_id'];

			$options = array(
					'conditions' => array('business_id' => $bid, 'question_id'=>$qid, 'response_id'=>$rid), //array of conditions
			);
			$unique = $this->BusinessProduct->find('first',$options);

			$flag = false;
			$flag = isset($unique['BusinessProduct']['id'])?true:false;


			$this->BusinessProduct->create();
			$count = count($this->request->data['BusinessProduct']['product_id']);//product count

			$prid = "";
			for ($i=0;$i<$count;$i++){
				if (isset($this->request->data['BusinessProduct']['product_id'][$i])){
					$prid .= $this->request->data['BusinessProduct']['product_id'][$i].";";
				}
			}
			$prid = rtrim($prid, ";");
			$this->request->data['BusinessProduct']['product_id']=$prid;


			if ($flag){
				$this->Session->setFlash(__('A duplicate record found.'));
				return $this->redirect(array('controller'=>'custom','action' => 'index'));
			}


				if ($this->BusinessProduct->save($this->request->data)) {
					$this->Session->setFlash(__('A product has been assign to Business, Question and Response.'));
					return $this->redirect(array('controller'=>'custom','action' => 'index'));
				} else {
					$this->Session->setFlash(__('The business product could not be saved. Please, try again.'));
				}

		}
		$options = array(
		    'fields' => array('Business.short_name'),
			);
		$businesses = $this->BusinessProduct->Business->find('list',$options);

		$options = array(
				'fields' => array('Question.short_name'),
		);
		$questions = $this->BusinessProduct->Question->find('list',$options);

		$options = array(
				'fields' => array('Response.short_name'),
		);
		$responses = $this->BusinessProduct->Response->find('list',$options);

		$options = array(
				'fields' => array('Product.short_name'),
		);
		$products = $this->BusinessProduct->Product->find('list',$options);

		$this->set(compact('businesses', 'questions', 'responses','products'));

		$this->Session->setFlash('One of the required fields is missing', 'default', array(), 'bpadd');
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
		$this->BusinessProduct->create();

		if (!$this->BusinessProduct->exists($id)) {
			throw new NotFoundException(__('Invalid business product'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$bid = $this->request->data['BusinessProduct']['business_id'];
			$qid = $this->request->data['BusinessProduct']['question_id'];
			$rid = $this->request->data['BusinessProduct']['response_id'];

			$options = array(
					'conditions' => array('business_id' => $bid, 'question_id'=>$qid, 'response_id'=>$rid), //array of conditions
			);
			$unique = $this->BusinessProduct->find('first',$options);

			$flag = false;
			$flag = isset($unique['BusinessProduct']['id'])?true:false;


			$this->BusinessProduct->id = $id;
			$count = count($this->request->data['BusinessProduct']['product_id']);//product count

			$prid = "";
			for ($i=0;$i<$count;$i++){
				if (isset($this->request->data['BusinessProduct']['product_id'][$i])){
					$prid .= $this->request->data['BusinessProduct']['product_id'][$i].";";
				}
			}
			$prid = rtrim($prid, ";");
			$this->request->data['BusinessProduct']['product_id']=$prid;



				if ($this->BusinessProduct->save($this->request->data)) {
					$this->Session->setFlash(__('The business product has been saved.'));
					return $this->redirect(array('controller'=>'custom','action' => 'index'));
				} else {
					$this->Session->setFlash(__('The business product could not be saved. Please, try again.'));

				}


		} else {
			$options = array('conditions' => array('BusinessProduct.' . $this->BusinessProduct->primaryKey => $id));
			$this->request->data = $this->BusinessProduct->find('first', $options);
			$default = $this->BusinessProduct->find('first', $options);
		}
		$options = array(
		    'fields' => array('Business.short_name'),
			);
		$businesses = $this->BusinessProduct->Business->find('list',$options);

		$options = array(
				'fields' => array('Question.short_name'),
		);
		$questions = $this->BusinessProduct->Question->find('list',$options);

		$options = array(
				'fields' => array('Response.short_name'),
		);
		$responses = $this->BusinessProduct->Response->find('list',$options);

		$options = array(
				'fields' => array('Product.short_name'),
		);
		$products = $this->BusinessProduct->Product->find('list',$options);

		$this->set(compact('businesses', 'questions', 'responses','products','default'));


	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BusinessProduct->id = $id;
		if (!$this->BusinessProduct->exists()) {
			throw new NotFoundException(__('Invalid business product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BusinessProduct->delete()) {
			$this->Session->setFlash(__('The business product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The business product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function get_bp($bid,$qid,$rid) {
		$this->layout = 'admin';
		if ($bid==null || $qid==null || $rid==null){
			return false;
		}

		$options = array(
				'conditions' => array('business_id' => $bid,'question_id'=>$qid,'response_id'=>$rid), //array of conditions
		);
		$list = $this->BusinessProduct->find('first',$options);

		return $list;

	}



}
