<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
$openid = m('user')->getOpenid();
$preUrl = $_COOKIE['preUrl'];
if ($_W['isajax']) {
    if ($_W['ispost']) {
        $mc = $_GPC['memberdata'];
        $info = pdo_fetch('select * from ' . tablename('sea_member') . ' where  mobile ="' . $mc['mobile'] . '" and pwd <> ""');
        if ($info) {
            $oldopenid = $info['openid'];
            $oldid = $info['id'];
            pdo_update('sea_member_address', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_member_cart', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_member_favorite', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_member_log', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_order', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_order_comment', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_saler', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_coupon_data', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_coupon_guess', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_coupon_log', array('openid' => $openid), array('openid' => $oldopenid));
            pdo_update('sea_creditshop_log', array('openid' => $openid), array('openid' => $oldopenid));
            //pdo_delete('sea_member', array('openid' => $oldopenid));
            pdo_delete('sea_member', array('id' => $oldid));
            pdo_update('sea_member', array('mobile' => $info['mobile'], 'pwd' => $info['pwd'], 'isbindmobile' => 1, 'credit1' => $info['credit1'], 'credit2' => $info['credit2']), array('openid' => $openid));
            show_json(1, array('preurl' => $preUrl));
        } else {
            pdo_update('sea_member', array('mobile' => $mc['mobile'], 'pwd' => md5($mc['password']), 'isbindmobile' => 1), array('openid' => $openid));
            show_json(1, array('preurl' => $preUrl));
        }
    }
}
include $this->template('member/bindmobile');