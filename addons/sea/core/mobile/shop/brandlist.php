<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
$openid = m('user')->getOpenid();
if (empty($openid)) {
    $openid_shop = m('user')->isLogin();
    $member_shop = m('member')->getMember($openid_shop);
}
$uniacid = $_W['uniacid'];
$set = set_medias(m('common')->getSysset('shop'), array('logo', 'img'));
$commission = p('commission');
if ($commission) {
    $shopid = intval($_GPC['shopid']);
    if (!empty($shopid)) {
        $myshop = set_medias($commission->getShop($shopid), array('img', 'logo'));
    }
}
$current_category = false;
if (!empty($_GPC['tcate'])) {
    $current_category = pdo_fetch('select id,parentid,name,level from ' . tablename('sea_category') . ' where id=:id 
        and uniacid=:uniacid order by displayorder DESC', array(':id' => intval($_GPC['tcate']), ':uniacid' => $_W['uniacid']));
} elseif (!empty($_GPC['ccate'])) {
    $current_category = pdo_fetch('select id,parentid,name,level from ' . tablename('sea_category') . ' where id=:id 
        and uniacid=:uniacid order by displayorder DESC', array(':id' => intval($_GPC['ccate']), ':uniacid' => $_W['uniacid']));
} elseif (!empty($_GPC['pcate'])) {
    $current_category = pdo_fetch('select id,parentid,name,level from ' . tablename('sea_category') . ' where id=:id 
        and uniacid=:uniacid order by displayorder DESC', array(':id' => intval($_GPC['pcate']), ':uniacid' => $_W['uniacid']));
}
$current_brand = pdo_fetch('select * from ' . tablename('sea_brand') . ' where id=:id 
    and uniacid=:uniacid limit 1', array(':id' => $_GPC['bid'], ':uniacid' => $_W['uniacid']));
$args = array('pagesize' => 20, 'page' => $_GPC['page'], 'isnew' => $_GPC['isnew'], 'brandid' => $_GPC['bid'], 'ishot' => $_GPC['ishot'], 'isrecommand' => $_GPC['isrecommand'], 'isdiscount' => $_GPC['isdiscount'], 'istime' => $_GPC['istime'], 'keywords' => $_GPC['keywords'], 'pcate' => $_GPC['pcate'], 'ccate' => $_GPC['ccate'], 'tcate' => $_GPC['tcate'], 'order' => $_GPC['order'], 'by' => $_GPC['by']);

if (!empty($myshop['selectgoods']) && !empty($myshop['goodsids'])) {
    $args['ids'] = $myshop['goodsids'];
}
$condition = ' and `uniacid` = :uniacid AND `deleted` = 0 and status=1';
$params = array(':uniacid' => $_W['uniacid']);
if (!empty($args['ids'])) {
    $condition .= ' and id in ( ' . $args['ids'] . ')';
}
$isnew = !empty($args['isnew']) ? 1 : 0;
if (!empty($isnew)) {
    $condition .= ' and isnew=1';
}
$ishot = !empty($args['ishot']) ? 1 : 0;
if (!empty($ishot)) {
    $condition .= ' and ishot=1';
}
$isrecommand = !empty($args['isrecommand']) ? 1 : 0;
if (!empty($isrecommand)) {
    $condition .= ' and isrecommand=1';
}
$isdiscount = !empty($args['isdiscount']) ? 1 : 0;
if (!empty($isdiscount)) {
    $condition .= ' and isdiscount=1';
}
$istime = !empty($args['istime']) ? 1 : 0;
if (!empty($istime)) {
    $condition .= ' and istime=1 and ' . time() . '>=timestart and ' . time() . '<=timeend';
}
$keywords = !empty($args['keywords']) ? $args['keywords'] : '';
if (!empty($keywords)) {
    $condition .= ' AND `title` LIKE :title';
    $params[':title'] = '%' . trim($keywords) . '%';
}
$tcate = !empty($args['tcate']) ? intval($args['tcate']) : 0;
if (!empty($tcate)) {
    $condition .= " AND (`tcate` = :tcate or FIND_IN_SET({$tcate},cates)<>0)";
    $params[':tcate'] = intval($tcate);
}
$ccate = !empty($args['ccate']) ? intval($args['ccate']) : 0;
if (!empty($ccate)) {
    $condition .= " AND ( `ccate` = :ccate or  FIND_IN_SET({$ccate},cates)<>0 )";
    $params[':ccate'] = intval($ccate);
}
$bid = !empty($args['brandid']) ? intval($args['brandid']) : 0;
if (!empty($bid)) {
    $condition .= ' AND `brandid` = :brandid';
    $params[':brandid'] = intval($bid);
}
$pcate = !empty($args['pcate']) ? intval($args['pcate']) : 0;
if (!empty($pcate)) {
   $condition .= ' AND `pcate` = :pcate';
    $params[':pcate'] = intval($pcate);
}
if (isset($_GPC['search_canfree'])) {
    $args['issendfree'] = intval($_GPC['search_canfree']);
    $condition .= ' AND `issendfree` = :search_canfree ';
    $params[':search_canfree'] =intval($_GPC['search_canfree']);
    $is_search_canfree = $_GPC['search_canfree'];
}
if (isset($_GPC['search_num'])) {
    if (intval($_GPC['search_num'])==1) {
        $args['order'] = ' sales desc ';
    }else {
        $args['order'] = ' sales asc ';
    }
    $is_search_num = $_GPC['search_num'];
}
if (isset($_GPC['search_price'])) {
    if (intval($_GPC['search_price'])==1) {
        $args['order'] = ' marketprice desc ';
    }else {
        $args['order'] = ' marketprice asc ';
    }
    $is_search_price = $_GPC['search_price'];
}

$total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('sea_goods') . " where 1 {$condition}", $params);

$pindex = max(1, intval($_GPC['page']));
$pager = pagination($total, $pindex, $args['pagesize']);

$goods = m('goods')->getList($args);
if ($_GPC['op'] == 'myshop') {
    $supplier_uid = intval($_GPC['supplier_uid']);
    if (!empty($supplier_uid)) {
        $my_message = pdo_fetch('select * from ' . tablename('sea_perm_user') . ' where uniacid = :uniacid and uid = :supplier_uid and status = 1',array(':uniacid'=>$_W['uniacid'],'supplier_uid'=>$supplier_uid));
        $my_message['member_message'] = m('member')->getInfo($my_message['openid']); 
        $my_message['goods_list'] = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and supplier_uid = :supplier_uid and status = 1 and deleted = 0',array('uniacid'=>$_W['uniacid'],'supplier_uid'=>$supplier_uid)); 
        $my_message['count'] = count($my_message['goods_list']);
        foreach ($my_message['goods_list'] as $key => &$value) {
            $value['thumb'] = $_W['siteroot'] .'attachment/'.$value['thumb'];
        }
        unset($value);
        //var_dump($my_message);exit;
        include $this->template('shop/myshop');exit;
    }
}
if (!empty($_GPC['supplier_uid']) && empty($_GPC['op'])) {
    $total = pdo_fetchcolumn('select count(*) from ' . tablename('sea_goods') . ' where uniacid = :uniacid and supplier_uid = :supplier_uid and status = 1 and deleted = 0',array(':uniacid'=>$_W['uniacid'],':supplier_uid'=>intval($_GPC['supplier_uid'])));
    $pindex = max(1, intval($_GPC['page']));
    $pager = pagination($total, $pindex, $args['pagesize']);
    $goods = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where uniacid = :uniacid and supplier_uid = :supplier_uid and status = 1 and deleted = 0',array('uniacid'=>$_W['uniacid'],'supplier_uid'=>intval($_GPC['supplier_uid'])));
}
foreach ($goods as $key => &$value) {
    $value['supplier_message'] = pdo_fetch('select * from ' . tablename('sea_perm_user') . ' where uniacid = :uniacid and uid = :supplier_uid and status = 1',array(':uniacid'=>$_W['uniacid'],'supplier_uid'=>$value['supplier_uid']));
        if (!empty($value['supplier_message']['openid'])) {
            $value['supplier_message']['member_message'] = m('member')->getInfo($value['supplier_message']['openid']);
        }
}
unset($value);
$category = false;

    if (!empty($_GPC['tcate'])) {
        $parent_category1 = pdo_fetch('select id,parentid,name,level,thumb from ' . tablename('sea_category') . ' 
            where id=:id and uniacid=:uniacid limit 1', array(':id' => $parent_category['parentid'], ':uniacid' => $_W['uniacid']));
        $category = pdo_fetchall('select id,name,level,thumb from ' . tablename('sea_category') . ' 
            where parentid=:parentid 
            and enabled=1 and uniacid=:uniacid order by level asc, isrecommand desc, displayorder DESC', array(':parentid' => $parent_category['id'], ':uniacid' => $_W['uniacid']));
        $category = array_merge(array(array('id' => 0, 'name' => '全部分类', 'level' => 0), $parent_category1, $parent_category), $category);
    } elseif (!empty($_GPC['ccate'])) {
        //var_dump($_GPC);exit;
        /*if (intval($set['catlevel']) == 3) {
            $category = pdo_fetchall('select id,name,level,thumb from ' . tablename('sea_category') . ' where 
                (parentid=:parentid or id=:parentid) and enabled=1  and uniacid=:uniacid 
                order by level asc, isrecommand desc, displayorder DESC', array(':parentid' => intval($_GPC['ccate']), ':uniacid' => $_W['uniacid']));
        } else {
            $category = pdo_fetchall('select id,name,level,thumb from ' . tablename('sea_category') . ' where 
                parentid=:parentid and enabled=1 and uniacid=:uniacid order by level asc, 
                isrecommand desc, displayorder DESC', array(':parentid' => $parent_category['id'], ':uniacid' => $_W['uniacid']));
        }
        $category = array_merge(array(array('id' => 0, 'name' => '全部分类', 'level' => 0), $parent_category), $category);*/
        $allcategory = pdo_fetchall('select id,parentid,name,level,thumb from ' . tablename('sea_category') . ' where 
                 enabled=1 and uniacid=:uniacid order by level asc, isrecommand desc, displayorder DESC', array(':uniacid' => $_W['uniacid']));
        $category = pdo_fetchall('select id,name,level,thumb,parentid from ' . tablename('sea_category') . ' where parentid=:parentid and enabled=1 and uniacid=:uniacid order by level asc, 
                isrecommand desc, displayorder DESC', array(':parentid' => 0, ':uniacid' => $_W['uniacid']));
        $current_category = intval($_GPC['ccate']);
        $ccatecategory = getCategoryTree($allcategory,$_GPC['ccate']);
        $ccatecategory[count($ccatecategory)] = array('id'=>intval($_GPC['ccate']));
        foreach ($ccatecategory as $ke => $val) {
            $ccatecategory['childid'][] = $val['id'];

        }
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $ccate_string = implode(',', $ccatecategory['childid']);
        //var_dump($ccate_string);exit;
        $goods = pdo_fetchall('select * from ' . tablename('sea_goods') . ' where ccate in (:ccate) and uniacid = :uniacid and status = 1 and deleted = 0  order by id desc limit ' . ($pindex - 1) * $psize . ',' . $psize,array(':uniacid'=>$_W['uniacid'],':ccate'=>$ccate_string));
        $total = pdo_fetchcolumn('select count(*) from ' . tablename('sea_goods') . ' where ccate in (:ccate) and uniacid = :uniacid and status = 1 and deleted = 0 ',array(':uniacid'=>$_W['uniacid'],':ccate'=>$ccate_string));
        $pager = pagination($total, $pindex, $psize);
        foreach ($goods as $k => &$va) {
            $va['thumb'] = $_W['siteroot'] .'attachment/'.$va['thumb'];
            if (!empty($va['supplier_uid'])) {
                $va['supplier_message']= pdo_fetch('select * from ' . tablename('sea_perm_user') . ' where uid=' . $va['supplier_uid'] . ' and uniacid=' . $_W['uniacid']);
                if (!empty($va['supplier_message']['openid'])) {
                    $va['supplier_message']['member_message'] = m('member')->getInfo($va['supplier_message']['openid']);
                }
            }
        }
        //var_dump($goods);exit;
        unset($va);
    } elseif (!empty($_GPC['pcate'])) {
        $category = pdo_fetchall('select id,name,level,thumb from ' . tablename('sea_category') . ' 
            where (parentid=:parentid or id=:parentid) and enabled=1 and uniacid=:uniacid order by level asc, 
            isrecommand desc, displayorder DESC', array(':parentid' => intval($_GPC['pcate']), ':uniacid' => $_W['uniacid']));
        $category = array_merge(array(array('id' => 0, 'name' => '全部分类', 'level' => 0)), $category);
    } else {
        $category = pdo_fetchall('select id,name,level,thumb from ' . tablename('sea_category') . ' 
            where parentid=0 and enabled=1 and uniacid=:uniacid order by displayorder DESC', array(':uniacid' => $_W['uniacid']));
    }
    foreach ($category as &$c) {
        $c['thumb'] = tomedia($c['thumb']);
        if ($current_category['id'] == $c['id']) {
            $c['on'] = true;
        }
    }
    unset($c);

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

if ($_W['isajax']) {
    show_json(1, array('goods' => $goods, 'pagesize' => $args['pagesize'], 'category' => $category, 'current_category' => $current_category));
}
include $this->template('shop/brandlist');