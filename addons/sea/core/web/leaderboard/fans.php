<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'fans';
$shop   = m('common')->getSysset('shop');
if ($op == 'fans') {
    //ca('member.member.view');
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $params    = array(
        ':uniacid' => $_W['uniacid']
    );
    $condition = " and dm.uniacid=:uniacid";

    $sql = "select  dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" ;

    $sql .= " where 1 {$condition}  ORDER BY dm.fanscount DESC";

    $sql .= " limit " . ($pindex - 1) * $psize . ',' . $psize;

    $list = pdo_fetchall($sql, $params);
    foreach ($list as &$row) {
        $row['levelname']  = empty($row['levelname']) ? (empty($shop['levelname']) ? '普通会员' : $shop['levelname']) : $row['levelname'];
        $row['ordercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where uniacid=:uniacid and openid=:openid and status=3', array(
            ':uniacid' => $_W['uniacid'],
            ':openid' => $row['openid']
        ));
        $row['ordermoney'] = pdo_fetchcolumn('select sum(goodsprice) from ' . tablename('sea_order') . ' where uniacid=:uniacid and openid=:openid and status=3', array(
            ':uniacid' => $_W['uniacid'],
            ':openid' => $row['openid']
        ));
        $row['credit1']    = m('member')->getCredit($row['openid'], 'credit1');
        $row['credit2']    = m('member')->getCredit($row['openid'], 'credit2');
        $row['followed']   = m('user')->followed($row['openid']);
    }
    unset($row);
    //$total           = pdo_fetchcolumn("select  count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " where 1 {$condition} ", $params);
    $total_sql = "select  count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id";
    $total_sql .= " where 1 {$condition} ";
    $total = pdo_fetchcolumn($total_sql,$params);
    //$total           = pdo_fetchcolumn("select count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " left join " . "(select openid,uniacid,follow,count(distinct openid) from " . tablename('mc_mapping_fans') . " where uniacid ={$_W['uniacid']} group by openid) f on f.openid=dm.openid" . " where 1 {$condition} ", $params);
    /*$total           = pdo_fetchcolumn("select count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " where 1 {$condition} ", $params);*/
    $pager           = pagination($total, $pindex, $psize);
} else if ($op == 'run') {
    //ca('member.member.view');
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
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
    $res = m('member')->runFans($tree_fans,$_GPC['dopage']);
    if($res)message('完成', "", 'success');
} else if ($op == 'sale') {
    //ca('member.member.view');
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $params    = array(
        ':uniacid' => $_W['uniacid']
    );
    $condition = " and dm.uniacid=:uniacid";

    $sql = "select  dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" ;

    $sql .= " where 1 {$condition}  ORDER BY dm.id DESC";

    //select *, count(distinct name) from table group by name
    //$sql = "select dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " left join " . " (select openid,uniacid,follow from " .tablename('mc_mapping_fans') . " where uniacid={$_W['uniacid']} group by openid) f on f.openid=dm.openid  and f.uniacid={$_W['uniacid']}" . " where 1 {$condition}  ORDER BY dm.id DESC";
    /* $sql = "select dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id"  . " where 1 {$condition}  ORDER BY dm.id DESC";*/
    $sql .= " limit " . ($pindex - 1) * $psize . ',' . $psize;

    $list = pdo_fetchall($sql, $params);
    foreach ($list as &$row) {
        $row['levelname']  = empty($row['levelname']) ? (empty($shop['levelname']) ? '普通会员' : $shop['levelname']) : $row['levelname'];
        $row['ordercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where uniacid=:uniacid and openid=:openid and status=3', array(
            ':uniacid' => $_W['uniacid'],
            ':openid' => $row['openid']
        ));
        $row['ordermoney'] = pdo_fetchcolumn('select sum(goodsprice) from ' . tablename('sea_order') . ' where uniacid=:uniacid and openid=:openid and status=3', array(
            ':uniacid' => $_W['uniacid'],
            ':openid' => $row['openid']
        ));
        $row['credit1']    = m('member')->getCredit($row['openid'], 'credit1');
        $row['credit2']    = m('member')->getCredit($row['openid'], 'credit2');
        $row['followed']   = m('user')->followed($row['openid']);
        $row['agentid_sell']   = pdo_fetchcolumn('select sum(goodsprice) from ' . tablename('sea_order') . ' where uniacid=:uniacid and agentid=:agentid and status=3', array(
            ':uniacid' => $_W['uniacid'],
            ':agentid' => $row['id']
        ));
    }debug1($list);
    unset($row);
    //$total           = pdo_fetchcolumn("select  count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " where 1 {$condition} ", $params);
    $total_sql = "select  count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id";
    $total_sql .= " where 1 {$condition} ";
    $total = pdo_fetchcolumn($total_sql,$params);
    //$total           = pdo_fetchcolumn("select count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " left join " . "(select openid,uniacid,follow,count(distinct openid) from " . tablename('mc_mapping_fans') . " where uniacid ={$_W['uniacid']} group by openid) f on f.openid=dm.openid" . " where 1 {$condition} ", $params);
    /*$total           = pdo_fetchcolumn("select count(*) from" . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " where 1 {$condition} ", $params);*/
    $pager           = pagination($total, $pindex, $psize);
} else if ($operation == 'setblack') {

}
load()->func('tpl');
include $this->template('web/leaderboard/fans');