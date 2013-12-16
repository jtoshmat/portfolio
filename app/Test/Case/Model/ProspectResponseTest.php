<?php
App::uses('ProspectResponse', 'Model');

/**
 * ProspectResponse Test Case
 *
 */
class ProspectResponseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prospect_response',
		'app.prospect',
		'app.state',
		'app.business',
		'app.user',
		'app.group',
		'app.post',
		'app.business_question',
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
		$this->ProspectResponse = ClassRegistry::init('ProspectResponse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProspectResponse);

		parent::tearDown();
	}

}
