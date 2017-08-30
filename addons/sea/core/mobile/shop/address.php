<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$openid    = m('user')->getOpenid();
$member    = m('member')->getMember($openid);
$trade     = m('common')->getSysset('trade');
if (!empty($trade['shareaddress']) && is_weixin()) {
    if (!$_W['isajax']) {
        $shareAddress = m('common')->shareAddress();
        if (empty($shareAddress)) {
            exit;
        }
    }
}

$istradearea = pdo_fetch('select id,is_tradearea from ' . tablename('tradearea_set') . ' where uniacid = :uniacid ',array(':uniacid'=>$_W['uniacid']));
if ($_W['isajax']) {
	if ($operation == 'display') {
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';
		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);
		$sql = 'SELECT COUNT(*) FROM ' . tablename('sea_member_address') . " where 1 $condition";
		$total = pdo_fetchcolumn($sql, $params);
		$list = array();
		if (!empty($total)) {
			$sql = 'SELECT * FROM ' . tablename('sea_member_address') . ' where 1 ' . $condition . ' ORDER BY `id` DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
			$list = pdo_fetchall($sql, $params);
		}
		show_json(1, array('list' => $list));
	} else if ($operation == 'new') {
		show_json(1, array('address' => array('province' => $member['province'], 'city' => $member['city']), 'area' => $member['area'], 'member' => $member, 'shareAddress' => $shareAddress));
	} else if ($operation == 'get') {
		$id = intval($_GPC['id']);
		$data = pdo_fetch('select * from ' . tablename('sea_member_address') . ' where id=:id and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));       $tradearea = pdo_fetch('select id,uniacid,area from ' . tablename('tradearea') . ' where uniacid = :uniacid and province = :province and city = :city and district = :district',array(':uniacid'=>$_W['uniacid'],':province'=>$data['province'],'city'=>$data['city'],'district'=>$data['area']));
		show_json(1, array('address' => $data, 'member' => $member, 'tradearea' => $tradearea));
	} 
	
	else if ($operation == 'trade') {
		if (!empty($_GPC['province']) || !empty($_GPC['city']) || !empty($_GPC['district'])) {
        $result = pdo_fetchall('select id,uniacid,area from ' . tablename('tradearea') . ' where uniacid = :uniacid and province = :province and city = :city and district = :district and status = 1',array(':uniacid'=>$_W['uniacid'],':province'=>$_GPC['province'],'city'=>$_GPC['city'],'district'=>$_GPC['district']));
    }
	    $address = $_GPC['addressid'];
		
		if (!empty($result)) {
        $re = pdo_fetch('select * from ' . tablename('sea_member_address') . ' where id=:id and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $address));
		$result['tradeid'] = $re['tradearea_id'];
        show_json(1,$result);
        }else{
        $result = '没有改记录！';
        show_json(0,$result);
        }
	}
	
	else if ($operation == 'submit' && $_W['ispost']) {
		$id = intval($_GPC['id']);
		$data = $_GPC['addressdata'];
		$data['openid'] = $openid;
		$data['uniacid'] = $_W['uniacid'];
		if (empty($id)) {
			$addresscount = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('sea_member_address') . ' where openid=:openid and deleted=0 and `uniacid` = :uniacid ', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
			if ($addresscount <= 0) {
				$data['isdefault'] = 1;
			}
			pdo_insert('sea_member_address', $data);
			$id = pdo_insertid();
		} else {
			pdo_update('sea_member_address', $data, array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $openid));
		}
		show_json(1, array('addressid' => $id));
	} else if ($operation == 'remove' && $_W['ispost']) {
		$id = intval($_GPC['id']);
		$data = pdo_fetch('select id,isdefault from ' . tablename('sea_member_address') . ' where  id=:id and openid=:openid and deleted=0 and uniacid=:uniacid  limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid, ':id' => $id));
		if (empty($data)) {
			show_json(0, '地址未找到');
		}
		pdo_update('sea_member_address', array('deleted' => 1), array('id' => $id));
		if ($data['isdefault'] == 1) {
			pdo_update('sea_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'id' => $id));
			$data2 = pdo_fetch('select id from ' . tablename('sea_member_address') . ' where openid=:openid and deleted=0 and uniacid=:uniacid order by id desc limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
			if (!empty($data2)) {
				pdo_update('sea_member_address', array('isdefault' => 1), array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'id' => $data2['id']));
				show_json(1, array('defaultid' => $data2['id']));
			}
		}
		show_json(1);
	} else if ($operation == 'setdefault' && $_W['ispost']) {
		$id = intval($_GPC['id']);
		$data = pdo_fetch('select id from ' . tablename('sea_member_address') . ' where id=:id and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
		if (empty($data)) {
			show_json(0, '地址未找到');
		}
		pdo_update('sea_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $openid));
		pdo_update('sea_member_address', array('isdefault' => 1), array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $openid));
		show_json(1);
	}
}
include $this->template('shop/address');