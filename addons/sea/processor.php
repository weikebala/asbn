<?php
/*=============================================================================
#     FileName: processor.php
#         Desc: 
#       Author: HaiRuan - http://www.iseasoft.cn
#        Email: 45300551@qq.com
#     HomePage: http://www.iseasoft.cn
#      Version: 0.0.1
#   LastChange: 2016-02-05 02:08:51
#      History:
=============================================================================*/

if (!defined('IN_IA')) {
    exit('Access Denied');
}
require IA_ROOT . '/addons/sea/version.php';
require IA_ROOT . '/addons/sea/defines.php';
require sea_INC . 'functions.php';
require sea_INC . 'processor.php';
require sea_INC . 'plugin/plugin_model.php';
class seaModuleProcessor extends Processor
{
    public function respond()
    {
        return parent::respond();
    }
}
