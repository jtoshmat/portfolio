<?php
App::uses('AppController', 'Controller');
/**
 * FrontProducts Controller
 *
 * @property FrontProduct $FrontProduct
 * @property PaginatorComponent $Paginator
 */
class FrontProductsController extends AppController {

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
		$this->FrontProduct->recursive = 0;
		$this->set('frontProducts', $this->Paginator->paginate());
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
		if (!$this->FrontProduct->exists($id)) {
			throw new NotFoundException(__('Invalid front product'));
		}
		$options = array('conditions' => array('FrontProduct.' . $this->FrontProduct->primaryKey => $id));
		$this->set('frontProduct', $this->FrontProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->FrontProduct->create();
			if ($this->FrontProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The front product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The front product could not be saved. Please, try again.'));
			}
		}
		$prospects = $this->FrontProduct->Prospect->find('list');
		$this->set(compact('prospects'));
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
		if (!$this->FrontProduct->exists($id)) {
			throw new NotFoundException(__('Invalid front product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FrontProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The front product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The front product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FrontProduct.' . $this->FrontProduct->primaryKey => $id));
			$this->request->data = $this->FrontProduct->find('first', $options);
		}
		$prospects = $this->FrontProduct->Prospect->find('list');
		$this->set(compact('prospects'));
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
		$this->FrontProduct->id = $id;
		if (!$this->FrontProduct->exists()) {
			throw new NotFoundException(__('Invalid front product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FrontProduct->delete()) {
			$this->Session->setFlash(__('The front product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The front product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function get_products($pid = null) {
		$this->layout = 'admin';
		if ($pid== null) {
			return false;
		}
		$options = array('conditions' => array('FrontProduct.prospect_id' => $pid));
		$output = $this->FrontProduct->find('all', $options);
		$this->set("myproducts",$output);
		return $output;
	}


}
