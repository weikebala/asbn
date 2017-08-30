<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="contact" />
        <div class="panel panel-default">
            <div class='panel-body'>  
      
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">客服电话</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.contact')) { ?>
                        <input type="text" name="shop[phone]" class="form-control" value="<?php  echo $set['shop']['phone'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="shop[phone]" value="<?php  echo $set['shop']['phone'];?>" />
                        <div class='form-control-static'><?php  echo $set['shop']['phone'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所在地址</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.contact')) { ?>
                        <input type="text" name="shop[address]" class="form-control" value="<?php  echo $set['shop']['address'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="shop[address]" value="<?php  echo $set['shop']['address'];?>" />
                        <div class='form-control-static'><?php  echo $set['shop']['address'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城简介</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.contact')) { ?>
                        <textarea name="shop[description]" class="form-control richtext" cols="70"><?php  echo $set['shop']['description'];?></textarea>
                        <?php  } else { ?>
                        <textarea name="shop[description]" class="form-control richtext" cols="70" style="display:none"><?php  echo $set['shop']['description'];?></textarea>
                        <div class='form-control-static'><?php  echo $set['shop']['description'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                       <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.contact')) { ?>
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