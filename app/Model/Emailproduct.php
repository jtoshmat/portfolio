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
class Emailproduct extends AppModel {
	public $useTable = 'questions';

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => 'long_name',
			'order' => ''
		)
	);






}
