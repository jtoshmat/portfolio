<?php
App::uses('AppController', 'Controller');
/**
 * OriginTypes Controller
 *
 * @property OriginType $OriginType
 */
class OriginTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout = 'admin';
		$this->OriginType->recursive = 0;
		$this->set('originTypes', $this->paginate());
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
		$this->OriginType->id = $id;
		if (!$this->OriginType->exists()) {
			throw new NotFoundException(__('Invalid origin type'));
		}
		$this->set('originType', $this->OriginType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->OriginType->create();
			if ($this->OriginType->save($this->request->data)) {
				$this->Session->setFlash(__('The origin type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The origin type could not be saved. Please, try again.'));
			}
		}
		$users = $this->OriginType->User->find('list');
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
		$this->OriginType->id = $id;
		if (!$this->OriginType->exists()) {
			throw new NotFoundException(__('Invalid origin type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OriginType->save($this->request->data)) {
				$this->Session->setFlash(__('The origin type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The origin type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->OriginType->read(null, $id);
		}
		$users = $this->OriginType->User->find('list');
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
		$this->OriginType->id = $id;
		if (!$this->OriginType->exists()) {
			throw new NotFoundException(__('Invalid origin type'));
		}
		if ($this->OriginType->delete()) {
			$this->Session->setFlash(__('Origin type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Origin type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
