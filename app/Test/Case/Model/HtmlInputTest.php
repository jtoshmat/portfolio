<?php
App::uses('HtmlInput', 'Model');

/**
 * HtmlInput Test Case
 *
 */
class HtmlInputTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.html_input',
		'app.response',
		'app.user',
		'app.group',
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HtmlInput = ClassRegistry::init('HtmlInput');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HtmlInput);

		parent::tearDown();
	}

}
