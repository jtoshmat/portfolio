<?php
App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 */
 
 
 

class OptionsController extends AppController {

/**
 * index method
 *
 * @return void
 */

	public function beforeFilter() {
	    parent::beforeFilter();
		$this->Auth->allow('getUserOptions');
		$this->Auth->allow('getQuestionsOptions');
		$this->Auth->allow('getQuestionsByProduct');
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}

	//get selected products from prospect_products table
	public function getUserOptions($id) {
		if (is_numeric($id)==false){
			return false;
		}
		$this->layout = 'json';
		$this->Option->recursive = -1;
		$output = $this->Option->find('all', array(
			'conditions'=>array('prospect_id'=>$id),
			'fields'=>array('id','product_id','prospect_id'),
			'order' => array('product_id asc')
			)
		);
		return $output;
	}
	
	//get the questions that belong to products from questions table
	public function getQuestionsOptions($id) {
/*		//get the products from above functions
		$products[] = $this->getUserOptions($id);
		$id = array();
		$i=0;
		foreach($products[0] as $k){			
			$id[$i] = $k['Option']['product_id'];	
			$i++;
		}		
		//import the Question model to search questions for products
		App::import('model','QuestionForm');
		$attr = new QuestionForm();
		$output = $attr->find('all', array('conditions' => array(
			'product_id' => $id,'active'=>1),
			'order' => array('product_id asc')		
			)
		);	
		//$output = $attr->find('all', array('conditions' => array("product_id" => array(1, 2, 3, 4))));	
		return $output;	*/	
	}
	
	//created by Jon Toshmatov on 3/13/2013
	
	//get the questions that belong to products from questions table
	public function getQuestionsByProduct($pid) {
		unset($output);
		$this->layout = 'json';
		$this->Option->recursive = -1;
		App::import('model','QuestionForm');
		$attr = new QuestionForm();		
		$output = $attr->find('all', array('conditions' => array('product_id' =>$pid,'active'=>1),'order' => array('product_id asc')));
		return $output;		
	}
 

 

 
 }
