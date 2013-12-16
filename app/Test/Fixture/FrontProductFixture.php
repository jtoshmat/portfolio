<?php
/**
 * FrontProductFixture
 *
 */
class FrontProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'primary'),
		'prospect_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'products' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'business' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'question' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'responseid' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'prospect_answer' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0 or 1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			
		),
		'tableParameters' => array()
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
			'business' => 'Lorem ipsum dolor sit amet',
			'question' => 'Lorem ipsum dolor sit amet',
			'responseid' => 'Lorem ipsum dolor sit amet',
			'prospect_answer' => 'Lorem ipsum dolor sit amet',
			'active' => 1,
			'created' => '2013-11-05 15:36:30',
			'modified' => '2013-11-05 15:36:30'
		),
	);

}
