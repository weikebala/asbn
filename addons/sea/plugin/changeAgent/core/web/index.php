<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-22
 * Time: 20:36
 */
global $_W, $_GPC;
$operation = empty($_GPC['op']) ? 'display' : $_GPC['op'];
function changeAgentFunction($id,$agentId){
    $data['agentid']=$agentId;
    pdo_update('sea_member', $data, array('id' => $id));
}
if($operation=='display'){
    //var_dump('select sum(money) as money from ' . tablename('sea_order') . ' o left join  ' . tablename('sea_bonus_goods') . '  cg on o.id=cg.orderid left join ' . tablename('sea_order_refund') . " r on r.orderid=o.id and ifnull(r.status,-1)<>-1 where o.status>=1 and o.uniacid=:uniacid and cg.mid = {$_var_52} ORDER BY o.createtime DESC,o.status DESC");
    //当前公众号 $_W['uniacid']
    $level = $this->set['level'];
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $params = array();
    $condition = '';
    if (!empty($_GPC['mid'])) {
        $condition .= ' and dm.id=:mid';
        $params[':mid'] = intval($_GPC['mid']);
    }
    if (!empty($_GPC['realname'])) {
        $_GPC['realname'] = trim($_GPC['realname']);
        $condition .= ' and ( dm.realname like :realname or dm.nickname like :realname or dm.mobile like :realname)';
        $params[':realname'] = "%{$_GPC['realname']}%";
    }
    if ($_GPC['parentid'] == '0') {
        $condition .= ' and dm.agentid=0';
    } else {
        if (!empty($_GPC['parentname'])) {
            $_GPC['parentname'] = trim($_GPC['parentname']);
            $condition .= ' and ( p.mobile like :parentname or p.nickname like :parentname or p.realname like :parentname)';
            $params[':parentname'] = "%{$_GPC['parentname']}%";
        }
    }
    if ($_GPC['followed'] != '') {
        if ($_GPC['followed'] == 2) {
            $condition .= ' and f.follow=0 and dm.uid<>0';
        } else {
            $condition .= ' and f.follow=' . intval($_GPC['followed']);
        }
    }
    if ($_GPC['bonus_area'] != '') {
        if ($_GPC['bonus_area'] == 1) {
            $condition .= ' and dm.bonus_area=1';
        } else {
            if ($_GPC['bonus_area'] == 2) {
                $condition .= ' and dm.bonus_area=2';
            } else {
                if ($_GPC['bonus_area'] == 3) {
                    $condition .= ' and dm.bonus_area=3';
                }
            }
        }
    }
    if ($_GPC['reside']['province'] != '') {
        $condition .= ' and dm.bonus_province=\'' . $_GPC['reside']['province'] . '\'';
    }
    if ($_GPC['reside']['city'] != '') {
        $condition .= 'and dm.bonus_city=\'' . $_GPC['reside']['city'] . '\'';
    }
    if ($_GPC['reside']['district'] != '') {
        $condition .= 'and dm.bonus_district=\'' . $_GPC['reside']['district'] . '\'';
    }
    if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime = time();
    }
    if (!empty($_GPC['time'])) {
        $starttime = strtotime($_GPC['time']['start']);
        $endtime = strtotime($_GPC['time']['end']);
        if ($_GPC['searchtime'] == '1') {
            $condition .= ' AND dm.agenttime >= :starttime AND dm.agenttime <= :endtime ';
            $params[':starttime'] = $starttime;
            $params[':endtime'] = $endtime;
        }
    }
    if (!empty($_GPC['agentlevel'])) {
        $condition .= ' and dm.bonuslevel=' . intval($_GPC['agentlevel']);
    }
    if (!empty($_GPC['agentlevels'])||$_GPC['agentlevels']=='0') {
        $condition .= ' and dm.agentlevels=' . intval($_GPC['agentlevels']);
    }
    if ($_GPC['status'] != '') {
        $condition .= ' and dm.status=' . intval($_GPC['status']);
    }
    if ($_GPC['agentblack'] != '') {
        $condition .= ' and dm.agentblack=' . intval($_GPC['agentblack']);
    }
    $sql = 'select dm.*,dm.nickname,dm.avatar,l.levelname,p.nickname as parentname,p.avatar as parentavatar from ' . tablename('sea_member') . ' dm ' . ' left join ' . tablename('sea_member') . ' p on p.id = dm.agentid ' . ' left join ' . tablename('sea_bonus_level') . ' l on l.id = dm.bonuslevel' . ' left join ' . tablename('mc_mapping_fans') . "f on f.openid=dm.openid and f.uniacid={$_W['uniacid']}" . ' where dm.uniacid = ' . $_W['uniacid'] . " and dm.isagent =1  {$condition} GROUP BY dm.id  ORDER BY dm.agenttime desc";
    if (empty($_GPC['export'])) {
        $sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;
    }
    $list = pdo_fetchall($sql, $params);
    $total = pdo_fetchcolumn('select count(dm.id) from' . tablename('sea_member') . ' dm  ' . ' left join ' . tablename('sea_member') . ' p on p.id = dm.agentid ' . ' left join ' . tablename('mc_mapping_fans') . 'f on f.openid=dm.openid' . ' where dm.uniacid =' . $_W['uniacid'] . " and dm.isagent =1 {$condition} ", $params);
    $agentSql='SELECT id,realname  FROM `fxs_sea_member` WHERE agentlevels=1 and uniacid = ' . $_W['uniacid'] ;
    $agentList=pdo_fetchall($agentSql);
    foreach ($list as &$row) {
        $info = p('commission')->getInfo($row['openid'], array('total', 'pay'));
        $row['levelcount'] = $info['agentcount'];
        if ($level >= 1) {
            $row['level1'] = $info['level1'];
        }
        if ($level >= 2) {
            $row['level2'] = $info['level2'];
        }
        if ($level >= 3) {
            $row['level3'] = $info['level3'];
        }
        $row['credit1'] = m('member')->getCredit($row['openid'], 'credit1');
        $row['credit2'] = m('member')->getCredit($row['openid'], 'credit2');
        $row['commission_total'] = $info['commission_total'];
        $row['commission_pay'] = $info['commission_pay'];
        $row['followed'] = m('user')->followed($row['openid']);
    }
    unset($row);
    if ($_GPC['export'] == '1') {
        ca('commission.agent.export');
        plog('commission.agent.export', '导出代理商数据');
        foreach ($list as &$row) {
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            $row['agentime'] = empty($row['agenttime']) ? '' : date('Y-m-d H:i', $row['agentime']);
            $row['groupname'] = empty($row['groupname']) ? '无分组' : $row['groupname'];
            $row['levelname'] = empty($row['levelname']) ? '普通等级' : $row['levelname'];
            $row['parentname'] = empty($row['parentname']) ? '总店' : '[' . $row['agentid'] . ']' . $row['parentname'];
            $row['statusstr'] = empty($row['status']) ? '' : '通过';
            $row['followstr'] = empty($row['followed']) ? '' : '已关注';
        }
        unset($row);
        m('excel')->export($list, array('title' => '代理商数据-' . date('Y-m-d-H-i', time()), 'columns' => array(array('title' => 'ID', 'field' => 'id', 'width' => 12), array('title' => '昵称', 'field' => 'nickname', 'width' => 12), array('title' => '姓名', 'field' => 'realname', 'width' => 12), array('title' => '手机号', 'field' => 'mobile', 'width' => 12), array('title' => '微信号', 'field' => 'weixin', 'width' => 12), array('title' => '推荐人', 'field' => 'parentname', 'width' => 12), array('title' => '代理商等级', 'field' => 'levelname', 'width' => 12), array('title' => '点击数', 'field' => 'clickcount', 'width' => 12), array('title' => '下线加盟商总数', 'field' => 'levelcount', 'width' => 12), array('title' => '一级下线加盟商数', 'field' => 'level1', 'width' => 12), array('title' => '二级下线加盟商数', 'field' => 'level2', 'width' => 12), array('title' => '三级下线加盟商数', 'field' => 'level3', 'width' => 12), array('title' => '累计佣金', 'field' => 'commission_total', 'width' => 12), array('title' => '打款佣金', 'field' => 'commission_pay', 'width' => 12), array('title' => '注册时间', 'field' => 'createtime', 'width' => 12), array('title' => '成为加盟商时间', 'field' => 'createtime', 'width' => 12), array('title' => '审核状态', 'field' => 'createtime', 'width' => 12), array('title' => '是否关注', 'field' => 'followstr', 'width' => 12))));
    }
    $pager = pagination($total, $pindex, $psize);
}
elseif($operation=='changeAgent'){
    $id=intval($_GPC['id']);
    $agentId=intval($_GPC['agentid']);
    if(empty($id)||empty($agentId)){
        message('非法参数', '', 'error');
    }
    $childCheckSql='SELECT COUNT(1) AS s FROM `fxs_sea_member` WHERE id=:id AND agentlevels=1 limit 1';
    $childCheckResult=pdo_fetchcolumn($childCheckSql,array(':id'=>$id));
    if($childCheckResult==1){
        message('渠道商不可以更改推荐人', '', 'error');
    }
    $agentCheckSql='SELECT COUNT(1) AS s FROM `fxs_sea_member` WHERE id=:id AND agentlevels=1 limit 1';
    $agentCheckResult=pdo_fetchcolumn($agentCheckSql,array(":id"=>$agentId));
    if($agentCheckResult==0){
        message("此推荐人不是渠道商",'','error');
    }
    changeAgentFunction($id,$agentId);
    //$this->model->upgradeLevelByAgent($id);
    message('更改成功!', $this->createPluginWebUrl('changeAgent/index'), 'success');
}
elseif($operation=="batchChangeAgent"){
    $id=$_GPC['ids'];
    $agentId=intval($_GPC['agentId']);
    if(empty($id)||empty($agentId)){
        message('非法参数', '', 'error');
    }
    if(preg_match('/[^0-9,]/',$id)){
        message('非法参数', '', 'error');
    }
    $agentCheckSql='SELECT COUNT(1) AS s FROM `fxs_sea_member` WHERE id=:id AND agentlevels=1 limit 1';
    $agentCheckResult=pdo_fetchcolumn($agentCheckSql,array(":id"=>$agentId));
    if($agentCheckResult==0){
        message("此推荐人不是渠道商",'','error');
    }
    $childCheckSql='SELECT GROUP_CONCAT(nickname) AS str  FROM `fxs_sea_member` WHERE id IN ('.$id.') AND agentlevels=1  GROUP BY agentid!=0 limit 1 ';
    $childCheckResult=pdo_fetchall($childCheckSql);
    if(!empty($childCheckResult)){
        message('【'.$childCheckResult[0]['str'].'】是渠道商，不可以更改推荐人', '', 'error');
    }
    $idArray=explode(",",$id);
    foreach($idArray as $ind){
        changeAgentFunction($ind,$agentId);
    }
    message('更改成功!', $this->createPluginWebUrl('changeAgent/index'), 'success');
}
elseif($operation=="excelChangeAgent"){
    echo "excelChangeAgent";
}
elseif($operation=="changeAgentLevels"){
    $id=intval($_GPC['id']);
    $type=$_GPC['type']=="up"?"up":"down";
    if(empty($id)){
        message('非法参数', '', 'error');
    }
    $agentlevelsWhere=($type=="up")?1:0;
    $agentCheckSql="SELECT COUNT(1) AS s FROM `fxs_sea_member` WHERE id=:id AND agentlevels={$agentlevelsWhere} limit 1";
    $agentCheckResult=pdo_fetchcolumn($agentCheckSql,array(":id"=>$id));
    if($agentCheckResult!=0){
        message(($type=="up")?"此推荐人已经是渠道商,无法升级！！！":"此推荐人不是渠道商，无法降级",'','error');
    }

    $data['agentlevels']=$agentlevelsWhere;
    if($type=="up") $data['agentid']=0;
    pdo_update('sea_member', $data, array('id' => $id));
    message('更改成功!', $this->createPluginWebUrl('changeAgent/index'), 'success');
}


load()->func('tpl');
include $this->template("display");
