<?php
App::uses('QuestionResponse', 'Model');

/**
 * QuestionResponse Test Case
 *
 */
class QuestionResponseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.question_response',
		'app.question',
		'app.user',
		'app.group',
		'app.post',
		'app.response'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuestionResponse = ClassRegistry::init('QuestionResponse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuestionResponse);

		parent::tearDown();
	}

}
