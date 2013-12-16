<?php
App::uses('BusinessQuestion', 'Model');

/**
 * BusinessQuestion Test Case
 *
 */
class BusinessQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.business_question',
		'app.business',
		'app.user',
		'app.group',
		'app.post',
		'app.question',
		'app.question_response',
		'app.response'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BusinessQuestion = ClassRegistry::init('BusinessQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BusinessQuestion);

		parent::tearDown();
	}

}
