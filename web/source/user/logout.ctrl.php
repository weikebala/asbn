<?php
/**
 * [iseasoft System] Copyright (c) 2015 iseasoft.cn
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
defined('IN_IA') or exit('Access Denied');
isetcookie('__session', '', -10000);

$forward = $_GPC['forward'];
if(empty($forward)) {
	$forward = './?refersh';
}
header('Location:' . url('account/welcome'));
