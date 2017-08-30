<?php
/**
 * 幸运数字活动模块
 *
 * @author 海软
 * @url http://www.iseasoft.cn/
 */
pdo_delete('rule', array('module' => 'stonefish_luckynum'));
pdo_delete('rule_keyword', array('module' => 'stonefish_luckynum'));
pdo_run("DROP TABLE ".tablename('stonefish_luckynum_award'));
pdo_run("DROP TABLE ".tablename('stonefish_luckynum_fans'));
pdo_run("DROP TABLE ".tablename('stonefish_luckynum'));
