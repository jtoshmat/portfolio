<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property User $User
 * @property Product $Product
 * @property AnswerType $AnswerType
 * @property ProspectResponse $ProspectResponse
 * @property Response $Response
 */
class MyQuestion extends AppModel {
	
	
	public $hasMany = array(
		'ProspectResponse' => array(
			'className' => 'ProspectResponse',
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
	);
}