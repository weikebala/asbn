<?php
/*=============================================================================
#     FileName: category.php
#         Desc: 商品分类
#       Author: HaiRuan - http://www.iseasoft.cn
#        Email: 45300551@qq.com
#     HomePage: http://www.iseasoft.cn
#      Version: 0.0.1
#   LastChange: 2016-02-13 00:32:05
#      History:
=============================================================================*/

if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$operation  = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
$openid     = m('user')->getOpenid();
$uniacid    = $_W['uniacid'];
$shopset    = set_medias(m('common')->getSysset('shop'), 'catadvimg');
$commission = p('commission');
if ($commission) {
	$shopid = intval($_GPC['shopid']);
	$shop = set_medias($commission->getShop($openid), array('img', 'logo'));
}
$this->setHeader();
include $this->template('shop/category');
