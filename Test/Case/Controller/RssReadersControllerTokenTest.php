<?php
/**
 * RssReadersControllerToken Test Case
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('RssReadersController', 'RssReaders.Controller');
App::uses('NetCommonsFrameComponent', 'NetCommons.Controller/Component');
App::uses('NetCommonsBlockComponent', 'NetCommons.Controller/Component');
App::uses('NetCommonsRoomRoleComponent', 'NetCommons.Controller/Component');

/**
 * Summary for RssReadersControllerToken Test Case
 */
class RssReadersControllerTokenTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.rss_readers.rss_reader',
		'plugin.rss_readers.rss_reader_frame_setting',
		'plugin.rss_readers.block',
		'plugin.rss_readers.frame',
		'plugin.rss_readers.site_setting',
		'plugin.rss_readers.box',
		'plugin.rss_readers.plugin',
		'plugin.rss_readers.language',
		'plugin.rooms.room',
		'plugin.rooms.roles_rooms_user',
		'plugin.roles.default_role_permission',
		'plugin.rooms.roles_room',
		'plugin.rooms.room_role_permission',
		'plugin.rooms.user',
		'plugin.pages.page'
	);

/**
 * setUp
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		Configure::write('Config.language', 'ja');
		$this->__login();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		Configure::write('Config.language', null);
		parent::tearDown();
		$this->__logout();
	}

/**
 * authUserCallback method
 *
 * @return array user
 */
	public function authUserCallback() {
		$user = array(
			'id' => 1,
			'username' => 'admin',
			'role_key' => 'system_administrator'
		);
		CakeSession::write('Auth.User', $user);
		return $user;
	}

/**
 * test getEditToken
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @return void
 */
	public function testGetEditToken() {
		$frameId = 1;
		$this->testAction('/rss_readers/rss_readers/getEditToken/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextContains('data[RssReader][url]', $this->view);
		$this->assertTextContains('data[RssReader][title]', $this->view);
		$this->assertTextContains('data[RssReader][link]', $this->view);
		$this->assertTextContains('data[RssReader][cache_time]', $this->view);
		$this->assertTextContains('data[RssReader][id]', $this->view);
		$this->assertTextContains('data[Block][id]', $this->view);
		$this->assertTextContains('data[Block][room_id]', $this->view);
		$this->assertTextContains('data[Block][language_id]', $this->view);
		$this->assertTextContains('data[Frame][id]', $this->view);
	}

/**
 * test getEditToken case not exist frame
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @return void
 */
	public function testGetEditTokenNotExistFrame() {
		$frameId = 999;
		try {
			$this->testAction('/rss_readers/rss_readers/getEditToken/' . $frameId . '/', array('method' => 'get'));
		} catch (ForbiddenException $e) {
			$this->assertEquals('NetCommonsFrame', $e->getMessage());
		}
	}

/**
 * test getRssInfoToken
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @return void
 */
	public function testGetRssInfoToken() {
		$frameId = 1;
		$this->testAction('/rss_readers/rss_readers/getRssInfoToken/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextContains('data[RssReader][url]', $this->view);
	}

/**
 * test getUpdateStatusToken
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @return void
 */
	public function testGetUpdateStatusToken() {
		$frameId = 1;
		$this->testAction('/rss_readers/rss_readers/getUpdateStatusToken/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextContains('data[RssReader][id]', $this->view);
		$this->assertTextContains('data[RssReader][status]', $this->view);
	}

/**
 * login　method
 *
 * @return void
 */
	private function __login() {
		// ログイン処理
		$this->Controller = $this->generate(
			'RssReaders.RssReaders',
			array(
				'components' => array(
					'Auth' => array('user'),
					'Session',
					'Security',
					'RequestHandler'
				)
			)
		);

		$this->Controller->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnCallback(array($this, 'authUserCallback')));

		$this->Controller->Auth->login(array(
				'username' => 'admin',
				'password' => 'admin',
				'role_key' => 'system_administrator'
			)
		);
		$this->assertTrue($this->Controller->Auth->loggedIn(), 'login');
	}

/**
 * logout method
 *
 * @return void
 */
	private function __logout() {
		// ログアウト処理
		$this->Controller->Auth->logout();
		$this->assertFalse($this->Controller->Auth->loggedIn(), 'logout');

		CakeSession::write('Auth.User', null);
		unset($this->Controller);
	}

}
