<?php
/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.cn
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */

require './framework/bootstrap.inc.php';
$host = $_SERVER['HTTP_HOST'];
if (!empty($host)) {
	$bindhost = pdo_fetch("SELECT * FROM ".tablename('site_multi')." WHERE bindhost = :bindhost", array(':bindhost' => $host));
	if (!empty($bindhost)) {
		header("Location: ". $_W['siteroot'] . 'app/index.php?i='.$bindhost['uniacid'].'&t='.$bindhost['id']);
		exit;
	}
}
 
if($_W['os'] == 'mobile' && (!empty($_GPC['i']) || !empty($_SERVER['QUERY_STRING']))) {

	header('Location: ./app/index.php?' . $_SERVER['QUERY_STRING']);//前台入口
	//header('Location: ./web/index.php?c=user&a=login&');
} else {
//echo $_SERVER['QUERY_STRING'];
 
	header('Location: ./web/index.php?' . $_SERVER['QUERY_STRING']);//后台入口
	//header('Location: ./web/index.php?c=user&a=login&');
}