<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
$openid = m('user')->getOpenid();
if (empty($openid)) {
    $openid_shop = m('user')->isLogin();
    $member_shop = m('member')->getMember($openid_shop);
}
$uniacid = $_W['uniacid'];
$set = set_medias(m('common')->getSysset('shop'), array('logo', 'img'));
$commission = p('commission');
if ($commission) {
    $shopid = intval($_GPC['shopid']);
    if (!empty($shopid)) {
        $myshop = set_medias($commission->getShop($shopid), array('img', 'logo'));
    }
}
$current_category = false;

$total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('sea_brand') . " where 1 and enabled=1", $params);
$pindex = max(1, intval($_GPC['page']));
$pager = pagination($total, $pindex, $args['pagesize']);

$brand=pdo_fetchall('SELECT * FROM ' . tablename('sea_brand') . " where enabled=1");
foreach ($brand as $key => $value) {
             $brand[$key]['thumb'] = $_W['siteroot'] .'attachment/'.$value['thumb'];
         }

if ($_W['isajax']) {
    show_json(1, array('brand' => $brand, 'pagesize' => $args['pagesize']));
}
include $this->template('shop/brand');