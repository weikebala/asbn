﻿<?php
global $_W;
if (!defined('IN_IA')) {
    exit('Access Denied');
}
$result = pdo_fetchcolumn('select id from ' . tablename('sea_plugin') . ' where identity=:identity', array(':identity' => 'fans'));
if(empty($result)){
    $displayorder_max = pdo_fetchcolumn('select max(displayorder) from ' . tablename('sea_plugin'));
    $displayorder = $displayorder_max + 1;
    $sql = "INSERT INTO " . tablename('sea_plugin') . " (`displayorder`,`identity`,`name`,`version`,`author`,`status`) VALUES(". $displayorder .",'fans','粉丝工具','1.0','官方','1');";
  pdo_query($sql);
}
message('粉丝工具插件安装成功', $this->createPluginWebUrl('fans/member'), 'success');