<?php
App::uses('Cron', 'Model');

/**
 * Cron Test Case
 *
 */
class CronTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cron',
		'app.business',
		'app.user',
		'app.group',
		'app.post',
		'app.business_question',
		'app.question',
		'app.custom',
		'app.response',
		'app.html_input',
		'app.response_answer',
		'app.front_question',
		'app.state',
		'app.prospect',
		'app.pr',
		'app.pr_prospect',
		'app.pr_business',
		'app.pr_question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cron = ClassRegistry::init('Cron');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cron);

		parent::tearDown();
	}

}
