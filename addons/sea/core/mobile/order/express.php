<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
function sortByTime($a, $b)
{
    if ($a['ts'] == $b['ts']) {
        return 0;
    } else {
        return $a['ts'] > $b['ts'] ? 1 : -1;
    }
}
function getList($_var_2, $_var_3)//ems 132458
{
    include IA_ROOT . '/addons/sea/core/inc/KdApiSearch.class.php';
    $kdaipserch = new KdApiSearch();
    $result = $kdaipserch->getOrderTracesByJson($_var_2,$_var_3);
	$result = json_decode($result,true);
	if(!empty($result['Traces'])){
		$allenoughs = $result['Traces'];
		$arrSort = array();
        foreach($allenoughs as $key=>$value){
            foreach($value as $k=>$v){
                $arrSort[$k][$key] = $v;
            }
        }
        array_multisort($arrSort['AcceptTime'],constant("SORT_DESC"),$allenoughs);
		$result['Traces'] = $allenoughs;
	}
    return $result;
}
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$openid    = m('user')->getOpenid();
$uniacid   = $_W['uniacid'];
$orderid   = intval($_GPC['id']);
if ($_W['isajax']) {
	if ($operation == 'display') {
		$order = pdo_fetch('select * from ' . tablename('sea_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
		if (empty($order)) {
			show_json(0);
		}
		$goods = pdo_fetchall("select og.goodsid,og.price,g.title,g.thumb,og.total,g.credit,og.optionid,og.optionname as optiontitle,g.isverify,g.storeids  from " . tablename('sea_order_goods') . " og " . " left join " . tablename('sea_goods') . " g on g.id=og.goodsid " . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(':uniacid' => $uniacid, ':orderid' => $orderid));
		$goods = set_medias($goods, 'thumb');
		$order['goodstotal'] = count($goods);
		$set = set_medias(m('common')->getSysset('shop'), 'logo');
		show_json(1, array('order' => $order, 'goods' => $goods, 'set' => $set));
	} else if ($operation == 'step') {
		$express = trim($_GPC['express']);
		$expresssn = trim($_GPC['expresssn']);
        $arr = getList($express, $expresssn);																	
		show_json(1, array('list' => $arr));
	}
}
include $this->template('order/express');
