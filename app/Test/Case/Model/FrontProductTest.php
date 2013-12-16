<?php
App::uses('FrontProduct', 'Model');

/**
 * FrontProduct Test Case
 *
 */
class FrontProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.front_product',
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
		$this->FrontProduct = ClassRegistry::init('FrontProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FrontProduct);

		parent::tearDown();
	}

}
