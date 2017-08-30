<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class PluginModel
{
    private $pluginname;
    public function __construct($name = '')
    {
        $this->pluginname = $name;
    }
    public function getSet()
    {
        global $_W, $_GPC;
        $set = m('common')->getSetData();
        $allset = iunserializer($set['plugins']);
        if (is_array($allset) && isset($allset[$this->pluginname])) {
            return $allset[$this->pluginname];
        }
        return array();
    }
    public function updateSet($data = array())
    {
        global $_W;
        $uniacid = $_W['uniacid'];
        $set = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
        if (empty($set)) {
            pdo_insert('sea_sysset', array('uniacid' => $uniacid, 'sets' => iserializer(array()), 'plugins' => iserializer(array($this->pluginname => $data))));
        } else {
            $sets = unserialize($set['plugins']);
            $sets[$this->pluginname] = $data;
            pdo_update('sea_sysset', array('plugins' => iserializer($sets)), array('uniacid' => $uniacid));
        }
        $set = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
        m('cache')->set('sysset', $set);
    }
    function getName()
    {
        return pdo_fetchcolumn('select name from ' . tablename('sea_plugin') . ' where identity=:identity limit 1', array(':identity' => $this->pluginname));
    }
}