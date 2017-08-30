<?php
/**
 * [iseasoft System] Copyright (c) 2014 iseasoft.Com
 * iseasoft is NOT a free software, it under the license terms, visited http://www.iseasoft.cn for more details.
 */
if($action != 'entry') {
	define('FRAME', 'setting');
	$frames = buildframes(array(FRAME));
	$frames = $frames[FRAME];
}
