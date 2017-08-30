<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
$result = pdo_fetchcolumn('select id from ' . tablename('sea_plugin') . ' where identity=:identity', array(':identity' => 'bonus'));
if (empty($result)) {
    $displayorder_max = pdo_fetchcolumn('select max(displayorder) from ' . tablename('sea_plugin'));
    $displayorder = $displayorder_max + 1;
    $sql = 'INSERT INTO ' . tablename('sea_plugin') . ' (`displayorder`,`identity`,`name`,`version`,`author`,`status`,`category`) VALUES(' . $displayorder . ',\'bonus\',\'海软分红\',\'1.0\',\'官方\',\'1\',\'biz\');';
    pdo_query($sql);
}