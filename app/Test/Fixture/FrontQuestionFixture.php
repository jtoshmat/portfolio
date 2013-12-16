<?php
/**
 * FrontQuestionFixture
 *
 */
class FrontQuestionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'buid' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'short_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'question' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'response' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'business_question_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'business_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'question_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'response_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'qid' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'primary'),
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
			'buid' => 1,
			'short_name' => 'Lorem ipsum dolor sit amet',
			'question' => 'Lorem ipsum dolor sit amet',
			'response' => 'Lorem ipsum dolor sit amet',
			'business_question_id' => 1,
			'business_id' => 1,
			'question_id' => 1,
			'response_id' => 1,
			'qid' => 1,
			'id' => 1
		),
	);

}
