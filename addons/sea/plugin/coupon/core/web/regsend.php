<?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
	exit('Access Denied');
}

global $_W, $_GPC;
//check_shop_auth
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$type = intval($_GPC['type']);
if ($operation == 'display') {
	ca('coupon.regsend.view');
	$condition = ' uniacid = :uniacid and coupontype=2';
	$params = array(':uniacid' => $_W['uniacid']);

	$sql = 'SELECT * FROM ' . tablename('sea_coupon') . ' ' . " where  1 and {$condition} LIMIT 1";
	$list = pdo_fetchall($sql, $params);
	foreach ($list as &$row) {
		$row['gettotal'] = pdo_fetchcolumn('select count(*) from ' . tablename('sea_coupon_data') . ' where couponid=:couponid and uniacid=:uniacid limit 1', array(':couponid' => $row['id'], ':uniacid' => $_W['uniacid']));
		$row['usetotal'] = pdo_fetchcolumn('select count(*) from ' . tablename('sea_coupon_data') . ' where used = 1 and couponid=:couponid and uniacid=:uniacid limit 1', array(':couponid' => $row['id'], ':uniacid' => $_W['uniacid']));
	}
	unset($row);
} elseif ($operation == 'post') {
	$id = intval($_GPC['id']);
	if (empty($id)) {
		ca('coupon.regsend.add');
	} else {
		ca('coupon.regsend.view|coupon.regsend.edit');
	}
	if (checksubmit('submit')) {
		$data = array('uniacid' => $_W['uniacid'], 'couponname' => trim($_GPC['couponname']), 'coupontype' => 2, 'catid' => intval($_GPC['catid']), 'timelimit' => intval($_GPC['timelimit']), 'usetype' => intval($_GPC['usetype']), 'returntype' => intval($_GPC['returntype']), 'enough' => trim($_GPC['enough']), 'timedays' => intval($_GPC['timedays']), 'timestart' => strtotime($_GPC['time']['start']), 'timeend' => strtotime($_GPC['time']['end']), 'backtype' => intval($_GPC['backtype']), 'deduct' => trim($_GPC['deduct']), 'discount' => trim($_GPC['discount']), 'backmoney' => trim($_GPC['backmoney']), 'backcredit' => trim($_GPC['backcredit']), 'backredpack' => trim($_GPC['backredpack']), 'backwhen' => intval($_GPC['backwhen']), 'gettype' => intval($_GPC['gettype']), 'getmax' => intval($_GPC['getmax']), 'credit' => intval($_GPC['credit']), 'money' => trim($_GPC['money']), 'usecredit2' => intval($_GPC['usecredit2']), 'total' => intval($_GPC['total']), 'bgcolor' => trim($_GPC['bgcolor']), 'thumb' => save_media($_GPC['thumb']), 'remark' => trim($_GPC['remark']), 'desc' => htmlspecialchars_decode($_GPC['desc']), 'descnoset' => intval($_GPC['descnoset']), 'status' => intval($_GPC['status']), 'resptitle' => trim($_GPC['resptitle']), 'respthumb' => save_media($_GPC['respthumb']), 'respdesc' => trim($_GPC['respdesc']), 'respurl' => trim($_GPC['respurl']), 'pwdkey' => trim($_GPC['pwdkey']), 'pwdwords' => trim($_GPC['pwdwords']), 'pwdask' => trim($_GPC['pwdask']), 'pwdsuc' => trim($_GPC['pwdsuc']), 'pwdfail' => trim($_GPC['pwdfail']), 'pwdfull' => trim($_GPC['pwdfull']), 'pwdurl' => trim($_GPC['pwdurl']), 'pwdtimes' => intval($_GPC['pwdtimes']), 'pwdopen' => intval($_GPC['pwdopen']), 'pwdown' => trim($_GPC['pwdown']), 'pwdexit' => trim($_GPC['pwdexit']), 'pwdexitstr' => trim($_GPC['pwdexitstr']));
		if (!empty($id)) {

			pdo_update('sea_coupon', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
			plog('coupon.regsend.edit', "编辑优惠券 ID: {$id} <br/>优惠券名称: {$data['couponname']}");
		} else {

			$data['createtime'] = time();
			pdo_insert('sea_coupon', $data);
			$id = pdo_insertid();
			plog('coupon.regsend.add', "添加优惠券 ID: {$id}  <br/>优惠券名称: {$data['couponname']}");
		}

		message('更新优惠券成功！', $this->createPluginWebUrl('coupon/regsend'), 'success');
	}
	$item = pdo_fetch('SELECT * FROM ' . tablename('sea_coupon') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
	if (empty($item)) {
		$starttime = time();
		$endtime = strtotime(date('Y-m-d H:i:s', $starttime) . '+7 days');
	} else {
		$type = $item['coupontype'];
		$starttime = $item['timestart'];
		$endtime = $item['timeend'];
	}
} elseif ($operation == 'delete') {
	ca('coupon.regsend.delete');
	$id = intval($_GPC['id']);
	$item = pdo_fetch('SELECT id,couponname FROM ' . tablename('sea_coupon') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
	if (empty($item)) {
		message('抱歉，优惠券不存在或是已经被删除！', $this->createPluginWebUrl('coupon/coupon', array('op' => 'display')), 'error');
	}
	pdo_delete('sea_coupon', array('id' => $id, 'uniacid' => $_W['uniacid']));
	$couponids = pdo_fetchall('select id from ' . tablename('sea_coupon') . ' where uniacid=:uniacid', array(':uniacid' => $_W['uniacid']), 'id');
	if (!empty($couponids)) {
		pdo_query('delete from ' . tablename('sea_coupon_data') . ' where couponid not in (' . implode(',', array_keys($couponids)) . ') and uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
	}
	pdo_delete('sea_coupon_data', array('couponid' => $id, 'uniacid' => $_W['uniacid']));
	plog('coupon.regsend.delete', "删除优惠券 ID: {$id}  <br/>优惠券名称: {$item['couponname']} ");
	message('优惠券删除成功！', $this->createPluginWebUrl('coupon/regsend', array('op' => 'display')), 'success');
} else if ($operation == 'query') {
	$kwd = trim($_GPC['keyword']);
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$condition = ' and uniacid=:uniacid';
	if (!empty($kwd)) {
		$condition .= ' AND couponname like :couponname';
		$params[':couponname'] = "%{$kwd}%";
	}
	$time = time();
	$ds = pdo_fetchall('SELECT * FROM ' . tablename('sea_coupon') . "  WHERE 1 {$condition} ORDER BY id asc", $params);
	foreach ($ds as &$d) {
		$d = $this->model->setCoupon($d, $time, false);
		$d['last'] = $this->model->get_last_count($d['id']);
		if ($d['last'] == -1) {
			$d['last'] = '不限';
		}
	}
	unset($d);
	include $this->template('coupon/query');
	exit;
}
$category = pdo_fetchall('select * from ' . tablename('sea_coupon_category') . ' where uniacid=:uniacid order by id desc', array(':uniacid' => $_W['uniacid']), 'id');
load()->func('tpl');
include $this->template('regsend');
