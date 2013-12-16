<?php
App::uses('FrontQuestion', 'Model');

/**
 * FrontQuestion Test Case
 *
 */
class FrontQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.front_question',
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
		$this->FrontQuestion = ClassRegistry::init('FrontQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FrontQuestion);

		parent::tearDown();
	}

}
