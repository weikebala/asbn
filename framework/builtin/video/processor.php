<?php
/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.cn
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
defined('IN_IA') or exit('Access Denied');

class VideoModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		$rid = $this->rule;
		$sql = "SELECT * FROM " . tablename('video_reply') . " WHERE `rid`=:rid";
		$item = pdo_fetch($sql, array(':rid' => $rid));
		if (empty($item)) {
			return false;
		}
		return $this->respVideo(array(
			'MediaId' => $item['mediaid'],
			'Title' => $item['title'],
			'Description' => $item['description']
		));
	}
}
