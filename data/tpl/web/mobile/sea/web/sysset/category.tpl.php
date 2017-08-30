<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="category" />
        <div class="panel panel-default">
            <div class='panel-body'>  
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类级别</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.category')) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="shop[catlevel]" value="2" <?php  if($set['shop']['catlevel']==2 || empty($set['shop']['catlevel'])) { ?>checked<?php  } ?> /> 二级
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="shop[catlevel]" value="3" <?php  if($set['shop']['catlevel']==3) { ?>checked<?php  } ?>/> 三级
                        </label>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[catlevel]" value="<?php  echo $set['shop']['catlevel'];?>" />
                        <div class='form-control-static'><?php  if($set['shop']['catlevel']==2 || empty($set['shop']['catlevel'])) { ?>二级<?php  } else { ?>三级<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">三级分类显示形式</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.category')) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="shop[catshow]" value="0" <?php  if(empty($set['shop']['catshow'])) { ?>checked<?php  } ?> /> 单页
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="shop[catshow]" value="1" <?php  if($set['shop']['catshow']==1) { ?>checked<?php  } ?>/> 多页
                        </label>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[catshow]" value="<?php  echo $set['shop']['catshow'];?>" />
                        <div class='form-control-static'><?php  if(empty($set['shop']['catshow'])) { ?>单页<?php  } else { ?>多页<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">推荐分类广告</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.category')) { ?>
                        <?php  echo tpl_form_field_image('shop[catadvimg]', $set['shop']['catadvimg'])?>
                        <span class='help-block'>分类页面中，推荐分类的广告图，建议尺寸640*320</span>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[catadvimg]" value="<?php  echo $set['shop']['catadvimg'];?>" />
                        <?php  if(!empty($set['shop']['catadvimg'])) { ?>
                        <a href='<?php  echo tomedia($set['shop']['catadvimg'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($set['shop']['catadvimg'])?>" style='width:200px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">推荐分类广告连接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.category')) { ?>
                        <input type="text" name="shop[catadvurl]" class="form-control" value="<?php  echo $set['shop']['catadvurl'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="shop[catadvurl]" value="<?php  echo $set['shop']['catadvurl'];?>" />
                        <div class='form-control-static'><?php  echo $set['shop']['catadvurl'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                   <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.category')) { ?>
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