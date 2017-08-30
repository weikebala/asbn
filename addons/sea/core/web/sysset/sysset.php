<?php
 
//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
function upload_cert($_var_0)
{
    global $_W;
    $_var_1 = IA_ROOT . '/addons/sea/cert';
    load()->func('file');
    mkdirs($_var_1, '0777');
    $_var_2 = $_var_0 . '_' . $_W['uniacid'] . '.pem';
    $_var_3 = $_var_1 . '/' . $_var_2;
    $_var_4 = $_FILES[$_var_0]['name'];
    $_var_5 = $_FILES[$_var_0]['tmp_name'];
    if (!empty($_var_4) && !empty($_var_5)) {
        $_var_6 = strtolower(substr($_var_4, strrpos($_var_4, '.')));
        if ($_var_6 != '.pem') {
            $_var_7 = '';
            if ($_var_0 == 'weixin_cert_file') {
                $_var_7 = 'CERT文件格式错误';
            } else {
                if ($_var_0 == 'weixin_key_file') {
                    $_var_7 = 'KEY文件格式错误';
                } else {
                    if ($_var_0 == 'weixin_root_file') {
                        $_var_7 = 'ROOT文件格式错误';
                    }
                }
            }
            message($_var_7 . ',请重新上传!', '', 'error');
        }
        return file_get_contents($_var_5);
    }
    return '';
}
$op = empty($_GPC['op']) ? 'shop' : trim($_GPC['op']);
if ($op == 'datamove') {
    $up = m('common')->dataMove();
    die('迁移成功');
}
$setdata = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
$set = unserialize($setdata['sets']);
$oldset = unserialize($setdata['sets']);
if ($op == 'template') {
    $styles = array();
    $styles2 = array();
    $dir = IA_ROOT . '/addons/sea/template/mobile/';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            if ($file != '..' && $file != '.') {
                if (is_dir($dir . '/' . $file)) {
                    $styles[] = $file;
                }
            }
        }
        closedir($handle);
    }
    $dir2 = IA_ROOT . '/addons/sea/template/pc/';
    if ($handle2 = opendir($dir2)) {
        while (($file = readdir($handle2)) !== false) {
            if ($file != '..' && $file != '.') {
                if (is_dir($dir2 . '/' . $file)) {
                    $styles2[] = $file;
                }
            }
        }
        closedir($handle);
    }

} else {
    if ($op == 'notice') {
        $salers = array();
        if (isset($set['notice']['openid'])) {
            if (!empty($set['notice']['openid'])) {
                $openids = array();
                $strsopenids = explode(',', $set['notice']['openid']);
                foreach ($strsopenids as $openid) {
                    $openids[] = '\'' . $openid . '\'';
                }
                $salers = pdo_fetchall('select id,nickname,avatar,openid from ' . tablename('sea_member') . ' where openid in (' . implode(',', $openids) . ") and uniacid={$_W['uniacid']}");
            }
        }
        $newtype = explode(',', $set['notice']['newtype']);
    } else {
        if ($op == 'pay') {
            $sec = m('common')->getSec();
            $sec = iunserializer($sec['sec']);
        } else {
            if ($op == 'pcset') {
                $designer = p('designer');
                $categorys = pdo_fetchall('SELECT * FROM ' . tablename('sea_article_category') . ' WHERE uniacid=:uniacid ', array(':uniacid' => $_W['uniacid']));
                if ($designer) {
                    $diypages = pdo_fetchall('SELECT id,pagetype,setdefault,pagename FROM ' . tablename('sea_designer') . ' WHERE uniacid=:uniacid order by setdefault desc  ', array(':uniacid' => $_W['uniacid']));
                }
                $article_sys = pdo_fetch('SELECT * FROM ' . tablename('sea_article_sys') . ' WHERE uniacid=:uniacid limit 1 ', array(':uniacid' => $_W['uniacid']));
                $article_sys['article_area'] = json_decode($article_sys['article_area'], true);
                $area_count = sizeof($article_sys['article_area']);
                if ($area_count == 0) {
                    $article_sys['article_area'][0]['province'] = '';
                    $article_sys['article_area'][0]['city'] = '';
                    $area_count = 1;
                }
                $goodcates = pdo_fetchall('SELECT id,name,parentid FROM ' . tablename('sea_category') . ' WHERE enabled=:enabled and uniacid= :uniacid  ', array(':uniacid' => $_W['uniacid'], ':enabled' => '1'));
                if (empty($set['shop']['hmenu_name'])) {
                    $set['shop']['hmenu_name'] = array('首页', '全部商品', '店铺公告', '成为加盟商', '会员中心');
                    $set['shop']['hmenu_url'] = array($this->createMobileUrl('shop/index'), $this->createMobileUrl('shop/list', array('order' => 'sales', 'by' => 'desc')), $this->createMobileUrl('shop/notice'), $this->createPluginMobileUrl('commission'), $this->createMobileUrl('member/info'));
                    $set['shop']['hmenu_id'] = array('yz01', 'yz02', 'yz03', 'yz04', 'yz05');
                }
            }
        }
    }
}
if (checksubmit()) {
    if ($op == 'shop') {
        $shop = is_array($_GPC['shop']) ? $_GPC['shop'] : array();
        $set['shop']['name'] = trim($shop['name']);
        $set['shop']['cservice'] = trim($shop['cservice']);
        $set['shop']['img'] = save_media($shop['img']);
        $set['shop']['logo'] = save_media($shop['logo']);
        $set['shop']['signimg'] = save_media($shop['signimg']);
        $set['shop']['diycode'] = trim($shop['diycode']);
        $set['shop']['copyright'] = trim($shop['copyright']);
        $set['shop']['btnname'] = trim($shop['btnname']);
        $set['shop']['btnlink'] = trim($shop['btnlink']);
        $hotkeyword = trim($shop['hotkeyword']);
        $hotkeyword = str_replace("，",",",$hotkeyword);
        $hotkeyword = trim($hotkeyword,",");
        $set['shop']['hotkeyword'] = $hotkeyword;
        plog('sysset.save.shop', '修改系统设置-商城设置');
    } elseif ($op == 'pcset') {
        $custom = is_array($_GPC['pcset']) ? $_GPC['pcset'] : array();
        $set['shop']['ispc'] = trim($custom['ispc']);
        $set['shop']['pctitle'] = trim($custom['pctitle']);
        $set['shop']['pckeywords'] = trim($custom['pckeywords']);
        $set['shop']['pcdesc'] = trim($custom['pcdesc']);
        $set['shop']['pccopyright'] = trim($custom['pccopyright']);
        $set['shop']['index'] = $custom['index'];
        $set['shop']['pclogo'] = save_media($custom['pclogo']);
        $set['shop']['reglogo'] = save_media($custom['reglogo']);
        $set['shop']['hmenu_name'] = $custom['hmenu_name'];
        $set['shop']['hmenu_url'] = $custom['hmenu_url'];
        $set['shop']['hmenu_id'] = $custom['hmenu_id'];
        $set['shop']['fmenu_name'] = $custom['fmenu_name'];
        $set['shop']['fmenu_url'] = $custom['fmenu_url'];
        $set['shop']['fmenu_id'] = $custom['fmenu_id'];
        plog('sysset.save.sms', '修改系统设置-PC设置');
    } elseif ($op == 'sms') {
        $sms = is_array($_GPC['sms']) ? $_GPC['sms'] : array();
        $set['sms']['type'] = $sms['type'];
        $set['sms']['account'] = $sms['account'];
        $set['sms']['password'] = $sms['password'];
        $set['sms']['appkey'] = $sms['appkey'];
        $set['sms']['secret'] = $sms['secret'];
        $set['sms']['signname'] = $sms['signname'];
        $set['sms']['product'] = $sms['product'];
        $set['sms']['templateCode'] = $sms['templateCode'];
        $set['sms']['templateCodeForget'] = $sms['templateCodeForget'];
        plog('sysset.save.sms', '修改系统设置-短信设置');
    }elseif($op == 'phb'){
        $phb = is_array($_GPC['phb']) ? $_GPC['phb'] : array();
        $set['phb'] = $phb;
       plog('sysset.save.phb', '修改系统设置-排行榜设置');     
    } elseif ($op == 'follow') {
        $set['share'] = is_array($_GPC['share']) ? $_GPC['share'] : array();
        $set['share']['icon'] = save_media($set['share']['icon']);
        plog('sysset.save.follow', '修改系统设置-分享及关注设置');
    } else {
        if ($op == 'notice') {
            $set['notice'] = is_array($_GPC['notice']) ? $_GPC['notice'] : array();
            if (is_array($_GPC['openids'])) {
                $set['notice']['openid'] = implode(',', $_GPC['openids']);
            }
            $set['notice']['newtype'] = $_GPC['notice']['newtype'];
            if (is_array($set['notice']['newtype'])) {
                $set['notice']['newtype'] = implode(',', $set['notice']['newtype']);
            }
            plog('sysset.save.notice', '修改系统设置-模板消息通知设置');
        } elseif ($op == 'trade') {
            $set['trade'] = is_array($_GPC['trade']) ? $_GPC['trade'] : array();
            if (!$_W['isfounder']) {
                unset($set['trade']['receivetime']);
                unset($set['trade']['closordertime']);
                unset($set['trade']['paylog']);
            } else {
                m('cache')->set('receive_time', $set['trade']['receivetime'], 'global');
                m('cache')->set('closeorder_time', $set['trade']['closordertime'], 'global');
                m('cache')->set('paylog', $set['trade']['paylog'], 'global');
            }
            plog('sysset.save.trade', '修改系统设置-交易设置');
        } elseif ($op == 'pay') {
            $pluginy = p('yunpay');
            if ($pluginy) {
                $pay = $set['pay']['yunpay'];
            }
            $set['pay'] = is_array($_GPC['pay']) ? $_GPC['pay'] : array();
            if ($pluginy) {
                $set['pay']['yunpay'] = $pay;
            }
            if ($_FILES['weixin_cert_file']['name']) {
                $sec['cert'] = upload_cert('weixin_cert_file');
            }
            if ($_FILES['weixin_key_file']['name']) {
                $sec['key'] = upload_cert('weixin_key_file');
            }
            if ($_FILES['weixin_root_file']['name']) {
                $sec['root'] = upload_cert('weixin_root_file');
            }
            if (empty($sec['cert']) || empty($sec['key']) || empty($sec['root'])) {
            }
            pdo_update('sea_sysset', array('sec' => iserializer($sec)), array('uniacid' => $_W['uniacid']));
            plog('sysset.save.pay', '修改系统设置-支付设置');
        } elseif ($op == 'template') {
            $shop = is_array($_GPC['shop']) ? $_GPC['shop'] : array();
            $set['shop']['style'] = save_media($shop['style']);
            $set['shop']['theme'] = trim($shop['theme']);
            m('cache')->set('template_shop', $set['shop']['style']);
            m('cache')->set('theme_shop', $set['shop']['theme']);

            $set['shop']['pstyle'] = save_media($shop['pstyle']);
            m('cache')->set('ptemplate_shop', $set['shop']['pstyle']);
            plog('sysset.save.template', '修改系统设置-模板设置');
        }elseif ($op == 'refund_add') {
		//添加退货地址
			$refund_add = is_array($_GPC['refund_add']) ? $_GPC['refund_add'] : array();
			$edit_id = $refund_add['edit_id'];//编辑退货地址id
			$uid = $refund_add['supplier_uid'];//供货商id
			$result = pdo_fetchall('SELECT realname,username FROM ' . tablename('sea_perm_user') . ' where uniacid = :uniacid and uid = :uid ', array(':uniacid' => $_W['uniacid'],':uid'=>$refund_add['supplier_uid']));//读取供货商昵称和真实姓名

			$data   = array(
				'uniacid' => intval($_W['uniacid']),
				'title' => $refund_add['title'],
				'name' => $refund_add['name'],
				'mobile' => $refund_add['mobile'],
				'province' => $_GPC['reside']['province'],
				'city' => $_GPC['reside']['city'],
				'area' => $_GPC['reside']['district'],
				'isdefault' => $refund_add['isdefault'],
				'address' => $refund_add['address'],
				'supplier_uid' => $refund_add['supplier_uid'],
				'realname' => $result[0]['realname'],
				'username' => $result[0]['username']
			);

			//默认退货地址
			if($refund_add['isdefault'] == 1){
				$is_default = 0;
				$isdefault   = array('isdefault' => $is_default);
				pdo_update('sea_refund_address', $isdefault, array('uniacid' => $_W['uniacid'],'supplier_uid' => $uid));
			 }
			if(empty($edit_id)){
            	pdo_insert('sea_refund_address', $data);
				message('退货地址添加成功!', $this->createWebUrl('sysset',array('op'=>'refund')), 'success');
			} else {
				pdo_update('sea_refund_address', $data, array('uniacid' => $_W['uniacid'],'id' => $edit_id));
				message('退货地址修改成功!', $this->createWebUrl('sysset',array('op'=>'refund')), 'success');
			}
			
        } elseif ($op == 'member') {
            $shop = is_array($_GPC['shop']) ? $_GPC['shop'] : array();
            $set['shop']['levelname'] = trim($shop['levelname']);
            $set['shop']['levelurl'] = trim($shop['levelurl']);
            plog('sysset.save.member', '修改系统设置-会员设置');
            $set['shop']['isbindmobile'] = intval($shop['isbindmobile']);
        } elseif ($op == 'category') {
            $shop = is_array($_GPC['shop']) ? $_GPC['shop'] : array();
            $set['shop']['catlevel'] = trim($shop['catlevel']);
            $set['shop']['catshow'] = intval($shop['catshow']);
            $set['shop']['catadvimg'] = save_media($shop['catadvimg']);
            $set['shop']['catadvurl'] = trim($shop['catadvurl']);
            plog('sysset.save.category', '修改系统设置-分类层级设置');
        } elseif ($op == 'contact') {
            $shop = is_array($_GPC['shop']) ? $_GPC['shop'] : array();
            $set['shop']['qq'] = trim($shop['qq']);
            $set['shop']['address'] = trim($shop['address']);
            $set['shop']['phone'] = trim($shop['phone']);
            $set['shop']['description'] = trim($shop['description']);
            plog('sysset.save.contact', '修改系统设置-联系方式设置');
        } 

    }
    $data = array('uniacid' => $_W['uniacid'], 'sets' => iserializer($set));
    if (empty($setdata)) {
        pdo_insert('sea_sysset', $data);
    } else {
        pdo_update('sea_sysset', $data, array('uniacid' => $_W['uniacid']));
    }
    $setdata = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
    m('cache')->set('sysset', $setdata);
    message('设置保存成功!', $this->createWebUrl('sysset', array('op' => $op)), 'success');
}

//退货地址列表
$pindex = max(1, intval($_GPC['page']));
$psize = 10;
$params = array(':uniacid' => $_W['uniacid'], ':deleted' => '0');
$condition = ' WHERE `uniacid` = :uniacid AND `deleted` = :deleted';
$sql = 'SELECT * FROM ' . tablename('sea_refund_address') . $condition . ' ORDER BY `id` DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
$sqls = 'SELECT COUNT(*) FROM ' . tablename('sea_refund_address') . $condition;
$total = pdo_fetchcolumn($sqls,$params);
$list = pdo_fetchall($sql, $params);
$pager = pagination($total, $pindex, $psize);
$result = pdo_fetchall('SELECT uid,realname,username FROM ' . tablename('sea_perm_user') . ' where uniacid =' . $_W['uniacid']);
$operation = !empty($_GPC['wwe']) ? $_GPC['wwe'] : 'shope';
//删除退货地址
if ($operation == 'delete') {
	$id = intval($_GPC['id']);
	if(!empty($id)){
		pdo_query('delete from ' . tablename('sea_refund_address') . " where id = ".$id );
        message('删除成功！', referer(), 'success');
	}
}elseif($operation == 'edit'){
//编辑退货地址
$id = intval($_GPC['id']);
$sqled = pdo_fetch('select * from ' . tablename('sea_refund_address') . ' where id = '.$id );

}
 

load()->func('tpl');
include $this->template('web/sysset/' . $op);
die;

