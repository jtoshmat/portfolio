<?php
App::uses('CnaCronJob', 'Model');

/**
 * CnaCronJob Test Case
 *
 */
class CnaCronJobTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cna_cron_job',
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
		$this->CnaCronJob = ClassRegistry::init('CnaCronJob');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CnaCronJob);

		parent::tearDown();
	}

}
