<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.group',
		'app.answer_type',
		'app.question',
		'app.product',
		'app.prospect',
		'app.state',
		'app.language',
		'app.origin_type',
		'app.device_type',
		'app.prospect_product',
		'app.prospect_response',
		'app.response',
		'app.login_entry'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
