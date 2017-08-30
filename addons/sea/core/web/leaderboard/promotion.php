<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'promotion';
$shop   = m('common')->getSysset('shop');
if ($op == 'fans') {

} else if ($op == 'run') {

} else if ($op == 'promotion') {
    $params    = array(
        ':uniacid' => $_W['uniacid']
    );
    $data = pdo_fetchall("SELECT agentid as id,GROUP_CONCAT(id) as downstr FROM  `fxs_sea_member` WHERE agentid!=0 and isagent=1 and uniacid=:uniacid GROUP BY agentid",$params,"id");
    $orderbyagentidData = pdo_fetchall("SELECT agentid AS id,SUM(price)-SUM(dispatchprice)-SUM(customs_price) AS counts FROM ".tablename('sea_order')." WHERE uniacid=:uniacid and status=3 GROUP BY agentid HAVING counts>0 and agentid>0", $params,"id");

    $memidarr = array();
    foreach($data as $key=>&$vo){
        $child = explode(",",$vo['downstr']);
        $ordersum = 0;
        foreach($child as $cvo){
            $ordersum+=$orderbyagentidData[$cvo]['counts'];
        }
        $memidarr[$vo['id']] = $ordersum;
    }
    unset($data,$orderbyagentidData,$vo,$ordersum);
    arsort($memidarr);
    $idarr = array_keys($memidarr);
    $idstr = implode(",",$idarr);
    if($idstr){
//获取订单推荐者店铺排名
        $condition = " and dm.uniacid=:uniacid";
        $condition = " and dm.id in (".$idstr.")";
        $sql = "select  dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar,s.name as shop_name,s.logo from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" . " left join " . tablename('sea_commission_shop') . " s on dm.id =s.mid" ;
        $sql .= " where 1 {$condition}";
        unset($idarr,$idstr);
        $list = pdo_fetchall($sql, $params,"id");
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
    }

    $newlist = array();
    //从新排序
    foreach($memidarr as $key=>$vo){
        $newlist[$key] = $list[$key];
        $newlist[$key]['ordersum'] = $vo;
    }
    unset($row,$memidarr,$vo,$list);
} else if ($operation == 'setblack') {

}
load()->func('tpl');
include $this->template('web/leaderboard/promotion');