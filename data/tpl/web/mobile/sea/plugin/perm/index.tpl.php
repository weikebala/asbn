<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<div class='alert alert-danger'>
	此功能仅超级管理员可见
</div>

<div class="main">
    <form id="dataform" action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                分权设置
            </div>
            <div class="panel-body">
                    <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">插件分权</label>
                       <div class="col-sm-9 col-xs-12">
                           <label class='radio-inline'>
                               <input type='radio' value="0" name='data[type]' <?php  if(empty($set['type'])) { ?>checked<?php  } ?> /> 关闭
                           </label>
                           <label class='radio-inline'>
                               <input type='radio' value="1" name='data[type]' <?php  if($set['type']==1) { ?>checked<?php  } ?> /> 开启
                           </label>
                           <span class='help-block'>开启后除超级管理员的公众号外，其他公众号均进行插件使用权限检测</span>
                       </div>
                   </div>
                   <div class="form-group">
                           <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                           <div class="col-sm-9 col-xs-12">
                                 <input type="submit" name="submit"  value="保存设置" class="btn btn-primary"/>
                                 <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                           </div>
                    </div>
            </div>
        </div>
    </form>  

	<form id="dataform" action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                清除缓存
            </div>
            <div class="panel-body">
                    <div class="form-group">
             
                           <span class='help-block'>清除二维码错误、分享页面图片</span>
                       </div>
                   </div>
                   <div class="form-group">
                           <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                           <div class="col-sm-9 col-xs-12">
                                 <input type="submit" name="submit"  value="清除缓存" class="btn btn-primary"/>
                                 <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                 <input type="hidden" name="ishc" value="1" />
                           </div>
                    </div>
            </div>
        </div>
    </form>
	
	
	
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
