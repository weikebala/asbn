<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<!--/wwwroot/addons/sea/template/web/sysset/-->
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="pay" />
        <div class="panel panel-default"> 
            <div class='panel-body'>

                <div class='alert alert-info'>
                    在开启以下支付方式前，请到 <a href='<?php  echo url('profile/payment')?>'>支付选项</a> 去设置好参数。
                </div>

                <div class="form-group">

                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">微信支付</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.pay')) { ?>
                        <label class='radio-inline'><input type='radio' name='pay[weixin]' value='1' <?php  if($set['pay']['weixin']==1) { ?>checked<?php  } ?>/> 开启</label>
                        <label class='radio-inline'><input type='radio' name='pay[weixin]' value='0' <?php  if($set['pay']['weixin']==0) { ?>checked<?php  } ?> /> 关闭</label>
                        <?php  } else { ?>
                        <input type="hidden" name="pay[weixin]" value="<?php  echo $set['pay']['weixin'];?>" />
                        <div class='form-control-static'> <?php  if($set['pay']['weixin']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div id='certs' <?php  if(empty($set['pay']['weixin'])) { ?>style="display:none"<?php  } ?>>
                     <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">CERT证书文件</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="hidden" name="pay[weixin_cert]" value="<?php  echo $set['pay']['weixin_cert'];?>"/>
                            <?php if(cv('sysset.save.pay')) { ?>

                            <input type="file" name="weixin_cert_file" class="form-control" />
                            <span class="help-block">
                                <?php  if(!empty($sec['cert'])) { ?>
                                <span class='label label-success'>已上传</span>
                                <?php  } else { ?>
                                <span class='label label-danger'>未上传</span>
                                <?php  } ?>
                                下载证书 cert.zip 中的 apiclient_cert.pem 文件</span>
                            <?php  } else { ?>
                           <?php  if(!empty($sec['cert'])) { ?>
                            <span class='label label-success'>已上传</span>
                            <?php  } else { ?>
                            <span class='label label-danger'>未上传</span>
                            <?php  } ?>
                            <?php  } ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">KEY密钥文件</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="hidden" name="pay[weixin_key]"  value="<?php  echo $set['pay']['weixin_key'];?>"/>
                            <?php if(cv('sysset.save.pay')) { ?>

                            <input type="file" name="weixin_key_file" class="form-control" />
                            <span class="help-block">
                               <?php  if(!empty($sec['key'])) { ?>
                                <span class='label label-success'>已上传</span>
                                <?php  } else { ?>
                                <span class='label label-danger'>未上传</span>
                                <?php  } ?>
                                下载证书 cert.zip 中的 apiclient_key.pem 文件
                            </span>
                            <?php  } else { ?>
                          <?php  if(!empty($sec['key'])) { ?>
                            <span class='label label-success'>已上传</span>
                            <?php  } else { ?>
                            <span class='label label-danger'>未上传</span>
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">ROOT文件</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="hidden" name="pay[weixin_root]" value="<?php  echo $set['pay']['weixin_root'];?>"/>
                            <?php if(cv('sysset.save.pay')) { ?>

                            <input type="file" name="weixin_root_file" class="form-control" />
                            <span class="help-block">
                              <?php  if(!empty($sec['root'])) { ?>
                                <span class='label label-success'>已上传</span>
                                <?php  } else { ?>
                                <span class='label label-danger'>未上传</span>
                                <?php  } ?>
                                下载证书 cert.zip 中的 rootca.pem 文件 
                            </span>
                            <?php  } else { ?>
                         <?php  if(!empty($sec['root'])) { ?>
                            <span class='label label-success'>已上传</span>
                            <?php  } else { ?>
                            <span class='label label-danger'>未上传</span>
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付宝支付</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.pay')) { ?>
                        <label class='radio-inline'><input type='radio' name='pay[alipay]' value='1' <?php  if($set['pay']['alipay']==1) { ?>checked<?php  } ?>/> 开启</label>
                        <label class='radio-inline'><input type='radio' name='pay[alipay]' value='0' <?php  if($set['pay']['alipay']==0) { ?>checked<?php  } ?> /> 关闭</label>
                        <?php  } else { ?>
                        <input type="hidden" name="pay[alipay]" value="<?php  echo $set['pay']['alipay'];?>"/>
                        <div class='form-control-static'> <?php  if($set['pay']['alipay']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">农行支付</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sysset.save.pay')) { ?>
                    <label class='radio-inline'><input type='radio' name='pay[abcchinapay]' value='1' <?php  if($set['pay']['abcchinapay']==1) { ?>checked<?php  } ?>/> 开启</label>
                    <label class='radio-inline'><input type='radio' name='pay[abcchinapay]' value='0' <?php  if($set['pay']['abcchinapay']==0) { ?>checked<?php  } ?> /> 关闭</label>
                    <?php  } else { ?>
                    <input type="hidden" name="pay[abcchinapay]" value="<?php  echo $set['pay']['abcchinapay'];?>"/>
                    <div class='form-control-static'> <?php  if($set['pay']['abcchinapay']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">余额支付</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.pay')) { ?>
                        <label class='radio-inline'><input type='radio' name='pay[credit]' value='1' <?php  if($set['pay']['credit']==1) { ?>checked<?php  } ?>/> 开启</label>
                        <label class='radio-inline'><input type='radio' name='pay[credit]' value='0' <?php  if($set['pay']['credit']==0) { ?>checked<?php  } ?> /> 关闭</label>
                        <?php  } else { ?>
                        <input type="hidden" name="pay[credit]" value="<?php  echo $set['pay']['credit'];?>"/>
                        <div class='form-control-static'> <?php  if($set['pay']['credit']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">货到付款</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.pay')) { ?>
                        <label class='radio-inline'><input type='radio' name='pay[cash]' value='1' <?php  if($set['pay']['cash']==1) { ?>checked<?php  } ?>/> 开启</label>
                        <label class='radio-inline'><input type='radio' name='pay[cash]' value='0' <?php  if($set['pay']['cash']==0) { ?>checked<?php  } ?> /> 关闭</label>
                        <?php  } else { ?>
                        <input type="hidden" name="pay[cash]" value="<?php  echo $set['pay']['cash'];?>"/>
                        <div class='form-control-static'> <?php  if($set['pay']['cash']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                       <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.pay')) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                          <?php  } ?>
                     </div>
            </div>

            </div>
            <script language="javascript">
                $(function () {
                    $(":radio[name='pay[weixin]']").click(function () {
                        if ($(this).val() == 1) {
                            $("#certs").show();
                        }
                        else {
                            $("#certs").hide();
                        }
                    })

                })
            </script>
        </div>     
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     
