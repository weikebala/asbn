<?php
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
	$set = pdo_fetch('select * from ' . tablename('tradearea_set') . ' where uniacid = :uniacid' , array(':uniacid'=>$_W['uniacid']));
}elseif ($operation == 'save') {
	$set = array(
		'is_tradearea' => $_GPC['is_tradearea'],
		'is_deliver' => $_GPC['is_deliver'],
		'uniacid' => $_W['uniacid'],
		);
	if (empty($_GPC['id'])) {
		$result = pdo_insert('tradearea_set',$set);
	}else {
		$result = pdo_query('update ' . tablename('tradearea_set') . ' set is_tradearea = :is_tradearea , is_deliver = :is_deliver where uniacid = :uniacid and id = :id',array(':is_tradearea'=>$_GPC['is_tradearea'],':is_deliver'=>$_GPC['is_deliver'],':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']));
	}
	if (isset($result)) {
		message('操作成功!', $this->createPluginWebUrl('tradearea/set', array('op' => 'display')), 'success');
	}
}
include $this->template('set');