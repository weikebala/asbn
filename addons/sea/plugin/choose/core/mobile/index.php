<?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
$openid     = m('user')->getOpenid();
$uniacid    = $_W['uniacid'];
$shopset    = set_medias(m('common')->getSysset('shop'), 'catadvimg');
$commission = p('commission');
if ($commission) {
	$shopid = intval($_GPC['shopid']);
	$shop = set_medias($commission->getShop($openid), array('img', 'logo'));
}
$color=pdo_fetch('select color from ' .tablename('sea_chooseagent'). ' where id='.$_GPC['pageid']);
$this->setHeader();
include $this->template('index');
