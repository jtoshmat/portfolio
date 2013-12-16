<?php
App::uses('AppModel', 'Model');
/**
 * Language Model
 *
 * @property User $User
 * @property Prospect $Prospect
 */
class Language extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'short_name' => array(
			'notempty' => array(
				'rule' => '/^[a-z]{2}$/',
				'message' => 'Language short name must be two lowercase letters only',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'long_name' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z\ ]{2,}$/',
				'message' => 'Please provide a descriptive name of the language',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Prospect' => array(
			'className' => 'Prospect',
			'foreignKey' => 'language_id',
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
	);

}
