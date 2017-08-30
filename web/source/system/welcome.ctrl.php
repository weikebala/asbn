<?php
/**
 * [iseasoft System] Copyright (c) 2015 iseasoft.cn
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
$_W['page']['title'] = '系统';

load()->model('cloud');

$cloud_registered = cloud_prepare();
$cloud_registered = $cloud_registered === true ? true : false;

template('system/welcome');
