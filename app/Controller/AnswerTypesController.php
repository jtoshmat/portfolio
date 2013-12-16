<?php
App::uses('AppController', 'Controller');
/**
 * AnswerTypes Controller
 *
 * @property AnswerType $AnswerType
 */
class AnswerTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AnswerType->recursive = 0;
		$this->set('answerTypes', $this->paginate());
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
		$this->AnswerType->id = $id;
		$this->layout = 'admin';
		if (!$this->AnswerType->exists()) {
			throw new NotFoundException(__('Invalid answer type'));
		}
		$this->set('answerType', $this->AnswerType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->AnswerType->create();
			
			if ($this->AnswerType->save($this->request->data)) {
				$this->Session->setFlash(__('The answer type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The answer type could not be saved. Please, try again.'));
			}
		}
		$users = $this->AnswerType->User->find('list');
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
		$this->AnswerType->id = $id;
		$this->layout = 'admin';
		if (!$this->AnswerType->exists()) {
			throw new NotFoundException(__('Invalid answer type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AnswerType->save($this->request->data)) {
				$this->Session->setFlash(__('The answer type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The answer type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AnswerType->read(null, $id);
		}
		$users = $this->AnswerType->User->find('list');
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
		$this->AnswerType->id = $id;
		if (!$this->AnswerType->exists()) {
			throw new NotFoundException(__('Invalid answer type'));
		}
		if ($this->AnswerType->delete()) {
			$this->Session->setFlash(__('Answer type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Answer type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
