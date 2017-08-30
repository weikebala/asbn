<?php
//海软商城 QQ:45300551
global $_W, $_GPC;
ca('sale.enough.view');
$set = $this->getSet();
if (checksubmit('submit')) {
	ca('sale.enough.save');
	$data = is_array($_GPC['data']) ? $_GPC['data'] : array();
	$set['enoughfree'] = intval($data['enoughfree']);
	$set['enoughorder'] = round(floatval($data['enoughorder']), 2);
	$set['enoughareas'] = $data['enoughareas'];
    $set['sale_type'] = $data['sale_type'];
    if($data['sale_type']==1){
        $set['enoughmoney'] = round(floatval($data['enoughmoney']), 2);
        $set['enoughdeduct'] = round(floatval($data['enoughdeduct']), 2);
        $enoughs = array();
        $postenoughs = is_array($_GPC['enough']) ? $_GPC['enough'] : array();
        foreach ($postenoughs as $key => $value) {
            $enough = floatval($value);
            if ($enough > 0) {
                $enoughs[] = array('enough' => floatval($_GPC['enough'][$key]), 'give' => floatval($_GPC['give'][$key]));
            }
        }
        $set['enoughs'] = $enoughs;
        $set['enoughmoneydz'] = null;
        $set['enoughzk'] = null;
        $set['enoughszk'] = null;
    }elseif($data['sale_type']==2){
        $set['enoughmoneydz'] = round(floatval($data['enoughmoneydz']), 2);
        $set['enoughzk'] = round(floatval($data['enoughzk']), 2);
        $enoughszk = array();
        $postenoughszk = is_array($_GPC['enoughzk']) ? $_GPC['enoughzk'] : array();
        foreach ($postenoughszk as $key => $value) {
            $enough = floatval($value);
            if ($enough > 0) {
                $enoughszk[] = array('enoughzk' => floatval($_GPC['enoughzk'][$key]), 'givezk' => floatval($_GPC['givezk'][$key]));
            }
        }
        $set['enoughszk'] = $enoughszk;
        $set['enoughmoney'] = null;
        $set['enoughdeduct'] = null;
        $set['enoughs'] = null;
    }
    /*单品促销*/
    $set['enoughmoneydp'] = round(floatval($data['enoughmoneydp']), 2);
    $set['enoughdeductdp'] = round(floatval($data['enoughdeductdp']), 2);
    $enoughs = array();
    $postenoughs = is_array($_GPC['enoughdp']) ? $_GPC['enoughdp'] : array();
    foreach ($postenoughs as $key => $value) {
        $enough = floatval($value);
        if ($enough > 0) {
            $enoughs[] = array('enoughdp' => floatval($_GPC['enoughdp'][$key]), 'givedp' => floatval($_GPC['givedp'][$key]));
        }
    }
    $set['enoughsdp'] = $enoughs;
    /*单品促销end*/
	$this->updateSet($set);
	plog('sale.enough.save', '修改满额优惠');
	message('满额优惠设置成功!', referer(), 'success');
}
$areas = m('cache')->getArray('areas', 'global');
if (!is_array($areas)) {
    require_once sea_INC . 'json/xml2json.php';
    $file    = IA_ROOT . "/addons/sea/static/js/dist/area/Area.xml";
    $content = file_get_contents($file);
    $json    = xml2json::transformXmlStringToJson($content);
    $areas   = json_decode($json, true);
    m('cache')->set('areas', $areas, 'global');
}
load()->func('tpl');
include $this->template('enough');
