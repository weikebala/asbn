<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
define('sea_DEBUG', false);//false
!defined('sea_PATH') && define('sea_PATH', IA_ROOT . '/addons/sea/');
!defined('sea_CORE') && define('sea_CORE', sea_PATH . 'core/');
!defined('sea_PLUGIN') && define('sea_PLUGIN', sea_PATH . 'plugin/');
!defined('sea_INC') && define('sea_INC', sea_CORE . 'inc/');
!defined('sea_URL') && define('sea_URL', $_W['siteroot'] . 'addons/sea/');
!defined('sea_STATIC') && define('sea_STATIC', sea_URL . 'static/');
!defined('sea_PREFIX') && define('sea_PREFIX', 'sea_');
