<?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
    exit('Access Denied');
}
class TmessageWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('tmessage');
    }
    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}