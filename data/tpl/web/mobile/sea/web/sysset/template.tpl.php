<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="template" />
        <div class="panel panel-default">
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">MOBILE-模板选择</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.template')) { ?>
                        <select class='form-control' name='shop[style]'>
                            <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                            <option value='<?php  echo $style;?>' <?php  if($style==$set['shop']['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                            <?php  } } ?>
                        </select>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[style]" value="<?php  echo $set['shop']['style'];?>"/>
                        <div class='form-control-static'>
                            <?php  if(empty($set['shop']['style'])) { ?>default<?php  } else { ?><?php  echo $set['shop']['style'];?><?php  } ?>
                        </div>
                        <?php  } ?>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">主题选择</label>
                    <div class="col-sm-9 col-xs-12">
                        <select class='form-control' name='shop[theme]'>
                            <option value='style' <?php  if('style'==$set['shop']['theme']) { ?>selected<?php  } ?>>默认主题</option>
                            <option value='style_red' <?php  if('style_red'==$set['shop']['theme']) { ?>selected<?php  } ?>>红黑主题</option>
                        </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">PC-模板选择</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.template')) { ?>
                        <select class='form-control' name='shop[pstyle]'>
                            <?php  if(is_array($styles2)) { foreach($styles2 as $style) { ?>
                            <option value='<?php  echo $style;?>' <?php  if($style==$set['shop']['pstyle']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                            <?php  } } ?>
                        </select>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[pstyle]" value="<?php  echo $set['shop']['pstyle'];?>"/>
                        <div class='form-control-static'>
                            <?php  if(empty($set['shop']['pstyle'])) { ?>default<?php  } else { ?><?php  echo $set['shop']['pstyle'];?><?php  } ?>
                        </div>
                        <?php  } ?>
                    </div>
                </div> 

                       <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.template')) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                          <?php  } ?>
                     </div>
            </div>
                       
            </div>

        </div>     
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     
