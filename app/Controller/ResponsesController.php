<?php
App::uses('AppController', 'Controller');
/**
 * Responses Controller
 *
 * @property Response $Response
 */
class ResponsesController extends AppController {

/**
 * index method
 *
 * @return void
 */

	public function index() {
		$this->layout = 'admin';
		$this->Response->recursive = 0;
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
		$this->Response->id = $id;
		if (!$this->Response->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		$this->set('response', $this->Response->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		$this->Response->recursive = 0;
		if ($this->request->is('post')) {
			$this->Response->create();
			if ($this->Response->save($this->request->data)) {
				$this->Session->setFlash(__('The response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response could not be saved. Please, try again.'));
			}
		}
		$users = $this->Response->User->find('list');
		$questions = $this->Response->Question->find('all');
		
		$this->set(compact('users', 'questions'));
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
		$this->Response->recursive = 0;
		$this->Response->id = $id;
		if (!$this->Response->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Response->save($this->request->data)) {
				$this->Session->setFlash(__('The response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Response->read(null, $id);
		}
		$users = $this->Response->User->find('list');
		$questions = $this->Response->Question->find('all');
		
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
		$this->Response->id = $id;
		if (!$this->Response->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		if ($this->Response->delete()) {
			$this->Session->setFlash(__('Response deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Response was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
