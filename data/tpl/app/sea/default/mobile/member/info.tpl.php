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
	.info_main .line1 {width:100%; height:80px; color:#666; font-size:13px;}
	.info_main .pic { border-top:1px solid #e9e9e9;width:97%;height:40px;color:#999;padding:3px;line-height:35px;font-size:13px;padding-left:10px;}
    .info_main .pic span {float:left;width:150px;}
    .info_main .pic .plus { float:right;width:30px;height:30px;border:1px solid #e9e9e9; color:#dedede;; font-size:18px;line-height:30px;text-align:center;}
    .info_main .pic .plus i { left:7px;top:7px;}
    .info_main .pic .images {float: right; width:auto;height:30px;}
    .info_main .pic .images .img { float:left; position:relative;width:30px;height:30px;border:1px solid #e9e9e9;margin-right:5px;}
    .info_main .pic .images .img img { position:absolute;top:0; width:100%;height:100%;}
    .info_main .pic .images .img .minus { position:absolute;color:red;width:8px;height:12px;top:-15px;right:-1px;}
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
<link href="../addons/sea/template/mobile/default/static/js/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="../addons/sea/template/mobile/default/static/js/star-rating.js" type="text/javascript"></script>
<script src="../addons/sea/static/js/dist/ajaxfileupload.js" type="text/javascript"></script>
<div id="container"></div>
<script id="member_info" type="text/html">
    <div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title">我的资料</div>
</div>
    <div class="info_main"  data-ogid='0'>
        <%if mobile%>
        <div class="line"><div class="title">手机号码</div><div class='info'><div class='inner'><%mobile%></div></div></div>
        <input type="hidden" id='mobile' value="<%mobile%>" />
        <%else%>
        <div class="line"><div class="title">手机号码</div><div class='info'><div class='inner'><input type="text" id='mobile' placeholder="请输入您的手机号码"  value="<%mobile%>" /></div></div></div>
        <%/if%>
		
		<%if sfz%>
        <div class="line"><div class="title">身份证号码</div><div class='info'><div class='inner'><%sfz%></div></div></div>
        <input type="hidden" id='sfz' value="<%sfz%>" />
        <%else%>
        <div class="line"><div class="title">身份证号码</div><div class='info'><div class='inner'><input type="text" id='sfz' placeholder="请输入身份证号码"  value="<%sfz%>" /></div></div></div>
        <%/if%>
		<%if realname%>
        <div class="line"><div class="title">真实姓名</div><div class='info'><div class='inner'><%realname%></div></div></div>
        <input type="hidden" id='realname' value="<%realname%>" />
        <%else%>
        <div class="line"><div class="title">真实姓名</div><div class='info'><div class='inner'><input type="text" id='realname' placeholder="请输入身份证号"  value="<%realname%>" /></div></div></div>
        <%/if%>
		<%if alipayuser%>
        <div class="line"><div class="title">支付宝账号</div><div class='info'><div class='inner'><%alipayuser%></div></div></div>
        <input type="hidden" id='alipayuser' value="<%alipayuser%>" />
        <%else%>
        <div class="line"><div class="title">支付宝账号</div><div class='info'><div class='inner'><input type="text" id='alipayuser' placeholder="请输入支付宝账号"  value="<%alipayuser%>" /></div></div></div>
        <%/if%>
		
        <div class="line"><div class="title">微信号</div><div class='info'><div class='inner'><input type="text"  id='weixin' placeholder="请输入微信号" value="<%weixin%>"/></div></div></div>
        <div class="line">
            <div class="title">性别</div><div class='info'><div class='inner'>
            <span class="gender" data-val="1"><i class="fa <%if gender=='1'%>fa-check-circle-o<%else%>fa-circle-o<%/if%>" <%if gender=='1'%>style="color:#0C9;"<%/if%>></i> 男</span>&nbsp;&nbsp;
            <span class="gender" data-val="2"><i class="fa <%if gender=='2'%>fa-check-circle-o<%else%>fa-circle-o<%/if%>" <%if gender=='2'%>style="color:#0C9;"<%/if%>></i> 女
                <input type="hidden" id="gender" value="<%sex%>" />
                </div></div>
        </div>
        <div class="line">
            <div class="title">所在城市</div><div class='info'><div class='inner'>
            <select id="sel-provance" onChange="selectCity();" class="select">
                <option value="" selected="true">省/直辖市</option>
            </select>
            <select id="sel-city" onChange="selectcounty()" class="select">
                <option value="" selected="true">请选择</option>
            </select>
            <select id="sel-area" class="select" style="display:none">
                <option value="" selected="true">请选择</option>
            </select></div></div>
        </div>
        <div class="line"  style="border:0px;"><div class="title">生日</div><div class='info'><div class='inner'><input type="text" id="birthday" placeholder="点击选择日期" readonly value='<%birthday%>'/></div></div></div>
        <%if sfzimages%>
			<div class="pic">身份证已上传
			 <input type="hidden" id='sfzimages' value="<%sfzimages%>" />
			</div>
		<%else%>
		 <div class="line1"> 
                    <div class="pic">
                        上传身份证正反面
                        <div class="plus" style="position:relative"><i class="fa fa-plus" style="position:absolute;"></i>
                            <input type="file" name='imgFile0' id='imgFile0' style="position:absolute;width:30px;height:30px;-webkit-tap-highlight-color: transparent;right:0;filter:alpha(Opacity=0); opacity: 0;" /></div>
                        <div class="images"></div>
                    </div>
                </div> 
		<%/if%>
    </div>
    <div class="info_sub">确认修改</div>
</script>
<script id="tpl_img" type="text/html">
    <div class='img' data-img='<%filename%>'>
       <img src='<%url%>' />
       <div class='minus'><i class='fa fa-minus-circle'></i></div>
   </div>
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
				
				   $('.plus input').change(function() {
						
						core.loading('正在上传');
						var comment =$(this).closest('.info_main');
						var ogid =0;
						$.ajaxFileUpload({
							url: core.getUrl('util/uploader'),
							data: {file: "imgFile" + ogid},
							secureuri: false, 
							fileElementId: 'imgFile'+ ogid, 
							dataType: 'json', 
							success: function(res, status) {
								core.removeLoading();
								var obj = $(tpl('tpl_img', res));
						
								$('.images',comment).append(obj);
								$('.minus',comment).click(function() {
								 
									core.json('util/uploader', {op: 'remove', file: $(obj).data('img')}, function(rjson) {
										if (rjson.status == 1) {
											$(obj).remove();
										}
										$('.plus',comment).show();
									}, false, true);
								});

								if ($('.img',comment).length >= 5) {
									$('.plus',comment).hide();
								}
							}, error: function(data, status, e) {
								core.removeLoading();
								core.tip.show('上传失败!');
							}
						});
					});

                $("#birthday").scroller('destroy').scroller($.extend(opt['date'], opt['default']));
                cascdeInit(data.province,data.city,data.dist);
                $('.gender').click(function() {
                    var $this = $(this);
                    var val = $this.data('val');
                    $('.gender').find('i').css('color', '#999').removeClass('fa-check-circle-o').addClass('fa-circle-o');
                    $(this).find('i').removeClass('fa-circle-o').addClass('fa-check-circle-o').css('color', '#0c9');
                    $('#gender').val(val);
                })
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
				   if($('#sfz').isEmpty()){
					   core.tip.show('请输入身份证!');
					   return;
				   }
				   if($('#alipayuser').isEmpty()){
					   core.tip.show('请输入支付宝账号!');
					   return;
				   }
				   
				  if( $('#weixin').isEmpty()){
					   core.tip.show('请输入微信号!');
					   return;
				   }
			  
                   $(this).html('正在处理...').attr('saving',1);
					var c0 = $('.info_main[data-ogid=0]');
					var cimages ='';
					c0.find(".img").each(function(){
					   cimages+=($(this).data('img'))+',';
					});
					if(cimages){
						var sfzimages=cimages.substring(0,cimages.length-1);
					}else{
						var sfzimages=$('#sfzimages').val();
					}
					
                   var birthday = $('#birthday').val().split('-');
                    core.json('member/info', {
                       'memberdata':{
                            'realname': $('#realname').val(),
                            'alipayuser': $('#alipayuser').val(),
                            'sfz': $('#sfz').val(),
                            'sfzimages':sfzimages,
                            'mobile': $('#mobile').val(),
                            'weixin': $('#weixin').val(),
                            'gender': $('#sex').val(),
                            'birthyear': $('#birthday').val().length>0?birthday[0]:0,
                            'birthmonth': $('#birthday').val().length>0?birthday[1]:0,
                            'birthday': $('#birthday').val().length>0?birthday[2]:0,
                            'province': $('#sel-provance').val(),
                            'city': $('#sel-city').val()
                       }, 'mcdata':{
                            'realname': $('#realname').val(),
                            'alipayuser': $('#alipayuser').val(),
                            'sfz': $('#sfz').val(),
                            'mobile': $('#mobile').val(),
                            'gender': $('#sex').val(),
                            'birthyear': $('#birthday').val().length>0?birthday[0]:0,
                            'birthmonth': $('#birthday').val().length>0?birthday[1]:0,
                            'birthday': $('#birthday').val().length>0?birthday[2]:0,
                            'resideprovince': $('#sel-provance').val(),
                            'residecity': $('#sel-city').val()
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
                            $('.info_sub').html('确认修改').removeAttr('saving');
                            core.tip.show('保存失败!');
                        }

                    },true,true);
                })
            }
        });

    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
