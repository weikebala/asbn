<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>支付结果</title>
<style>
    .but{
        border: 1px #999 solid;
        color: #515152;
        font-size: 12px;
        height: 25px;
        line-height: 25px;
        text-align: center;
    }
    .but1{
        width: 84%;
        margin-left: 8%;
        margin-top: 15%;
    }
    .but2{
        border-radius: 5px;
        padding: 5px 15px;
        float: right;
        margin-right: 20px;
    }
    .but2 a{
        text-decoration: none;
        color: #515152;
    }
    .foot{
        position: fixed;
        bottom: 60%;
        padding-left: 25%;
    }
</style>
<div>
    <p class="but but1"><?php  if($paymentResult=="success") { ?>恭喜您！付款成功！<?php  } else { ?>您的订单号:<?php  echo $orderinfo['ordersn'];?>支付失败<?php  } ?></p>
    <p class="but but1"><?php  if($paymentResult=="success") { ?>我们将尽快发出，谢谢您的惠顾<?php  } else { ?>如遇到问题请联系客服<?php  } ?></p>
    <div class="foot">
        <p class="but but2"><a href="<?php  echo $this->createMobileUrl('member')?>">个人中心</a></p>
        <p class="but but2"><a href="<?php  echo $this->createMobileUrl('shop/index')?>">再逛逛</a></p>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

