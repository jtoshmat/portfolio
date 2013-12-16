<?php
App::uses('AppModel', 'Model');
/**
 * Response Model
 *
 * @property User $User
 * @property Question $Question
 * @property Prospect $Prospect
 */
class MyResponse extends AppModel {
public $name = 'response'; //<---- MUST HAVE TABLE NAME
	
	public $hasAndBelongsToMany = array(
		'ProspectResponse' => array(
			'className' => 'ProspectResponse',
			'joinTable' => 'prospect_responses',
			'foreignKey' => 'question_id',
			'associationForeignKey' => 'prospect_id',	
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
		)
	);

}
	
