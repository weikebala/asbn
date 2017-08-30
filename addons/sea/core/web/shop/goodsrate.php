<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    print 'Access Denied';
}
global $_W, $_GPC;
$operation =  'change';
if ($operation == 'change') {
    $seaRateSql='SELECT rate FROM `fxs_sea_hscode_rate` WHERE id=1';
    $seaRateResult=pdo_fetch($seaRateSql);
    $seaRate=$seaRateResult["rate"];
    $bondedRateSql='SELECT rate FROM `fxs_sea_hscode_rate` WHERE id=2';
    $bondedRateResult=pdo_fetch($bondedRateSql);
    $bondedRate=$bondedRateResult["rate"];
    $ordinaryRateSql='SELECT rate FROM `fxs_sea_hscode_rate` WHERE id=3';
    $ordinaryRateResult=pdo_fetch($ordinaryRateSql);
    $ordinaryRate=$ordinaryRateResult["rate"];
    if(checksubmit('submit')){
        if(!is_numeric($_GPC['seaRate']))message("海外直邮税率输入错误",'','error');
        if(!is_numeric($_GPC['bondedRate']))message("进口保税税率输入错误",'','error');
        if(!is_numeric($_GPC['ordinaryRate']))message("贸易进口税率输入错误",'','error');
        $data["rate"]=$_GPC['seaRate'];
        pdo_update('sea_hscode_rate', $data, array('id' => 1));
        $data["rate"]=$_GPC['bondedRate'];
        pdo_update('sea_hscode_rate', $data, array('id' => 2));
        $data["rate"]=$_GPC['ordinaryRate'];
        pdo_update('sea_hscode_rate', $data, array('id' => 3));
        message('更改成功!', $this->createWebUrl('shop/goodsrate'), 'success');
    }
} else {

}
load()->func('tpl');
include $this->template('web/shop/goodsrate');