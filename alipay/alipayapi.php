<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" content="text/html" http-equiv="Content-Type">
	<title>支付宝境外收单交易接口接口</title>
</head>
<?php
/* *
 * 功能：境外收单交易接口接入页
 * 版本：3.4
 * 修改日期：2016-03*08
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*****************
 
 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 *1、开发文档中心（https://ds.alipay.com/fd-ij9mtflt/home.html）
 *2、支持中心（https://global.alipay.com/service/service.htm）
 *3、支持邮箱（overseas_support@service.alibaba.com）

 *如果想使用扩展功能,请按文档要求,自行添加到parameter数组即可。
 **********************************************
 */

require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");

/**************************请求参数**************************/
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $_POST['WIDout_trade_no'];

        //订单名称，必填
        $subject = $_POST['WIDsubject'];

		//付款外币币种，必填
        $currency = $_POST['currency'];
		
        //付款外币金额，必填
        $total_fee = $_POST['WIDtotal_fee'];

        //商品描述，可空
        $body = $_POST['WIDbody'];

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service"       => $alipay_config['service'],
		"partner"       => $alipay_config['partner'],
		"notify_url"	=> $alipay_config['notify_url'],
		"return_url"	=> $alipay_config['return_url'],
		
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"merchant_url" => 'http://shop.as-ba.cn/alipay/index.php',
		"body"	=> $body,
		"currency" => $currency,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		//其他业务参数根据在线开发文档，添加参数.文档地址:https://ds.alipay.com/fd-ij9mtflt/home.html
        //如"参数名"=>"参数值"
		
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;

?>
</body>
</html>