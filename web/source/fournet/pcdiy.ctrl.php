<?php
/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.cn
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
defined('IN_IA') or exit('Access Denied');
$do = in_array($do, array('display', 'post', 'delete')) ? $do : 'display';

if($do == 'display') {
} elseif($do == 'post') {
} elseif($do == 'delete') {
}
template('fournet/pcdiy');

