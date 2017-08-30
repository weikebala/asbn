<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Core extends WeModuleSite
{
    public $footer = array();
    public $header = null;
    public $yzShopSet = array();
    public function __construct()
    {
        global $_W, $_GPC;
        if (is_weixin()) {
            #跟新微信用户数据 处理分销关系
            m('member')->checkMember();	
        } else {
            $_var_0 = array('poster', 'postera');
            if (p('commission') && !in_array($_GPC['p'], $_var_0) && !strpos($_SERVER['SCRIPT_NAME'], 'notify')) {
                if (strexists($_SERVER['REQUEST_URI'], '/web/')) {
                    return;
                }
                p('commission')->checkAgent();
            }
        }
        $this->yzShopSet = m('common')->getSysset('shop');
    }
    public function sendSms($_var_1, $_var_2, $_var_3 = 'reg')
    {
        $set = m('common')->getSysset();
        if ($set['sms']['type'] == 1) {
            return send_sms($set['sms']['account'], $set['sms']['password'], $_var_1, $_var_2);
        } else {
            return send_sms_alidayu($_var_1, $_var_2, $_var_3);
        }
    }
    public function runTasks()
    {
        global $_W;
        load()->func('communication');
        $_var_5 = strtotime(m('cache')->getString('receive', 'global'));
        $_var_6 = intval(m('cache')->getString('receive_time', 'global'));
        if (empty($_var_6)) {
            $_var_6 = 60;
        }
        $_var_6 *= 60;
        $_var_7 = time();
        if ($_var_5 + $_var_6 <= $_var_7) {
            m('cache')->set('receive', date('Y-m-d H:i:s', $_var_7), 'global');
            ihttp_request($_W['siteroot'] . 'addons/sea/core/mobile/order/receive.php', null, null, 1);
        }
        $_var_5 = strtotime(m('cache')->getString('closeorder', 'global'));
        $_var_6 = intval(m('cache')->getString('closeorder_time', 'global'));
        if (empty($_var_6)) {
            $_var_6 = 60;
        }
        $_var_6 *= 60;
        $_var_7 = time();
        if ($_var_5 + $_var_6 <= $_var_7) {
            m('cache')->set('closeorder', date('Y-m-d H:i:s', $_var_7), 'global');
            ihttp_request($_W['siteroot'] . 'addons/sea/core/mobile/order/close.php', null, null, 1);
        }
        if (p('coupon')) {
            $_var_8 = strtotime(m('cache')->getString('couponbacktime', 'global'));
            $_var_9 = p('coupon')->getSet();
            $_var_10 = intval($_var_9['backruntime']);
            if (empty($_var_10)) {
                $_var_10 = 60;
            }
            $_var_10 *= 60;
            $_var_11 = time();
            if ($_var_8 + $_var_10 <= $_var_11) {
                m('cache')->set('couponbacktime', date('Y-m-d H:i:s', $_var_11), 'global');
                ihttp_request($_W['siteroot'] . 'addons/sea/plugin/coupon/core/mobile/back.php', null, null, 1);
            }
        }
        die('run finished.');
    }
    public function setHeader()
    {
        global $_W, $_GPC;
        $openid = m('user')->getOpenid();
        $followed = m('user')->followed($openid);
        $mid = intval($_GPC['mid']);
        $memberid = m('member')->getMid();
        $this->setFooter();
        @session_start();
        if (!$followed && $memberid != $mid && isMobile()) {
            $set = m('common')->getSysset();
            $this->header = array('url' => $set['share']['followurl']);
            $friend = false;
            if (!empty($mid)) {
                if (!empty($_SESSION[sea_PREFIX . '_shareid']) && $_SESSION[sea_PREFIX . '_shareid'] == $mid) {
                    $mid = $_SESSION[sea_PREFIX . '_shareid'];
                }
                $member = m('member')->getMember($mid);
                if (!empty($member)) {
                    $_SESSION[sea_PREFIX . '_shareid'] = $mid;
                    $friend = true;
                    $this->header['icon'] = $member['avatar'];
                    $this->header['text'] = '来自好友 <span>' . $member['nickname'] . '</span> 的推荐';
                }
            }
            if (!$friend) {
                $this->header['icon'] = tomedia($set['shop']['logo']);
                $this->header['text'] = '欢迎进入 <span>' . $set['shop']['name'] . '</span>';
            }
        }
    }
    public function setFooter()
    {
        global $_W, $_GPC;
        $_var_18 = strtolower(trim($_GPC['p']));
        $_var_19 = strtolower(trim($_GPC['method']));
        if (strexists($_var_18, 'poster') && $_var_19 == 'build') {
            return;
        }
        if (strexists($_var_18, 'designer') && ($_var_19 == 'index' || empty($_var_19)) && $_GPC['preview'] == 1) {
            return;
        }
        $openid = m('user')->getOpenid();
        $designer = p('designer');
        if ($designer && $_GPC['p'] != 'designer') {
            $menu = $designer->getDefaultMenu();
            if (!empty($menu)) {
                $this->footer['diymenu'] = true;
                $this->footer['diymenus'] = $menu['menus'];
                $this->footer['diyparams'] = $menu['params'];
                return;
            }
        }
        $mid = intval($_GPC['mid']);
        $this->footer['first'] = array('text' => '首页', 'ico' => 'home', 'url' => $this->createMobileUrl('shop'));
        $this->footer['second'] = array('text' => '分类', 'ico' => 'list', 'url' => $this->createMobileUrl('shop/category'));
        $this->footer['seconds'] = array('text' => '品牌', 'ico' => 'list', 'url' => $this->createMobileUrl('shop/brand'));
        $this->footer['commission'] = false;
        $member = m('member')->getMember($openid);
        if (!empty($member['isblack'])) {
            if ($_GPC['op'] != 'black') {
                header('Location: ' . $this->createMobileUrl('member/login', array('op' => 'black')));
            }
        }
        if (p('commission')) {
            $set = p('commission')->getSet();
            if (empty($set['level'])) {
                return;
            }
            $isagent = $member['isagent'] == 1 && $member['status'] == 1;
            if ($_GPC['do'] == 'plugin') {
                $this->footer['first'] = array('text' => empty($set['closemyshop']) ? $set['texts']['shop'] : '首页', 'ico' => 'home', 'url' => empty($set['closemyshop']) ? $this->createPluginMobileUrl('commission/myshop', array('mid' => $member['id'])) : $this->createMobileUrl('shop'));
                if ($_GPC['method'] == '') {
                    $this->footer['first']['text'] = empty($set['closemyshop']) ? $set['texts']['myshop'] : '首页';
                }
                if (empty($member['agentblack'])) {
                    $this->footer['commission'] = array('text' => $set['texts']['center'], 'ico' => 'sitemap', 'url' => $this->createPluginMobileUrl('commission'));
                }
            } else {
                if (empty($member['agentblack'])) {
                    if (!$isagent) {
                        $this->footer['commission'] = array('text' => $set['texts']['become'], 'ico' => 'sitemap', 'url' => $this->createPluginMobileUrl('commission/register'));
                    } else {
                        $this->footer['commission'] = array('text' => empty($set['closemyshop']) ? $set['texts']['shop'] : $set['texts']['center'], 'ico' => empty($set['closemyshop']) ? 'heart' : 'sitemap', 'url' => empty($set['closemyshop']) ? $this->createPluginMobileUrl('commission/myshop', array('mid' => $member['id'])) : $this->createPluginMobileUrl('commission'));
                    }
                }
            }
        }
        if (strstr($_SERVER['REQUEST_URI'], 'app')) {
            if (!isMobile()) {
                if ($this->yzShopSet['ispc'] == 0) {
                }
            }
        }
        if (is_weixin()) {
            if (!empty($this->yzShopSet['isbindmobile'])) {
                if (empty($member) || $member['isbindmobile'] == 0) {
                    if ($_GPC['p'] != 'bindmobile' && $_GPC['p'] != 'sendcode') {
                        $_var_23 = $this->createMobileUrl('member/bindmobile');
                        redirect($_var_23);
                        die;
                    }
                }
            }
        }
    }
    public function createMobileUrl($do, $query = array(), $noredirect = true)
    {
        global $_W, $_GPC;
        $do = explode('/', $do);
        if (isset($do[1])) {
            $query = array_merge(array('p' => $do[1]), $query);
        }
        if (empty($query['mid'])) {
            $mid = intval($_GPC['mid']);
            if (!empty($mid)) {
                $query['mid'] = $mid;
            }
        }
        return $_W['siteroot'] . 'app/' . substr(parent::createMobileUrl($do[0], $query, true), 2);
    }
    public function createWebUrl($do, $query = array())
    {
        global $_W;
        $do = explode('/', $do);
        if (count($do) > 1 && isset($do[1])) {
            $query = array_merge(array('p' => $do[1]), $query);
        }
        return $_W['siteroot'] . 'web/' . substr(parent::createWebUrl($do[0], $query, true), 2);
    }
    public function createPluginMobileUrl($do, $query = array())
    {
        global $_W, $_GPC;
        $do = explode('/', $do);
        $query = array_merge(array('p' => $do[0]), $query);
        $query['m'] = 'sea';
        if (isset($do[1])) {
            $query = array_merge(array('method' => $do[1]), $query);
        }
        if (isset($do[2])) {
            $query = array_merge(array('op' => $do[2]), $query);
        }
        if (empty($query['mid'])) {
            $mid = intval($_GPC['mid']);
            if (!empty($mid)) {
                $query['mid'] = $mid;
            }
        }
        return $_W['siteroot'] . 'app/' . substr(parent::createMobileUrl('plugin', $query, true), 2);
    }
    public function createPluginWebUrl($do, $query = array())
    {
        global $_W;
        $do = explode('/', $do);
        $query = array_merge(array('p' => $do[0]), $query);
        if (isset($do[1])) {
            $query = array_merge(array('method' => $do[1]), $query);
        }
        if (isset($do[2])) {
            $query = array_merge(array('op' => $do[2]), $query);
        }
        return $_W['siteroot'] . 'web/' . substr(parent::createWebUrl('plugin', $query, true), 2);
    }
    public function _exec($do, $default = '', $web = true)
    {
        global $_GPC;
        $do = strtolower(substr($do, $web ? 5 : 8));
        $p = trim($_GPC['p']);
        empty($p) && ($p = $default);
        if ($web) {
            $file = IA_ROOT . '/addons/sea/core/web/' . $do . '/' . $p . '.php';
        } else {
            $this->setFooter();
            $file = IA_ROOT . '/addons/sea/core/mobile/' . $do . '/' . $p . '.php';
        }
        if (!is_file($file)) {
            message("未找到 控制器文件 {$do}::{$p} : {$file}");
        }
        include $file;
        die;
    }
    public function _execFront($do, $default = '', $web = true)
    { 
        global $_W, $_GPC;
        define('IN_SYS', true);
        $_W['templateType'] = 'web';
        $do = strtolower(substr($do, 5));
        $p = trim($_GPC['p']);
        empty($p) && ($p = $default);
        $file = IA_ROOT . '/addons/sea/core/web/' . $do . '/' . $p . '.php';
        if (!is_file($file)) {
            message("未找到 控制器文件 {$do}::{$p} : {$file}");
        }
        include $file;
        die;
    }
    public function template($filename, $type = TEMPLATE_INCLUDEPATH)
    {  
        global $_W;
        $_var_33 = isMobile() ? 'mobile' : 'pc';
        $set = m('common')->getSysset('shop');
        if (strstr($_SERVER['REQUEST_URI'], 'app')) {
            if (!isMobile()) {
                if ($set['ispc'] == 0) {
                    $_var_33 = 'mobile';
                }
            }
        }
        if ($_W['templateType'] && $_W['templateType'] == 'web') {
        }
        $name = strtolower($this->modulename);
        if (defined('IN_SYS')) {
            $source = IA_ROOT . "/web/themes/{$_W['template']}/{$name}/{$filename}.html";
            $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/{$name}/{$filename}.tpl.php";
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/{$_W['template']}/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
            }
            if (!is_file($source)) {
                $explode = explode('/', $filename);
                $temp = array_slice($explode, 1);
                $source = IA_ROOT . "/addons/{$name}/plugin/" . $explode[0] . '/template/' . implode('/', $temp) . '.html';
            }
        } else {
            $template = m('cache')->getString('template_shop');
			if($_var_33 == 'pc' && $set['ispc'] == 1){
					$template = m('cache')->getString('ptemplate_shop');
			}
            if (empty($template)) {
                $template = 'default';
            }
            if (!is_dir(IA_ROOT . '/addons/sea/template/' . $_var_33 . '/' . $template)) {
                $template = 'default';
            }
            $compile = IA_ROOT . "/data/tpl/app/sea/{$template}/{$_var_33}/{$filename}.tpl.php";
            $source = IA_ROOT . "/addons/{$name}/template/{$_var_33}/{$template}/{$filename}.html";
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/{$_var_33}/default/{$filename}.html";
            }
            if (!is_file($source)) {
                $names = explode('/', $filename);
                $pluginname = $names[0];
                $_var_42 = m('cache')->getString('template_' . $pluginname);
                if (empty($_var_42)) {
                    $_var_42 = 'default';
                }
                if (!is_dir(IA_ROOT . '/addons/sea/plugin/' . $pluginname . "/template/{$_var_33}/" . $_var_42)) {
                    $_var_42 = 'default';
                }
                $pfilename = $names[1];
                $source = IA_ROOT . '/addons/sea/plugin/' . $pluginname . "/template/{$_var_33}/" . $_var_42 . "/{$pfilename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/app/themes/{$_W['template']}/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
            }
        }
        if (!is_file($source)) {
            die("Error: template source '{$filename}' is not exist!");
        }
        if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
            shop_template_compile($source, $compile, true);
        }
        return $compile;
    }
    public function getUrl()
    {
        if (p('commission')) {
            $set = p('commission')->getSet();
            if (!empty($set['level'])) {
                return $this->createPluginMobileUrl('commission/myshop');
            }
        }
        return $this->createMobileUrl('shop');
    }
}