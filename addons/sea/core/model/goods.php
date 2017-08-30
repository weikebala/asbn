<?php
/*=============================================================================
#     FileName: goods.php
#         Desc: ��Ʒ��
#       Author: HaiRuan - http://www.iseasoft.cn
#        Email: 45300551@qq.com
#     HomePage: http://www.iseasoft.cn
#      Version: 0.0.1
#   LastChange: 2016-02-05 02:32:56
#      History:
=============================================================================*/
if (!defined('IN_IA')) {
    exit('Access Denied');
}
class Sz_DYi_Goods
{
    public function getOption($goodsid = 0, $optionid = 0)
    {
        global $_W;
        return pdo_fetch('select * from ' . tablename('sea_goods_option') . ' where id=:id and goodsid=:goodsid and uniacid=:uniacid', array(
            ':id' => $optionid,
            ':uniacid' => $_W['uniacid'],
            ':goodsid' => $goodsid
        ));
    }
    public function getList($args = array())
    {
        global $_W;
        $page      = !empty($args['page']) ? intval($args['page']) : 1;
        $pagesize  = !empty($args['pagesize']) ? intval($args['pagesize']) : 10;
        $random    = !empty($args['random']) ? $args['random'] : false;
        $order     = !empty($args['order']) ? $args['order'] : ' displayorder desc,createtime desc';
        $orderby   = !empty($args['by']) ? $args['by'] : '';
        $ids       = !empty($args['ids']) ? trim($args['ids']) : '';
        $brandid       = !empty($args['brandid']) ? trim($args['brandid']) : '';
        $sup_uid   = !empty($args['supplier_uid']) ? trim($args['supplier_uid']) : '';
        $condition = ' and `uniacid` = :uniacid AND `deleted` = 0 and status=1';
        $params    = array(
            ':uniacid' => $_W['uniacid']
        );
        if (!empty($ids)) {
            $condition .= " and id in ( " . $ids . ")";
        }
        if (!empty($sup_uid)) {
            $condition .= " and supplier_uid = :supplier_uid ";
            $params[':supplier_uid'] = intval($sup_uid);
        }
        $isnew = !empty($args['isnew']) ? 1 : 0;
        if (!empty($isnew)) {
            $condition .= " and isnew=1";
        }
        $ishot = !empty($args['ishot']) ? 1 : 0;
        if (!empty($ishot)) {
            $condition .= " and ishot=1";
        }
        $isrecommand = !empty($args['isrecommand']) ? 1 : 0;
        if (!empty($isrecommand)) {
            $condition .= " and isrecommand=1";
        }
        $isdiscount = !empty($args['isdiscount']) ? 1 : 0;
        if (!empty($isdiscount)) {
            $condition .= " and isdiscount=1";
        }
        $istime = !empty($args['istime']) ? 1 : 0;
        if (!empty($istime)) {
            $condition .= " and istime=1 and " . time() . ">=timestart and " . time() . "<=timeend";
        }
        $keywords = !empty($args['keywords']) ? $args['keywords'] : '';
        if (!empty($keywords)) {
            $condition .= ' AND `title` LIKE :title';
            $params[':title'] = '%' . trim($keywords) . '%';
        }
        $brandid = intval($args['brandid']);
		 if (!empty($brandid)) {
                $condition .= ' AND  `brandid` = :brandid';
                $params[':brandid'] = intval($brandid);
            }
		
        $tcate = intval($args['tcate']);
        if (!empty($tcate)) {
            $condition .= " AND ( `tcate` = :tcate or  FIND_IN_SET({$tcate},tcates)<>0 )";
            $params[':tcate'] = intval($tcate);
        } else {
            $ccate = intval($args['ccate']);
            if (!empty($ccate)) {
                $condition .= " AND ( `ccate` = :ccate or  FIND_IN_SET({$ccate},ccates)<>0 )";
                $params[':ccate'] = intval($ccate);
            } else {
                $pcate = intval($args['pcate']);
                if (!empty($pcate)) {
                    $condition .= " AND ( `pcate` = :pcate or  FIND_IN_SET({$pcate},pcates)<>0 )";
                    $params[':pcate'] = intval($pcate);
                }
            }
        }
        $openid  = m('user')->getOpenid();
        $member  = m('member')->getMember($openid);
        $levelid = intval($member['level']);
        $groupid = intval($member['groupid']);
        $condition .= " and ( ifnull(showlevels,'')='' or FIND_IN_SET( {$levelid},showlevels)<>0 ) ";
        $condition .= " and ( ifnull(showgroups,'')='' or FIND_IN_SET( {$groupid},showgroups)<>0 ) ";
        if (!$random) {
            $sql = "SELECT id,title,thumb,marketprice,productprice,sales,total,description,unit FROM " . tablename('sea_goods') . " where 1 {$condition} ORDER BY {$order} {$orderby} LIMIT " . ($page - 1) * $pagesize . ',' . $pagesize;
        } else {
            $sql = "SELECT id,title,thumb,marketprice,productprice,sales,total,description,unit FROM " . tablename('sea_goods') . " where 1 {$condition} ORDER BY rand() LIMIT " . $pagesize;
        }
        $list = pdo_fetchall($sql, $params);
        $list = set_medias($list, 'thumb');
        return $list;
    }
    public function getRecomList($args = array())
    {
        global $_W;
        $pagesize  = !empty($args['pagesize']) ? intval($args['pagesize']) : 4;
        $goodids       = $args['good_id'];
        $ids = pdo_get("sea_goods",array("id"=>$goodids),"recom_goods");
        $ids = $ids['recom_goods'];
        if(empty($ids)) return null;
        $condition = ' and `uniacid` = :uniacid AND `deleted` = 0 and status=1';
        $params    = array(
            ':uniacid' => $_W['uniacid']
        );
        if (!empty($ids)) {
            $condition .= " and id in ( " . $ids . ")";
        }
        $openid  = m('user')->getOpenid();
        $member  = m('member')->getMember($openid);
        $levelid = intval($member['level']);
        $groupid = intval($member['groupid']);
        $condition .= " and ( ifnull(showlevels,'')='' or FIND_IN_SET( {$levelid},showlevels)<>0 ) ";
        $condition .= " and ( ifnull(showgroups,'')='' or FIND_IN_SET( {$groupid},showgroups)<>0 ) ";
        $sql = "SELECT id,title,thumb,marketprice,productprice,sales,total,description,unit FROM " . tablename('sea_goods') . " where 1 {$condition}";
        $list = pdo_fetchall($sql, $params);
        $list = set_medias($list, 'thumb');
        return $list;
    }
    public function getComments($goodsid = '0', $args = array())
    {
        global $_W;
        $page      = !empty($args['page']) ? intval($args['page']) : 1;
        $pagesize  = !empty($args['pagesize']) ? intval($args['pagesize']) : 10;
        $condition = ' and `uniacid` = :uniacid AND `goodsid` = :goodsid and deleted=0';
        $params    = array(
            ':uniacid' => $_W['uniacid'],
            ':goodsid' => $goodsid
        );
        $sql       = "SELECT id,nickname,headimgurl,content,images FROM " . tablename('sea_goods_comment') . " where 1 {$condition} ORDER BY createtime desc LIMIT " . ($page - 1) * $pagesize . ',' . $pagesize;
        $list      = pdo_fetchall($sql, $params);
        foreach ($list as &$row) {
            $row['images'] = set_medias(unserialize($row['images']));
        }
        unset($row);
        return $list;
    }
}