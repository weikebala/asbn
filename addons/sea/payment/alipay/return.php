<html>
<head>
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
</head>
<body>
<div>
    <p class="but but1">恭喜您！付款成功！</p>
    <p class="but but1">我们将尽快发出，谢谢您的惠顾</p>
    <div class="foot">
        <p class="but but2"><a href="{php echo $this->createMobileUrl('shop/index')}">再逛逛</a></p>
    </div>
</div>
</body>
</html>

