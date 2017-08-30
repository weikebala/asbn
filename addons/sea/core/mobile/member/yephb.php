<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
/* 积分排行 */
global $_W, $_GPC;


$limitsum = 10; //显示多少个排行

//$sql = "SELECT * FROM " . tablename('sea_member')." WHERE uniacid = :uniacid ORDER BY credit2 DESC LIMIT {$limitsum}";
$orderby = empty($_GPC['orderby']) ? 'ordermoney' : 'ordercount';
$condition1 = ' and m.uniacid=:uniacid';
$params1 = array(':uniacid' => $_W['uniacid']);
$sql     = "SELECT m.realname, m.mobile,m.avatar,m.nickname,l.levelname," . "(select ifnull( count(o.id) ,0) from  " . tablename('sea_order') . " o where o.openid=m.openid and o.status>=1 {$condition})  as ordercount," . "(select ifnull(sum(o.price),0) from  " . tablename('sea_order') . " o where o.openid=m.openid  and o.status>=1 {$condition})  as ordermoney" . " from " . tablename('sea_member') . " m  " . " left join " . tablename('sea_member_level') . " l on l.id = m.level" . " where 1 {$condition1} order by {$orderby} desc LIMIT {$limitsum} ";
$params = array(':uniacid' => $_W['uniacid']);
$list = pdo_fetchall($sql, $params);

include $this->template('member/yephb');
