<?php
/**
 * 海软升级服务端
 *
 * @url
 */
ini_set('display_errors','On');
error_reporting(0);
defined('IN_IA') or exit('Access Denied');

include "model.php";

class Upgrade_clientModuleSite extends WeModuleSite {

	function __construct(){
		global $_W,$_GPC;
		
	}

	public function __rout($file,$dir = 'web'){
        global $_W,$_GPC;
        if ($dir == 'web') {
        	$file = 'core/web/' .$file. '.php';
        } elseif ($dir == 'moblie') {
        	$file = 'core/moblie' . $file . '.php';
        } 
        include_once $file;
    }

	public function doWebList(){
		global $_GPC,$_W;
        $this->__rout('list');
	}

    public function doWebset(){
        global $_GPC,$_W;
        $this->__rout('set');
    }
}
