<?php
App::uses('AppController', 'Controller');
/**
 * ProspectResponses Controller
 *
 * @property ProspectResponse $ProspectResponse
 * @property PaginatorComponent $Paginator
 */
class ProspectResponsesController extends AppController {

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
		$this->ProspectResponse->recursive = 0;
		$this->set('prospectResponses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProspectResponse->exists($id)) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		$options = array('conditions' => array('ProspectResponse.' . $this->ProspectResponse->primaryKey => $id));
		$this->set('prospectResponse', $this->ProspectResponse->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$bid = null;
			$this->request->data = str_replace("'","",$this->request->data);

			//get Business id
			  foreach ($this->request->data['ProspectResponse'] as $pr){
			  	if (isset($pr['business_id'])){
			  		$bid = $pr['business_id'];
			  		$pid = $pr['prospect_id'];
			  		break;
			  	}
			  }
			  if (is_numeric($bid)==false){
			  	return $this->Session->setFlash(__('Business id is blank.'));
			  }

			  $all= Array();
			  //find duplicate before save
			  $i=0;



			  foreach ($this->request->data['ProspectResponse'] as $pr){
			  	$pid = $pr['prospect_id'];
			  	$bid = $pr['business_id'];
			  	$qid = $pr['question_id'];
			  	$rid =  $pr['responseid'];
			  	$question = $this->request->data['ProspectResponse'][$qid]['question'];
			  	$business = $this->request->data['ProspectResponse'][$qid]['business'];
			  	$prospect_answer = (isset($this->request->data['ProspectResponse'][$qid]['prospect_answer']))?$this->request->data['ProspectResponse'][$qid]['prospect_answer']:null;

			  	$business = str_replace("'", "\'", $business);
			  	$question = str_replace("'", "\'", $question);

			  	$all['prospect_id'] = $pid;
			  	$all['business_id'] = $bid;
			  	$all['question_id'][$qid] = $prospect_answer;

				$existing = $this->ProspectResponse->query("SELECT * from prospect_responses WHERE prospect_id = {$pid} and question = '".$question."' and business = '".$business."'  ");
				$id = (isset($existing[0]['prospect_responses']['id']))?$existing[0]['prospect_responses']['id']:null;

 				if (count($existing)==0){
 					$this->ProspectResponse->create();
 					$this->ProspectResponse->saveAll($this->request->data['ProspectResponse'][$qid], array('validate' => 'first','validate' => true, 'deep' => true));
 					$this->Session->write('CNA.qid', $all);
 				}else{
 					$this->ProspectResponse->id = $id;
 					$this->Session->write('CNA.qid', $all);
					$this->ProspectResponse->save($this->request->data['ProspectResponse'][$qid]);
 				}

 				$i++;
			  }
			 //$this->Session->setFlash(__('The prospect response has been saved.'));
			 return $this->redirect(array('controller'=>'pages',
			 'action'=>'display','products',	'?' => array('bid'=>$bid), 'admin'=>false));
		}


		$prospects = $this->ProspectResponse->Prospect->find('list');
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
		if (!$this->ProspectResponse->exists($id)) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProspectResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect response has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prospect response could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProspectResponse.' . $this->ProspectResponse->primaryKey => $id));
			$this->request->data = $this->ProspectResponse->find('first', $options);
		}
		$prospects = $this->ProspectResponse->Prospect->find('list');
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
		$this->ProspectResponse->id = $id;
		if (!$this->ProspectResponse->exists()) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProspectResponse->delete()) {
			$this->Session->setFlash(__('The prospect response has been deleted.'));
		} else {
			$this->Session->setFlash(__('The prospect response could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function prospect_response_find($uid = null) {
		if (!$uid) {
			return false;
		}
		$options = array(
				'conditions' => array('prospect_id' => $uid),
				//'fields' => array('ProspectResponse.id')
				);
		$id = $this->ProspectResponse->find('all',$options);
		return $id;
	}


	public function prospect_edit($id = null) {
		if (!$this->ProspectResponse->exists($id)) {
			throw new NotFoundException(__('Invalid prospect response'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProspectResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The prospect response has been saved.'));
				return $this->redirect(array('controller'=>'pages','action' => 'display','questions'));
			} else {
				$this->Session->setFlash(__('The prospect response could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProspectResponse.' . $this->ProspectResponse->primaryKey => $id));
			$this->request->data = $this->ProspectResponse->find('first', $options);
		}
		$prospects = $this->ProspectResponse->Prospect->find('list');
		$this->set(compact('prospects'));
	}

}
