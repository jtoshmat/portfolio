<?php
App::uses('AppModel', 'Model');
/**
 * DeviceType Model
 *
 * @property User $User
 * @property Prospect $Prospect
 */
class DeviceType extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'device_type_name' => array(
			'notempty' => array(
				'rule' => '/^[a-z]{2,}$/',
				'message' => 'Device Type Name should be lowercase letters only',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z0-9\-\_\+\=\!\#\$\%\&\*\(\)\@\,\.\?\ ]{2,}$/',
				'message' => 'Please provide a description of the device',
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
			'foreignKey' => 'device_type_id',
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
