<?php
/**
 * BusinessProductFixture
 *
 */
class BusinessProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'business_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'question_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'response_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
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
			'business_id' => 1,
			'question_id' => 1,
			'response_id' => 1,
			'active' => 1,
			'created' => '2013-10-28 15:33:11',
			'modified' => '2013-10-28 15:33:11'
		),
	);

}
