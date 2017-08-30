<?php
//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$ordersn = $_GPC['ordersn'];
$orderinfo = pdo_get("sea_order",array("ordersn"=>$ordersn));
if(empty($orderinfo)){
    $url = $this->createMobileUrl("member");
    die("<script>top.window.location.href='{$url}'</script>");
}
$paymentResult = "fail";
if($orderinfo['status']>=1){
    $paymentResult = "success";
}
include $this->template('order/payresult');