<?php
App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 */




class AutosController extends AppController {

/**
 * index method
 *
 * @return void
 */

	public function beforeFilter() {
	    parent::beforeFilter();
		$this->Auth->allow('getAutos');
		$this->Auth->allow('getMake');
		$this->Auth->allow('getModel');
		$this->Auth->allow('getTrim');
	    $this->Auth->deny('index', 'view','edit','delete','add');
	}




	//created by Jon Toshmatov on 7/25/2013


	public function getAutos() {
	    $this->layout = 'json';
		$this->Auto->recursive = 2;
		$autos = $this->Auto->find('all', array(
				'fields' =>('DISTINCT model_year'),
				'order' =>('model_year desc')
		));
		return $autos;
 	}

 	public function getMake() {
 		$year = $this->request->data['year'];
 		$this->layout = 'json';
 		$this->Auto->recursive = 2;
		$make = $this->Auto->find('all', array(
				'conditions'=>array('model_year'=>''.$year.''),
				'fields' =>('DISTINCT model_make_id'),
				'order' =>('model_make_id asc')
		));
		$this->set('make', $make);
 		return $make;
 	}

 	public function getModel() {
 		$make = $this->request->data['make'];
 		$year = $this->request->data['year'];
 		$this->layout = 'json';
 		$this->Auto->recursive = 2;
 		$model = $this->Auto->find('all', array(
 				'conditions'=>array('model_make_id'=>''.$make.'','model_year'=>''.$year.''),
 				'fields' =>('DISTINCT model_name'),
 				'order' =>('model_name asc')
 		));
 		$this->set('model', $model);
 		return $model;
 	}

 	public function getTrim() {
 		$model = $this->request->data['model'];
 		$year = $this->request->data['year'];
 		$this->layout = 'json';
 		$this->Auto->recursive = 2;
 		$trim = $this->Auto->find('all', array(
 				'conditions'=>array('model_name'=>''.$model.'','model_year'=>''.$year.''),
 				'fields' =>('DISTINCT model_trim'),
 				'order' =>('model_trim asc')
 		));
 		$this->set('trim', $trim);
 		return $trim;
 	}




 }
