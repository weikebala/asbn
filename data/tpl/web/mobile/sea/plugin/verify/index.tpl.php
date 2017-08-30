<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form id="dataform" action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                核销设置
            </div>
            <div class="panel-body">
                    <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">核销关键词</label>
                       <div class="col-sm-9 col-xs-12">
                           <input type="text" name="data[verifykeyword]" class="form-control" value="<?php  echo $set['verifykeyword'];?>" />
                           <span class='help-block'>店员核销使用，如果不填写默认为核销，使用方法: 回复关键词后系统会提示输入消费码</span>
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
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
