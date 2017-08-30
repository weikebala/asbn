<?php
/**
 * 话费充值模块订阅器
 *
 * @author 封遗
 * @url http://www.iseasoft.cn/
 */
defined('IN_IA') or exit('Access Denied');

class Feng_rechargeModuleReceiver extends WeModuleReceiver {
	public function receive() {
		$type = $this->message['type'];
		//这里定义此模块进行消息订阅时的, 消息到达以后的具体处理过程, 请查看海软文档来编写你的代码
	}
}