<?php
//海软商城 QQ:45300551
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require '../../../../../../framework/bootstrap.inc.php';
require '../../../../../../addons/sea/defines.php';
require '../../../../../../addons/sea/core/inc/functions.php';
require '../../../../../../addons/sea/core/inc/plugin/plugin_model.php';
global $_W, $_GPC;
ignore_user_abort();
set_time_limit(0);
$p = p('coupon');
$sets = pdo_fetchall('select uniacid from ' . tablename('sea_sysset'));
foreach ($sets as $set) {
	$_W['uniacid'] = $set['uniacid'];
	if (empty($_W['uniacid'])) {
		continue;
	}
	$trade = m('common')->getSysset('trade', $_W['uniacid']);
	$days = intval($trade['refunddays']);
	$daytimes = 86400 * $days;
	$orders = pdo_fetchall('select id,couponid from ' . tablename('sea_order') . " where  uniacid={$_W['uniacid']} and status=3 and couponid<>0 and finishtime + {$daytimes} <=unix_timestamp() ");
	if (!empty($orders)) {
		if ($p) {
			foreach ($orders as $o) {
				if (!empty($o['couponid'])) {
					$p->backConsumeCoupon($o['id']);
				}
			}
		}
	}
}
