<?php
App::uses('AppModel', 'Model');
/**
* ProspectResponse Model
*
* @property Prospect $Prospect
* @property Question $Question
*/
class MySearch extends AppModel {
public $name = 'ProspectResponse';
/**
* Primary key field
*
* @var string
*/
public $primaryKey = 'prospect_response_id';
 

//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
* belongsTo associations
*
* @var array
*/
public $belongsTo = array(
	'ProspectResponse' => array(
	'className' => 'ProspectResponse',
	'foreignKey' => 'prospect_id',
	'conditions' => '',
	'fields' => '',
	'order' => ''
)
);
 
 


}