<?php
App::uses('AppController', 'Controller');
/**
 * DeviceTypes Controller
 *
 * @property DeviceType $DeviceType
 */
class DeviceTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DeviceType->recursive = 0;
		$this->set('deviceTypes', $this->paginate());
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
		$this->DeviceType->id = $id;
		$this->layout = 'admin';
		if (!$this->DeviceType->exists()) {
			throw new NotFoundException(__('Invalid device type'));
		}
		$this->set('deviceType', $this->DeviceType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->DeviceType->create();
			if ($this->DeviceType->save($this->request->data)) {
				$this->Session->setFlash(__('The device type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The device type could not be saved. Please, try again.'));
			}
		}
		$users = $this->DeviceType->User->find('list');
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
		$this->DeviceType->id = $id;
		$this->layout = 'admin';
		if (!$this->DeviceType->exists()) {
			throw new NotFoundException(__('Invalid device type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DeviceType->save($this->request->data)) {
				$this->Session->setFlash(__('The device type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The device type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->DeviceType->read(null, $id);
		}
		$users = $this->DeviceType->User->find('list');
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
		$this->DeviceType->id = $id;
		if (!$this->DeviceType->exists()) {
			throw new NotFoundException(__('Invalid device type'));
		}
		if ($this->DeviceType->delete()) {
			$this->Session->setFlash(__('Device type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Device type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
