<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="sms" />
        <div class="panel panel-default">
            <div class='panel-body'>  

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信设置</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  
                        if(!$set['sms']['type'])
                        { 
                            $set['sms']['type'] = 1;
                        }
                        ?>
                        <?php if(cv('sysset.save.sms')) { ?>
                        <label class='radio-inline sms_type' type="1"><input type='radio' name='sms[type]' value='1' <?php  if($set['sms']['type']==1) { ?>checked<?php  } ?>/> 互亿无线</label>
                        <label class='radio-inline sms_type' type="2"><input type='radio' name='sms[type]' value='2' <?php  if($set['sms']['type']==2) { ?>checked<?php  } ?> /> 阿里大鱼</label>
                        <?php  } else { ?>
                        <input type="hidden" name="sms[type]" value="<?php  echo $set['sms']['type'];?>" />
                        <div class='form-control-static'> <?php  if($set['sms']['type']==1) { ?>互亿无线<?php  } else { ?>阿里大鱼<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div id="sms1" <?php  if($set['sms']['type']==2) { ?> class="hide"<?php  } ?>>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信账号</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[account]" class="form-control" value="<?php  echo $set['sms']['account'];?>" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[account]" value="<?php  echo $set['sms']['account'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['account'];?></div>
                            <?php  } ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信密码</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[password]" class="form-control" value="<?php  echo $set['sms']['password'];?>" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[password]" value="<?php  echo $set['sms']['password'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['password'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>

                <div id="sms2"  <?php  if($set['sms']['type']==1) { ?> class="hide"<?php  } ?>>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                        <div class="col-sm-9 col-xs-12 alert alert-info">
                            请到 <a href='http://www.alidayu.com/' taget="_blank">阿里大鱼</a> 去申请开通,短信模板中必须包含code和product,请参考默认用户注册验证码设置。
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppKey:</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[appkey]" class="form-control" value="<?php  echo $set['sms']['appkey'];?>" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[appkey]" value="<?php  echo $set['sms']['appkey'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['appkey'];?></div>
                            <?php  } ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">secret:</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[secret]" class="form-control" value="<?php  echo $set['sms']['secret'];?>" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[secret]" value="<?php  echo $set['sms']['secret'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['secret'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信签名:</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[signname]" class="form-control" value="<?php  echo $set['sms']['signname'];?>" placeholder="注册验证" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[signname]" value="<?php  echo $set['sms']['signname'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['signname'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册短信模板ID:</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[templateCode]" class="form-control" value="<?php  echo $set['sms']['templateCode'];?>"  placeholder="SMS_5057806" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[templateCode]" value="<?php  echo $set['sms']['templateCode'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['templateCode'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">找回密码短信模板ID:</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[templateCodeForget]" class="form-control" value="<?php  echo $set['sms']['templateCodeForget'];?>"  placeholder="SMS_5057806" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[templateCodeForget]" value="<?php  echo $set['sms']['templateCodeForget'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['templateCodeForget'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">product变量:</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if(cv('sysset.save.sms')) { ?>
                            <input type="text" name="sms[product]" class="form-control" value="<?php  echo $set['sms']['product'];?>" placeholder="此值将会出现在短信模板中product处" />
                            <?php  } else { ?>
                            <input type="hidden" name="sms[product]" value="<?php  echo $set['sms']['product'];?>"/>
                            <div class='form-control-static'><?php  echo $set['sms']['product'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <!--
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">用于测试短信接口的手机号</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.sms')) { ?>
                        <input type="text" name="sms[password]" class="form-control" value="<?php  echo $set['sms']['password'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="sms[password]" value="<?php  echo $set['sms']['password'];?>"/>
                        <div class='form-control-static'><?php  echo $set['sms']['password'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                -->
              <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.sms')) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                          <?php  } ?>
                     </div>
            </div>
                       
            </div>
        </div>     
    </form>
</div>
<script>
$(function(){
    $('.sms_type').click(function(){
        var type = $(this).attr('type');
        $('#sms1').hide();
        $('#sms2').hide();
        $('#sms'+type).removeClass('hide').show();
    });
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     
