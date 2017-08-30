<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}
require IA_ROOT . '/addons/sea/defines.php';
require sea_INC . 'plugin/plugin_processor.php';

class TradeareaProcessor extends PluginProcessor
{
	public function __construct()
	{
		parent::__construct('tradearea');
	}

	public function respond($obj = null)
	{
		global $_W;
	}

	private function responseEmpty()
	{
		ob_clean();
		ob_start();
		echo '';
		ob_flush();
		ob_end_flush();
		exit(0);
	}
}
