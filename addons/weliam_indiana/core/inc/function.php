<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
} 
/*
 * 返回以$name为名字的类对象
 * */
function m($name = '') {
	static $_modules = array();
	if (isset($_modules[$name])) {
		return $_modules[$name];
	} 
	$model = WELIAM_INDIANA_CORE."model/" . strtolower($name) . '.php';
	if (!is_file($model)) {
		die(' Model ' . $name . ' Not Found!');
	} 
	require $model;
	$class_name = 'Welian_Indiana_' . ucfirst($name);//调用该类
	$_modules[$name] = new $class_name();
	return $_modules[$name];
} 
function is_array2($array) {
	if (is_array($array)) {
		foreach ($array as $k => $v) {
			return is_array($v);
		} 
		return false;
	} 
	return false;
} 
function is_weixin() {
	if (empty($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false && strpos($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') === false) {
		return false;
	} 
	return true;
}