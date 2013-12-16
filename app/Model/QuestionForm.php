<?php
App::uses('AppModel', 'Model');
class QuestionForm extends AppModel {
//public $useTable = 'questions';
var $name = "questions";


	public $belongsTo = array(
		'AnswerType' => array(
			'className' => 'AnswerType',
			'foreignKey' => 'answer_type_id',
			'conditions' => '',
			'fields' => 'type',
			'order' => ''
		),
		
	);
	
		public $hasMany = array(
			'QuestionForm' => array(
			'className' => 'Response',
			'foreignKey' => 'question_id',
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
