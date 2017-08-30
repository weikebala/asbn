<?php

/* 佣金排行 */
global $_W, $_GPC;
$openid = m('user')->getOpenid();
$limitsum = 50; //显示多少个排行
$setdata1 = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
$set1 = unserialize($setdata1['sets']);
$isopen['switch'] = $set1['phb']['switch'];
$isopen['isintegral'] = $set1['phb']['isintegral'];
$isopen['isexpense'] = $set1['phb']['isexpense'];
$isopen['iscommission'] = $set1['phb']['iscommission'];
$isopen['isfans'] = $set1['phb']['isfans'];
$isopen['issales'] = $set1['phb']['issales'];
$isopen['istuiguang'] = $set1['phb']['istuiguang'];
$name['integralname'] = $set1['phb']['integralname'];
$name['expensename'] = $set1['phb']['expensename'];
$name['commissionname'] = $set1['phb']['commissionname'];
$name['fansname'] = $set1['phb']['fansname'];
$name['salesname'] = $set1['phb']['salesname'];
$name['tuiguangname'] = $set1['phb']['tuiguangname'];
if($isopen['switch'] == 1){
	if($isopen['isintegral'] == 1){
		$atv = 1;
	}elseif($isopen['isexpense'] ==1){
		$atv = 2;
	}elseif($isopen['iscommission'] ==1){
		$atv = 3;
	}elseif($isopen['isfans'] ==1){
		$atv = 4;
	}elseif($isopen['issales'] ==1){
		$atv = 5;
	}elseif($isopen['istuiguang'] ==1){
		$atv = 6;
	}else{
		$atv = 0;
	}
	
	$count = 0;
	if($isopen['isintegral'] == 1){
		$count += 1;
	}
	if($isopen['isexpense'] == 1){
		$count += 1;
	}
	
	if($isopen['iscommission'] == 1){
		$count += 1;
	}
	if($isopen['isfans'] == 1){
		$count += 1;
	}
	if($isopen['issales'] == 1){
		$count += 1;
	}
	if($isopen['istuiguang'] == 1){
		$count += 1;
	}
	
}else{
	$atv = 0;
	$count = 0;
}

$type = isset($_GPC['type'])&&($_GPC['type'])? $_GPC['type'] : ($atv - 1);
if($type == 0){
$sql = "SELECT * FROM " . tablename('sea_member')." WHERE uniacid = :uniacid ORDER BY credit1 DESC LIMIT {$limitsum}";
$params = array(':uniacid' => $_W['uniacid']);
$list = pdo_fetchall($sql, $params);
$switch = 0;
}
if($type == 1){
$orderby = empty($_GPC['orderby']) ? 'ordermoney' : 'ordercount';
$condition1 = ' and m.uniacid=:uniacid';
$params1 = array(':uniacid' => $_W['uniacid']);
$sql     = "SELECT m.openid,m.realname, m.mobile,m.avatar,m.nickname,l.levelname," . "(select ifnull( count(o.id) ,0) from  " . tablename('sea_order') . " o where o.openid=m.openid and o.status>=1 {$condition})  as ordercount," . "(select ifnull(sum(o.price),0) from  " . tablename('sea_order') . " o where o.openid=m.openid  and o.status>=1 {$condition})  as ordermoney" . " from " . tablename('sea_member') . " m  " . " left join " . tablename('sea_member_level') . " l on l.id = m.level" . " where 1 {$condition1} order by {$orderby} desc LIMIT {$limitsum} ";
$params = array(':uniacid' => $_W['uniacid']);
$list = pdo_fetchall($sql, $params);
$switch = 1;
}
if($type == 2){

$info = pdo_fetchall('select openid,nickname,avatar,isagent from ' . tablename('sea_member') . ' where  uniacid='.$_W['uniacid'].' and isagent=1');
foreach($info as $key => $item){
	$arr[$key]['openid'] = $item['openid'];
	$arr[$key]['nickname'] = $item['nickname'];
	$arr[$key]['avatar'] = $item['avatar'];
	
	$member = $this->model->getInfo($item['openid'], array('total'));
	$arr[$key]['commission'] = $member['commission_total'];
}
$commission = array();
foreach ($arr as $ar) {
    $commission[] = $ar['commission'];
}
array_multisort($commission, SORT_DESC, $arr);
$list = $arr;

$switch = 2;
}
//粉丝榜
if($type == 3){
	$sql = "select  dm.*,l.levelname,g.groupname,a.nickname as agentnickname,a.avatar as agentavatar from " . tablename('sea_member') . " dm " . " left join " . tablename('sea_member_group') . " g on dm.groupid=g.id" . " left join " . tablename('sea_member') . " a on a.id=dm.agentid" . " left join " . tablename('sea_member_level') . " l on dm.level =l.id" ;
    $sql .= " where 1 {$condition}  ORDER BY dm.fanscount DESC";
    $sql .= " limit {$limitsum}";
    $list = pdo_fetchall($sql, $params);
	$switch = 3;
}
//销售榜
if($type == 4){
	//获取订单推荐者店铺排名
    $orderbyagentidData = pdo_fetchall("SELECT agentid AS id,SUM(price)-SUM(dispatchprice)-SUM(customs_price) AS counts FROM ".tablename('sea_order')." WHERE uniacid=:uniacid and status=3 GROUP BY agentid HAVING counts>0 and agentid>0 ORDER BY SUM(price)-SUM(dispatchprice)-SUM(customs_price) DESC", array(':uniacid' => $_W['uniacid']));

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
        $list = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
        $listarr = array();
        foreach ($list as &$row) {
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
        $newlist1 = array_slice($newlist,0,$limitsum);
        $list = array_values($newlist1);
        unset($newlist1);
    }
	$switch = 4;
}
//推广榜
if($type == 5){
	$data = pdo_fetchall("SELECT agentid as id,GROUP_CONCAT(id) as downstr FROM  `fxs_sea_member` WHERE agentid!=0 and isagent=1 and uniacid=:uniacid GROUP BY agentid",array(':uniacid' => $_W['uniacid']),"id");
    $orderbyagentidData = pdo_fetchall("SELECT agentid AS id,SUM(price)-SUM(dispatchprice)-SUM(customs_price) AS counts FROM ".tablename('sea_order')." WHERE uniacid=:uniacid and status=3 GROUP BY agentid HAVING counts>0 and agentid>0", array(':uniacid' => $_W['uniacid']),"id");

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
        $list = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']),"id");
    }

    $newlist = array();
    //从新排序
    foreach($memidarr as $key=>$vo){
        $newlist[$key] = $list[$key];
        $newlist[$key]['ordersum'] = $vo;
    }
    $newlists = array_slice($newlist,0,$limitsum);
    $list = array_values($newlists);
    unset($newlists);
	$switch = 5;
}

for($i=0;$i<=($limitsum - 1);$i++){
	if($list[$i]['openid'] == $openid){
		$m_num = $i + 1;
	}
}
if($type == 0){
	$sql = "SELECT credit1 FROM " . tablename('sea_member')." WHERE openid = :openid ORDER BY credit1 DESC LIMIT 1";
$params = array(':openid' => $openid);
$m2 = pdo_fetch($sql, $params);
$m = $m2['credit1'];
}elseif($type == 1){
	$orderby = empty($_GPC['orderby']) ? 'ordermoney' : 'ordercount';
$condition1 = ' and m.uniacid=:uniacid and m.openid=:openid';
$params1 = array(':uniacid' => $_W['uniacid']);
$sql     = "SELECT m.openid,m.realname, m.mobile,m.avatar,m.nickname,l.levelname," . "(select ifnull( count(o.id) ,0) from  " . tablename('sea_order') . " o where o.openid=m.openid and o.status>=1 {$condition})  as ordercount," . "(select ifnull(sum(o.price),0) from  " . tablename('sea_order') . " o where o.openid=m.openid  and o.status>=1 {$condition})  as ordermoney" . " from " . tablename('sea_member') . " m  " . " left join " . tablename('sea_member_level') . " l on l.id = m.level" . " where 1 {$condition1} order by {$orderby} desc LIMIT 1 ";
$params = array(':uniacid' => $_W['uniacid'],':openid' => $openid);
$m2 = pdo_fetch($sql, $params);
$m = $m2['ordermoney'];
}elseif($type == 2){
	$m2 = $this->model->getInfo($openid, array('total'));
	$m = $m2['commission_total'];
}elseif($type == 3){
	$sql = "SELECT fanscount FROM " . tablename('sea_member')." WHERE openid = :openid and uniacid=:uniacid ORDER BY fanscount DESC LIMIT 1";
	$params = array(':openid' => $openid,":uniacid"=>$_W['uniacid']);
	$m2 = pdo_fetch($sql, $params);
	$m = $m2['fanscount'];
}elseif($type == 4){
	$memberinfo = pdo_get("sea_member",array("uniacid"=>$_W['uniacid'],"openid"=>$openid));
	$m = $newlist[$memberinfo['id']]['ordersell'];
}elseif($type == 5){
	$memberinfo = pdo_get("sea_member",array("uniacid"=>$_W['uniacid'],"openid"=>$openid));
	$m = $newlist[$memberinfo['id']]['ordersum'];
}
$avatar = pdo_fetch('select avatar from ' . tablename('sea_member') . ' where  openid=:openid ', array(':openid' => $openid));
include $this->template('yongjin');
