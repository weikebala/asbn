<?php
//海软商城 QQ:45300551
if (!defined('IN_IA')) {
	exit('Access Denied');
}
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
//check_shop_auth
if($operation == "display"){
    ca('coupon.log.view');
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $condition = ' d.uniacid = :uniacid';
    $params = array(':uniacid' => $_W['uniacid']);
    if (!empty($_GPC['coupon'])) {
        $coupon = trim($_GPC['coupon']);
        if (is_numeric($coupon)) {
            $condition .= ' AND c.id=' . intval($coupon);
        } else {
            $condition .= ' AND c.couponname LIKE :coupon or c.id like :coupon';
            $params[':coupon'] = "%{$_GPC['coupon']}%";
        }
    }
    if (!empty($_GPC['realname'])) {
        $_GPC['realname'] = trim($_GPC['realname']);
        $condition .= ' and ( m.realname like :realname or m.nickname like :realname or m.mobile like :realname)';
        $params[':realname'] = "%{$_GPC['realname']}%";
    }
    if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime = time();
    }
    if (empty($starttime1) || empty($endtime1)) {
        $starttime1 = strtotime('-1 month');
        $endtime1 = time();
    }
    if (!empty($_GPC['searchtime'])) {
        $starttime = strtotime($_GPC['time']['start']);
        $endtime = strtotime($_GPC['time']['end']);
        if ($_GPC['searchtime'] == '1') {
            $condition .= ' AND d.gettime >= :starttime AND d.gettime <= :endtime ';
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
    }
    if (!empty($_GPC['searchtime1'])) {
        $starttime1 = strtotime($_GPC['time1']['start']);
        $endtime1 = strtotime($_GPC['time1']['end']);
        if ($_GPC['searchtime'] == '1') {
            $condition .= ' AND d.usetime >= :starttime1 AND d.gettime <= :endtime1 ';
            $params[':starttime1'] = $starttime1;
            $params[':endtime1'] = $endtime1;
        }
    }
    if ($_GPC['type'] != '') {
        $condition .= ' AND c.coupontype = :coupontype';
        $params[':coupontype'] = intval($_GPC['type']);
    }
    if ($_GPC['used'] != '') {
        $condition .= ' AND d.used =' . intval($_GPC['used']);
    }
    if ($_GPC['gettype'] != '') {
        $condition .= ' AND d.gettype = :gettype';
        $params[':gettype'] = intval($_GPC['gettype']);
    }
    $sql = 'SELECT d.*, c.coupontype,c.couponname,m.nickname,m.avatar,m.realname,m.mobile FROM ' . tablename('sea_coupon_data') . ' d ' . ' left join ' . tablename('sea_coupon') . ' c on d.couponid = c.id ' . ' left join ' . tablename('sea_member') . ' m on m.openid = d.openid and m.uniacid = d.uniacid ' . " where  1 and {$condition} ORDER BY gettime DESC";
    if (empty($_GPC['export'])) {
        $sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
    }
    $list = pdo_fetchall($sql, $params);
    foreach ($list as &$row) {
        $row['gettime'] = date('Y-m-d H:i', $row['gettime']);
        if (!empty($row['usetime'])) {
            $row['usetime'] = date('Y-m-d H:i', $row['usetime']);
        } else {
            $row['usetime'] = '---';
        }
        $couponstr = '消费';
        if ($row['coupontype'] == 1) {
            $couponstr = '充值';
        }
        $row['couponstr'] = $couponstr;
        if ($row['gettype'] == 0) {
            $row['gettypestr'] = '后台发放';
        } else if ($row['gettype'] == 1) {
            $row['gettypestr'] = '领券中心';
        } else if ($row['gettype'] == 2) {
            $row['gettypestr'] = '积分商城';
        } else if ($row['gettype'] == 3) {
            $row['gettypestr'] = '超级海报';
        } else if ($row['gettype'] == 4) {
            $row['gettypestr'] = '活动海报';
        } else if ($row['gettype'] == 5) {
            $row['gettypestr'] = '口令优惠券';
        }
    }
    unset($row);
    if ($_GPC['export'] == 1) {
        ca('coupon.log.export');
        $columns = array(array('title' => 'ID', 'field' => 'id', 'width' => 12), array('title' => '优惠券', 'field' => 'couponname', 'width' => 24), array('title' => '类型', 'field' => 'couponstr', 'width' => 12), array('title' => '会员信息', 'field' => 'nickname', 'width' => 12), array('title' => '姓名', 'field' => 'realname', 'width' => 12), array('title' => '手机号', 'field' => 'mobile', 'width' => 12), array('title' => '获取方式', 'field' => 'gettypestr', 'width' => 12), array('title' => '获取时间', 'field' => 'gettime', 'width' => 12), array('title' => '使用时间', 'field' => 'usetime', 'width' => 12), array('title' => '使用单号', 'field' => 'usetime', 'width' => 12));
        m('excel')->export($list, array('title' => '优惠券数据-' . date('Y-m-d-H-i', time()), 'columns' => $columns));
    }
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('sea_coupon_data') . ' d ' . ' left join ' . tablename('sea_coupon') . ' c on d.couponid = c.id ' . ' left join ' . tablename('sea_member') . ' m on m.openid = d.openid and m.uniacid = d.uniacid ' . "where 1 and {$condition}", $params);
    $pager = pagination($total, $pindex, $psize);
}elseif($operation == "delete"){//删除用户优惠券
    ca('coupon.log.delete|coupon.log.view');
    $id = $_GPC['id'];
    if(empty($id)) message('参数错误!', '', 'error');
    $conpondata = pdo_get("sea_coupon_data",array("id"=>$id));
    if(empty($conpondata)) message('要删除的优惠券不存在', '', 'error');
    $del_res = pdo_delete("sea_coupon_data",array("id"=>$id));
    if($del_res === false) message('优惠券删除失败', '', 'error');
    message('优惠券删除成功', $this->createPluginWebUrl('coupon/log'), 'success');
}

load()->func('tpl');
include $this->template('log');
