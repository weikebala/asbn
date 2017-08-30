<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="member" />
        <div class="panel panel-default">
            <div class='panel-body'>  
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">默认会员级别名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.member')) { ?>
                        <input type="text" name="shop[levelname]" class="form-control" value="<?php echo empty($set['shop']['levelname'])?'普通会员':$set['shop']['levelname']?>"  />
                        <span class="help-block">会员默认等级名称，不填写默认“普通会员”</span>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[levelname]" value="<?php  echo $set['shop']['levelname'];?>" />
                        <div class='form-control-static'><?php echo empty($set['shop']['levelname'])?'普通会员':$set['shop']['levelname']?></div>
                        <?php  } ?>
                    </div>
                </div>
	
				
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员等级说明连接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.member')) { ?>
                        <input type="text" name="shop[levelurl]" class="form-control" value="<?php  echo $set['shop']['levelurl'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="shop[levelurl]" value="<?php  echo $set['shop']['levelurl'];?>" />
                        <div class='form-control-static'><?php  echo $set['shop']['levelurl'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员等级升级依据</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.member')) { ?>
                        <label class="radio radio-inline">
                              <input type="radio" name="shop[leveltype]" value="0" <?php  if(empty($set['shop']['leveltype'])) { ?>checked<?php  } ?>/> 已完成的订单金额
                        </label>
                       <label class="radio radio-inline">
                              <input type="radio" name="shop[leveltype]" value="1" <?php  if($set['shop']['leveltype']==1) { ?>checked<?php  } ?>/> 已完成的订单数量
                        </label>
                        <span class="help-block">默认为完成订单金额</span> 
                        <?php  } else { ?>
                        <input type="hidden" name="shop[leveltype]" value="<?php  echo $set['shop']['leveltype'];?>" />
                        <div class='form-control-static'>
							<?php  if(empty($set['shop']['leveltype'])) { ?>
							 已完成的订单金额
							 <?php  } else if($set['shop']['leveltype']==1) { ?>
							 已完成的订单数量
							 <?php  } ?>
						</div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">强制绑定手机</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.member')) { ?>
                        <label class="radio radio-inline">
                              <input type="radio" name="shop[isbindmobile]" value="0" <?php  if(empty($set['shop']['isbindmobile'])) { ?>checked<?php  } ?>/> 否
                        </label>
                       <label class="radio radio-inline">
                              <input type="radio" name="shop[isbindmobile]" value="1" <?php  if($set['shop']['isbindmobile']==1) { ?>checked<?php  } ?>/> 是
                        </label>
                        <span class="help-block">进入商城是否强制绑定手机号</span> 
                        <?php  } ?>
                    </div>
                </div>
                       <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.member')) { ?>
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
