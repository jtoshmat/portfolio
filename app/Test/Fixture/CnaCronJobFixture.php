<?php
/**
 * CnaCronJobFixture
 *
 */
class CnaCronJobFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'primary'),
		'business_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'business_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'address2' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'city' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'state_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'zip_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'best_time_to_call' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'website' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'comefrom' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'agent' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'pr_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'pr_prospect_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'products' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'business' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'pr_business_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'question' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'pr_question_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'responseid' => array('type' => 'integer', 'null' => true, 'default' => null),
		'prospect_answer' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'run_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'business_name' => 'Lorem ipsum dolor sit amet',
			'business_id' => 1,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet',
			'address2' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'state_id' => 1,
			'zip_code' => 'Lor',
			'email' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ips',
			'best_time_to_call' => 'Lorem ipsum dolor sit amet',
			'website' => 'Lorem ipsum dolor sit amet',
			'comefrom' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'agent' => 'Lorem ipsum dolor sit amet',
			'modified' => '2013-12-13 11:42:06',
			'pr_id' => 1,
			'pr_prospect_id' => 1,
			'products' => 'Lorem ipsum dolor sit amet',
			'business' => 'Lorem ipsum dolor sit amet',
			'pr_business_id' => 1,
			'question' => 'Lorem ipsum dolor sit amet',
			'pr_question_id' => 1,
			'responseid' => 1,
			'prospect_answer' => 'Lorem ipsum dolor sit amet',
			'run_time' => '2013-12-13 11:42:06'
		),
	);

}
