<?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
    exit('Access Denied');
}
class PosterMobile extends Plugin
{
	public function __construct()
	{
		parent::__construct('poster');
	}
	public function build()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
}