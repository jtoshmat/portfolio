<?php
App::uses('BusinessProduct', 'Model');

/**
 * BusinessProduct Test Case
 *
 */
class BusinessProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.business_product',
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
		$this->BusinessProduct = ClassRegistry::init('BusinessProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BusinessProduct);

		parent::tearDown();
	}

}
