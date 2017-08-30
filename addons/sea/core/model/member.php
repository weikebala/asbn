<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Sz_DYi_Member
{
    private $_fansData = 0;
    public function getInfo($openid = '')
    {
        global $_W;
        $uid = intval($openid);
        if ($uid == 0) {
            $info = pdo_fetch('select * from ' . tablename('sea_member') . ' where openid=:openid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
        } else {
            $info = pdo_fetch('select * from ' . tablename('sea_member') . ' where id=:id  and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $uid));
        }
        if (!empty($info['uid'])) {
            load()->model('mc');
            $uid = mc_openid2uid($info['openid']);
            $_var_3 = mc_fetch($uid, array('credit1', 'credit2', 'birthyear', 'birthmonth', 'birthday', 'gender', 'avatar', 'resideprovince', 'residecity', 'nickname'));
            $info['credit1'] = $_var_3['credit1'];
            $info['credit2'] = $_var_3['credit2'];
            $info['birthyear'] = empty($info['birthyear']) ? $_var_3['birthyear'] : $info['birthyear'];
            $info['birthmonth'] = empty($info['birthmonth']) ? $_var_3['birthmonth'] : $info['birthmonth'];
            $info['birthday'] = empty($info['birthday']) ? $_var_3['birthday'] : $info['birthday'];
            $info['nickname'] = empty($info['nickname']) ? $_var_3['nickname'] : $info['nickname'];
            $info['gender'] = empty($info['gender']) ? $_var_3['gender'] : $info['gender'];
            $info['sex'] = $info['gender'];
            $info['avatar'] = empty($info['avatar']) ? $_var_3['avatar'] : $info['avatar'];
            $info['headimgurl'] = $info['avatar'];
            $info['province'] = empty($info['province']) ? $_var_3['resideprovince'] : $info['province'];
            $info['city'] = empty($info['city']) ? $_var_3['residecity'] : $info['city'];
        }
        if (!empty($info['birthyear']) && !empty($info['birthmonth']) && !empty($info['birthday'])) {
            $info['birthday'] = $info['birthyear'] . '-' . (strlen($info['birthmonth']) <= 1 ? '0' . $info['birthmonth'] : $info['birthmonth']) . '-' . (strlen($info['birthday']) <= 1 ? '0' . $info['birthday'] : $info['birthday']);
        }
        if (empty($info['birthday'])) {
            $info['birthday'] = '';
        }
        return $info;
    }
    public function getMember($openid = '')
    {
        global $_W;
        $uid = intval($openid);
        if (empty($uid)) {
            $info = pdo_fetch('select * from ' . tablename('sea_member') . ' where  openid=:openid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
        } else {
            $info = pdo_fetch('select * from ' . tablename('sea_member') . ' where id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $uid));
        }
        if (!empty($info)) {
            $openid = $info['openid'];
            if (empty($info['uid'])) {
                $followed = m('user')->followed($openid);
                if ($followed) {
                    load()->model('mc');
                    $uid = mc_openid2uid($openid);
                    if (!empty($uid)) {
                        $info['uid'] = $uid;
                        $_var_5 = array('uid' => $uid);
                        if ($info['credit1'] > 0) {
                            mc_credit_update($uid, 'credit1', $info['credit1']);
                            $_var_5['credit1'] = 0;
                        }
                        if ($info['credit2'] > 0) {
                            mc_credit_update($uid, 'credit2', $info['credit2']);
                            $_var_5['credit2'] = 0;
                        }
                        if (!empty($_var_5)) {
                            pdo_update('sea_member', $_var_5, array('id' => $info['id']));
                        }
                    }
                }
            }
            $credits = $this->getCredits($openid);
            $info['credit1'] = $credits['credit1'];
            $info['credit2'] = $credits['credit2'];
			
			//yangyang
			$uniacid = $_W['uniacid'];

			$conditionc = ' and f.uniacid= :uniacid and f.openid=:openid and f.deleted=0';
			$paramsc = array(':uniacid' => $uniacid, ':openid' => $openid);

			$totalprice = 0;
			$sql = 'SELECT f.id,f.total,f.goodsid,g.total as stock, o.stock as optionstock, g.maxbuy,g.title,g.thumb,ifnull(o.marketprice, g.marketprice) as marketprice,g.productprice,o.title as optiontitle,f.optionid,o.specs FROM ' . tablename('sea_member_cart') . ' f ' . ' left join ' . tablename('sea_goods') . ' g on f.goodsid = g.id ' . ' left join ' . tablename('sea_goods_option') . ' o on f.optionid = o.id ' . ' where 1 ' . $conditionc . ' ORDER BY `id` DESC ';
			$list = pdo_fetchall($sql, $paramsc);
			foreach ($list as &$r) {
				if (!empty($r['optionid'])) {
					$r['stock'] = $r['optionstock'];
				}
				$totalprice += $r['marketprice'] * $r['total'];
				$total += $r['total'];
			}
			$info['total']=$total;
				if(empty($total)){
					$info['total'] = 0;
				}
			
        }
		
	
        return $info;
    }
    public function getMid()
    {
        global $_W;
        $openid = m('user')->getOpenid();
        $member = $this->getMember($openid);
        return $member['id'];
    }
    public function setCredit($openid = '', $credittype = 'credit1', $credits = 0, $log = array())
    {
        global $_W;
        load()->model('mc');
        $uid = mc_openid2uid($openid);
        if (!empty($uid)) {
            $value = pdo_fetchcolumn("SELECT {$credittype} FROM " . tablename('mc_members') . ' WHERE `uid` = :uid', array(':uid' => $uid));
            $newcredit = $credits + $value;
            if ($newcredit <= 0) {
                $newcredit = 0;
            }
            pdo_update('mc_members', array($credittype => $newcredit), array('uid' => $uid));
            if (empty($log) || !is_array($log)) {
                $log = array($uid, '未记录');
            }
            $data = array('uid' => $uid, 'credittype' => $credittype, 'uniacid' => $_W['uniacid'], 'num' => $credits, 'createtime' => TIMESTAMP, 'operator' => intval($log[0]), 'remark' => $log[1]);
            pdo_insert('mc_credits_record', $data);
        } else {
            $value = pdo_fetchcolumn("SELECT {$credittype} FROM " . tablename('sea_member') . ' WHERE  uniacid=:uniacid and openid=:openid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
            $newcredit = $credits + $value;
            if ($newcredit <= 0) {
                $newcredit = 0;
            }
            pdo_update('sea_member', array($credittype => $newcredit), array('uniacid' => $_W['uniacid'], 'openid' => $openid));
        }
    }
    public function getCredit($openid = '', $credittype = 'credit1')
    {
        global $_W;
        load()->model('mc');
        $uid = mc_openid2uid($openid);
        if (!empty($uid)) {
            return pdo_fetchcolumn("SELECT {$credittype} FROM " . tablename('mc_members') . ' WHERE `uid` = :uid', array(':uid' => $uid));
        } else {
            return pdo_fetchcolumn("SELECT {$credittype} FROM " . tablename('sea_member') . ' WHERE  openid=:openid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
        }
    }
    public function getCredits($openid = '', $credittype = array('credit1', 'credit2'))
    {
        global $_W;
        load()->model('mc');
        $uid = mc_openid2uid($openid);
        $credittype = implode(',', $credittype);
        if (!empty($uid)) {
            return pdo_fetch("SELECT {$credittype} FROM " . tablename('mc_members') . ' WHERE `uid` = :uid limit 1', array(':uid' => $uid));
        } else {
            return pdo_fetch("SELECT {$credittype} FROM " . tablename('sea_member') . ' WHERE  openid=:openid and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
        }
    }
    /*
     * 得到粉丝树
     */
    public function doFansTree(&$list,$pk = 'id',$pid = 'agentid',$child = '_child',$root = 0){
        if(is_array($list)){
            $refer = array();
            foreach($list as $key=>$data){
                $refer[$data[$pk]] = & $list[$key];
            }
            foreach($list as $key=>$data){
                if(isset($refer[$data[$pid]]) && $data[$pk] != $data[$pid]){
                    $refer[$data[$pid]][$child][$data[$pk]] = &$list[$key];
                }
            }
        }
        return $refer;
    }
    //根据粉丝树进行排序操作
    public function doSortFans(&$tree,$sort,$offset,$length){
        if(!is_array($tree))return NULL;
        foreach($tree as $key=>&$vo){
            $this->_fansData = $vo['counts'];
            if(!empty($vo['child']))
                $this->getFansIds($vo['child']);
            $vo['counts'] = $this->_fansData;
            $this->_fansData = 0;
            unset($tree[$key]['child']);
            unset($tree[$key]['agentid']);
        }
        return $tree;
    }
    public function runFans(&$tree,$page,$psize){
        $pagesize = $psize?$psize:500;
        $offset = ($page-1)*$pagesize;
        $sum = count($tree);
        if(ceil($sum/$pagesize) < $page)message('完成', "", 'error');
        $doData = array_slice($tree,$offset,$pagesize,true);
        foreach($doData as $key=>$vo){
            $fans_counts = self::_getFansCount($vo['child'],$vo['counts']);
            pdo_update('sea_member', array('fanscount'=>$fans_counts), array('id' => $key));
        }
        return true;
    }
    /*
     * 获取一个粉丝所有上级粉丝 字符串组
     */
    public function getAgentidStr($id,&$result=array()){
        array_push($result,$id);
        $agentid = pdo_fetchcolumn('select agentid from ' . tablename('sea_member') . ' where  id=:id limit 1', array(
            ':id' => $id
        ));
        if($agentid != 0){
            self::getAgentidStr($agentid,$result);
        }
        return implode(',',$result);
    }

    private function _getFansCount($data,&$count){
        if(is_array($data)){
            foreach($data as $key=>$vo){
                $count+=$vo["counts"];
                if(!empty($vo['child']))self::_getFansCount($vo['child'],$count);
            }
        }
        return $count;
    }
    private  function getFansIds($agentChildData){
        if(is_array($agentChildData)){
           foreach($agentChildData as $key=>$vo){
               $this->_fansData+= $vo['counts'];
               if(isset($vo['child']))
                  $this->getFansIds($vo['child']);
           }
        }
    }
    #get sea_member 数据  更新mc_fans_map和mc_member表的数据
    public function checkMember($openid = '')
    {
        global $_W, $_GPC;
		
        if (strexists($_SERVER['REQUEST_URI'], '/web/')) {
            return;
        }
        if (empty($openid)) {
            $openid = m('user')->getOpenid();
        }
        if (empty($openid)) {
            return;
        }
        #sea_member
        $member = m('member')->getMember($openid);
        #微信登录用户数据
        $userinfo = m('user')->getInfo();
        #判断微信用户是否关注公众号
        $followed = m('user')->followed($openid);
        $uid = 0;
        $mc = array();
        load()->model('mc');
        if ($followed) {
            #得到mc_fans_map uid 也就是mc_member 用户id
            $uid = mc_openid2uid($openid);
            #mc_member data
            $mc = mc_fetch($uid, array('realname', 'mobile', 'avatar', 'resideprovince', 'residecity', 'residedist'));
        }
        $_var_16 = false;
		
        if (empty($member)) {
            if ($followed) {
                $uid = mc_openid2uid($openid);
                $mc = mc_fetch($uid, array('realname', 'mobile', 'avatar', 'resideprovince', 'residecity', 'residedist'));
            }
			$mid=$_GPC['mid'];
			if(empty($mid)){
				$member = array('uniacid' => $_W['uniacid'],'isone' => 1, 'uid' => $uid, 'openid' => $openid, 'realname' => !empty($mc['realname']) ? $mc['realname'] : '', 'mobile' => !empty($mc['mobile']) ? $mc['mobile'] : '', 'nickname' => !empty($mc['nickname']) ? $mc['nickname'] : $userinfo['nickname'], 'avatar' => !empty($mc['avatar']) ? $mc['avatar'] : $userinfo['avatar'], 'gender' => !empty($mc['gender']) ? $mc['gender'] : $userinfo['sex'], 'province' => !empty($mc['residecity']) ? $mc['resideprovince'] : $userinfo['province'], 'city' => !empty($mc['residecity']) ? $mc['residecity'] : $userinfo['city'],'area' => !empty($mc['residedist']) ? $mc['residedist'] : '', 'createtime' => time(), 'status' => 0);
			}else{
				$member = array('uniacid' => $_W['uniacid'],'isone' => 0, 'uid' => $uid, 'openid' => $openid, 'realname' => !empty($mc['realname']) ? $mc['realname'] : '', 'mobile' => !empty($mc['mobile']) ? $mc['mobile'] : '', 'nickname' => !empty($mc['nickname']) ? $mc['nickname'] : $userinfo['nickname'], 'avatar' => !empty($mc['avatar']) ? $mc['avatar'] : $userinfo['avatar'], 'gender' => !empty($mc['gender']) ? $mc['gender'] : $userinfo['sex'], 'province' => !empty($mc['residecity']) ? $mc['resideprovince'] : $userinfo['province'], 'city' => !empty($mc['residecity']) ? $mc['residecity'] : $userinfo['city'],'area' => !empty($mc['residedist']) ? $mc['residedist'] : '', 'createtime' => time(), 'status' => 0);
			}
		   $_var_16 = true;
		
			// $realname= !empty($mc['realname']) ? $mc['realname'] : '';
			// $mobile=!empty($mc['mobile']) ? $mc['mobile'] : '';
			// $nickname=!empty($mc['nickname']) ? $mc['nickname'] : $userinfo['nickname'];
			// $avatar= !empty($mc['avatar']) ? $mc['avatar'] : $userinfo['avatar'];
			// $gender= !empty($mc['gender']) ? $mc['gender'] : $userinfo['sex'];
			// $province= !empty($mc['residecity']) ? $mc['resideprovince'] : $userinfo['province'];
			// $city= !empty($mc['residecity']) ? $mc['residecity'] : $userinfo['city'];
			// $area= !empty($mc['residedist']) ? $mc['residedist'] : '';
			// $createtime=time();
			// pdo_query("INSERT INTO ". tablename('sea_member')  ." (uniacid, uid,openid,realname,mobile,nickname,avatar,gender,province,city,area,createtime,status) VALUES (".$_W['uniacid'].", ".$uid.", '".$openid."', '".$realname."', '".$mobile."', '".$nickname."', '".$avatar."', '".$gender."', '".$province."', '".$city."', '".$area."', '".$createtime."', 0)");
            
		
		 pdo_insert('sea_member', $member);
		  // header('Location: /app/index.php?i=1&c=entry&p=bs&do=member&m=sea');

			// $mid=$_GPC['mid'];
			// if(empty($mid)){
			   // header('Location: /app/index.php?i=1&c=entry&p=bs&do=member&m=sea');
			// }
			
        } else {
	
            $_var_5 = array();
            if ($userinfo['nickname'] != $member['nickname']) {
                $_var_5['nickname'] = $userinfo['nickname'];
            }
            if ($userinfo['avatar'] != $member['avatar']) {
                $_var_5['avatar'] = $userinfo['avatar'];
            }
            if (!empty($_var_5)) {
                pdo_update('sea_member', $_var_5, array('id' => $member['id']));
            }
        }
        if (p('commission')) {
            #分销关系整理 分享次数加一
            p('commission')->checkAgent();
        }
        if (p('poster')) {
            p('poster')->checkScan();
        }
        if ($_var_16 && is_weixin()) {
        }
    }
    function getLevels()
    {
        global $_W;
        return pdo_fetchall('select * from ' . tablename('sea_member_level') . ' where uniacid=:uniacid order by level asc', array(':uniacid' => $_W['uniacid']));
    }
    function getLevel($openid)
    {
        global $_W;
        if (empty($openid)) {
            return false;
        }
        $member = m('member')->getMember($openid);
        if (empty($member['level'])) {
            return array('discount' => 10);
        }
        $level = pdo_fetch('select * from ' . tablename('sea_member_level') . ' where id=:id and uniacid=:uniacid order by level asc', array(':uniacid' => $_W['uniacid'], ':id' => $member['level']));
        if (empty($level)) {
            return array('discount' => 10);
        }
        return $level;
    }
    function upgradeLevel($openid)
    {
        global $_W;
        if (empty($openid)) {
            return;
        }
        $_var_18 = m('common')->getSysset('shop');
        $_var_19 = intval($_var_18['leveltype']);
        $member = m('member')->getMember($openid);
        if (empty($member)) {
            return;
        }
        $level = false;
        if (empty($_var_19)) {
            $_var_20 = pdo_fetchcolumn('select ifnull( sum(og.realprice),0) from ' . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_order') . ' o on o.id=og.orderid ' . ' where o.openid=:openid and o.status=3 and o.uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':openid' => $member['openid']));
            $level = pdo_fetch('select * from ' . tablename('sea_member_level') . " where uniacid=:uniacid  and {$_var_20} >= ordermoney and ordermoney>0  order by level desc limit 1", array(':uniacid' => $_W['uniacid']));
        } else {
            if ($_var_19 == 1) {
                $ordercount = pdo_fetchcolumn('select count(*) from ' . tablename('sea_order') . ' where openid=:openid and status=3 and uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':openid' => $member['openid']));
                $level = pdo_fetch('select * from ' . tablename('sea_member_level') . " where uniacid=:uniacid  and {$ordercount} >= ordercount and ordercount>0  order by level desc limit 1", array(':uniacid' => $_W['uniacid']));
            }
        }
        if (empty($level)) {
            return;
        }
        if ($level['id'] == $member['level']) {
            return;
        }
        $oldlevel = $this->getLevel($openid);
        $_var_23 = false;
        if (empty($oldlevel['id'])) {
            $_var_23 = true;
        } else {
            if ($level['level'] > $oldlevel['level']) {
                $_var_23 = true;
            }
        }
        if ($_var_23) {
            pdo_update('sea_member', array('level' => $level['id']), array('id' => $member['id']));
            m('notice')->sendMemberUpgradeMessage($openid, $oldlevel, $level);
        }
    }
    function getGroups()
    {
        global $_W;
        return pdo_fetchall('select * from ' . tablename('sea_member_group') . ' where uniacid=:uniacid order by id asc', array(':uniacid' => $_W['uniacid']));
    }
    function getGroup($openid)
    {
        if (empty($openid)) {
            return false;
        }
        $member = m('member')->getMember($openid);
        return $member['groupid'];
    }
    function setRechargeCredit($openid = '', $money = 0)
    {
        if (empty($openid)) {
            return;
        }
        global $_W;
        $credit = 0;
        $set = m('common')->getSysset(array('trade', 'shop'));
        if ($set['trade']) {
            $tmoney = floatval($set['trade']['money']);
            $tcredit = intval($set['trade']['credit']);
            if ($tmoney > 0) {
                if ($money % $tmoney == 0) {
                    $credit = intval($money / $tmoney) * $tcredit;
                } else {
                    $credit = (intval($money / $tmoney) + 1) * $tcredit;
                }
            }
        }
        if ($credit > 0) {
            $this->setCredit($openid, 'credit1', $credit, array(0, $set['shop']['name'] . '会员充值积分:credit2:' . $credit));
        }
    }
    function writelog($_var_29, $_var_30 = 'Error')
    {
        $_var_31 = fopen($_var_30 . '.txt', 'a');
        fwrite($_var_31, $_var_29);
        fclose($_var_31);
    }
}