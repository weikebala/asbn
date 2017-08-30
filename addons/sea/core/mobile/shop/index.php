<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
$uploadappnoshow=true;
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
#获取openid
$openid = m('user')->getOpenid();
if (empty($openid)) {
    $openid_shop = m('user')->isLogin();
    $member_shop = m('member')->getMember($openid_shop);
}
$isonemember = m('member')->getMember($openid);
if($isonemember['isone']==1){
	 header('Location: '.$this->createMobileUrl('member/bs'));
}	
//加盟商首页加入加盟商店铺信息
if (!empty($isonemember) && $isonemember['status'] == 1 && $isonemember['isagent'] == 1){
	$commissionClass = p('commission');
	$shop = set_medias($commissionClass->getShop($isonemember['id']), array('img', 'logo'));
	$sysset = $commissionClass->getSet();
	$sysset = set_medias($sysset, 'dzbg');
}
$designer = p('designer');
if (empty($this->yzShopSet['ispc']) || isMobile()) {
    if ($designer) {
        $pagedata = $designer->getPage();
        if ($pagedata) {
            extract($pagedata);
            
            $guide = $designer->getGuide($system, $pageinfo);
            $_W['shopshare'] = array('title' => $share['title'], 'imgUrl' => $share['imgUrl'], 'desc' => $share['desc'], 'link' => $this->createMobileUrl('shop'));

            if (p('commission')) {
                $set = p('commission')->getSet();
                if (!empty($set['level'])) {
                    $member = m('member')->getMember($openid);
                    if (!empty($member) && $member['status'] == 1 && $member['isagent'] == 1) {
                        $_W['shopshare']['link'] = $this->createMobileUrl('shop', array('mid' => $member['id']));
                        if (empty($set['become_reg']) && (empty($member['realname']) || empty($member['mobile']))) {
                            $trigger = true;
                        }
                    } else {
                        if (!empty($_GPC['mid'])) {
                            $_W['shopshare']['link'] = $this->createMobileUrl('shop', array('mid' => $_GPC['mid']));
                        }
                    }
                }
            }

            $mid=$member_shop['id'];
            //拉取分类
            $category = pdo_fetchall('select id,name,thumb,parentid,level,activity_url from ' . tablename('sea_category') . ' where uniacid=:uniacid and level=1 and enabled=1 and activity_url!="" order by displayorder desc', array(':uniacid' => $_W['uniacid']));
            $setdata = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
            $set = unserialize($setdata['sets']);
            include $this->template('shop/index_diy');
            die;
        }
    }
}
if ($operation == 'index') {
    $advs = pdo_fetchall('select id,advname,link,thumb,thumb_pc from ' . tablename('sea_adv') . ' where uniacid=:uniacid and enabled=1 order by displayorder desc', array(':uniacid' => $uniacid));
    foreach ($advs as $key => $adv) {
        if (!empty($advs[$key]['thumb'])) {
            $adv[] = $advs[$key];
        }
        if (!empty($advs[$key]['thumb_pc'])) {
            $adv_pc[] = $advs[$key];
        }
    }
    $advs = set_medias($advs, 'thumb,thumb_pc');
    $advs_pc = set_medias($adv_pc, 'thumb,thumb_pc');
    $category = pdo_fetchall('select id,name,thumb,parentid,level from ' . tablename('sea_category') . ' where uniacid=:uniacid and ishome=1 and enabled=1 order by displayorder desc', array(':uniacid' => $_W['uniacid']));
    $category = set_medias($category, 'thumb');
    $index_name = array('isrecommand' => '精品推荐', 'isnew' => '新上商品', 'ishot' => '热卖商品', 'isdiscount' => '促销商品', 'issendfree' => '包邮商品', 'istime' => '限时特价');
    foreach ($category as &$c) {
        $c['thumb'] = tomedia($c['thumb']);
        if ($c['level'] == 3) {
            $c['url'] = $this->createMobileUrl('shop/list', array('tcate' => $c['id']));
        } else {
            if ($c['level'] == 2) {
                $c['url'] = $this->createMobileUrl('shop/list', array('ccate' => $c['id']));
            }
        }
    }
    $ads_pc = array();
    $goods_pc = array();
    if (!empty($this->yzShopSet['index']['isrecommand']) && !empty($this->yzShopSet['ispc'])) {
        $ads_pc['isrecommand'] = pdo_fetchall('select * from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'isrecommand\'', array(':uniacid' => $uniacid));
        $goods_pc['isrecommand'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 and isrecommand=1 order by displayorder desc limit 4', array(':uniacid' => $uniacid));
        $ads_pc['isrecommand'] = set_medias($ads_pc['isrecommand'], 'thumb');
        $goods_pc['isrecommand'] = set_medias($goods_pc['isrecommand'], 'thumb');
    }
    if (!empty($this->yzShopSet['index']['isnew']) && !empty($this->yzShopSet['ispc'])) {
        $ads_pc['isnew'] = pdo_fetchall('select * from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'isnew\'', array(':uniacid' => $uniacid));
        $goods_pc['isnew'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 and isnew=1 order by displayorder desc limit 4', array(':uniacid' => $uniacid));
        $ads_pc['isnew'] = set_medias($ads_pc['isnew'], 'thumb');
        $goods_pc['isnew'] = set_medias($goods_pc['isnew'], 'thumb');
    }
    if (!empty($this->yzShopSet['index']['ishot']) && !empty($this->yzShopSet['ispc'])) {
        $ads_pc['ishot'] = pdo_fetchall('select * from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'ishot\'', array(':uniacid' => $uniacid));
        $goods_pc['ishot'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 and ishot=1 order by displayorder desc limit 4', array(':uniacid' => $uniacid));
        $ads_pc['ishot'] = set_medias($ads_pc['ishot'], 'thumb');
        $goods_pc['ishot'] = set_medias($goods_pc['ishot'], 'thumb');
    }
    if (!empty($this->yzShopSet['index']['isdiscount']) && !empty($this->yzShopSet['ispc'])) {
        $ads_pc['isdiscount'] = pdo_fetchall('select * from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'isdiscount\'', array(':uniacid' => $uniacid));
        $goods_pc['isdiscount'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 and isdiscount=1 order by displayorder desc limit 4', array(':uniacid' => $uniacid));
        $ads_pc['isdiscount'] = set_medias($ads_pc['isdiscount'], 'thumb');
        $goods_pc['isdiscount'] = set_medias($goods_pc['isdiscount'], 'thumb');
    }
    if (!empty($this->yzShopSet['index']['issendfree']) && !empty($this->yzShopSet['ispc'])) {
        $ads_pc['issendfree'] = pdo_fetchall('select * from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'issendfree\'', array(':uniacid' => $uniacid));
        $goods_pc['issendfree'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 and issendfree=1 order by displayorder desc limit 4', array(':uniacid' => $uniacid));
        $ads_pc['issendfree'] = set_medias($ads_pc['issendfree'], 'thumb');
        $goods_pc['issendfree'] = set_medias($goods_pc['issendfree'], 'thumb');
    }
    if (!empty($this->yzShopSet['index']['istime']) && !empty($this->yzShopSet['ispc'])) {
        $ads_pc['istime'] = pdo_fetchall('select * from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'istime\'', array(':uniacid' => $uniacid));
        $goods_pc['istime'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 and istime=1 order by displayorder desc limit 4', array(':uniacid' => $uniacid));
        $ads_pc['istime'] = set_medias($ads_pc['istime'], 'thumb');
        $goods_pc['istime'] = set_medias($goods_pc['istime'], 'thumb');
    }
    $ads_pc['bottom_ad'] = pdo_fetch('select link,thumb from ' . tablename('sea_adpc') . ' where uniacid=:uniacid and location=\'bottom_ad\'', array(':uniacid' => $uniacid));
    if (!empty($ads_pc['bottom_ad'])) {
        $ads_pc['bottom_ad'] = set_medias($ads_pc['bottom_ad'], 'thumb');
    }
    unset($c);
} else {
    if ($operation == 'goods') {
        $type = $_GPC['type'];
        $args = array('page' => $_GPC['page'], 'pagesize' => 6, 'isrecommand' => 1, 'order' => 'displayorder desc,createtime desc', 'by' => '');
        $goods = m('goods')->getList($args);

    }
}
if ($_W['isajax']) {
    if ($operation == 'index') {
        show_json(1, array('set' => $set, 'advs' => $advs, 'category' => $category));
    } else {
        if ($operation == 'goods') {
            $type = $_GPC['type'];
            show_json(1, array('goods' => $goods, 'pagesize' => $args['pagesize'],'mid' => $member_shop['id']));
        }
    }
}
if ($operation == 'index' && $this->yzShopSet['ispc']) {
    $categorylist = getIndexCategory();
    $goodsall = getCategoryGoods();
    $supplierinfo = getSupplier();
}
function getIndexCategory(){
    global $_W, $_GPC;
   $categorylist = pdo_fetchall('select * from ' . tablename('sea_category') . ' where uniacid = :uniacid and parentid = 0 and enabled = 1',array(':uniacid'=>$_W['uniacid']));
   foreach ($categorylist as $key => &$value) {
        $value['advimg'] = $_W['siteroot'] .'/attachment/'.$value['advimg'];
    }
    unset($value);
    return $categorylist;
}
function getCategoryGoods($id,$limit = 4){
    global $_GPC,$_W;
    $allcategorylist = pdo_fetchall('select * from ' . tablename('sea_category') . ' where uniacid = :uniacid and enabled = 1',array(':uniacid'=>$_W['uniacid']));
    //var_dump($allcategorylist);;
    $categorylist = pdo_fetchall('select * from ' . tablename('sea_category') . ' where uniacid = :uniacid and parentid =0 and enabled = 1',array(':uniacid'=>$_W['uniacid']));
    foreach ($categorylist as $key => &$value) {
        $value['child'] = getCategoryTree($allcategorylist,$value['id']);
        $value['advimg'] = $_W['siteroot'] .'/attachment/'.$value['advimg'];
        foreach ($value['child'] as $ke => $val) {
            $value['childid'][] = $val['id'];

        }
        $childidstring = implode(',', $value['childid']);
        $value['goodslist'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where ccate in (:ccate) and uniacid = :uniacid and status = 1 and deleted = 0  order by id desc limit 0,4',array(':uniacid'=>$_W['uniacid'],':ccate'=>$childidstring));
        foreach ($value['goodslist'] as $k => &$va) {
            $va['thumb'] = $_W['siteroot'] .'/attachment/'.$va['thumb'];
            if (!empty($va['supplier_uid'])) {
                $supplierinfo = pdo_fetch('select * from ' . tablename('sea_perm_user') . ' where uid=' . $va['supplier_uid'] . ' and uniacid=' . $_W['uniacid']);
                if (!empty($supplierinfo['openid'])) {
                    $va['supplier_message'] = m('member')->getInfo($supplierinfo['openid']);
                }
            }
        }
        unset($va);


    }
    unset($value);
    //var_dump($categorylist);exit;
    return $categorylist;
}
function getCategoryTree($array,$parentid=0){
    $arr = array();
    foreach($array as $v){
        if($v['parentid']==$parentid){
            $arr[] = $v;
            $arr = array_merge($arr,getCategoryTree($array,$v['id']));
        }
    }
    return $arr;
}
function getSupplier(){
    global $_GPC,$_W;
    $supplierinfo = pdo_fetchall('select * from ' . tablename('sea_perm_user') . ' where uniacid=' . $_W['uniacid'] . ' limit 0,5');
    foreach ($supplierinfo as $key => &$value) {
        if (!empty($value['openid'])) {
            $value['member_message'] = m('member')->getInfo($value['openid']);
        }
        $salerlist = pdo_fetchall(' select * from ' . tablename('sea_order_goods') . ' og left join ' . tablename('sea_order') . ' o on o.id=og.orderid left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid where og.supplier_uid=:supplier_uid and og.uniacid=:uniacid', array(':supplier_uid' => $value['uid'], ':uniacid' => $_W['uniacid']));
        $value['saler_num'] = count($salerlist);

    }
    unset($value);
    return $supplierinfo;
}
$this->setHeader();
include $this->template('shop/index');