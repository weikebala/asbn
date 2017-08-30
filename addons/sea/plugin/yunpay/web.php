<?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
    exit('Access Denied');
}
require_once 'model.php';
class YunpayWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('yunpay');
    }
    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function fetch()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}

