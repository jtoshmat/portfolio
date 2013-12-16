<?php
App::uses('ResponseAnswer', 'Model');

/**
 * ResponseAnswer Test Case
 *
 */
class ResponseAnswerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.response_answer',
		'app.user',
		'app.group',
		'app.post',
		'app.response',
		'app.html_input',
		'app.business_question',
		'app.business',
		'app.question',
		'app.question_response',
		'app.custom',
		'app.front_question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ResponseAnswer = ClassRegistry::init('ResponseAnswer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ResponseAnswer);

		parent::tearDown();
	}

}
