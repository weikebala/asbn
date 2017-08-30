<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'sale';
$shop   = m('common')->getSysset('shop');
if ($op == 'fans') {

} else if ($op == 'run') {

} else if ($op == 'sale') {
    //ca('member.member.view');
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $params    = array(
        ':uniacid' => $_W['uniacid']
    );
    //获取订单推荐者店铺排名
    $orderbyagentidData = pdo_fetchall("SELECT agentid AS id,SUM(price)-SUM(dispatchprice)-SUM(customs_price) AS counts FROM ".tablename('sea_order')." WHERE uniacid=:uniacid and status=3 GROUP BY agentid HAVING counts>0 and agentid>0 ORDER BY SUM(price)-SUM(dispatchprice)-SUM(customs_price) DESC", $params);
    if($orderbyagentidData){
        $newSellOrder = array();
        $memberidArr = array();
        foreach($orderbyagentidData as $key=>$vo){
            $memberidArr[] = $vo[id];
            $newSellOrder[$vo['id']] = $vo;
        }
        unset($orderbyagentidData);
        $condition = " and dm.uniacid=:uniacid and dm.isagent=1 and dm.status=1";

        $sql = "select  dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar,s.name as shop_name,s.logo from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " left join " . tablename('sea_commission_shop') . " s on dm.id =s.mid and s.uniacid={$_W['uniacid']}" ;

        $sql .= " where 1 {$condition} and dm.id in(".implode(',',$memberidArr).")";

        //select *, count(distinct name) from table group by name
        //$sql = "select dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " left join " . " (select openid,uniacid,follow from " .tablename('mc_mapping_fans') . " where uniacid={$_W['uniacid']} group by openid) f on f.openid=dm.openid  and f.uniacid={$_W['uniacid']}" . " where 1 {$condition}  ORDER BY dm.id DESC";
        /* $sql = "select dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id"  . " where 1 {$condition}  ORDER BY dm.id DESC";*/


        $list = pdo_fetchall($sql, $params);
        $listarr = array();
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
            $row['ordersell'] = $newSellOrder[$row['id']]['counts'];
            $listarr[$row['id']] = $row;
        }
        unset($row,$newSellOrder,$list);
        //从新排序
        $newlist = array();
        foreach($memberidArr as $key=>$vo){
            if(!empty($listarr[$vo]))$newlist[$vo] = $listarr[$vo];
        }
        unset($listarr,$memberidArr);
        $newlist = array_values($newlist);
    }
} else if ($operation == 'setblack') {

}
load()->func('tpl');
include $this->template('web/leaderboard/sale');