<?php
App::uses('AppController', 'Controller');
/**
 * Responses Controller
 *
 * @property Response $Response
 */
class SaveResponsesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('createResponse');
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}
	
	public function index() {
		$this->layout = 'admin';
		$this->SaveResponse->recursive = 0;
		$this->set('responses', $this->paginate());
	}


/**
 * Save responses method
 * Created by Jon Toshmatov
 * 3/7/2013
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	public function createResponse(){
		$this->layout = 'json';
		$this->SaveResponse->recursive = 2;		
		if($this->request->is('post') && !empty($this->request->data)){		 
			$this->SaveResponse->create();
			
				//saving the data to db
				
			            /*
             * Acceptable format for products: Jon Toshmatov 03/02/2013
             $this->request->data['ProspectProduct']=array("product[0]" => "1", "product[1]" => "2", "product[2]" => "3");
				[ProspectProduct] => Array
			        (
			            [product[0]] => 1
			            [product[1]] => 2
			            [product[2]] => 3
			        )
             */
		 
				$this->request->data['Response']['response_text']=99;
				$this->request->data['Response']['active']=1;
				$this->request->data['Response']['question_id']=1;
				$this->request->data['Response']['user_id']=19;
				
				$this->request->data['ProspectResponse']['response_value']=99;
				$this->request->data['ProspectResponse']['active']=1;
				$this->request->data['ProspectResponse']['prospect_id']=1;
				
				
				$this->SaveResponse->saveAll($this->request->data, array('atomic' => 'false'));
				$this->set('responses', $this->SaveResponse->id);	
				 		 
				 print_r($this->request->data);

			
			//Jon's test area starts
/*			$this->set('responses', 99);
			return 999999;	
			echo "<pre>";
			print_r($this->request->data);*/
			
			//Jon's test area ends
				 
		}
		else {
			$return = 'Requets must be in a post method';
		}
	}	

}
