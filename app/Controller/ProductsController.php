<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
 
 
 

class ProductsController extends AppController {

/**
 * index method
 *
 * @return void
 */

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('getProducts');
		$this->Auth->allow('getUserOptions');
		$this->Auth->allow('getProductName');
		
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}
	

	public function index() {
		$this->layout = 'admin';
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	public function getProducts() {
	    //$this->layout = 'json';
		$this->Product->recursive = -1;
		$products = $this->Product->find('all', array('order'=>'Product.short_name ASC', 'conditions'=>array('active'=>'1'), 'fields' => array('id','short_name', 'long_name','omniture_name', 'product_name')));
		// $this->set('products', $products);
		return $products;
	}
	
	public function getProductName($id) {
	    $this->layout = 'json';
		$this->Product->recursive = -1;
		
		$products = $this->Product->find('all', array(
		'order'=>'Product.short_name ASC', 
		'conditions'=>array('id'=>'7'), 
		'fields' => array('long_name')
		));
		return $products;
	}
	
 
	
	
	
	
	public function getUserOptions() {
		$this->layout = 'json';
		$this->Product->recursive = -1;
		//$options = $this->Product->query("SELECT * FROM prospects where first_name='Jon';");		
		$options = $this->Product->find('all', array('fields' => array('id','long_name'),'conditions'=>array('short_name'=>'Auto')));	
		return $options;
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->set('product', $this->Product->read(null, $id));		
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$users = $this->Product->User->find('list');
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved - WOHOOO'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Product->read(null, $id);
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('Product deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
