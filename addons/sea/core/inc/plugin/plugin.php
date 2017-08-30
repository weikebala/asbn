<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Plugin extends Core
{
    public $pluginname;
    public $model;
    public function __construct($name  = '')
    {
        parent::__construct();
        $this->modulename = 'sea';
        $this->pluginname = $name;
        $this->loadModel();
        if (strexists($_SERVER['REQUEST_URI'], '/web/')) {
            cpa($this->pluginname);
        } else {
            if (strexists($_SERVER['REQUEST_URI'], '/app/')) {
                $this->setFooter();
            }
        }
        $this->module['title'] = pdo_fetchcolumn('select title from ' . tablename('modules') . ' where name=\'sea\' limit 1');
    }
    private function loadModel()
    {
        $modelfile = IA_ROOT . '/addons/' . $this->modulename . '/plugin/' . $this->pluginname . '/model.php';
        if (is_file($modelfile)) {
            $classname = ucfirst($this->pluginname) . 'Model';
            require $modelfile;
            $this->model = new $classname($this->pluginname);
        }
    }
    public function getSet()
    {
        return $this->model->getSet();
    }
    public function updateSet($data = array())
    {
        $this->model->updateSet($data);
    }
    public function template($filename, $type = TEMPLATE_INCLUDEPATH)
    {
        global $_W;
        $_var_6 = isMobile() ? 'mobile' : 'pc';
        if (strstr($_SERVER['REQUEST_URI'], 'app')) {
            if (!isMobile()) {
                if ($this->yzShopSet['ispc'] == 0) {
                    $_var_6 = 'mobile';
                }
            }
        }
        $defineDir = IA_ROOT . '/addons/sea/';
        if (defined('IN_SYS')) {
            $source = IA_ROOT . '/addons/sea/plugin/' . $this->pluginname . "/template/{$filename}.html";
            $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/sea/plugin/" . $this->pluginname . "/{$filename}.tpl.php";
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/sea/template/{$filename}.html";
                $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/sea/{$filename}.tpl.php";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/{$_W['template']}/{$filename}.html";
                $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/{$filename}.tpl.php";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                $compile = IA_ROOT . "/data/tpl/web/default/{$filename}.tpl.php";
            }
        } else {
            $_var_10 = m('cache')->getString('template_shop');
            if (empty($_var_10)) {
                $_var_10 = 'default';
            }
            if (!is_dir(IA_ROOT . "/addons/sea/template/{$_var_6}/" . $_var_10)) {
                $_var_10 = 'default';
            }
            $_var_11 = m('cache')->getString('template_' . $this->pluginname);
            if (empty($_var_11)) {
                $_var_11 = 'default';
            }
            if (!is_dir(IA_ROOT . '/addons/sea/plugin/' . $this->pluginname . "/template/{$_var_6}/" . $_var_11)) {
                $_var_11 = 'default';
            }
            $compile = IA_ROOT . '/data/app/sea/plugin/' . $this->pluginname . "/{$_var_11}/{$_var_6}/{$filename}.tpl.php";
            $source = $defineDir . '/plugin/' . $this->pluginname . "/template/{$_var_6}/{$_var_11}/{$filename}.html";
            if (!is_file($source)) {
                $source = $defineDir . '/plugin/' . $this->pluginname . "/template/{$_var_6}/default/{$filename}.html";
                $compile = IA_ROOT . '/data/app/sea/plugin/' . $this->pluginname . "/default/{$_var_6}/{$filename}.tpl.php";
            }
            if (!is_file($source)) {
                $source = $defineDir . "/template/{$_var_6}/{$_var_10}/{$filename}.html";
                $compile = IA_ROOT . "/data/app/sea/{$_var_10}/{$filename}.tpl.php";
            }
            if (!is_file($source)) {
                $source = $defineDir . "/template/{$_var_6}/default/{$filename}.html";
                $compile = IA_ROOT . "/data/app/sea/default/{$filename}.tpl.php";
            }
            if (!is_file($source)) {
                $source = $defineDir . "/template/{$_var_6}/{$filename}.html";
                $compile = IA_ROOT . "/data/app/sea/{$filename}.tpl.php";
            }
            if (!is_file($source)) {
                $names = explode('/', $filename);
                $pluginname = $names[0];
                $_var_14 = m('cache')->getString('template_' . $pluginname);
                if (empty($_var_14)) {
                    $_var_14 = 'default';
                }
                if (!is_dir(IA_ROOT . '/addons/sea/plugin/' . $pluginname . "/template/{$_var_6}/" . $_var_14)) {
                    $_var_14 = 'default';
                }
                $pfilename = $names[1];
                $source = IA_ROOT . '/addons/sea/plugin/' . $pluginname . "/template/{$_var_6}/" . $_var_14 . "/{$pfilename}.html";
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
    public function _exec_plugin($do, $web = true)
    {
        global $_GPC;
        if ($web) {
            $file = IA_ROOT . '/addons/sea/plugin/' . $this->pluginname . '/core/web/' . $do . '.php';
        } else {
            $file = IA_ROOT . '/addons/sea/plugin/' . $this->pluginname . '/core/mobile/' . $do . '.php';
        }
        if (!is_file($file)) {
            message("未找到控制器文件 : {$file}");
        }
        include $file;
        die;
    }
}