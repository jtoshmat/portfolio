<?php
App::uses('AppController', 'Controller');
/**
 * SiteSettings Controller
 *
 * @property SiteSetting $SiteSetting
 * @property PaginatorComponent $Paginator
 */
class SiteSettingsController extends AppController {

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
		$this->SiteSetting->recursive = 0;
		$this->set('siteSettings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SiteSetting->exists($id)) {
			throw new NotFoundException(__('Invalid site setting'));
		}
		$options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => $id));
		$this->set('siteSetting', $this->SiteSetting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SiteSetting->create();
			if ($this->SiteSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The site setting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site setting could not be saved. Please, try again.'));
			}
		}
		$users = $this->SiteSetting->User->find('list');
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
		if (!$this->SiteSetting->exists($id)) {
			throw new NotFoundException(__('Invalid site setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SiteSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The site setting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => $id));
			$this->request->data = $this->SiteSetting->find('first', $options);
		}
		$users = $this->SiteSetting->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SiteSetting->id = $id;
		if (!$this->SiteSetting->exists()) {
			throw new NotFoundException(__('Invalid site setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SiteSetting->delete()) {
			$this->Session->setFlash(__('The site setting has been deleted.'));
		} else {
			$this->Session->setFlash(__('The site setting could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
