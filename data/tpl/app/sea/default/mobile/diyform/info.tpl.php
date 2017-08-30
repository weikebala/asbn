<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>会员资料</title>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/formcss', TEMPLATE_INCLUDEPATH)) : (include template('diyform/formcss', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    body {margin:0px;width:100%; background:#efefef; font-family:微软雅黑; -moz-appearance:none;}
    .info_sub {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .select { border:1px solid #ccc;height:25px;}
    .diyform_main .dline {margin:0 10px;height:45px;  line-height:45px; color:#666; border-bottom:1px solid #e8e8e8; }
    .diyform_main .dline .dtitle {height:45px; width:90px; line-height:45px; color:#444; float:left; font-size:14px; text-align: left; }
    .diyform_main .dline1 { height: auto;overflow:hidden;}
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

   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/formfields', TEMPLATE_INCLUDEPATH)) : (include template('diyform/formfields', TEMPLATE_INCLUDEPATH));?>
 
    <div class="info_sub">确认修改</div>
	<div style="height:20px">&nbsp;</div>
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

                <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/common_js', TEMPLATE_INCLUDEPATH)) : (include template('diyform/common_js', TEMPLATE_INCLUDEPATH));?>

                $('.info_sub').click(function() {

                    if($(this).attr('saving')=='1')
                    {
                        return;
                    }

                    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/common_js_data', TEMPLATE_INCLUDEPATH)) : (include template('diyform/common_js_data', TEMPLATE_INCLUDEPATH));?>

                    $(this).html('正在处理...').attr('saving',1);

                    core.json('member/info', {
                       'memberdata':diydata
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