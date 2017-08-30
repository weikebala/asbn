<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<title>供应商申请</title>     
<script language="javascript" src="../addons/sea/static/js/require.js"></script>
<script language="javascript" src="../addons/sea/static/js/app/config.js?v=2"></script>
<script language="javascript" src="../addons/sea/static/js/dist/jquery-1.11.1.min.js"></script>
<script language="javascript" src="../addons/sea/static/js/dist/jquery.gcjs.js"></script>
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    .info_main {height:auto;  background:#fff; margin-top:14px; border-bottom:1px solid #e8e8e8; border-top:1px solid #e8e8e8;}
    .info_main .line {margin:0 10px; height:40px; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
    .info_main .line .title {height:40px; width:80px; line-height:40px; color:#444; float:left; font-size:16px;}
    .info_main .line .info { width:100%;float:right;margin-left:-80px; }
    .info_main .line .inner { margin-left:80px; }
    .info_main .line .inner input {height:38px; width:100%;display:block; padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
    .info_main .line .inner .user_sex {line-height:40px;}
    .info_sub {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
	.info_sub1 {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .select { border:1px solid #ccc;height:25px;}
</style>
<script src="../addons/sea/static/js/dist/mobiscroll/mobiscroll.core-2.5.2.js" type="text/javascript"></script>
<script src="../addons/sea/static/js/dist/mobiscroll/mobiscroll.core-2.5.2-zh.js" type="text/javascript"></script>
<link href="../addons/sea/static/js/dist/mobiscroll/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css" />
<link href="../addons/sea/static/js/dist/mobiscroll/mobiscroll.animation-2.5.2.css" rel="stylesheet" type="text/css" />
<script src="../addons/sea/static/js/dist/mobiscroll/mobiscroll.datetime-2.5.1.js" type="text/javascript"></script>
<script src="../addons/sea/static/js/dist/mobiscroll/mobiscroll.datetime-2.5.1-zh.js" type="text/javascript"></script>
<script src="../addons/sea/static/js/dist/mobiscroll/mobiscroll.android-ics-2.5.2.js" type="text/javascript"></script>
<link href="../addons/sea/static/js/dist/mobiscroll/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../addons/sea/static/js/dist/area/cascade.js"></script>
<div id="container" class="rightlist"></div></div>
<script id="member_info" type="text/html">
    <div class="page_topbar">
		<div class="title">供应商申请</div>
	</div>
	<?php  if(empty($af_supplier)){?>
    <div class="info_main">
        <div class="line"><div class="title">姓名</div><div class='info'><div class='inner'><input type="text" id='realname' placeholder="请输入您的姓名"  value="" /></div></div></div>
        <div class="line"><div class="title">手机号码</div><div class='info'><div class='inner'><input type="text" id='mobile' placeholder="请输入您的手机号码"  value="" /></div></div></div>
        <div class="line"><div class="title">微信号</div><div class='info'><div class='inner'><input type="text" id='weixin' placeholder="请输入微信号" value=""/></div></div></div>
		<div class="line"><div class="title">产品名称</div><div class='info'><div class='inner'><input type="text" id='productname' placeholder="请输入产品名称" value=""/></div></div></div>
    </div>
    <div class="info_sub">提交申请</div>
	<?php  }?>
	<?php  if(!empty($af_supplier)){?>
		<div class="page_topbar">
			<div class="title">您已经提交过申请了</div>
		</div>
		<div class="info_sub1">确定</div>
	<?php  }?>
</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        core.pjson('supplier/af_supplier',{},function(json){
            if (json.result.member) {
                var data = json.result.member;
                $('#container').html(tpl('member_info', data));
        				$('.info_sub1').click(function(){
        				 window.location.href="<?php  echo $this->createMobileUrl('order')?>";
        				});
                $('.info_sub').click(function() {
			
                    if($(this).attr('saving')=='1')
                    {
                        return;
                    }
                   
                       if( $('#realname').isEmpty()){
                           core.tip.show('请输入姓名!');
                           return;
                       }
                       if(!$('#mobile').isMobile()){
                           core.tip.show('请输入正确手机号码!');
                           return;
                       }
                       if( $('#weixin').isEmpty()){
                           core.tip.show('请输入微信号!');
                           return;
                       }
					   if( $('#productname').isEmpty()){
                           core.tip.show('请输入产品名!');
                           return;
                       }
                  
                   $(this).html('正在处理...').attr('saving',1);
                    core.pjson('supplier/af_supplier', {
                       'memberdata':{
                            'realname': $('#realname').val(),
                            'mobile': $('#mobile').val(),
                            'weixin': $('#weixin').val(),
							'productname': $('#productname').val()
                        }
                    }, function(json) {
                       
                        if(json.status==1){
                             core.tip.show('提交申请成功');
                             <?php  if(!empty($_GPC['returnurl'])) { ?>
                                 location.href="<?php  echo urldecode($_GPC['returnurl'])?>";
                             <?php  } else { ?>
                                 location.href="<?php  echo $this->createMobileUrl('member')?>";
                             <?php  } ?>
                        }
                        else{
                            $('.info_sub').html('确认').removeAttr('saving');
                            core.tip.show('提交申请失败!');
                        }
                    },true,true);
                })
            }
        });

    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>