<?php
/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.cn
 * iseasoft isNOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
defined('IN_IA') or exit('Access Denied');
checkauth();
load()->model('coupon');
load()->classs('coupon');
if(empty($_W['acid'])) {
	message('acid不存在', referer(), 'error');
}



