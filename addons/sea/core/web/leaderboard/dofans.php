<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'dofans';
$pagesize = 500;
if ($op == 'run') {
    //ca('member.member.view');
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = $pagesize;
    $params    = array(
        ':uniacid' => $_W['uniacid']
    );
    //获取粉丝排行数据
    $fans = pdo_fetchall("select id,agentid from ".tablename('sea_member')." where uniacid=:uniacid", $params);
    $fansCount = pdo_fetchall("SELECT agentid AS id,COUNT(agentid) AS counts FROM ".tablename('sea_member')." WHERE uniacid=:uniacid GROUP BY agentid", $params);
    $fans_new = array();
    $fansCountnew = array();
    foreach($fans as $key=>$vo){
        $fans_new[$vo['id']] = $vo;
    }
    unset($fans);
    foreach($fansCount as $key=>$vo){
        $fansCountnew[$vo['id']] = $vo['counts'];
    }
    unset($fansCount);
    foreach($fans_new as $key=>&$vo){
        $vo['counts'] = $fansCountnew[$key];
    }
    $tree_fans = m('member')->doFansTree($fans_new,"id","agentid","child",0);
    unset($fans_new);
    $_GPC['dopage'] = max(1,$_GPC['dopage']);
    $res = m('member')->runFans($tree_fans,$_GPC['dopage'],$psize);
    if($res)message('完成', "", 'success');
}
$params    = array(
    ':uniacid' => $_W['uniacid']
);
$fans = pdo_fetchall("select id,agentid from ".tablename('sea_member')." where uniacid=:uniacid", $params);
$sumcount = count($fans);
$pagesum = ceil($sumcount/$pagesize);
load()->func('tpl');
include $this->template('web/leaderboard/dofans');