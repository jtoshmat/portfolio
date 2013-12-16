<?php
App::uses('Custom', 'Model');

/**
 * Custom Test Case
 *
 */
class CustomTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.custom'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Custom = ClassRegistry::init('Custom');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Custom);

		parent::tearDown();
	}

}
