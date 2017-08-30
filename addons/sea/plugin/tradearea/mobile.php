<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class TradeareaMobile extends Plugin
{
	public function __construct()
	{
		parent::__construct('tradearea');
	}

	public function index()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

}