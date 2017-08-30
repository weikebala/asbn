<?php
//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
	die('Access Denied');
}
global $_W, $_GPC;
$openid = m('user')->getOpenid();
$set = m('common')->getSysset(array('trade'));
$shop_set = m('common')->getSysset(array('shop'));
$member = m('member')->getMember($openid);
$member['nickname'] = empty($member['nickname']) ? $member['mobile'] : $member['nickname'];
$uniacid = $_W['uniacid'];
$trade['withdraw'] = $set['trade']['withdraw'];
$trade['closerecharge'] = $set['trade']['closerecharge'];
$hascom = false;
$shopset = array();
$supplier_switch = false;
if (p('supplier')) {
	$supplier_set = p('supplier')->getSet();
	if (!empty($supplier_set['switch'])) {
		$supplier_switch = true;
	}
}
$shopset['supplier_switch'] = $supplier_switch;
$setdata1 = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
$set1 = unserialize($setdata1['sets']);
if($set1['phb']['switch'] == 1 ){
 	$shopset['switch'] = true; }
else{
 	$shopset['switch'] = false;
 }
if($set1['phb']['isintegral'] == 1 ){
 	$shopset['isintegral'] = true; }
else{
 	$shopset['isintegral'] = false;
 }
 if($set1['phb']['isexpense'] == 1 ){
 	$shopset['isexpense'] = true; }
else{
 	$shopset['isexpense'] = false;
 }
 
 if($set1['phb']['iscommission'] == 1 ){
 	$shopset['iscommission'] = true; }
else{
 	$shopset['iscommission'] = false;
 }
  if($set1['phb']['isfans'] == 1 ){
 	$shopset['isfans'] = true; }
else{
 	$shopset['isfans'] = false;
 }
  if($set1['phb']['issales'] == 1 ){
 	$shopset['issales'] = true; }
else{
 	$shopset['issales'] = false;
 }
  if($set1['phb']['istuiguang'] == 1 ){
 	$shopset['istuiguang'] = true; }
else{
 	$shopset['istuiguang'] = false;
 }
$shopset['phbname'] = $set1['phb']['phbname'];
//print_r($shopset);die();
$plugc = p('commission');
if ($plugc) {
	$pset = $plugc->getSet();
	if (!empty($pset['level'])) {
		if ($member['isagent'] == 1 && $member['status'] == 1) {
			$hascom = true;
		}
	}
}
$shopset['commission_text'] = $pset['texts']['center'];
$shopset['hascom'] = $hascom;
$hascoupon = false;
$hascouponcenter = false;
$plugin_coupon = p('coupon');
if ($plugin_coupon) {
	$pcset = $plugin_coupon->getSet();
	if (empty($pcset['closemember'])) {
		$hascoupon = true;
		$hascouponcenter = true;
	}
}
$shopset['hascoupon'] = $hascoupon;
$shopset['hascouponcenter'] = $hascouponcenter;


$pluginbonus = p('bonus');
$bonus_start = false;
$bonus_text = "";
if (!empty($pluginbonus)) {
	$bonus_set = $pluginbonus->getSet();
	if (!empty($bonus_set['start'])) {
		$bonus_start = true;
		$bonus_text = $bonus_set['detail_text'] ? $bonus_set['detail_text'] : '分红明细';
	}
}
$shopset['bonus_start'] = $bonus_start;
$shopset['bonus_text'] = $bonus_text;
$shopset['is_weixin'] = is_weixin();
if ($_W['isajax']) {
	$level = array('levelname' => empty($this->yzShopSet['levelname']) ? '普通会员' : $this->yzShopSet['levelname']);
	if (!empty($member['level'])) {
		$level = m('member')->getLevel($openid);
	}
	$orderparams = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);
	$order = array('status0' => pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and status=0  and uniacid=:uniacid limit 1', $orderparams), 'status1' => pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and status=1 and refundid=0 and uniacid=:uniacid limit 1', $orderparams), 'status2' => pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and status=2 and refundid=0 and uniacid=:uniacid limit 1', $orderparams), 'status4' => pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and refundid<>0 and uniacid=:uniacid limit 1', $orderparams));
	if (mb_strlen($member['nickname'], 'utf-8') > 6) {
		$member['nickname'] = mb_substr($member['nickname'], 0, 6, 'utf-8');
	}
	$referrer = array();
	if ($shop_set['shop']['isreferrer']) {
		if ($member['agentid'] > 0) {
			$referrer = pdo_fetch('select * from ' . tablename('sea_member') . ' where uniacid=' . $_W['uniacid'] . ' and id = \'' . $member['agentid'] . '\' ');
			$referrer['realname'] = mb_substr($referrer['realname'], 0, 6, 'utf-8');
		} else {
			$referrer['realname'] = '总店';
		}
	}
	$open_creditshop = false;
	$creditshop = p('creditshop');
	if ($creditshop) {
		$creditshop_set = $creditshop->getSet();
		if (!empty($creditshop_set['centeropen'])) {
			$open_creditshop = true;
		}
	}
	$counts = array('cartcount' => pdo_fetchcolumn('select ifnull(sum(total),0) from ' . tablename('sea_member_cart') . ' where uniacid=:uniacid and openid=:openid and deleted=0 ', array(':uniacid' => $uniacid, ':openid' => $openid)), 'favcount' => pdo_fetchcolumn('select count(*) from ' . tablename('sea_member_favorite') . ' where uniacid=:uniacid and openid=:openid and deleted=0 ', array(':uniacid' => $uniacid, ':openid' => $openid)));
	if ($plugin_coupon) {
		$time = time();
		$sql = 'select count(*) from ' . tablename('sea_coupon_data') . ' d';
		$sql .= ' left join ' . tablename('sea_coupon') . ' c on d.couponid = c.id';
		$sql .= ' where d.openid=:openid and d.uniacid=:uniacid and  d.used=0 ';
		$sql .= " and (   (c.timelimit = 0 and ( c.timedays=0 or c.timedays*86400 + d.gettime >=unix_timestamp() ) )  or  (c.timelimit =1 and c.timestart<={$time} && c.timeend>={$time})) order by d.gettime desc";
		$counts['couponcount'] = pdo_fetchcolumn($sql, array(':openid' => $openid, ':uniacid' => $_W['uniacid']));
	}

	show_json(1, array('member' => $member, 'referrer' => $referrer, 'shop_set' => $shop_set, 'order' => $order, 'level' => $level, 'open_creditshop' => $open_creditshop, 'counts' => $counts, 'shopset' => $shopset, 'trade' => $trade));
}
include $this->template('member/center');