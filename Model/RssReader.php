<?php
/**
 * RssReader Model
 *
 * @property RssReader $RssReader
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('RssReadersAppModel', 'RssReaders.Model');

/**
 * RssReader Model
 *
 * @author Kosuke Miura <k_miura@zenk.co.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\RssReaders\Model
 */
class RssReader extends RssReadersAppModel {

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.Publishable'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * belongsTo associations
 *
 * @var    array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge($this->validate, array(
			'block_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('net_commons', 'Invalid request.'),
					'allowEmpty' => false,
					'required' => true,
				)
			),
			'key' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),

			//status to set in PublishableBehavior.

			'link' => array(
				'url' => array(
					'rule' => 'url',
					'message' => __d('net_commons', 'Invalid request.'),
					'allowEmpty' => false,
					'required' => true,
				)
			),
		));

		return parent::beforeValidate($options);
	}

/**
 * Get rss reader
 *
 * @param int $blockId blocks.id
 * @param bool $contentEditable true can edit the content, false not can edit the content.
 * @return array $rssReader
 */
	public function getRssReader($blockId, $contentEditable) {
		$conditions = array(
			'block_id' => $blockId,
		);
		if (! $contentEditable) {
			$conditions['status'] = NetCommonsBlockComponent::STATUS_PUBLISHED;
		}

		$rssReader = $this->find('first', array(
			'recursive' => -1,
			'conditions' => $conditions,
			'order' => 'Announcement.id DESC',
		));

		return $rssReader;



//		$conditions = array(
//			'block_id' => $blockId
//		);
//		if (!$editable) {
//			$conditions['status'] = NetCommonsBlockComponent::STATUS_PUBLISHED;
//		}
//
//		$rssReader = $this->find(
//			'first',
//			array(
//				'conditions' => $conditions,
//				'order' => $this->name . '.id DESC'
//			)
//		);
//
//		return $rssReader;
	}

/**
 * save rss_reader
 *
 * @param array $data received post data
 * @param int $frameId frames.id
 * @return bool $result
 */
	public function saveRssReader($data, $frameId) {
//		$data['Block']['name'] = $data[$this->name]['title'];
//
//		try {
//			// rssのデータをシリアライズして保存。
//			$url = $data[$this->name]['url'];
//			$data[$this->name]['serialize_value'] = $this->serializeRssData($url);
//		} catch (XmlException $e) {
//			// Xmlが取得できない場合異常終了
//			return false;
//		}
//
//		$result = $this->saveAll($data);
//
//		// 新規登録の場合は、Frames.block_idを更新する。
//		if ($result && !strlen($data[$this->name]['id'])) {
//			$rssReaderId = $this->getLastInsertID();
//			$rssReaderData = $this->findById($rssReaderId);
//			$blockId = $rssReaderData[$this->name]['block_id'];
//
//			$frameData = array(
//				'Frame' => array(
//					'id' => $frameId,
//					'block_id' => $blockId
//				)
//			);
//			$this->Frame = ClassRegistry::init('Frame');
//			$result = $this->Frame->save($frameData);
//			if ($result !== false) {
//				$result = true;
//			}
//		}
//
//		return $result;
	}

/**
 * update serialize_value
 *
 * @param array $rssReaderData rss_reader
 * @return string $serializeValue
 */
	public function updateSerializeValue($rssReaderData) {
//		$cacheTime = $rssReaderData[$this->name]['cache_time'];
//		$modified = $rssReaderData[$this->name]['modified'];
//		$modifiedDate = new DateTime($modified);
//		$nowDate = new DateTime;
//		$interval = $nowDate->getTimeStamp() - $modifiedDate->getTimeStamp();
//
//		// 設定したキャッシュ時間を経過している場合は、RSSを再取得し更新する。
//		if ($interval > $cacheTime) {
//			$url = $rssReaderData[$this->name]['url'];
//			$rssReaderData[$this->name]['serialize_value'] = $this->serializeRssData($url);
//			$this->save($rssReaderData);
//		}
//		$serializeValue = $rssReaderData[$this->name]['serialize_value'];
//
//		return $serializeValue;
	}

/**
 * serialize rss data
 *
 * @param string $url url
 * @return string $serializeValue
 */
	public function serializeRssData($url) {
//		$xmlData = Xml::toArray(Xml::build($url));
//		$serializeValue = serialize($xmlData);
//
//		return $serializeValue;
	}
}
