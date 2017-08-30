<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>余额提现</title>
<style type="text/css">
body {margin:0px; background:#efefef; -moz-appearance:none;}
input {-webkit-appearance:none; outline:none;}
.balance_img {height:80px; width:80px; margin:70px auto 0px; background:#ffb400; border-radius:40px; color:#fff; font-size:70px; text-align:center; line-height:90px;}
.balance_text {height:20px; width:100%; margin-top:16px; text-align:center; line-height:20px; font-size:16px; color:#666;}
.balance_num {height:24px; width:100%; margin-top:10px; text-align:center; line-height:24px; font-size:22px; color:#444;}
.balance_list {height:auto; width:100%; text-align:center; color:#92b5d6; font-size:16px; margin-top:80px;}
.balance_sub1 {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.balance_sub2 {height:44px; margin:14px 5px; background:#f49c06; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.balance_sub3 {height:44px; margin:14px 5px;background:#e2cb04; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}

</style>
<div id="container"></div>

<script id="tpl_main" type="text/html">
   <div class="balance_img"><i class="fa fa-cny"></i></div>
   <div class="balance_text">您的当前余额</div>
   <div class="balance_num">￥<span id="credit"><%credit%></span></div>
   <div class="balance_num" style="height:30px;">
   <input type="text" id="money" value='' style="width:90%; height:38px; font-size:20px; margin:auto; border:1px solid #eee; padding:0px 2%; text-align:center;" placeholder="请输入提现的金额"/></div>
   <div class="button balance_sub1">确认提现</div>
<div class="balance_sub3" onclick="location.href='<?php  echo $this->createMobileUrl('member/log',array('type'=>1))?>'">提现记录</div>
</script>
<script language="javascript">
    require(['tpl', 'core'], function (tpl, core) {
 
        core.json('member/withdraw', {}, function (json) {
            
            var result = json.result;
            if (json.status != 1) {
                core.tip.show(json.result);
                return;
            }
            
            $('#container').html(tpl('tpl_main', result));
            
            if(result.noinfo){
                core.message('请补充您的资料后才能申请提现!',result.infourl,'warning');
                return;
            }
         
            var withdrawmoney = <?php echo empty($set['trade']['withdrawmoney'])?0:floatval($set['trade']['withdrawmoney'])?>;
           
            if(result.credit<=0){
                core.message('无余额，无法申请提现!',"<?php  echo $this->createMobileUrl('member')?>",'warning');
                return;
            }
     
              if(withdrawmoney>0 && result.credit<withdrawmoney){
                core.message('余额不足 '+ withdrawmoney +' 元，无法申请提现!',"<?php  echo $this->createMobileUrl('member')?>",'warning');
                return;
            }
             
            
            $('.balance_sub1').click(function () {
                    if ($(this).attr('submitting') == '1') {
                        return;
                    }
                    var money = $('#money').val();
                    if (!$('#money').isNumber()) {
                       
                        core.tip.show('请输入数字金额!');
                        return;
                    }
                     if( parseFloat(money) < withdrawmoney){
                        core.tip.show('满 '+ withdrawmoney +' 元才能申请提现!');
                        return;
                    }
                   
                    $(this).attr('submitting', 1);
                    core.json('member/withdraw', {op: 'submit', money: money}, function (rjson) {
                        if(rjson.status!=1){
                            $(this).removeAttr('submitting');
                            core.tip.show(rjson.result);
                            return;
                        }
                        core.message('提现申请提交成功，请等待审核!',"<?php  echo $this->createMobileUrl('member')?>",'success');
                    }, true, true);
 
            });
        }, true);
    });

</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
