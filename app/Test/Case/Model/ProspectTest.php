<?php
App::uses('Prospect', 'Model');

/**
 * Prospect Test Case
 *
 */
class ProspectTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prospect',
		'app.state'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Prospect = ClassRegistry::init('Prospect');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Prospect);

		parent::tearDown();
	}

}
