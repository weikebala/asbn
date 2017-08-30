<?php
/**
 * 会员财务中心
 *
 * 作者:Kim
 * 模块定制QQ: 45300551
 * 后台体验地址: http://www.iseasoft.cn
 */
defined('IN_IA') or exit('Access Denied');
global $_W,$_GPC;
if(!$_W['isfounder']) {
    message('不能访问, 需要创始人权限才能访问.');
}
$ops = array("auto");
$op = in_array($_GPC["op"], $ops) ? $_GPC["op"] : "display";

if($_W["ispost"] && $_W["isajax"]) {
    if($op == "auto") {
        die(json_encode(common_group_check()));
    }
}
include $this->template('financial_test');