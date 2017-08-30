<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    print 'Access Denied';
}
global $_W, $_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($op == 'display') {
    ca('exhelper.printset.view');
    $condition = '';
    if (p('supplier')) {
        $condition .= " and uid={$_W['uid']}";
    }
    $printset = pdo_fetch('SELECT * FROM ' . tablename('sea_exhelper_sys') . " WHERE uniacid=:uniacid {$condition} limit 1", array(':uniacid' => $_W['uniacid']));
}
if ($_W['ispost']) {
    ca('exhelper.printset.save');
    $port = $_GPC['port'];
    $ip = $_GPC['ip'];
    $uid = $_W['uid'];
    if (p('supplier')) {
        $supplier_printset = pdo_fetch('SELECT * FROM ' . tablename('sea_exhelper_sys') . " WHERE uniacid=:uniacid and uid={$_W['uid']} limit 1", array(':uniacid' => $_W['uniacid']));
        if (empty($supplier_printset)) {
            pdo_insert('sea_exhelper_sys', array('port' => $port, 'ip' => $ip, 'uniacid' => $_W['uniacid'], 'uid' => $uid));
        } else {
            pdo_update('sea_exhelper_sys', array('port' => $port, 'ip' => $ip), array('uniacid' => $_W['uniacid'], 'uid' => $uid));
        }
    } else {
        if (empty($printset)) {
            pdo_insert('sea_exhelper_sys', array('port' => $port, 'ip' => $ip, 'uniacid' => $_W['uniacid']));
        } else {
            pdo_update('sea_exhelper_sys', array('port' => $port, 'ip' => $ip), array('uniacid' => $_W['uniacid']));
        }
    }
    message('保存成功！', $this->createPluginWebUrl('exhelper/printset', array('op' => 'display')), 'success');
}
load()->func('tpl');
include $this->template('printset');