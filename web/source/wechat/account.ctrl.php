<?php
/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.cn
 * iseasoft isNOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
defined('IN_IA') or exit('Access Denied');
$accounts = uni_accounts();
if(!empty($accounts)) {
	foreach($accounts as $key => $li) {
		if($li['level'] < 3) {
			unset($accounts[$key]);
		}
	}
}
template('wechat/account');