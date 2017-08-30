<?php
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
load()->func('tpl');
if ($operation == 'display') {
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $list = pdo_fetchall('select * from ' . tablename('tradearea') . " where uniacid = :uniacid order by id asc limit " . ($pindex - 1) * $psize . ',' . $psize,array(':uniacid'=>$_W['uniacid']));
    foreach ($list as $key => &$value) {
    	$value['deliver'] = pdo_fetchcolumn('select name from ' . tablename('tradearea_deliver') . ' where id = :deliver_id and uniacid = :uniacid',array(':deliver_id'=>$value['deliver_id'],':uniacid'=>$_W['uniacid']));
    }
    unset($value);
    $total =pdo_fetchcolumn('select count(*) from ' . tablename('tradearea') . ' where uniacid = :uniacid',array(':uniacid'=>$_W['uniacid']));
    $pager           = pagination($total, $pindex, $psize);
    $deliver_list = pdo_fetchall('select id,name from ' . tablename('tradearea_deliver') . ' where uniacid = :uniacid ',array(':uniacid'=>$_W['uniacid']));
} elseif ($operation == 'add' || $operation == 'edit') {
	//var_dump($_GPC);exit;
	$tradearea = array(  
			'tradearea_name' => $_GPC['tradearea_name'],
			'province' => $_GPC['province'],
			'city' => $_GPC['city'],
			'district' => $_GPC['district'],
			'area' => $_GPC['area'],
			'status' => $_GPC['status'],
			'operator' => $_W['username'],
			'uniacid' => $_W['uniacid'],
			'deliver_id' => $_GPC['deliver_id']
			);
	if (empty($_GPC['id'])) {
		$tradearea['addtime'] = time();
		$tradearea['edittime'] = $tradearea['addtime'];
		$result = pdo_insert('tradearea',$tradearea);
	}else{
		$tradearea['edittime'] = time();
		$result = pdo_update('tradearea',$tradearea,array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']),'and');
	}
	if (isset($result)) {
		message('操作成功!',$this->createPluginWebUrl('tradearea/index',array('op'=>'display'),'seccess'));
	}else{
		message('操作失败!',$this->createPluginWebUrl('tradearea/index',array('op'=>'display'),'seccess'));
	}
} elseif ($operation == 'delete') {
	if (!empty($_GPC['id'])) {
		$result = pdo_query('delete from ' . tablename('tradearea') . ' where id = :id and uniacid = :uniacid',array(':id'=>$_GPC['id'],':uniacid'=>$_W['uniacid']));
		if (!empty($result)) {
			message('删除成功！',$this->createPluginWebUrl('tradearea/index',array(':op' => 'display', )),'seccess');
		}else {
			message('删除失败！',$this->createPluginWebUrl('tradearea/index',array(':op' => 'display', )),'seccess');
		}
	}
} else if ($operation == 'tradearea') {
	$id = intval($_GPC['id']);
	if (isset($id)) {
		$tradearea = pdo_fetch('select id,province,city,district,area,deliver_id from' . tablename('tradearea') . ' where uniacid = :uniacid and id = :id ',array(':uniacid'=>$_W['uniacid'],':id'=>$id));

		if (!empty($tradearea)) {
			show_json(1,$tradearea);
		}else{
			$tradearea = '没有记录！';
			show_json(0,$tradearea);
		}
	}
}
include $this->template('index');