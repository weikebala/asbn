<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Sz_DYi_User
{
    private $sessionid;
    public function __construct()
    {
        global $_W;
        $this->sessionid = "__cookie_sea_201507200000_{$_W['uniacid']}";
    }
    function getOpenid()
    {
        $userinfo = $this->getInfo(false, true);
        return $userinfo['openid'];
    }
    function getPerOpenid()
    {
        global $_W, $_GPC;
        $lifeTime = 24 * 3600 * 3;
        session_set_cookie_params($lifeTime);
        @session_start();
        $cookieid = "__cookie_sea_openid_{$_W['uniacid']}";
        $openid = base64_decode($_COOKIE[$cookieid]);
        if (!empty($openid)) {
            return $openid;
        }
        load()->func('communication');
        $appId = $_W['account']['key'];
        $appSecret = $_W['account']['secret'];
        $access_token = '';
        $code = $_GPC['code'];
        $url = $_W['siteroot'] . 'app/index.php?' . $_SERVER['QUERY_STRING'];
        if (empty($code)) {
            $authurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appId . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
            header('location: ' . $authurl);
            die;
        } else {
            $tokenurl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appId . '&secret=' . $appSecret . '&code=' . $code . '&grant_type=authorization_code';
            $resp = ihttp_get($tokenurl);
            $token = @json_decode($resp['content'], true);
            if (!empty($token) && is_array($token) && $token['errmsg'] == 'invalid code') {
                $authurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appId . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
                header('location: ' . $authurl);
                die;
            }
            if (is_array($token) && !empty($token['openid'])) {
                $access_token = $token['access_token'];
                $openid = $token['openid'];
                setcookie($cookieid, base64_encode($openid));
            } else {
                $querys = explode('&', $_SERVER['QUERY_STRING']);
                $newq = array();
                foreach ($querys as $q) {
                    if (!strexists($q, 'code=') && !strexists($q, 'state=') && !strexists($q, 'from=') && !strexists($q, 'isappinstalled=')) {
                        $newq[] = $q;
                    }
                }
                $rurl = $_W['siteroot'] . 'app/index.php?' . implode('&', $newq);
                $authurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appId . '&redirect_uri=' . urlencode($rurl) . '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
                header('location: ' . $authurl);
                die;
            }
        }
        return $openid;
    }
    function isLogin()
    {
        global $_W, $_GPC;
        @session_start();
        $cookieid = "__cookie_sea_userid_{$_W['uniacid']}";
        $openid = base64_decode($_COOKIE[$cookieid]);
        if (empty($_SERVER['HTTP_USER_AGENT']) && empty($openid) && $_GPC['token']) {
            $openid = $_GPC['token'];
        }
        if (!empty($openid)) {
            return $openid;
        }
        return false;
    }
    function getUserInfo()
    {
        global $_W, $_GPC;
        $_var_17 = array('address', 'commission', 'cart');
        $_var_18 = array('category', 'login', 'receive', 'close', 'designer', 'register', 'sendcode', 'bindmobile', 'forget', 'article');
        $_var_19 = array('shop', 'login', 'register');
        if (!$_GPC['p'] && $_GPC['do'] == 'shop') {
            return;
        }
        if (!in_array($_GPC['p'], $_var_18) && !in_array($_GPC['do'], $_var_19) or in_array($_GPC['p'], $_var_17)) {
            if ($_GPC['method'] != 'myshop' or $_GPC['c'] != 'entry') {
                $openid = $this->isLogin();
                if (!$openid && $_GPC['p'] != 'cart') {
                    if ($_GPC['do'] != 'runtasks') {
                        setcookie('preUrl', $_W['siteurl']);
                    }
                    $_var_20 = $_GPC['mid'] ? '&mid=' . $_GPC['mid'] : '';
                    $url = "/app/index.php?i={$_W['uniacid']}&c=entry&p=login&do=member&m=sea" . $_var_20;
                    redirect($url);
                } else {
                    $userinfo = array('openid' => $openid, 'headimgurl' => '');
                    return $userinfo;
                }
            }
        }
    }
    function getInfo($base64 = false, $debug = false)//false true
    {
        global $_W, $_GPC;
        if (!is_weixin()) {
            return $this->getUserInfo();
        }
        $userinfo = array();
        if (sea_DEBUG) {
            $userinfo = array('openid' => 'oVwSVuJXB7lGGc93d0gBXQ_h-czc', 'nickname' => '小萝莉', 'headimgurl' => '', 'province' => '香港', 'city' => '九龙');
        } else {
            load()->model('mc');
            if (empty($_GPC['directopenid'])) {
                $userinfo = mc_oauth_userinfo();
            } else {
                $userinfo = array('openid' => $this->getPerOpenid());
            }
            $need_openid = false;
            if ($_W['container'] != 'wechat') {
                if ($_GPC['do'] == 'order' && $_GPC['p'] == 'pay') {
                    $need_openid = false;
                }
                if ($_GPC['do'] == 'member' && $_GPC['p'] == 'recharge') {
                    $need_openid = false;
                }
                if ($_GPC['do'] == 'plugin' && $_GPC['p'] == 'article' && $_GPC['preview'] == '1') {
                    $need_openid = false;
                }
            }
        }
        if ($base64) {
            return urlencode(base64_encode(json_encode($userinfo)));
        }
        return $userinfo;
    }
    function oauth_info()
    {
        global $_W, $_GPC;
        if ($_W['container'] != 'wechat') {
            if ($_GPC['do'] == 'order' && $_GPC['p'] == 'pay') {
                return array();
            }
            if ($_GPC['do'] == 'member' && $_GPC['p'] == 'recharge') {
                return array();
            }
        }
        $lifeTime = 24 * 3600 * 3;
        session_set_cookie_params($lifeTime);
        @session_start();
        $sessionid = "__cookie_sea_201507100000_{$_W['uniacid']}";
        $session = json_decode(base64_decode($_SESSION[$sessionid]), true);
        $openid = is_array($session) ? $session['openid'] : '';
        $nickname = is_array($session) ? $session['openid'] : '';
        if (!empty($openid)) {
            return $session;
        }
        load()->func('communication');
        $appId = $_W['account']['key'];
        $appSecret = $_W['account']['secret'];
        $access_token = '';
        $code = $_GPC['code'];
        $url = $_W['siteroot'] . 'app/index.php?' . $_SERVER['QUERY_STRING'];
        if (empty($code)) {
            $authurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appId . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
            header('location: ' . $authurl);
            die;
        } else {
            $tokenurl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appId . '&secret=' . $appSecret . '&code=' . $code . '&grant_type=authorization_code';
            $resp = ihttp_get($tokenurl);
            $token = @json_decode($resp['content'], true);
            if (!empty($token) && is_array($token) && $token['errmsg'] == 'invalid code') {
                $authurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appId . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
                header('location: ' . $authurl);
                die;
            }
            if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
                die('获取token失败,请重新进入!');
            } else {
                $access_token = $token['access_token'];
                $openid = $token['openid'];
            }
        }
        $infourl = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $resp = ihttp_get($infourl);
        $userinfo = @json_decode($resp['content'], true);
        if (isset($userinfo['nickname'])) {
            $_SESSION[$sessionid] = base64_encode(json_encode($userinfo));
            return $userinfo;
        } else {
            die('获取用户信息失败，请重新进入!');
        }
    }
    function followed($openid = '')
    {
        global $_W;
        $followed = !empty($openid);
        if ($followed) {
            $mf = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid=:openid and uniacid=:uniacid limit 1', array(':openid' => $openid, ':uniacid' => $_W['uniacid']));
            $followed = $mf['follow'] == 1;
        }
        return $followed;
    }
}