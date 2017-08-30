<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
global $_W, $_GPC;
ca('yunpay.yunpay');
$setdata = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
$set = unserialize($setdata['sets']);
$pay = $set['pay']['yunpay'];
if (!is_array($pay)) {
    $pay = array();
}
if ($_W['ispost']) {
    $yunpay = array_elements(array('switch', 'account', 'partner', 'secret'), $_GPC['yunpay']);
    $yunpay['switch'] = $yunpay['switch'] == 'true';
    $yunpay['account'] = trim($yunpay['account']);
    $yunpay['partner'] = trim($yunpay['partner']);
    $yunpay['secret'] = trim($yunpay['secret']);
    $set['pay']['yunpay'] = $yunpay;
    $setdata = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
    if (pdo_update('sea_sysset', array('sets' => iserializer($set)), array('uniacid' => $_W['uniacid'])) !== false) {
        m('cache')->set('sysset', $setdata);
        message('保存支付信息成功. ', 'refresh');
    } else {
        message('保存支付信息失败, 请稍后重试. ');
    }
    die;
}
load()->func('tpl');
include $this->template('index');