<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
global $_W, $_GPC;
$operation = empty($_GPC['op']) ? 'display' : $_GPC['op'];
if ($operation == 'display') {
    $roleid = pdo_fetchcolumn('select id from ' . tablename('sea_perm_role') . ' where status1=1');
    $where = '';
    if (empty($_GPC['uid'])) {
        $where .= ' and uniacid=' . $_W['uniacid'];
    } else {
        $where .= ' and uid="' . $_GPC['uid'] . '" and uniacid=' . $_W['uniacid'];
    }
    $list = pdo_fetchall('select * from ' . tablename('sea_perm_user') . ' where roleid=' . $roleid . ' ' . $where);
    $total = count($list);
} else {
    if ($operation == 'detail') {
        $uid = intval($_GPC['uid']);
        $supplierinfo = pdo_fetch('select * from ' . tablename('sea_perm_user') . ' where uid="' . $uid . '" and uniacid=' . $_W['uniacid']);
        if (!empty($supplierinfo['openid'])) {
            $saler = m('member')->getInfo($supplierinfo['openid']);
        }
        $totalmoney = pdo_fetchcolumn(' select ifnull(sum(g.costprice*og.total),0) from ' . tablename('sea_order_goods') . ' og left join ' . tablename('sea_order') . ' o on o.id=og.orderid left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid where og.supplier_uid=:supplier_uid and og.uniacid=:uniacid', array(':supplier_uid' => $uid, ':uniacid' => $_W['uniacid']));
        $totalmoneyok = pdo_fetchcolumn(' select ifnull(sum(g.costprice*og.total),0) from ' . tablename('sea_order_goods') . ' og left join ' . tablename('sea_order') . ' o on o.id=og.orderid left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid where og.supplier_uid=:supplier_uid and og.supplier_apply_status=1 and og.uniacid=:uniacid', array(':supplier_uid' => $uid, ':uniacid' => $_W['uniacid']));
        if (checksubmit('submit')) {
            $data = is_array($_GPC['data']) ? $_GPC['data'] : array();
            pdo_update('sea_perm_user', $data, array('uid' => $uid));
            message('保存成功!', $this->createPluginWebUrl('supplier/supplier'), 'success');
        }
    }
}
load()->func('tpl');
include $this->template('supplier');