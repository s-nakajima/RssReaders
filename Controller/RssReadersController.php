<?php
/**
 * RssReaders Controller
 *
 * @property RssReader $RssReader
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

//App::uses('Xml', 'Utility');
App::uses('RssReadersAppController', 'RssReaders.Controller');

/**
 * RssReaders Controller
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\RssReaders\Controller
 */
class RssReadersController extends RssReadersAppController {

/**
 * Model name
 *
 * @var    array
 */
	public $uses = array(
		'Comments.Comment',
		'RssReaders.RssReader',
		'RssReaders.RssReaderFrameSetting'
	);

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsFrame',
		'NetCommons.NetCommonsWorkflow',
		'NetCommons.NetCommonsRoomRole' => array(
			//コンテンツの権限設定
			'allowedActions' => array(
				'contentEditable' => array('edit')
			),
		),
	);

/**
 * helpers
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.Token'
		//'RssReaders.RssReader'
	);

/**
 * index
 *
 * @return CakeResponse
 */
	public function index() {
		$this->view = 'RssReaders/view';
		$this->view();
	}

/**
 * view
 *
 * @return void
 */
	public function view() {
		$this->__initRssReader();

		if ($this->request->is('ajax')) {
			$tokenFields = Hash::flatten($this->request->data);
			$hiddenFields = array(
				'RssReader.block_id',
				'RssReader.key'
			);
			$this->set('tokenFields', $tokenFields);
			$this->set('hiddenFields', $hiddenFields);
			$this->renderJson();
		} else {
			if ($this->viewVars['contentEditable']) {
				$this->view = 'RssReader/viewForEditor';
			}
		}
	}

/**
 * edit
 *
 * @return void
 */
	public function edit() {
//		return $this->render('RssReaders/form', false);
	}

/**
 * __initRssReader method
 *
 * @return void
 */
	private function __initRssReader() {
		if (!$rssReader = $this->RssReader->getRssReader(
			$this->viewVars['blockId'],
			$this->viewVars['contentEditable']
		)) {
			$rssReader = $this->RssReader->create();
		}
		$comments = $this->Comment->getComments(
			array(
				'plugin_key' => 'rss_readers',
				'content_key' => isset($rssReader['RssReader']['key']) ? $rssReader['RssReader']['key'] : null,
			)
		);

		$results = array(
			'rssReader' => $rssReader['RssReader'],
			'comments' => $comments,
			'contentStatus' => $rssReader['RssReader']['status'],
		);
		$results = $this->camelizeKeyRecursive($results);
		$this->set($results);
	}

}
