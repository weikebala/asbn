<?php
//海软商城 QQ:45300551
global $_W, $_GPC;
ca('perm.set');
$type = m('cache')->getString('permset', 'global');
$set  = array(
    'type' => intval($type)
);
if (checksubmit('submit')) {
	$ishc=$_POST['ishc'];
	if($ishc==1){
		$poster_url=IA_ROOT. '/addons/sea/data/poster/'.$_W['uniacid'];
		$qrcode_url=IA_ROOT. '/addons/sea/data/qrcode/'.$_W['uniacid'];
		rmdirsm($poster_url,true);
		rmdirsm($qrcode_url,true);
		message('清除缓存成功!', referer(), 'success');
	}else{
		m('cache')->set('permset', intval($_GPC['data']['type']), 'global');
		message('设置成功!', referer(), 'success');
	}
}
load()->func('tpl');
include $this->template('index');

function rmdirsm($path, $clean = false) {
	if (!is_dir($path)) {
		return false;
	}
	$files = glob($path . '/*');
	if ($files) {
		foreach ($files as $file) {
			is_dir($file) ? rmdirs($file) : @unlink($file);
		}
	}
	return $clean ? true : @rmdir($path);
}