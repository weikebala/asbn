<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
global $_W, $_GPC;
	$cond = '';
	$roleid = pdo_fetchcolumn('select roleid from' . tablename('sea_perm_user') . ' where uid=' . $_W['uid'] . ' and uniacid=' . $_W['uniacid']);//角色id
	$perm_role = 0;
	if($roleid==1){
		//供应商
		$perm_role = pdo_fetchcolumn('select status1 from' . tablename('sea_perm_role') . ' where id=' . $roleid);
        $cond = ' and identity in (\'exhelper\',\'taobao\') ';
	}
	else{
		$cond='';
		if($_W['role'] =='founder'){
		}else if($_W['role']=='manager'){
		$type = m('cache')->getString('permset', 'global');
			$set  = array(
				'type' => intval($type)
			);
			if($set['type']==1){
				$perm_m =pdo_fetchcolumn('select plugins from' . tablename('sea_perm_plugin') . ' where acid=' . $_W['uniacid']);
				$allperm_m=explode(',',$perm_m);
				if(!empty($allperm_m)){
						foreach($allperm_m as $key=>$var){
							$cond.="'".$var."',";
						}
						$cond = substr($cond,0,strlen($cond)-1);
				}
				$cond = ' and identity in ('.$cond.') ';
			}
		}else{
			//正常权限
			$all_plugin= pdo_fetchall('select * from ' . tablename('sea_plugin'));
			//取总角色
			if(!empty($roleid)){
				$cond=' and identity in (';
				 $perm_r =pdo_fetchcolumn('select perms from' . tablename('sea_perm_role') . ' where id=' . $roleid);
				 $perm_u =pdo_fetchcolumn('select perms from' . tablename('sea_perm_user') . ' where uid=' . $_W['uid'] . ' and uniacid=' . $_W['uniacid']);
				$perm_s=$perm_r.','.$perm_u;
				foreach($all_plugin as $key=>$var){
					if(strpos($perm_s, $var['identity'])){
						//$cond.="\'".$var['identity']."\',";
						$cond.="'".$var['identity']."',";
					}
				}
				$cond = substr($cond,0,strlen($cond)-1).')';
			}else{
				$cond=" and identity in ('meiyou')";
			}
		}
	}
/*
if (p('supplier')) {
    $roleid = pdo_fetchcolumn('select roleid from' . tablename('sea_perm_user') . ' where uid=' . $_W['uid'] . ' and uniacid=' . $_W['uniacid']);
    if ($roleid == 0) {
        $perm_role = 0;
    } else {
        if (p('supplier')) {
            $perm_role = pdo_fetchcolumn('select status1 from' . tablename('sea_perm_role') . ' where id=' . $roleid);
            $cond = ' and identity in (\'exhelper\',\'taobao\') ';
        } else {
            $perm_role = 0;
        }
    }
}*/
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$category = m('plugin')->getCategory();
foreach ($category as $ck => &$cv) {
  $cv['plugins'] = pdo_fetchall('select * from ' . tablename('sea_plugin') . " where category=:category {$cond} order by displayorder asc", array(':category' => $ck));
   // $cv['plugins'] = pdo_fetchall('select * from ' . tablename('sea_plugin') . " where 1=1 {$cond} order by displayorder asc");
	
}

unset($cv);
include $this->template('web/plugins/list');
die;