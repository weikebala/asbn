<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>会员资料</title>
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    .info_main {height:auto;  background:#fff; margin-top:14px; border-bottom:1px solid #e8e8e8; border-top:1px solid #e8e8e8;}
    .info_main .line {margin:0 10px; height:40px; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
    .info_main .line .title {height:40px; width:80px; line-height:40px; color:#444; float:left; font-size:16px;}
    .info_main .line .info { width:100%;float:right;margin-left:-80px; }
    .info_main .line .inner { margin-left:80px; }
    .info_main .line .inner input {height:40px; width:100%;display:block; padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
    .info_main .line .inner .user_sex {line-height:40px;}
    .info_sub {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
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
<div id="container"></div>
<script id="member_info" type="text/html">
    <div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title">成为捕手</div>
</div>
    <div class="info_main">
		
        <div class="line"><div class="title">推荐人ID</div><div class='info'><div class='inner'><input type="text"  id='tjid' placeholder="请输入推荐人ID" value=""/></div></div></div>
		<p style="font-size:14px;color:#666;width:96%;margin-left:2%">温馨提示:【如果您通过您好友了解到商城，请在推荐人栏输入朋友的ID；如果通过媒体或其他渠道了解到平台的，请输入"0"】</p>
      
    </div>
    <div class="info_sub">确认</div>
</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        core.json('member/info',{},function(json){
            if (json.result.member) {
 
                var data = json.result.member;
 
                $('#container').html(tpl('member_info', data));

                var currYear = (new Date()).getFullYear();
                var opt = {};
                opt.date = {preset: 'date'};
                opt.datetime = {preset: 'datetime'};
                opt.time = {preset: 'time'};
                opt.default = {
                    theme: 'android-ics light', 
                    display: 'modal',
                    mode: 'scroller',
                    lang: 'zh',
                    startYear: currYear - 100,
                    endYear: currYear 
                };

               
                $('.info_sub').click(function() {
                    if($(this).attr('saving')=='1')
                    {
                        return;
                    }
				   
				  if( $('#tjid').isEmpty()){
					   core.tip.show('请输入推荐人ID!');
					   return;
				   }
				   var tjid=$('#tjid').val()
                   $(this).html('正在处理...').attr('saving',1);
                    core.json('member/bs', {
                       'memberdata':{
                            'agentid': $('#tjid').val() 
                       }, 'mcdata':{
                            'agentid': $('#tjid').val()
                       }
                    }, function(json) {
                       
                        if(json.status==1){
                             core.tip.show('保存成功');
                             <?php  if(!empty($_GPC['returnurl'])) { ?>
                                 location.href="<?php  echo urldecode($_GPC['returnurl'])?>";
                             <?php  } else { ?>
                                 location.href="<?php  echo $this->createMobileUrl('member')?>";
                             <?php  } ?>
                        }
                        else{
                            $('.info_sub').html('确认').removeAttr('saving');
                            core.tip.show('保存失败!');
                        }

                    },true,true);
                })
            }
        });

    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footers', TEMPLATE_INCLUDEPATH)) : (include template('common/footers', TEMPLATE_INCLUDEPATH));?>
