<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="follow" />
        <div class="panel panel-default">
            
              <div class='panel-heading'>
                关注设置
            </div>
            
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">关注引导页</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.follow')) { ?>
                        <input type="text" name="share[followurl]" class="form-control" value="<?php  echo $set['share']['followurl'];?>" />
                        <span class='help-block'>用户未关注的引导页面，建议使用短链接：<a target="_blank" href="http://www.dwz.cn">短网址</a>
                            <?php  } else { ?>
                            <input type="hidden" name="share[followurl]" value="<?php  echo $set['share']['followurl'];?>" />
                            <div class='form-control-static'><?php  echo $set['share']['followurl'];?></div>
                            <?php  } ?>
                    </div>
                </div>
            </div>
            <div class='panel-heading'>
                分享设置
            </div>
            <div class='panel-body'> 
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享标题</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.follow')) { ?>
                        <input type="text" name="share[title]" class="form-control" value="<?php  echo $set['share']['title'];?>" />
                        <span class="help-block">不填写默认商城名称</span>
                        <?php  } else { ?>
                        <input type="hidden" name="share[title]" value="<?php  echo $set['share']['title'];?>" />
                        <div class='form-control-static'><?php  echo $set['share']['title'];?></div>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享图标</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.follow')) { ?>

                        <?php  echo tpl_form_field_image('share[icon]', $set['share']['icon']);?>
                        <span class="help-block">不选择默认商城LOGO</span>
                        <?php  } else { ?>
                        <input type="hidden" name="share[icon]" value="<?php  echo $set['share']['icon'];?>" />
                        <?php  if(!empty($set['share']['icon'])) { ?>
                        <a href='<?php  echo tomedia($set['share']['icon'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($set['share']['icon'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.follow')) { ?>
                        <textarea style="height:100px;" name="share[desc]" class="form-control" cols="60"><?php  echo $set['share']['desc'];?></textarea>
                        <?php  } else { ?>
                        <textarea style="height:100px;display: none" name="share[desc]" class="form-control" cols="60"><?php  echo $set['share']['desc'];?></textarea>
                        <div class='form-control-static'><?php  echo $set['share']['desc'];?></div>
                        <?php  } ?>
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享连接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.follow')) { ?>
                        <input type="text" name="share[url]" class="form-control" value="<?php  echo $set['share']['url'];?>" />
                        <span class='help-block'>用户分享出去的连接，默认为首页</span>
                        <?php  } else { ?>
                        <input type="hidden" name="share[url]" value="<?php  echo $set['share']['url'];?>" />
                        <div class='form-control-static'><?php  echo $set['share']['url'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                       <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.follow')) { ?>
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