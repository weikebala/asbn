<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
/*
define('CLOUD_UPGRADE_URL', 'http://115.29.33.155/web/index.php?c=account&a=upgradetest');
if (!defined('IN_IA')) {
    die('Access Denied');
}
global $_W, $_GPC;
if (!$_W['isfounder']) {
    message('无权访问!');
}
$op = empty($_GPC['op']) ? 'display' : $_GPC['op'];
load()->func('communication');
load()->func('file');
if ($op == 'display') {
    define('CLOUD_URL', 'http://115.29.33.155/web/index.php?c=account&a=register');
    $data['domain'] = $_SERVER['HTTP_HOST'];
    $data['signature'] = 'sz_cloud_register';
    $res = ihttp_request(CLOUD_URL, $data);
    if (!$res) {
        die('通讯失败,请检查网络');
    }
    $content = json_decode($res['content'], 1);
    if ($content['status'] == 2) {
        die(json_encode(array('result' => 0, 'message' => $content['msg'] . '. ')));
    }
    $versionfile = IA_ROOT . '/addons/sea/version.php';
    $updatedate = date('Y-m-d H:i', filemtime($versionfile));
    $version = sea_VERSION;
} else {
    if ($op == 'check') {
        set_time_limit(0);
        global $my_scenfiles;
        my_scandir(IA_ROOT . '/addons/sea');
        $files = array();
        foreach ($my_scenfiles as $sf) {
            $files[] = array('path' => str_replace(IA_ROOT . '/addons/sea/', '', $sf), 'md5' => md5_file($sf));
        }
        $files = base64_encode(json_encode($files));
        $version = defined('sea_VERSION') ? sea_VERSION : '1.0';
        $resp = ihttp_post(CLOUD_UPGRADE_URL, array('type' => 'upgrade', 'signature' => 'sz_cloud_register', 'domain' => $_SERVER['HTTP_HOST'], 'version' => $version, 'files' => $files));
        $ret = @json_decode($resp['content'], true);
        if (is_array($ret)) {
            if ($ret['result'] == 1) {
                $files = array();
                if (!empty($ret['files'])) {
                    foreach ($ret['files'] as $file) {
                        $entry = IA_ROOT . '/addons/sea/' . $file['path'];
                        if (!is_file($entry) || md5_file($entry) != $file['md5']) {
                            $dir = explode('/', $file['path']);
                            if (@$dir[0] == 'tmp') {
                                continue;
                            }
                            $files[] = array('path' => $file['path'], 'download' => 0);
                            $difffile[] = $file['path'];
                        } else {
                            $samefile[] = $file['path'];
                        }
                    }
                }
                $tmpdir = IA_ROOT . '/addons/sea/tmp/' . date('ymd');
                if (!is_dir($tmpdir)) {
                    mkdirs($tmpdir);
                }
                $ret['files'] = $files;
                file_put_contents($tmpdir . '/file.txt', json_encode($ret));
                die(json_encode(array('result' => 1, 'version' => $ret['version'], 'files' => $ret['files'], 'filecount' => count($files), 'upgrade' => !empty($ret['upgrade']), 'log' => str_replace('
', '<br/>', base64_decode($ret['log'])))));
            }
        }
        die(json_encode(array('result' => 0, 'message' => $ret . '. ')));
    } else {
        if ($op == 'download') {
            $tmpdir = IA_ROOT . '/addons/sea/tmp/' . date('ymd');
            $f = file_get_contents($tmpdir . '/file.txt');
            $upgrade = json_decode($f, true);
            $files = $upgrade['files'];
            $path = '';
            foreach ($files as $f) {
                if (empty($f['download'])) {
                    $path = $f['path'];
                    break;
                }
            }
            if (!empty($path)) {
                if (!empty($_GPC['nofiles'])) {
                    if (in_array($path, $_GPC['nofiles'])) {
                        foreach ($files as &$f) {
                            if ($f['path'] == $path) {
                                $f['download'] = 1;
                                break;
                            }
                        }
                        unset($f);
                        $upgrade['files'] = $files;
                        $tmpdir = IA_ROOT . '/addons/sea/tmp/' . date('ymd');
                        if (!is_dir($tmpdir)) {
                            mkdirs($tmpdir);
                        }
                        file_put_contents($tmpdir . '/file.txt', json_encode($upgrade));
                        die(json_encode(array('result' => 3)));
                    }
                }
                $resp = ihttp_post(CLOUD_UPGRADE_URL, array('type' => 'download', 'signature' => 'sz_cloud_register', 'domain' => $_SERVER['HTTP_HOST'], 'version' => $version, 'path' => $path));
                $ret = @json_decode($resp['content'], true);
                if (is_array($ret)) {
                    $path = $ret['path'];
                    $dirpath = dirname($path);
                    if (!is_dir(IA_ROOT . '/addons/sea/' . $dirpath)) {
                        mkdirs(IA_ROOT . '/addons/sea/' . $dirpath, '0777');
                    }
                    $content = base64_decode($ret['content']);
                    file_put_contents(IA_ROOT . '/addons/sea/' . $path, $content);
                    if (isset($ret['path1'])) {
                        $path1 = $ret['path1'];
                        $dirpath1 = dirname($path1);
                        if (!is_dir(IA_ROOT . '/addons/sea/' . $dirpath1)) {
                            mkdirs(IA_ROOT . '/addons/sea/' . $dirpath1, '0777');
                        }
                        $content1 = base64_decode($ret['content1']);
                        file_put_contents(IA_ROOT . '/addons/sea/' . $path1, $content1);
                    }
                    $success = 0;
                    foreach ($files as &$f) {
                        if ($f['path'] == $path) {
                            $f['download'] = 1;
                            break;
                        }
                        if ($f['download']) {
                            $success++;
                        }
                    }
                    unset($f);
                    $upgrade['files'] = $files;
                    $tmpdir = IA_ROOT . '/addons/sea/tmp/' . date('ymd');
                    if (!is_dir($tmpdir)) {
                        mkdirs($tmpdir);
                    }
                    file_put_contents($tmpdir . '/file.txt', json_encode($upgrade));
                    die(json_encode(array('result' => 1, 'total' => count($files), 'success' => $success)));
                }
            } else {
                if (!empty($upgrade['upgrade'])) {
                    $updatefile = IA_ROOT . '/addons/sea/upgradesql.php';
                    file_put_contents($updatefile, base64_decode($upgrade['upgrade']));
                    require $updatefile;
                    @unlink($updatefile);
                }
                file_put_contents(IA_ROOT . '/addons/sea/version.php', '<?php if(!defined(\'IN_IA\')) {exit(\'Access Denied\');}if(!defined(\'sea_VERSION\')) {define(\'sea_VERSION\', \'' . $upgrade['version'] . '\');}');
                $tmpdir = IA_ROOT . '/addons/sea/tmp';
                @rmdirs($tmpdir);
                @rmdirs(IA_ROOT . '/addons/sea/data/cache');
                $time = time();
                global $my_scenfiles;
                my_scandir(IA_ROOT . '/addons/sea');
                foreach ($my_scenfiles as $file) {
                    if (!strexists($file, '/sea/data/') && !strexists($file, 'version.php')) {
                        @touch($file, $time);
                    }
                }
                die(json_encode(array('result' => 2)));
            }
        } else {
            if ($op == 'download_zip') {
                define('CLOUD_UPGRADE_URL', 'http://xinghuo.yunzshop.com/web/index.php?c=account&a=upgrade');
                $data['version'] = sea_VERSION;
                $data['method'] = 'upgrade';
                $res = ihttp_request(CLOUD_UPGRADE_URL, $data);
                if (!$res) {
                    die(json_encode(array('result' => 0, 'msg' => '通讯失败,请检查网络')));
                }
                $res = json_decode($res['content'], 1);
                if ($res['msg'] == 'new') {
                    die(json_encode(array('result' => 0, 'msg' => '已经是最新程序')));
                }
                foreach ($res as $v) {
                    if ($v['version'] == sea_VERSION) {
                        continue;
                    }
                    $filename = 'http://xinghuo.yunzshop.com/data/upgrade_zip/' . $v['version'] . '.zip';
                    curl_download($filename, IA_ROOT . '/addons/sea/upgrade.zip');
                    $zip = new ZipArchive();
                    $res = $zip->open(IA_ROOT . '/addons/sea/upgrade.zip');
                    if ($res === TRUE) {
                        $zip->extractTo(IA_ROOT . '/addons');
                        $zip->close();
                        $version = file_get_contents(IA_ROOT . '/addons/sea/version.php');
                        $v = preg_replace('/define\\(\'sea_VERSION\', \'(.+)\'\\)/', 'define(\'sea_VERSION\', \'' . $v['version'] . '\')', $version);
                        file_put_contents(IA_ROOT . '/addons/sea/version.php', $v);
                    } else {
                        die(json_encode(array('result' => 0, 'msg' => '解压失败')));
                    }
                }
                die(json_encode(array('result' => 2)));
            } else {
                if ($op == 'checkversion') {
                    file_put_contents(IA_ROOT . '/addons/sea/version.php', '<?php if(!defined(\'IN_IA\')) {exit(\'Access Denied\');}if(!defined(\'sea_VERSION\')) {define(\'sea_VERSION\', \'1.0\');}');
                    header('location: ' . $this->createWebUrl('upgrade'));
                    die;
                }
            }
        }
    }
}
*/
include $this->template('web/sysset/upgrade');