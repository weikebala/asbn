<?php
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
load()->func('tpl');
if ($operation == 'display') {
	$pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $list = pdo_fetchall('select * from ' . tablename('tradearea_deliver') . " where uniacid = :uniacid order by id asc limit " . ($pindex - 1) * $psize . ',' . $psize,array(':uniacid'=>$_W['uniacid']));
    foreach ($list as $key => &$value) {
    	//$area = pdo_fetch('select id,province,city,district,area from ' . tablename('tradearea') . ' where uniacid = :uniacid and deliver_id = :deliver_id limit 1',array(':uniacid'=>$_W['uniacid'],':deliver_id'=>$value['id']));
		 $area = pdo_fetchall('select id,province,city,district,area from ' . tablename('tradearea') . ' where uniacid = :uniacid and deliver_id = :deliver_id ',array(':uniacid'=>$_W['uniacid'],':deliver_id'=>$value['id']));
		 foreach ($area as $key1 => &$value1) {
			 $value1['tradearea'] = $value1['province'].'/'.$value1['city'].'/'.$value1['district'].'/'.$value1['area'];
		 }
		 unset($value1);
    	  $value['tradearea'] = $area;
    }
	
    unset($value);
    $total =pdo_fetchcolumn('select count(*) from ' . tablename('tradearea_deliver') . ' where uniacid = :uniacid',array(':uniacid'=>$_W['uniacid']));
    $pager           = pagination($total, $pindex, $psize);
    $tradearea_list = pdo_fetchall('select id,tradearea_name,deliver_id from ' . tablename('tradearea') . ' where uniacid = :uniacid ',array(':uniacid'=>$_W['uniacid']));
}elseif ($operation == 'add' || $operation == 'edit') {
	$deliver = array(
		'name' => $_GPC['name'],
		'phone' => $_GPC['phone'],
		'status' => $_GPC['status'],
		'operator' => $_W['username']
		);
	if (empty($_GPC['id'])) {
		$time = time();
		$deliver['addtime'] = $time;
		$deliver['edittime'] = $time;
		$deliver['uniacid'] = $_W['uniacid'];
		$deliver_result = pdo_insert('tradearea_deliver',$deliver);
		$deliver_id = pdo_insertid();
		//var_dump($_GPC['tradearea_id']);
		if (!empty($_GPC['tradearea_id']) || isset($deliver_id)) {

			$result = pdo_query('update ' . tablename('tradearea') . ' set deliver_id = :deliver_id where id = :tradearea_id and uniacid = :uniacid',array('deliver_id'=>$deliver_id,':tradearea_id'=>$_GPC['tradearea_id'],':uniacid'=>$_W['uniacid']));
		}
	}else {
		$deliver_result = pdo_update('tradearea_deliver',$deliver,array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']),'and');
		if (isset($result) || !empty($_GPC['id'])) {
			$result = pdo_query('update ' . tablename('tradearea') . ' set deliver_id = :deliver_id where id = :id and uniacid = :uniacid',array(':deliver_id'=>$_GPC['id'],':id'=>$_GPC['tradearea_id'],':uniacid'=>$_W['uniacid']));
		}
	}
	if (isset($result)) {
		message('操作成功!',$this->createPluginWebUrl('tradearea/deliver',array('op'=>'display')),'success');
	}else{
		message('操作失败!',$this->createPluginWebUrl('tradearea/deliver',array('op'=>'display')),'success');
	}
}elseif ($operation == 'delete') {
	if (!empty($_GPC['id'])) {
		$result = pdo_query('delete from ' . tablename('tradearea_deliver') . ' where id = :id',array('id'=>$_GPC['id']));
		if (isset($result)) {
			message('删除成功!',$this->createPluginWebUrl('tradearea/deliver',array('op'=>'display'),'success'));
		}
	}
}
include $this->template('deliver');