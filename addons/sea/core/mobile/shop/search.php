<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
//获取热搜关键词
$setdata = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
$set = unserialize($setdata['sets']);
$hotkeyword = trim($set['shop']["hotkeyword"]);
$hotkeyword = str_replace("，",",",$hotkeyword);
$hotkeyword = trim($hotkeyword,",");
if(!empty($hotkeyword))
	$hotkeyword = explode(",",$hotkeyword);
$hotkeyword = is_array($hotkeyword)?$hotkeyword:array();
$this->setHeader();
include $this->template('shop/search');
