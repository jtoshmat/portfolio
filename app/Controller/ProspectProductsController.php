<?php
App::uses('AppController', 'Controller');
/**
 * ProspectProducts Controller
 *
 * @property ProspectProduct $ProspectProduct
 */
class ProspectProductsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ProspectProduct->recursive = 0;
		$this->set('prospectProducts', $this->paginate());
		$this->layout = 'admin';
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ProspectProduct->id = $id;
		if (!$this->ProspectProduct->exists()) {
			throw new NotFoundException(__('Invalid prospect product'));
		}
		$this->set('prospectProduct', $this->ProspectProduct->read(null, $id));
	}

	public function viewProductsForProspect($prospect_id = null){
		//build array of product for the given id
		$products = $this->Option->find('all', array('conditions'=> array('prospect_id'=>$prospect_id)));
		return $products;
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProspectProduct->create();
			if ($this->ProspectProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect product could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProspectProduct->Product->find('list');
		$prospects = $this->ProspectProduct->Prospect->find('list');
		$this->set(compact('products', 'prospects'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ProspectProduct->id = $id;
		if (!$this->ProspectProduct->exists()) {
			throw new NotFoundException(__('Invalid prospect product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProspectProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect product could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ProspectProduct->read(null, $id);
		}
		$products = $this->ProspectProduct->Product->find('list');
		$prospects = $this->ProspectProduct->Prospect->find('list');
		$this->set(compact('products', 'prospects'));
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
		$this->ProspectProduct->id = $id;
		if (!$this->ProspectProduct->exists()) {
			throw new NotFoundException(__('Invalid prospect product'));
		}
		if ($this->ProspectProduct->delete()) {
			$this->Session->setFlash(__('Prospect product deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Prospect product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
