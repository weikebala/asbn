<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;

$openid         = m('user')->getOpenid();
$member         = m('member')->getInfo($openid);
$mid=$_GPC['mid'];
if(empty($mid)){
    if($member['isone']==1){
        pdo_update('sea_member', array('isone' => 0), array('openid' => $openid));
    }
}
$template_flag  = 0;
if ($_W['isajax']) {
    if ($_W['ispost']) {
        $memberdata = $_GPC['memberdata'];
     
		pdo_update('sea_member', $memberdata, array(
			'openid' => $openid,
			'uniacid' => $_W['uniacid']
		));
        show_json(1);
    }
    show_json(1, array(
        'member' => $member
    ));
}

include $this->template('member/bs');
