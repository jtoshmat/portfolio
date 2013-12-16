<?php
/**
 * ProspectResponseFixture
 *
 */
class ProspectResponseFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'prospect_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'products' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'business_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'question_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'response_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0 or 1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'prospect_id' => 1,
			'products' => 'Lorem ipsum dolor sit amet',
			'business_id' => 1,
			'question_id' => 1,
			'response_id' => 1,
			'active' => 1,
			'created' => '2013-11-01 17:01:17',
			'modified' => '2013-11-01 17:01:17'
		),
	);

}
