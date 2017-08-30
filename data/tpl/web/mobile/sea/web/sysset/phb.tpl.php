<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<!--/wwwroot/addons/sea/template/web/sysset/-->
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="phb" />
    <div class='panel panel-default'>
           <div class='panel-heading'>
            排行榜设置
        </div>

        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">开启排行榜</label>
                <div class="col-sm-4 col-xs-6">
                    <label class="radio-inline"><input type="radio"  name="phb[switch]" value="0" <?php  if($set['phb']['switch']==0) { ?>checked<?php  } ?> /> 关闭</label>
                    <label class="radio-inline"><input type="radio"  name="phb[switch]" value="1" <?php  if($set['phb']['switch']==1) { ?>checked<?php  } ?> /> 开启</label>
                    <span class='help-block'>选择开启则在会员中心显示排行榜选项</span>
                    <span class='help-block'>排行榜总开关开启并且以下三个排行榜最少开启一个才会在会员中心显示排行榜选项</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">排行榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['phbname'];?>" name="phb[phbname]">
                    <span class='help-block'>自定义会员中心显示的排行榜名称，前台最多显示18个中文字符</span>
                </div>

            </div>
        </div>

        <div class='panel-heading'>
            积分排行榜
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分排行榜</label>
                <div class="col-sm-4 col-xs-6">
                     <label class="radio-inline"><input type="radio"  name="phb[isintegral]" value="0"  <?php  if($set['phb']['isintegral']==0) { ?>checked<?php  } ?>/> 关闭</label>
                    <label class="radio-inline"><input type="radio"   name="phb[isintegral]" value="1"  <?php  if($set['phb']['isintegral']==1) { ?>checked<?php  } ?>/> 开启</label>
                    <span class='help-block'>在排行榜中显示积分排行榜</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['integralname'];?>" name="phb[integralname]">
                    <span class='help-block'>自定义积分排行榜名称，前台最多显示8个中文字符</span>
                </div>
            </div>
        </div>

        <div class='panel-heading'>
            消费排行榜
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费排行榜</label>
                <div class="col-sm-4 col-xs-6">
                     <label class="radio-inline"><input type="radio"  name="phb[isexpense]" value="0"  <?php  if($set['phb']['isexpense']==0) { ?>checked<?php  } ?>/> 关闭</label>
                    <label class="radio-inline"><input type="radio"   name="phb[isexpense]" value="1"  <?php  if($set['phb']['isexpense']==1) { ?>checked<?php  } ?>/> 开启</label>
                    <span class='help-block'>在排行榜中显示消费排行榜</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['expensename'];?>" name="phb[expensename]">
                    <span class='help-block'>自定义消费排行榜名称，前台最多显示8个中文字符</span>
                </div>
            </div>
        </div>
        <div class='panel-heading'>
            佣金排行榜
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">佣金排行榜</label>
                <div class="col-sm-4 col-xs-6">
                     <label class="radio-inline"><input type="radio"  name="phb[iscommission]" value="0"  <?php  if($set['phb']['iscommission']==0) { ?>checked<?php  } ?>/> 关闭</label>
                    <label class="radio-inline"><input type="radio"   name="phb[iscommission]" value="1"  <?php  if($set['phb']['iscommission']==1) { ?>checked<?php  } ?> /> 开启</label>
                    <span class='help-block'>在排行榜中显示佣金排行榜</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">佣金榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['commissionname'];?>" name="phb[commissionname]">
                    <span class='help-block'>自定义佣金排行榜名称，前台最多显示8个中文字符</span>
                </div>
            </div>
        </div>
        
        <div class='panel-heading'>
            粉丝排行榜
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">粉丝排行榜</label>
                <div class="col-sm-4 col-xs-6">
                     <label class="radio-inline"><input type="radio"  name="phb[isfans]" value="0"  <?php  if($set['phb']['isfans']==0) { ?>checked<?php  } ?>/> 关闭</label>
                    <label class="radio-inline"><input type="radio"   name="phb[isfans]" value="1"  <?php  if($set['phb']['isfans']==1) { ?>checked<?php  } ?> /> 开启</label>
                    <span class='help-block'>在排行榜中显示粉丝排行榜</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">粉丝榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['fansname'];?>" name="phb[fansname]">
                    <span class='help-block'>自定义粉丝排行榜名称，前台最多显示8个中文字符</span>
                </div>
            </div>
        </div>
        
        <div class='panel-heading'>
            销售排行榜
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">销售排行榜</label>
                <div class="col-sm-4 col-xs-6">
                     <label class="radio-inline"><input type="radio"  name="phb[issales]" value="0"  <?php  if($set['phb']['issales']==0) { ?>checked<?php  } ?>/> 关闭</label>
                    <label class="radio-inline"><input type="radio"   name="phb[issales]" value="1"  <?php  if($set['phb']['issales']==1) { ?>checked<?php  } ?> /> 开启</label>
                    <span class='help-block'>在排行榜中显示销售排行榜</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">销售榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['salesname'];?>" name="phb[salesname]">
                    <span class='help-block'>自定义销售排行榜名称，前台最多显示8个中文字符</span>
                </div>
            </div>
        </div>
        
        <div class='panel-heading'>
            推广排行榜
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">推广排行榜</label>
                <div class="col-sm-4 col-xs-6">
                     <label class="radio-inline"><input type="radio"  name="phb[istuiguang]" value="0"  <?php  if($set['phb']['istuiguang']==0) { ?>checked<?php  } ?>/> 关闭</label>
                    <label class="radio-inline"><input type="radio"   name="phb[istuiguang]" value="1"  <?php  if($set['phb']['istuiguang']==1) { ?>checked<?php  } ?> /> 开启</label>
                    <span class='help-block'>在排行榜中显示推广排行榜</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">推广榜名称</label>
                <div class="col-sm-9 col-xs-12">
                    <input class="form-control" type="text" value="<?php  echo $set['phb']['tuiguangname'];?>" name="phb[tuiguangname]">
                    <span class='help-block'>自定义推广排行榜名称，前台最多显示8个中文字符</span>
                </div>
            </div>
        </div>    
        
        <div class="form-group"></div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick='return formcheck()' />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
        </div>
    
    </div>
</form> 
</div>
<script language='javascript'>
        require(['bootstrap'], function ($) {
            $('.btn,.tip').each(function(){
                
                if( $(this).closest('td').css('position')=='relative'){
                    return true;
                }
                $(this).hover(function () {
                    $(this).tooltip('show');
                }, function () {
                    $(this).tooltip('hide');
                });
            })
            
        });
                   $('.js-clip').each(function(){
            util.clip(this, $(this).attr('data-url'));
        });
</script>
<script type="text/javascript">
    require(['bootstrap']);
        function check_sz_yi_upgrade() {
  
        require(['util'], function (util) {
            if (util.cookie.get('checkeweishopupgrade_sys')) {
                return;
            }
            $.post('http://fx5.iseasoft.cn/web/index.php?c=site&a=entry&p=upgrade&op=check&do=sysset&m=sz_yi', function (ret) {
          
                ret = eval("(" + ret + ")");
                
                if (ret && ret.result == '1') { 
                    if(ret.filecount>0){
                        var html = '<div id="ewei-shop-upgrade-tips" class="upgrade-tips" style="top:50px;left:0;position:fixed"><a href="http://fx5.iseasoft.cn/web/index.php?c=site&a=entry&p=upgrade&do=sysset&m=sz_yi">海软全网加盟检测到新版本 ' + ret.version;
                        html+=',请尽快更新！</a><span class="tips-close" style="background:#ff6600;" onclick="check_sz_yi_upgrade_hide();"><i class="fa fa-times-circle"></i></span></div>';
                        $('body').prepend(html);
                   }
                }
            });
        });
    }

    function check_sz_yi_upgrade_hide() {
        require(['util'], function (util) {
            util.cookie.set('checkeweishopupgrade_sys', 1, 3600);
            $('#ewei-shop-upgrade-tips').hide();
        });
    }
    $(function () {
        check_sz_yi_upgrade();
    });
    </script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     
