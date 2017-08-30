<?php
//海软商城 QQ:45300551
error_reporting(0);
define('IN_MOBILE', true);
if (!empty($_POST)) {

    require $_SERVER['DOCUMENT_ROOT'].'/framework/bootstrap.inc.php';
    require $_SERVER['DOCUMENT_ROOT'].'/addons/sea/defines.php';
    require $_SERVER['DOCUMENT_ROOT'].'/addons/sea/core/inc/functions.php';
    require $_SERVER['DOCUMENT_ROOT'].'/addons/sea/core/inc/plugin/plugin_model.php';
    require_once ($_SERVER['DOCUMENT_ROOT'].'/payment/abcchina/ebusclient/Result.php');
//1、取得MSG参数，并利用此参数值生成验证结果对象
    $tResult = new Result();
    $tResponse = $tResult->init($_POST['MSG']);
    m('common')->paylog($_POST['MSG']);
    /*if ($tResponse->isSuccess()) {
        //2、、支付成功
        print ("TrxType         = [" . $tResponse->getValue("TrxType") . "]<br/>");
        print ("OrderNo         = [" . $tResponse->getValue("OrderNo") . "]<br/>");
        print ("Amount          = [" . $tResponse->getValue("Amount") . "]<br/>");
        print ("BatchNo         = [" . $tResponse->getValue("BatchNo") . "]<br/>");
        print ("VoucherNo       = [" . $tResponse->getValue("VoucherNo") . "]<br/>");
        print ("HostDate        = [" . $tResponse->getValue("HostDate") . "]<br/>");
        print ("HostTime        = [" . $tResponse->getValue("HostTime") . "]<br/>");
        print ("MerchantRemarks = [" . $tResponse->getValue("MerchantRemarks") . "]<br/>");
        print ("PayType         = [" . $tResponse->getValue("PayType") . "]<br/>");
        print ("NotifyType      = [" . $tResponse->getValue("NotifyType") . "]<br/>");

    } else {
        //3、失败
        //print ("<br>ReturnCode   = [" . $tResponse->getReturnCode() . "]<br>");
        //print ("ErrorMessage = [" . $tResponse->getErrorMessage() . "]<br>");
    }*/




	$out_trade_no = $tResponse->getValue("OrderNo");
	$body = $_POST['body'];
    $total_fee =$tResponse->getValue("Amount");
	//$strs = explode(':', $body);
	$_W['uniacid'] = $_W['weid'] = intval($strs[0]);
	$setting = uni_setting($_W['uniacid'], array('payment'));
    $type=$tResponse->getValue("MerchantRemarks");
	if (is_array($setting['payment'])) {
			m('common')->paylog("setting: ok\r\n");
			$prepares = array();
            if ($tResponse->isSuccess()) {
				m('common')->paylog("sign: ok\r\n");
				if ($type!="充值") {
                    $tMerchantPage= $type;
					$tid = $out_trade_no;
					$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `tid`=:tid and `module`=:module limit 1';
					$params = array();
					$params[':tid'] = $tid;
					$params[':module'] = 'sea';
					$log = pdo_fetch($sql, $params);
					m('common')->paylog('log: ' . (empty($log) ? '' : json_encode($log)) . "\r\n");
					if (!empty($log) && $log['status'] == '0' && $log['fee'] == $total_fee) {
						m('common')->paylog("corelog: ok\r\n");
						$site = WeUtility::createModuleSite($log['module']);
						if (!is_error($site)) {
							$method = 'payResult';
							if (method_exists($site, $method)) {
								$ret = array();
								$ret['weid'] = $log['weid'];
								$ret['uniacid'] = $log['uniacid'];
								$ret['result'] = 'success';
								$ret['type'] = $log['type'];
								$ret['from'] = 'return';
								$ret['tid'] = $log['tid'];
								$ret['user'] = $log['openid'];
								$ret['fee'] = $log['fee'];
								$ret['is_usecard'] = $log['is_usecard'];
								$ret['card_type'] = $log['card_type'];
								$ret['card_fee'] = $log['card_fee'];
								$ret['card_id'] = $log['card_id'];
								m('common')->paylog('method: execute
');
								$result = $site->$method($ret);
								if (is_array($result) && $result['result'] == 'success') {
									$record = array();
									$record['status'] = '1';
									pdo_update('core_paylog', $record, array('plid' => $log['plid']));
									//exit('success');
								}
							} else {
								m('common')->paylog('method not found!
');
							}
						} else {
							m('common')->paylog('error: ' . json_encode($site) . "\r\n");
						}
					}

				} else if ($type == '充值') {
					$logno = trim($out_trade_no);
					if (empty($logno)) {
						exit;
					}
					$log = pdo_fetch('SELECT * FROM ' . tablename('sea_member_log') . ' WHERE `uniacid`=:uniacid and `logno`=:logno limit 1', array(':uniacid' => $_W['uniacid'], ':logno' => $logno));
					if (!empty($log) && empty($log['status']) && $log['fee'] == $total_fee) {
						pdo_update('sea_member_log', array('status' => 1, 'rechargetype' => 'alipay'), array('id' => $log['id']));
						m('member')->setCredit($log['openid'], 'credit2', $log['money'], array(0, '海软商城会员充值:credit2:' . $log['money']));
						m('member')->setRechargeCredit($log['openid'], $log['money']);
						if (p('sale')) {
							p('sale')->setRechargeActivity($log);
						}
						m('notice')->sendMemberLogMessage($log['id']);
					}
				}
			}
		}

}
print ("<html><head><meta http-equiv=\"refresh\" content=\"0; url='".$tMerchantPage."'\"></head></html>");
exit('fail');
