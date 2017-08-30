<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}
require_once 'model.php';

class TradeareaWeb extends Plugin
{
	public function __construct()
	{
		parent::__construct('tradearea');
	}

	public function index()
	{

		$this->_exec_plugin(__FUNCTION__);
	}

	public function deliver()
	{
		$this->_exec_plugin(__FUNCTION__);
	}

	public function set()
	{
		$this->_exec_plugin(__FUNCTION__);
	}

}

//测试
