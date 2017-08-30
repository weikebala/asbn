 <?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
    exit('Access Denied');
}
if (!class_exists('ChooseModel')) {
    class ChooseModel extends PluginModel
    {
        public function getUid()
        {
            global $_W, $_GPC;
            $a=pdo_fetch('select * from '.tablename('sea_chooseagent'));
            if($a['isopen']==1){
                return $a['uid'];   
            }else{
                return false; 
            }
        }
    }    
}        