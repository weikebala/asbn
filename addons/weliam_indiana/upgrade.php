<?php
//一元夺宝1.1增加字段
if(!pdo_fieldexists('weliam_indiana_goodslist', 'maxnum')) {
	pdo_query("ALTER TABLE ".tablename('weliam_indiana_goodslist')." ADD `maxnum` int( 11 )  NOT NULL;");
}
if(!pdo_fieldexists('weliam_indiana_consumerecord', 'ip')) {
	pdo_query("ALTER TABLE ".tablename('weliam_indiana_consumerecord')." ADD `ip` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('weliam_indiana_consumerecord', 'ipaddress')) {
	pdo_query("ALTER TABLE ".tablename('weliam_indiana_consumerecord')." ADD `ipaddress` VARCHAR( 145 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_weliam_indiana_hexiao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '核销id',
  `name` varchar(50) NOT NULL COMMENT '核销名称',
  `discount` decimal(10,2) NOT NULL COMMENT '核销金额',
  `hexiaoperson` varchar(32) NOT NULL COMMENT '核销人',
  `usedperson` varchar(32) NOT NULL COMMENT '被核销人',
  `createtime` int(11) NOT NULL COMMENT '核销时间',
  `uniacid` int(10) DEFAULT NULL COMMENT '公众号id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

//一元夺宝1.1.4增加字段
if(!pdo_fieldexists('weliam_indiana_cart', 'ip')) {
	pdo_query("ALTER TABLE ".tablename('weliam_indiana_cart')." ADD `ip` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('weliam_indiana_cart', 'ipaddress')) {
  pdo_query("ALTER TABLE ".tablename('weliam_indiana_cart')." ADD `ipaddress` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}

//一元夺宝1.2.0增加字段
if(!pdo_fieldexists('weliam_indiana_goodslist', 'sort')) {
	pdo_query("ALTER TABLE ".tablename('weliam_indiana_goodslist')." ADD `sort` int( 11 )  NOT NULL;");
}

//一元夺宝1.3.0增加字段
pdo_query("CREATE TABLE IF NOT EXISTS `ims_weliam_indiana_withdraw` (
 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
 `uniacid` int(11) NOT NULL COMMENT '公众号id',
 `openid` varchar(225) NOT NULL COMMENT '提现人',
 `createtime` varchar(45) NOT NULL COMMENT '提现时间',
 `number` int(11) NOT NULL COMMENT '金额',
 `status` int(2) NOT NULL COMMENT '提现状态（1：等待提现；2：提现成功；3提现失败）',
 `type` int(2) NOT NULL COMMENT '提现方式（1：微信；2支付宝；3京东钱包；4：百度钱包）',
 `order_no` varchar(225) NOT NULL COMMENT '提现订单号',
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

//一元夺宝1.5.4增加字段
if(!pdo_fieldexists('weliam_indiana_invite', 'type')) {
  pdo_query("ALTER TABLE ".tablename('weliam_indiana_invite')." ADD `type` int(11)  NOT NULL;");
}
if(!pdo_fieldexists('weliam_indiana_period', 'comment')) {
  pdo_query("ALTER TABLE ".tablename('weliam_indiana_period')." ADD `comment` varchar(2048)  NOT NULL;");
}

//判断是否是1.5.5以上的版本
$isdbup = pdo_fetch("select version from".tablename('modules')."where name='weliam_indiana'");
$all = explode('.',$isdbup['version']);
if($all[0] == 1 && $all[1] == 5 && $all[2] < 5){
  pdo_update("weliam_indiana_goodslist",array('init_money'=>1));
}elseif($all[0] == 1 && $all[1] < 5){
  pdo_update("weliam_indiana_goodslist",array('init_money'=>1));
}

//一元夺宝1.5.7更新
if(!pdo_fieldexists('weliam_indiana_goodslist', 'next_init_money')) {
  pdo_query("ALTER TABLE ".tablename('weliam_indiana_goodslist')." ADD `next_init_money` int(11)  NOT NULL;");
}

//一元夺宝1.6.1更新
pdo_query("CREATE TABLE IF NOT EXISTS `ims_weliam_indiana_member` (
  `mid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `openid` varchar(145) NOT NULL COMMENT '用户openid',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `mobile` varchar(25) NOT NULL COMMENT '手机',
  `email` varchar(145) NOT NULL COMMENT '电子邮件',
  `credit1` decimal(10,2) NOT NULL COMMENT '积分',
  `credit2` decimal(10,2) NOT NULL COMMENT '余额',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `nickname` varchar(145) NOT NULL COMMENT '昵称',
  `realname` varchar(145) NOT NULL COMMENT '真实姓名',
  `avatar` varchar(445) NOT NULL COMMENT '头像',
  `gender` int(2) NOT NULL COMMENT '性别',
  `vip` int(2) NOT NULL COMMENT 'vip等级',
  `address` varchar(225) NOT NULL COMMENT '地址',
  `nationality` varchar(30) NOT NULL COMMENT '国家',
  `resideprovince` varchar(30) NOT NULL COMMENT '省份',
  `residecity` varchar(30) NOT NULL COMMENT '城市',
  `residedist` varchar(30) NOT NULL COMMENT '地区',
  `account` varchar(145) NOT NULL COMMENT '账号',
  `password` varchar(145) NOT NULL COMMENT '密码',
  `status` int(2) NOT NULL COMMENT '用户状态',
  `type` int(2) NOT NULL COMMENT '用户类型',
  `ip` varchar(35) NOT NULL COMMENT '固定IP',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

pdo_query("CREATE TABLE IF NOT EXISTS `ims_weliam_indiana_machineset` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `period_number` varchar(145) NOT NULL COMMENT '商品期号',
  `machine_num` int(11) NOT NULL COMMENT '使用机器人个数',
  `createtime` varchar(145) NOT NULL COMMENT '创建时间',
  `start_time` varchar(145) NOT NULL COMMENT '开始时间',
  `end_time` varchar(145) NOT NULL COMMENT '结束时间',
  `next_time` varchar(145) NOT NULL COMMENT '机器人下个自动购买时间',
  `status` int(2) NOT NULL COMMENT '机器人状态',
  `max_num` int(11) NOT NULL,
  `timebucket` varchar(145) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

if(!pdo_fieldexists('weliam_indiana_period', 'machine_time')) {
  pdo_query("ALTER TABLE ".tablename('weliam_indiana_period')." ADD `machine_time` varchar(145)  NOT NULL;");
}

//夺宝1.6.9更新
if(!pdo_fieldexists('weliam_indiana_machineset', 'is_followed')) {
  pdo_query("ALTER TABLE ".tablename('weliam_indiana_machineset')." ADD `is_followed` int(2)  NOT NULL;");
}