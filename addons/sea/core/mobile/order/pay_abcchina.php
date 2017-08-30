<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$openid    = m('user')->getOpenid();
if (empty($openid)) {
    $openid = $_GPC['openid'];
}
$member  = m('member')->getMember($openid);
$uniacid = $_W['uniacid'];
$orderid = intval($_GPC['orderid']);
$logid   = intval($_GPC['logid']);
$shopset = m('common')->getSysset('shop');
if ($_W['isajax']) {
	if (!empty($orderid)) {
		$order = pdo_fetch("select * from " . tablename('sea_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
		if (empty($order)) {
			show_json(0, '订单未找到!');
		}
		$log = pdo_fetch('SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1', array(':uniacid' => $uniacid, ':module' => 'sea', ':tid' => $order['ordersn']));
		if (!empty($log) && $log['status'] != '0') {
			show_json(0, '订单已支付, 无需重复支付!');
		}
		$param_title = $shopset['name'] . "订单: " . $order['ordersn'];
		$abcchina = array('success' => false);
		$params = array();
		$params['tid'] = $log['tid'];
		$params['user'] = $openid;
		$params['fee'] = $order['price'];
		$params['title'] = $param_title;
		load()->func('communication');
		load()->model('payment');
		$setting = uni_setting($_W['uniacid'], array('payment'));
		if (is_array($setting['payment'])) {
			$options = $setting['payment']['abcchinapay'];
            require_once ($_SERVER['DOCUMENT_ROOT'].'/payment/abcchina/ebusclient/PaymentRequest.php');

            $tRequest = new PaymentRequest();ob_clean();
            $tRequest->order["PayTypeID"] = 'ImmediatePay'; //设定交易类型
            $tRequest->order["OrderNo"] = $order['ordersn']; //设定订单编号
            $tRequest->order["ExpiredDate"] = '30'; //设定订单保存时间
            $tRequest->order["OrderAmount"] = $order['price']; //设定交易金额
            $tRequest->order["CurrencyCode"] = '156'; //设定交易币种
            $tRequest->order["InstallmentMark"] = '0'; //分期标识
            $installmentMerk = 0;
            $paytypeID = 'ImmediatePay';
            $tRequest->order["OrderDate"] = date('Y/m/d',$order['createtime']); //设定订单日期 （必要信息 - YYYY/MM/DD）
            $tRequest->order["OrderTime"] = date('H:i:s',$order['createtime']);; //设定订单时间 （必要信息 - HH:MM:SS）
            $tRequest->order["CommodityType"] = '0202'; //设置商品种类

//2、订单明细
            $goods = pdo_fetchall("select og.price,g.title,og.total from " . tablename('sea_order_goods') . ' og ' . ' left join ' . tablename('sea_goods') . ' g on g.id=og.goodsid ' . ' where og.orderid=:orderid and og.uniacid=:uniacid ', array(':uniacid' => $uniacid, ':orderid' => $orderid));
            $orderGoods=array();
            foreach($goods as $v){
                $orderGoods[]=array(
                    "ProductName" =>''. $v['title'],//商品名称
                    "UnitPrice" => ''.$v['price'], //商品总价
                    "Qty" => ''.$v['total'] //商品数量
                );
            }

            $tRequest->orderitems = $orderGoods;

//3、生成支付请求对象
            $tRequest->request["PaymentType"] = 'A'; //设定支付类型
            $tRequest->request["PaymentLinkType"] = '2'; //设定支付接入方式
            if ($tRequest->request["PaymentType"] === "6" && $tRequest->request["PaymentLinkType"] === "2") {
                $tRequest->request["UnionPayLinkType"] = '0'; //当支付类型为6，支付接入方式为2的条件满足时，需要设置银联跨行移动支付接入方式
            }
            $tRequest->request["NotifyType"] = '1'; //设定通知方式
            $tRequest->request["ResultNotifyURL"] = 'http://10.164.0.171:8010/WebSite/netBank/zh_CN/CBBP/CbbpHandler.aspx';; //设定通知URL地址
            $tRequest->request['IsBreakAccount']='0';
            $memberAddressArray=unserialize($order['carrier']);
            $tRequest->request['MerchantRemarks']='I20|573442391|'.$order['goodsprice'].'|'.$order['customs_price'].'|156|'.$order['dispatchprice'].'|0.0|'.$memberAddressArray['carrier_mobile'];//$this->createMobileUrl('order/payresult', array('ordersn' => $order['ordersn']));;
            $tResponse = $tRequest->postRequest();
//支持多商户配置
//$tResponse = $tRequest->extendPostRequest(2);
            $PaymentURL = $tResponse->GetValue("PaymentURL");

			$abcchina['url']=$PaymentURL;
			if (!empty($PaymentURL)) {
				$abcchina['success'] = true;
			}
		}
	} elseif (!empty($logid)) {
		$log = pdo_fetch('SELECT * FROM ' . tablename('sea_member_log') . ' WHERE `id`=:id and `uniacid`=:uniacid limit 1', array(':uniacid' => $uniacid, ':id' => $logid));
		if (empty($log)) {
			show_json(0, '充值出错!');
		}
		if (!empty($log['status'])) {
			show_json(0, '已经充值成功,无需重复支付!');
		}
		$alipay = array('success' => false);
		$params = array();
		$params['tid'] = $log['logno'];
		$params['user'] = $log['openid'];
		$params['fee'] = $log['money'];
		$params['title'] = $log['title'];
		load()->func('communication');
		load()->model('payment');
		$setting = uni_setting($_W['uniacid'], array('payment'));
		if (is_array($setting['payment'])) {
			$options = $setting['payment']['abcchinapay'];
            require_once ($_SERVER['DOCUMENT_ROOT'].'/payment/abcchina/ebusclient/PaymentRequest.php');

            $tRequest = new PaymentRequest();ob_clean();
            $tRequest->order["PayTypeID"] = 'ImmediatePay'; //设定交易类型
            $tRequest->order["OrderNo"] = $log['logno']; //设定订单编号
            $tRequest->order["ExpiredDate"] = '30'; //设定订单保存时间
            $tRequest->order["OrderAmount"] = $log['money']; //设定交易金额
            $tRequest->order["CurrencyCode"] = '156'; //设定交易币种
            $tRequest->order["InstallmentMark"] = '0'; //分期标识
            $installmentMerk = 0;
            $paytypeID = 'ImmediatePay';
            $tRequest->order["OrderDate"] = date('Y/m/d'); //设定订单日期 （必要信息 - YYYY/MM/DD）
            $tRequest->order["OrderTime"] = date('H:i:s');; //设定订单时间 （必要信息 - HH:MM:SS）
            $tRequest->order["CommodityType"] = '0201'; //设置商品种类

//2、订单明细
            $orderGoods=array();

                $orderGoods[]=array(
                    "ProductName" =>'网站充值',//商品名称
                    "UnitPrice" => ''.$log['money'], //商品总价
                );

            $tRequest->orderitems = $orderGoods;

//3、生成支付请求对象
            $tRequest->request["PaymentType"] = 'A'; //设定支付类型
            $tRequest->request["PaymentLinkType"] = '2'; //设定支付接入方式
            if ($tRequest->request["PaymentType"] === "6" && $tRequest->request["PaymentLinkType"] === "2") {
                $tRequest->request["UnionPayLinkType"] = '0'; //当支付类型为6，支付接入方式为2的条件满足时，需要设置银联跨行移动支付接入方式
            }
            $tRequest->request["NotifyType"] = '0'; //设定通知方式
            $tRequest->request["ResultNotifyURL"] = $_W['siteroot'] . 'addons/sea/payment/abcchina/notify.php';; //设定通知URL地址
            $tRequest->request['IsBreakAccount']='0';
            $tRequest->request['MerchantRemarks']='充值';
            $tResponse = $tRequest->postRequest();
//支持多商户配置
//$tResponse = $tRequest->extendPostRequest(2);
            $PaymentURL = $tResponse->GetValue("PaymentURL");

            $abcchina['url']=$PaymentURL;
            if (!empty($PaymentURL)) {
                $abcchina['success'] = true;
            }
		}
	}
	show_json(1, array('abcchina' => $abcchina));
}
include $this->template('order/pay_abcchina');
