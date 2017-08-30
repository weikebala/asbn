<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
function icheck_gpc($name)
{
    if (is_array($name)) {
        foreach ($name as $key => $value) {
            $name[stripslashes($key)] = icheck_gpc($value);
        }
    } else {
        $name = inject_check($name);
        if ($name) {
            die('非法参数');
        }
    }
    return $name;
}
function inject_check($_var_3)
{
    return preg_match('/eval|select|insert|update|delete|\'|\\/\\*|\\*|\\.\\.\\/|\\.\\/|union|into|load_file|outfile/i', $_var_3);
}
function sz_tpl_form_field_date($name, $value = '', $_var_5 = false)
{
    $_var_6 = '';
    if (!defined('TPL_INIT_DATA')) {
        $_var_6 = '
			<script type="text/javascript">
				require(["datetimepicker"], function(){
					$(function(){
						$(".datetimepicker").each(function(){
							var option = {
								lang : "zh",
								step : "10",
								timepicker : ' . (!empty($_var_5) ? 'true' : 'false') . ',closeOnDateSelect : true,
			format : "Y-m-d' . (!empty($_var_5) ? ' H:i:s"' : '"') . '};
			$(this).datetimepicker(option);
		});
	});
});
</script>';
        define('TPL_INIT_DATA', true);
    }
    $_var_5 = empty($_var_5) ? false : true;
    if (!empty($value)) {
        $value = strexists($value, '-') ? strtotime($value) : $value;
    } else {
        $value = TIMESTAMP;
    }
    $value = $_var_5 ? date('Y-m-d H:i:s', $value) : date('Y-m-d', $value);
    $_var_6 .= '<input type="text" name="' . $name . '"  value="' . $value . '" placeholder="请选择日期时间" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;" />';
    return $_var_6;
}
function isMobile()
{
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    if (isset($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    }
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $_var_7 = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile', 'WindowsWechat');
        if (preg_match('/(' . implode('|', $_var_7) . ')/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))) {
            return true;
        }
    }
    return false;
}
function chmod_dir($dir, $_var_9 = '')
{
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if (is_dir($dir . '/' . $file)) {
                    if ($file != '.' && $file != '..') {
                        $path = $dir . '/' . $file;
                        $_var_9 ? chmod($path, $_var_9) : FALSE;
                        chmod_dir($path);
                    }
                } else {
                    $path = $dir . '/' . $file;
                    $_var_9 ? chmod($path, $_var_9) : FALSE;
                }
            }
        }
        closedir($handle);
    }
}
function curl_download($url, $dir)
{
    $_var_14 = curl_init($url);
    $_var_15 = fopen($dir, 'wb');
    curl_setopt($_var_14, CURLOPT_FILE, $_var_15);
    curl_setopt($_var_14, CURLOPT_HEADER, 0);
    $_var_16 = curl_exec($_var_14);
    curl_close($_var_14);
    fclose($_var_15);
    return $_var_16;
}
function send_sms($_var_17, $_var_18, $_var_19, $_var_20)
{
    $content = '您的验证码是：' . $_var_20 . '。请不要把验证码泄露给其他人。如非本人操作，可不用理会！';
    $_var_22 = file_get_contents('http://106.ihuyi.cn/webservice/sms.php?method=Submit&account=' . $_var_17 . '&password=' . $_var_18 . '&mobile=' . $_var_19 . '&content=' . urldecode($content));
    return xml_to_array($_var_22);
}
function send_sms_alidayu($_var_19, $_var_20, $_var_23)
{
    $set = m('common')->getSysset();
    include IA_ROOT . '/addons/sea/alifish/TopSdk.php';
    switch ($_var_23) {
        case 'reg':
            $_var_25 = $set['sms']['templateCode'];
            break;
        case 'forget':
            $_var_25 = $set['sms']['templateCodeForget'];
            break;
        default:
            $_var_25 = $set['sms']['templateCode'];
            break;
    }
    $_var_26 = new TopClient();
    $_var_26->appkey = $set['sms']['appkey'];
    $_var_26->secretKey = $set['sms']['secret'];
    $_var_27 = new AlibabaAliqinFcSmsNumSendRequest();
    $_var_27->setExtend('123456');
    $_var_27->setSmsType('normal');
    $_var_27->setSmsFreeSignName($set['sms']['signname']);
    $_var_27->setSmsParam("{\"code\":\"{$_var_20}\",\"product\":\"{$set['sms']['product']}\"}");
    $_var_27->setRecNum($_var_19);
    $_var_27->setSmsTemplateCode($_var_25);
    $resp = $_var_26->execute($_var_27);
    return objectArray($resp);
}
function xml_to_array($_var_29)
{
    $_var_30 = '/<(\\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/';
    if (preg_match_all($_var_30, $_var_29, $_var_31)) {
        $_var_32 = count($_var_31[0]);
        for ($i = 0; $i < $_var_32; $i++) {
            $_var_34 = $_var_31[2][$i];
            $key = $_var_31[1][$i];
            if (preg_match($_var_30, $_var_34)) {
                $_var_35[$key] = xml_to_array($_var_34);
            } else {
                $_var_35[$key] = $_var_34;
            }
        }
    }
    return $_var_35;
}
function redirect($url, $_var_36 = 0)
{
    echo "<meta http-equiv=refresh content='{$_var_36}; url={$url}'>";
    die;
}
function m($name = '')
{
    static $_modules = array();
    if (isset($_modules[$name])) {
        return $_modules[$name];
    }
    $model = sea_CORE . 'model/' . strtolower($name) . '.php';
    if (!is_file($model)) {
        die(' Model ' . $name . ' Not Found!');
    }
    require $model;
    $class_name = 'Sz_DYi_' . ucfirst($name);
    $_modules[$name] = new $class_name();
    return $_modules[$name];
}
function isEnablePlugin($name)
{
    $_var_40 = m('cache')->getArray('plugins', 'global');
    if ($_var_40) {
        foreach ($_var_40 as $_var_41) {
            if ($_var_41['identity'] == $name) {
                if ($_var_41['status']) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}
function p($name = '')
{
    if (!isEnablePlugin($name)) {
        return false;
    }
    if ($name != 'perm' && !IN_MOBILE) {
        static $_perm_model;
        if (!$_perm_model) {
            $perm_model_file = sea_PLUGIN . 'perm/model.php';
            if (is_file($perm_model_file)) {
                require $perm_model_file;
                $perm_class_name = 'PermModel';
                $_perm_model = new $perm_class_name('perm');
            }
        }
        if ($_perm_model) {
            if (!$_perm_model->check_plugin($name)) {
                return false;
            }
        }
    }
    static $_plugins = array();
    if (isset($_plugins[$name])) {
        return $_plugins[$name];
    }
    $model = sea_PLUGIN . strtolower($name) . '/model.php';
    if (!is_file($model)) {
        return false;
    }
    require $model;
    $class_name = ucfirst($name) . 'Model';
    $_plugins[$name] = new $class_name($name);
    return $_plugins[$name];
}
function byte_format($input, $dec = 0)
{
    $prefix_arr = array(' B', 'K', 'M', 'G', 'T');
    $value = round($input, $dec);
    $i = 0;
    while ($value > 1024) {
        $value /= 1024;
        $i++;
    }
    $return_str = round($value, $dec) . $prefix_arr[$i];
    return $return_str;
}
function save_media($url)
{
    $config = array('qiniu' => false);
    $plugin = p('qiniu');
    if ($plugin) {
        $config = $plugin->getConfig();
        if ($config) {
            if (strexists($url, $config['url'])) {
                return $url;
            }
            $qiniu_url = $plugin->save(tomedia($url), $config);
            if (empty($qiniu_url)) {
                return $url;
            }
            return $qiniu_url;
        }
        return $url;
    }
    return $url;
}
function is_array2($array)
{
    if (is_array($array)) {
        foreach ($array as $k => $v) {
            return is_array($v);
        }
        return false;
    }
    return false;
}
function set_medias($list = array(), $fields = null)
{
    if (empty($fields)) {
        foreach ($list as &$row) {
            $row = tomedia($row);
        }
        return $list;
    }
    if (!is_array($fields)) {
        $fields = explode(',', $fields);
    }
    if (is_array2($list)) {
        foreach ($list as $key => &$value) {
            foreach ($fields as $field) {
                if (isset($list[$field])) {
                    $list[$field] = tomedia($list[$field]);
                }
                if (is_array($value) && isset($value[$field])) {
                    $value[$field] = tomedia($value[$field]);
                }
            }
        }
        return $list;
    } else {
        foreach ($fields as $field) {
            if (isset($list[$field])) {
                $list[$field] = tomedia($list[$field]);
            }
        }
        return $list;
    }
}
function get_last_day($year, $month)
{
    return date('t', strtotime("{$year}-{$month} -1"));
}
function show_message($msg = '', $url = '', $type = 'success')
{
    $scripts = '<script language=\'javascript\'>require([\'core\'],function(core){ core.message(\'' . $msg . '\',\'' . $url . '\',\'' . $type . '\')})</script>';
    die($scripts);
}
function show_json($status = 1, $return = null)
{
    $ret = array('status' => $status);
    if ($return) {
        $ret['result'] = $return;
    }
    die(json_encode($ret));
}
function is_weixin()
{
    if (empty($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false && strpos($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') === false) {
        return false;
    }
    return true;
}
function b64_encode($obj)
{
    if (is_array($obj)) {
        return urlencode(base64_encode(json_encode($obj)));
    }
    return urlencode(base64_encode($obj));
}
function b64_decode($str, $is_array = true)
{
    $str = base64_decode(urldecode($str));
    if ($is_array) {
        return json_decode($str, true);
    }
    return $str;
}
function create_image($img)
{
    $ext = strtolower(substr($img, strrpos($img, '.')));
    if ($ext == '.png') {
        $thumb = imagecreatefrompng($img);
    } else {
        if ($ext == '.gif') {
            $thumb = imagecreatefromgif($img);
        } else {
            $thumb = imagecreatefromjpeg($img);
        }
    }
    return $thumb;
}
function get_authcode()
{
    $auth = get_auth();
    return empty($auth['code']) ? '' : $auth['code'];
}
function get_auth()
{
    global $_W;
    $set = pdo_fetch('select sets from ' . tablename('sea_sysset') . ' order by id asc limit 1');
    $sets = iunserializer($set['sets']);
    if (is_array($sets)) {
        return is_array($sets['auth']) ? $sets['auth'] : array();
    }
    return array();
}
function check_shop_auth($url = '', $type = 's')
{
    global $_W, $_GPC;
    if ($_W['ispost'] && $_GPC['do'] != 'auth') {
        $auth = get_auth();
        load()->func('communication');
        $domain = $_SERVER['HTTP_HOST'];
        $ip = gethostbyname($domain);
        $setting = setting_load('site');
        $id = isset($setting['site']['key']) ? $setting['site']['key'] : '0';
        if (empty($type) || $type == 's') {
            $post_data = array('type' => $type, 'ip' => $ip, 'id' => $id, 'code' => $auth['code'], 'domain' => $domain);
        } else {
            $post_data = array('type' => 'm', 'm' => $type, 'ip' => $ip, 'id' => $id, 'code' => $auth['code'], 'domain' => $domain);
        }
        $resp = ihttp_post($url, $post_data);
        $status = $resp['content'];
        if ($status != '1') {
            message(base64_decode('6K+35Yiw5b6u6LWe5a6Y5pa56LSt5LmwLeS6uuS6uuWVhuWfjuaooeWdly1iYnMuMDEyd3ouY29tIQ=='), '', 'error');
        }
    }
}
$my_scenfiles = array();
function my_scandir($dir)
{
    global $my_scenfiles;
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            if ($file != '..' && $file != '.' && $file != '.git' && $file != 'tmp') {
                if (is_dir($dir . '/' . $file)) {
                    my_scandir($dir . '/' . $file);
                } else {
                    $my_scenfiles[] = $dir . '/' . $file;
                }
            }
        }
        closedir($handle);
    }
}
function shop_template_compile($from, $to, $inmodule = false)
{
    $path = dirname($to);
    if (!is_dir($path)) {
        load()->func('file');
        mkdirs($path);
    }
    $content = shop_template_parse(file_get_contents($from), $inmodule);
    if (IMS_FAMILY == 'x' && !preg_match('/(footer|header|account\\/welcome|login|register)+/', $from)) {
        $content = str_replace('微赞', '系统', $content);
    }
    file_put_contents($to, $content);
}
function shop_template_parse($str, $inmodule = false)
{
    $str = template_parse($str, $inmodule);
    $str = preg_replace('/{ifp\\s+(.+?)}/', '<?php if(cv($1)) { ?>', $str);
    $str = preg_replace('/{ifpp\\s+(.+?)}/', '<?php if(cp($1)) { ?>', $str);
    $str = preg_replace('/{ife\\s+(\\S+)\\s+(\\S+)}/', '<?php if( ce($1 ,$2) ) { ?>', $str);
    return $str;
}
function ce($permtype = '', $item = null)
{
    $perm = p('perm');
    if ($perm) {
        return $perm->check_edit($permtype, $item);
    }
    return true;
}
function cv($permtypes = '')
{
    $perm = p('perm');
    if ($perm) {
        return $perm->check_perm($permtypes);
    }
    return true;
}
function ca($permtypes = '')
{
    if (!cv($permtypes)) {
        message('您没有权限操作，请联系管理员!', '', 'error');
    }
}
function cp($pluginname = '')
{
    $perm = p('perm');
    if ($perm) {
        return $perm->check_plugin($pluginname);
    }
    return true;
}
function cpa($pluginname = '')
{
    if (!cp($pluginname)) {
        message('您没有权限操作，请联系管理员!', '', 'error');
    }
}
function plog($type = '', $op = '')
{
    $perm = p('perm');
    if ($perm) {
        $perm->log($type, $op);
    }
}
function objectArray($array)
{
    if (is_object($array)) {
        $array = (array) $array;
    }
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = objectArray($value);
        }
    }
    return $array;
}
function tpl_form_field_category_3level($name, $parents, $children, $parentid, $childid, $thirdid)
{
    $html = '
<script type="text/javascript">
	window._' . $name . ' = ' . json_encode($children) . ';
</script>';
    if (!defined('TPL_INIT_CATEGORY_THIRD')) {
        $html .= '
<script type="text/javascript">
	function renderCategoryThird(obj, name){
		var index = obj.options[obj.selectedIndex].value;
		require([\'jquery\', \'util\'], function($, u){
			$selectChild = $(\'#\'+name+\'_child\');
                                                      $selectThird = $(\'#\'+name+\'_third\');
			var html = \'<option value="0">请选择二级分类</option>\';
                                                      var html1 = \'<option value="0">请选择三级分类</option>\';
			if (!window[\'_\'+name] || !window[\'_\'+name][index]) {
				$selectChild.html(html);
                                                                        $selectThird.html(html1);
				return false;
			}
			for(var i=0; i< window[\'_\'+name][index].length; i++){
				html += \'<option value="\'+window[\'_\'+name][index][i][\'id\']+\'">\'+window[\'_\'+name][index][i][\'name\']+\'</option>\';
			}
			$selectChild.html(html);
                                                    $selectThird.html(html1);
		});
	}
        function renderCategoryThird1(obj, name){
		var index = obj.options[obj.selectedIndex].value;
		require([\'jquery\', \'util\'], function($, u){
			$selectChild = $(\'#\'+name+\'_third\');
			var html = \'<option value="0">请选择三级分类</option>\';
			if (!window[\'_\'+name] || !window[\'_\'+name][index]) {
				$selectChild.html(html);
				return false;
			}
			for(var i=0; i< window[\'_\'+name][index].length; i++){
				html += \'<option value="\'+window[\'_\'+name][index][i][\'id\']+\'">\'+window[\'_\'+name][index][i][\'name\']+\'</option>\';
			}
			$selectChild.html(html);
		});
	}
</script>
			';
        define('TPL_INIT_CATEGORY_THIRD', true);
    }
    $html .= '<div class="row row-fix tpl-category-container">
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<select class="form-control tpl-category-parent" id="' . $name . '_parent" name="' . $name . '[parentid]" onchange="renderCategoryThird(this,\'' . $name . '\')">
			<option value="0">请选择一级分类</option>';
    $_var_96 = '';
    foreach ($parents as $row) {
        $html .= '
			<option value="' . $row['id'] . '" ' . ($row['id'] == $parentid ? 'selected="selected"' : '') . '>' . $row['name'] . '</option>';
    }
    $html .= '
		</select>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<select class="form-control tpl-category-child" id="' . $name . '_child" name="' . $name . '[childid]" onchange="renderCategoryThird1(this,\'' . $name . '\')">
			<option value="0">请选择二级分类</option>';
    if (!empty($parentid) && !empty($children[$parentid])) {
        foreach ($children[$parentid] as $row) {
            $html .= '
			<option value="' . $row['id'] . '"' . ($row['id'] == $childid ? 'selected="selected"' : '') . '>' . $row['name'] . '</option>';
        }
    }
    $html .= '
		</select>
	</div>
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<select class="form-control tpl-category-child" id="' . $name . '_third" name="' . $name . '[thirdid]">
			<option value="0">请选择三级分类</option>';
    if (!empty($childid) && !empty($children[$childid])) {
        foreach ($children[$childid] as $row) {
            $html .= '
			<option value="' . $row['id'] . '"' . ($row['id'] == $thirdid ? 'selected="selected"' : '') . '>' . $row['name'] . '</option>';
        }
    }
    $html .= '</select>
	</div>
</div>';
    return $html;
}