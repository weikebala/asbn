<?php defined('IN_IA') or exit('Access Denied');?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('designer/index', TEMPLATE_INCLUDEPATH)) : (include template('designer/index', TEMPLATE_INCLUDEPATH));?>
