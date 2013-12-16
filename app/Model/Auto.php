<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property User $User
 * @property Question $Question
 * @property Prospect $Prospect
 */



class Auto extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

 public $useTable = 'carquery';


  /**
 * belongsTo associations
 *
 * @var array
 */

	public $belongsTo = array(

	);


	/**
 * hasMany associations
 *
 * @var array
 */
/*		public $hasAndBelongsToMany = array(
		'ProspectProduct' => array(
			'className' => 'ProspectProduct',
			'joinTable' => 'prospect_products',
			'foreignKey' => 'prospect_id',
			'associationForeignKey' => 'product_id',
			'unique' => 'false',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Response' => array(
			'className' => 'Response',
			'foreignKey' => 'question_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);*/


}//end of class Option
