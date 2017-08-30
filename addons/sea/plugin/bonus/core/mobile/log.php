<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$openid = m('user')->getOpenid();
$mid = m('member')->getMid();
$uniacid = $_W['uniacid'];
$agentLevel = $this->model->getLevel($openid);
//exit;
if ($_W['isajax']) {
    
//}
//if ($operation == 'display') {
	//获取当前用户uid
	$uids=pdo_fetch('select uid from '.tablename('sea_member').' where id='.$mid );
	//获取当前人所有分红记录
	$pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = '  and `openid`=:openid and `uid`=:uid and uniacid=:uniacid';
        $params = array(':openid' => $openid,':uid' => $uids['uid'], ':uniacid' => $uniacid);
        $status = trim($_GPC['status']);
        $commissioncount = 0;
        $list = pdo_fetchall('select * from ' . tablename('sea_bonus_log') . " where 1 {$condition} order by id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
        $total = pdo_fetchcolumn('select count(*) from ' . tablename('sea_bonus_log') . " where 1 {$condition}", $params);
        foreach ($list as &$row) {
            $commissioncount += $row['money'];
            $row['dealtime'] = date('Y-m-d H:i', $row['ctime']);
        }
        unset($row);
	
        show_json(1, array('total' => $total, 'list' => $list, 'pagesize' => $psize, 'commissioncount' => number_format($commissioncount, 2)));
		
		
}
include $this->template('log');
/*
if ($operation == 'detail') {
    include $this->template('log_detail');
}
*/