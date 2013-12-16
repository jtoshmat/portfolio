<?php
App::uses('AppModel', 'Model');
/**
 * Prospect Model
 *
 * @property State $State
 * @property Language $Language
 * @property OriginType $OriginType
 * @property DeviceType $DeviceType
 * @property ProspectProduct $ProspectProduct
 * @property ProspectResponse $ProspectResponse
 */
class Emailprospectresponse extends AppModel {
	public $useTable = 'prospect_responses';

	public $belongsTo = array(
			'Question' => array(
					'className' => 'Question',
					'foreignKey' => 'question_id',
					'fields' => array('id','question_text'),
					'order' => ''
			)

	);






}
