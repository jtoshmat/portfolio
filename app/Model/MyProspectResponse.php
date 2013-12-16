<?php
App::uses('AppModel', 'Model');
/**
 * ProspectResponse Model
 *
 * @property Prospect $Prospect
 * @property Question $Question
 */
class MyProspectResponse extends AppModel {
public $name = 'prospect_responses'; //<---- MUST HAVE TABLE NAME
//public $primaryKey = 'prospect_response_id';
	
	
}//end of class
