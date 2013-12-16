<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$current_id = parent::get_user();
		// For CakePHP 2.0
		//$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		//$this->Auth->allow();

		//$this->Auth->allow('index');
		$this->Auth->allow('initDB'); // We can remove this line after we're finished

		$this->Auth->deny('index');
		if ($this->Auth->loggedIn()){
			if ($current_id['group_id']==1){
				$this->Auth->allow();//Admin is the highest role in the project adn ca
			}else{
				$this->Auth->deny(array('users'=>'index'));
				$this->Auth->deny(array('users'=>'view'));
				$this->Auth->allow(array('users'=>'profile'));//everybody can view their owb profile

			}


			$this->Auth->allow('show_message');
		}

	}

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
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

		public function login() {
			$this->layout = 'admin';
		    if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		            //return $this->redirect($this->Auth->redirect());
		        	return $this->redirect(array('controller'=>'customs','action'=>'index'));
		        }
		        $this->Session->setFlash(__('Your username or password was incorrect.'));
		    }
		}

	public function logout() {
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}

	public function initDB() {
		$group = $this->User->Group;
		//Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');
		//allow sta for ui only
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		//allow report users for report only
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}


	public function profile($id = null) {
		$this->layout = 'admin';
		if ($id==null){return false;}
		$current_id = parent::get_user();

		if ($current_id['id']!=$id && $current_id['group_id']!=1){
			$this->Session->setFlash(__('You are not authorized to view others profiles'));
			$this->redirect(array("controller" => "errors","action" => "index"));
			return false;
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		return $this->User->find('first', $options);
	}

	public function profile_edit($id = null) {
		$this->layout = 'admin';

		if ($this->request->is(array('post', 'put'))) {
			return 1;
		}

	}


	public function show_message($msg = null){
		return  $this->Session->setFlash('');
	}



}//end of class
