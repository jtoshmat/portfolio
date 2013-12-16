<?php
App::uses('AppModel', 'Model');
/**
 * Response Model
 *
 * @property User $User
 * @property Question $Question
 * @property Prospect $Prospect
 */
class SaveResponse extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'response_text' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z0-9\ \.\!\@\#\$\%\&\*\(\)\?\,]{2,}$/',
				'message' => 'Please enter an answer',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'question_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please associate your answer to a question',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
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
		)*/
		
	public $hasAndBelongsToMany = array(
		'Prospect' => array(
			'className' => 'Prospect',
			'joinTable' => 'prospect_responses',
			'foreignKey' => 'response_id',
			'associationForeignKey' => 'prospect_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
