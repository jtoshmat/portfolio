<?php
/**
 * CustomFixture
 *
 */
class CustomFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'qid' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'bsn' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'qsn' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'rsn' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'qid' => 1,
			'bsn' => 'Lorem ipsum dolor sit amet',
			'qsn' => 'Lorem ipsum dolor sit amet',
			'rsn' => 'Lorem ipsum dolor sit amet'
		),
	);

}
