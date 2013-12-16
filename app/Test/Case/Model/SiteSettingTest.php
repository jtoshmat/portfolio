<?php
App::uses('SiteSetting', 'Model');

/**
 * SiteSetting Test Case
 *
 */
class SiteSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_setting',
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
		$this->SiteSetting = ClassRegistry::init('SiteSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteSetting);

		parent::tearDown();
	}

}
