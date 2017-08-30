<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Sz_DYi_Common
{
    public function dataMove()
    {
        $_var_0 = 'ewei_shop';
        $_var_1 = 'sea';
        $_var_2 = pdo_fetchall('SHOW TABLES LIKE \'%' . $_var_1 . '%\'');
        if (!$_var_2) {
            return false;
        }
        foreach ($_var_2 as $_var_3) {
            foreach ($_var_3 as $_var_4) {
                $_var_5 = 'drop table `' . $_var_4 . '`';
                pdo_query($_var_5);
            }
        }
        $_var_2 = pdo_fetchall('SHOW TABLES LIKE \'%' . $_var_0 . '%\'');
        if (!$_var_2) {
            return false;
        }
        foreach ($_var_2 as $_var_3) {
            foreach ($_var_3 as $_var_4) {
                $_var_5 = 'rename table `' . $_var_4 . '` to `' . str_replace($_var_0, $_var_1, $_var_4) . '`';
                pdo_query($_var_5);
            }
        }
        if (!pdo_fieldexists('sea_member', 'regtype')) {
            pdo_query('ALTER TABLE ' . tablename('sea_member') . ' ADD    `regtype` tinyint(3) DEFAULT \'1\';');
        }
        if (!pdo_fieldexists('sea_member', 'isbindmobile')) {
            pdo_query('ALTER TABLE ' . tablename('sea_member') . ' ADD    `isbindmobile` tinyint(3) DEFAULT \'0\';');
        }
        if (!pdo_fieldexists('sea_member', 'isjumpbind')) {
            pdo_query('ALTER TABLE ' . tablename('sea_member') . ' ADD    `isjumpbind` tinyint(3) DEFAULT \'0\';');
        }
        if (!pdo_fieldexists('sea_member', 'pwd')) {
            pdo_query('ALTER TABLE  ' . tablename('sea_member') . ' CHANGE  `pwd`  `pwd` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');
        }
        pdo_query('UPDATE `ims_sea_plugin` SET `name` = \'海软加盟\' WHERE `identity` = \'commission\'');
        pdo_query('UPDATE `ims_qrcode` SET `name` = \'sea_POSTER_QRCODE\', `keyword`=\'sea_POSTER\' WHERE `keyword` = \'EWEI_SHOP_POSTER\'');
        if (!pdo_fieldexists('sea_goods', 'cates')) {
            pdo_query('ALTER TABLE ' . tablename('sea_goods') . ' ADD     `cates` text;');
        }
    }
    public function getSetData($uniacid = 0)
    {
        global $_W;
        if (empty($uniacid)) {
            $uniacid = $_W['uniacid'];
        }
        $set = m('cache')->getArray('sysset', $uniacid);
        if (empty($set)) {
            $set = pdo_fetch('select * from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
            if (empty($set)) {
                $set = array();
            }
            m('cache')->set('sysset', $set, $uniacid);
        }
        return $set;
    }
    public function getSysset($key = '', $uniacid = 0)
    {
        global $_W, $_GPC;
        $set = $this->getSetData($uniacid);
        $_var_9 = unserialize($set['sets']);
        $_var_10 = array();
        if (!empty($key)) {
            if (is_array($key)) {
                foreach ($key as $k) {
                    $_var_10[$k] = isset($_var_9[$k]) ? $_var_9[$k] : array();
                }
            } else {
                $_var_10 = isset($_var_9[$key]) ? $_var_9[$key] : array();
            }
            return $_var_10;
        } else {
            return $_var_9;
        }
    }
    public function alipay_build($params, $alipay = array(), $type = 0, $openid = '',$refreurl = "")
    {
        global $_W;
        $_var_16 = $params['tid'];
        $set = array();
        $set['service'] = 'alipay.wap.create.direct.pay.by.user';
        $set['partner'] = $alipay['partner'];
        $set['_input_charset'] = 'utf-8';
        if (empty($type)) {
            $set['notify_url'] = $_W['siteroot'] . 'addons/sea/payment/alipay/notify.php';
            $set['return_url'] = $_W['siteroot'] . "app/index.php?i={$_W['uniacid']}&c=entry&m=sea&do=order&p=pay&op=return&openid=" . $openid;
        } else {
            $set['notify_url'] = $_W['siteroot'] . 'addons/sea/payment/alipay/notify.php';
            $set['return_url'] = $_W['siteroot'] . "app/index.php?i={$_W['uniacid']}&c=entry&m=sea&do=member&p=recharge&op=return&openid=" . $openid;
        }
        $set['out_trade_no'] = $_var_16;
        $set['subject'] = $params['title'];
        $set['total_fee'] = $params['fee'];
		$set['show_url'] = $_W['siteroot'] . "app/index.php?i={$_W['uniacid']}&c=entry&m=sea&do=order";
        $set['seller_id'] = $alipay['partner'];
        $set['payment_type'] = 1;
        $set['body'] = $_W['uniacid'] . ':' . $type;
		ksort($set);
		reset($set);
		$_var_17 = array();
        foreach ($set as $key => $_var_18) {
            if ($key != 'sign' && $key != 'sign_type') {
                $_var_17[] = "{$key}={$_var_18}";
            }
        }
		$string = implode($_var_17, '&');
        $string .= $alipay['secret'];
        $set['sign'] = md5($string);
		$set['sign_type'] = 'MD5';
        return array('url' => "https://mapi.alipay.com/gateway.do?" . http_build_query($set, '', '&'));
    }
    function wechat_build($params, $wechat, $type = 0)
    {
        global $_W;
        load()->func('communication');
        if (empty($wechat['version']) && !empty($wechat['signkey'])) {
            $wechat['version'] = 1;
        }
        $wOpt = array();
        if ($wechat['version'] == 1) {
            $wOpt['appId'] = $wechat['appid'];
            $wOpt['timeStamp'] = TIMESTAMP . '';
            $wOpt['nonceStr'] = random(8) . '';
            $package = array();
            $package['bank_type'] = 'WX';
            $package['body'] = urlencode($params['title']);
            $package['attach'] = $_W['uniacid'] . ':' . $type;
            $package['partner'] = $wechat['partner'];
            $package['device_info'] = 'sea';
            $package['out_trade_no'] = $params['tid'];
            $package['total_fee'] = $params['fee'] * 100;
            $package['fee_type'] = '1';
            $package['notify_url'] = $_W['siteroot'] . 'addons/sea/payment/wechat/notify.php';
            $package['spbill_create_ip'] = CLIENT_IP;
            $package['input_charset'] = 'UTF-8';
            ksort($package);
            $string1 = '';
            foreach ($package as $key => $v) {
                if (empty($v)) {
                    continue;
                }
                $string1 .= "{$key}={$v}&";
            }
            $string1 .= "key={$wechat['key']}";
            $sign = strtoupper(md5($string1));
            $string2 = '';
            foreach ($package as $key => $v) {
                $v = urlencode($v);
                $string2 .= "{$key}={$v}&";
            }
            $string2 .= "sign={$sign}";
            $wOpt['package'] = $string2;
            $string = '';
            $keys = array('appId', 'timeStamp', 'nonceStr', 'package', 'appKey');
            sort($keys);
            foreach ($keys as $key) {
                $v = $wOpt[$key];
                if ($key == 'appKey') {
                    $v = $wechat['signkey'];
                }
                $key = strtolower($key);
                $string .= "{$key}={$v}&";
            }
            $string = rtrim($string, '&');
            $wOpt['signType'] = 'SHA1';
            $wOpt['paySign'] = sha1($string);
            return $wOpt;
        } else {
            $package = array();
            $package['appid'] = $wechat['appid'];
            $package['mch_id'] = $wechat['mchid'];
            $package['nonce_str'] = random(8) . '';
            $package['body'] = $params['title'];
            $package['device_info'] = 'sea';
            $package['attach'] = $_W['uniacid'] . ':' . $type;
            $package['out_trade_no'] = $params['tid'];
            $package['total_fee'] = $params['fee'] * 100;
            $package['spbill_create_ip'] = CLIENT_IP;
            $package['notify_url'] = $_W['siteroot'] . 'addons/sea/payment/wechat/notify.php';
            $package['trade_type'] = $params['trade_type'] == 'NATIVE' ? 'NATIVE' : 'JSAPI';
            $package['openid'] = $_W['fans']['from_user'];
            ksort($package, SORT_STRING);
            $string1 = '';
            foreach ($package as $key => $v) {
                if (empty($v)) {
                    continue;
                }
                $string1 .= "{$key}={$v}&";
            }
            $string1 .= "key={$wechat['signkey']}";
            $package['sign'] = strtoupper(md5($string1));
            $dat = array2xml($package);
            $response = ihttp_request('https://api.mch.weixin.qq.com/pay/unifiedorder', $dat);
            if (is_error($response)) {
                return $response;
            }
            $xml = @simplexml_load_string($response['content'], 'SimpleXMLElement', LIBXML_NOCDATA);
            if (strval($xml->return_code) == 'FAIL') {
                return error(-1, strval($xml->return_msg));
            }
            if (strval($xml->result_code) == 'FAIL') {
                return error(-1, strval($xml->err_code) . ': ' . strval($xml->err_code_des));
            }
            $prepayid = $xml->prepay_id;
            $wOpt['appId'] = $wechat['appid'];
            $wOpt['timeStamp'] = TIMESTAMP . '';
            $wOpt['nonceStr'] = random(8) . '';
            $wOpt['package'] = 'prepay_id=' . $prepayid;
            $wOpt['signType'] = 'MD5';
            if ($params['trade_type'] == 'NATIVE') {
                $_var_32 = (array) $xml->code_url;
                $wOpt['code_url'] = $_var_32[0];
            }
            ksort($wOpt, SORT_STRING);
            foreach ($wOpt as $key => $v) {
                $string .= "{$key}={$v}&";
            }
            $string .= "key={$wechat['signkey']}";
            $wOpt['paySign'] = strtoupper(md5($string));
            return $wOpt;
        }
    }
    public function getAccount()
    {
        global $_W;
        load()->model('account');
        if (!empty($_W['acid'])) {
            return WeAccount::create($_W['acid']);
        } else {
            $acid = pdo_fetchcolumn('SELECT acid FROM ' . tablename('account_wechats') . ' WHERE `uniacid`=:uniacid LIMIT 1', array(':uniacid' => $_W['uniacid']));
            return WeAccount::create($acid);
        }
        return false;
    }
    public function shareAddress()
    {
        global $_W, $_GPC;
        $appid = $_W['account']['key'];
        $secret = $_W['account']['secret'];
        load()->func('communication');
        $url = $_W['siteroot'] . 'app/index.php?' . $_SERVER['QUERY_STRING'];
        if (empty($_GPC['code'])) {
            $_var_37 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
            header("location: {$_var_37}");
            die;
        }
        $code = $_GPC['code'];
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
        $resp = ihttp_get($token_url);
        $token = @json_decode($resp['content'], true);
        if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
            return false;
        }
        $package = array('appid' => $appid, 'url' => $url, 'timestamp' => time() . '', 'noncestr' => random(8, true) . '', 'accesstoken' => $token['access_token']);
        ksort($package, SORT_STRING);
        $addrSigns = array();
        foreach ($package as $k => $v) {
            $addrSigns[] = "{$k}={$v}";
        }
        $string = implode('&', $addrSigns);
        $addrSign = strtolower(sha1(trim($string)));
        $data = array('appId' => $appid, 'scope' => 'jsapi_address', 'signType' => 'sha1', 'addrSign' => $addrSign, 'timeStamp' => $package['timestamp'], 'nonceStr' => $package['noncestr']);
        return $data;
    }
    public function createNO($table, $field, $prefix)
    {
        $billno = date('YmdHis') . random(6, true);
        while (1) {
            $count = pdo_fetchcolumn('select count(*) from ' . tablename('sea_' . $table) . " where {$field}=:billno limit 1", array(':billno' => $billno));
            if ($count <= 0) {
                break;
            }
            $billno = date('YmdHis') . random(6, true);
        }
        return $prefix . $billno;
    }
    public function html_images($detail = '')
    {
        $detail = htmlspecialchars_decode($detail);
        preg_match_all('/<img.*?src=[\\\'| "](.*?(?:[\\.gif|\\.jpg|\\.png|\\.jpeg]?))[\\\'|"].*?[\\/]?>/', $detail, $imgs);
        $images = array();
        if (isset($imgs[1])) {
            foreach ($imgs[1] as $img) {
                $im = array('old' => $img, 'new' => save_media($img));
                $images[] = $im;
            }
        }
        foreach ($images as $img) {
            $detail = str_replace($img['old'], $img['new'], $detail);
        }
        return $detail;
    }
    public function getSec($uniacid = 0)
    {
        global $_W;
        if (empty($uniacid)) {
            $uniacid = $_W['uniacid'];
        }
        $set = pdo_fetch('select sec from ' . tablename('sea_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
        if (empty($set)) {
            $set = array();
        }
        return $set;
    }
    public function paylog($_var_55 = '')
    {
        global $_W;
        $data['msg']=is_array($_var_55)?serialize($_var_55):$_var_55;
        pdo_insert('pay_log', $data);
        $_var_56 = m('cache')->getString('paylog', 'global');
        if (!empty($_var_56)) {
            $_var_57 = IA_ROOT . '/addons/sea/data/paylog/' . $_W['uniacid'] . '/' . date('Ymd');
            if (!is_dir($_var_57)) {
                load()->func('file');
                @mkdirs($_var_57, '0777');
            }
            $_var_58 = $_var_57 . '/' . date('H') . '.log';
            file_put_contents($_var_58, $_var_55, FILE_APPEND);
        }
    }
}