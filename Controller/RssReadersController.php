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

App::uses('Xml', 'Utility');
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
		//'Frames.Frame',
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
		//'NetCommons.NetCommonsBlock',
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
//		// Frameのデータをviewにセット
//		if (!$this->NetCommonsFrame->setView($this, $frameId)) {
//			throw new ForbiddenException('NetCommonsFrame');
//		}
//
//		// RssReaderの取得
//		$rssReaderData = $this->RssReader->getContent(
//			$this->viewVars['blockId'],
//			$this->viewVars['contentEditable']
//		);
//
//		$rssXmlData = array();
//		if (!empty($rssReaderData)) {
//			// シリアライズされているRSSのデータを配列に戻す
//			$rssSerializeData = $this->RssReader->updateSerializeValue($rssReaderData);
//			$rssXmlData = unserialize($rssSerializeData);
//		}
//		$this->set('rssReaderData', $rssReaderData);
//		$this->set('rssXmlData', $rssXmlData);
//
//		// RssReaderFrameSettingの取得
//		$rssReaderFrameData =
//			$this->RssReaderFrameSetting->getRssReaderFrameSetting($this->viewVars['frameKey']);
//		// RssReaderFrameSettingが存在しない場合は初期化する
//		if (empty($rssReaderFrameData)) {
//			$rssReaderFrameData =
//				$this->RssReaderFrameSetting->createRssReaderFrameSetting($this->viewVars['frameKey']);
//		}
//		$this->set('rssReaderFrameSettingData', $rssReaderFrameData);
//
//		return $this->render('RssReaders/view');
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
 * update RssReader status
 *
 * @return void
 */
	public function update_status() {
//		$saveData = $this->request->data;
//		$this->RssReader->save($saveData);
//
//		$params = array(
//			'name' => __d('net_commons', 'Successfully finished.')
//		);
//		$this->set(compact('params'));
//		$this->set('_serialize', 'params');
//
//		return $this->render(false);
	}
}
