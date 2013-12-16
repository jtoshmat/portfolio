<?php
App::uses('AppModel', 'Model');
/**
 * ProspectResponse Model
 *
 * @property Prospect $Prospect
 */
class ProspectResponse extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'prospect_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
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
		'Prospect' => array(
			'className' => 'Prospect',
			'foreignKey' => 'prospect_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
