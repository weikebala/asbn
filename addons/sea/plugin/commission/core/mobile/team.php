<?php
global $_W, $_GPC;
$openid   = m('user')->getOpenid();
$tabwidth = "50";
if ($this->set['level'] >= 1) {
    $tabwidth = 100;
}
if ($this->set['level'] >= 2) {
    $tabwidth = 50;
}
if ($this->set['level'] >= 3) {
    $tabwidth = 33.3;
}
$member = $this->model->getInfo($openid,array(
    'total',
    'pay',
    'ordercount'
));
$total  = $member['agentcount'];
$agentlevels=$member['agentlevels'];
$level  = intval($_GPC['level']);
($level > 3 || $level <= 0) && $level = 1;
$condition = '';
$level1    = $member['level1'];
$level2    = $member['level2'];
$level3    = $member['level3'];
$hasangent = false;
//求出总粉丝
$allfensi=$member["fanscount"];
$allliansuodian=$member["agentcount"];
//求出总连锁数量
//求出本月连锁店累积订单
$by_order_num=$member['byordercount'];
$by_order_total=$member['byordermoney'];
$by_order_commission=$member["by_commission_total"];
//求出本月累积成交
//求出本月分红总金额
//求出历史
$all_order_num=$member['ordercount'];
$all_order_total=$member['ordermoney'];
$all_order_commission=$member["commission_total"];
$agentids = array();
if ($level1 > 0) {
	$agentids[] = $member['id'];
}
if ($level2 > 0) {
	$agentids = array_merge(array_keys($member['level1_agentids']),$agentids);
}
if ($level3 > 0) {
	$agentids = array_merge($agentids,array_keys($member['level2_agentids']));
}
if(count($agentids)>0){
	$hasangent = true;
	$condition = " and agentid in( " . implode(",",$agentids) . ")";
} 
$agentdata = pdo_fetchall("select * from " . tablename('sea_member') . " where isagent =1 and status=1 and uniacid = " . $_W['uniacid'] . " {$condition}");
foreach($agentdata as $key=>$vo){
	$info = $this->model->getInfo($vo['openid'], array('total','pay','ordercount'));
	$by_order_num += $info['byordercount'];
	$by_order_tota += $info['byordermoney'];
	$by_order_commission += $info['by_commission_total'];
	$all_order_num += $info['ordercount'];
	$all_order_total += $info['ordermoney'];
	$all_order_commission += $info['commission_total'];
	$allliansuodian += $info['agentcount'];
}
if ($_W['isajax']) {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$list = array();
	if ($hasangent) {
		$list = pdo_fetchall("select * from " . tablename('sea_member') . " where isagent =1 and status=1 and uniacid = " . $_W['uniacid'] . " {$condition}  ORDER BY agenttime desc limit " . ($pindex - 1) * $psize . ',' . $psize);
		foreach ($list as &$row) {
			$info = $this->model->getInfo($row['openid'], array('total'));
			$row['commission_total'] = $info['commission_total'];
			$row['agentcount1'] = $info['agentcount'];
			$row['agenttime'] = date('Y-m-d H:i', $row['agenttime']);
			$row['agentcount'] = $row['fanscount'];
			$row['agentcount2'] = $row['agentcount']-$row['agentcount1'];
		}
	}
	unset($row);
	show_json(1, array('list' => $list, 'pagesize' => $psize));
}
include $this->template('team');
