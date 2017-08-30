<?php

/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.cn
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */

!defined('IN_UC') && exit('Access Denied');

class domaincontrol extends base {

	function __construct() {
		$this->domaincontrol();
	}

	function domaincontrol() {
		parent::__construct();
		$this->init_input();
		$this->load('domain');
	}

	function onls() {
		return $_ENV['domain']->get_list(1, 9999, 9999);
	}
}

?>