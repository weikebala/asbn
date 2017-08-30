<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="notice" />
        <div class="panel panel-default">
            <style type='text/css'>
                .multi-item { height:110px;}
                .img-thumbnail { width:100px;height:100px}
                .img-nickname { position: absolute;bottom:0px;line-height:25px;height:25px;
                                color:#fff;text-align:center;width:90px;bottom:55px;background:rgba(0,0,0,0.8);left:5px;}
                .multi-img-details { padding:5px;}
            </style>
            <div class='panel-body'>
                <div class='alert alert-info'>
                    请将公众平台模板消息所在行业选择为： IT科技/互联网|电子商务
                </div>
            </div>
            <div class='panel-heading'>
                卖家通知
            </div>
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单生成通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[new]" class="form-control" value="<?php  echo $set['notice']['new'];?>" />
                        <div class="help-block">通知公众平台模板消息编号: OPENTM205213550 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[new]" value="<?php  echo $set['notice']['new'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['new'];?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>

                        <div class='input-group'>
                            <input type="text" id='salers' name="salers" maxlength="30" value="<?php  if(is_array($salers)) { foreach($salers as $saler) { ?> <?php  echo $saler['nickname'];?>; <?php  } } ?>" class="form-control" readonly />
                            <div class='input-group-btn'>
                                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus').modal();">选择通知人</button>
                            </div>
                        </div>
                        <div class="input-group multi-img-details" id='saler_container'>
                            <?php  if(is_array($salers)) { foreach($salers as $saler) { ?>
                            <div class="multi-item saler-item" openid='<?php  echo $saler['openid'];?>'>
                                 <img class="img-responsive img-thumbnail" src='<?php  echo $saler['avatar'];?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                                 <div class='img-nickname'><?php  echo $saler['nickname'];?></div>
                                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
                                <em onclick="remove_member(this)"  class="close">×</em>
                            </div>
                            <?php  } } ?>
                        </div>
                        <span class='help-block'>订单生成后商家通知，可以制定多个人，如果不填写则不通知</span>
                        <div id="modal-module-menus"  class="modal fade" tabindex="-1">
                            <div class="modal-dialog" style='width: 920px;'>
                                <div class="modal-content">
                                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择通知人</h3></div>
                                    <div class="modal-body" >
                                        <div class="row">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="请输入粉丝昵称/姓名/手机号" />
                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_members();">搜索</button></span>
                                            </div>
                                        </div>
                                        <div id="module-menus" style="padding-top:5px;"></div>
                                    </div>
                                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                </div>

                            </div>
                        </div>
                        <?php  } else { ?>
                        <div class="input-group multi-img-details" id='saler_container'>
                            <?php  if(is_array($salers)) { foreach($salers as $saler) { ?>
                            <div class="multi-item saler-item" openid='<?php  echo $saler['openid'];?>'>
                                 <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
                                <img class="img-responsive img-thumbnail" src='<?php  echo $saler['avatar'];?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                                     <div class='img-nickname'><?php  echo $saler['nickname'];?></div>
                                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
                            </div>
                            <?php  } } ?>
                        </div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知方式</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="0" name='notice[newtype][]' <?php  if(in_array(0,$newtype)) { ?>checked<?php  } ?> /> 下单通知
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="1" name='notice[newtype][]' <?php  if(in_array(1,$newtype)) { ?>checked<?php  } ?> /> 付款通知
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="2" name='notice[newtype][]' <?php  if(in_array(2,$newtype)) { ?>checked<?php  } ?> /> 买家确认收货通知
                        </label>
                        <div class="help-block">通知商家方式</div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[newtype]" value="<?php  echo $set['notice']['newtype'];?>" />
                         <div class='form-control-static'><?php  if(in_array(0,$newtype)) { ?>下单通知;<?php  } ?><?php  if(in_array(1,$newtype)) { ?>付款通知;<?php  } ?><?php  if(in_array(2,$newtype)) { ?>买家收货通知;<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

            </div>
            <div class='panel-heading'>
                买家通知
            </div>
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单提交成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[submit]" class="form-control" value="<?php  echo $set['notice']['submit'];?>" />
                        <div class="help-block">公众平台模板消息编号: OPENTM200746866 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[submit]" value="<?php  echo $set['notice']['submit'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['submit'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">自提订单提交成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[carrier]" class="form-control" value="<?php  echo $set['notice']['carrier'];?>" />
                        <div class="help-block">公众平台模板消息编号:  OPENTM201594720  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[carrier]" value="<?php  echo $set['notice']['carrier'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['carrier'];?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单取消通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[cancel]" class="form-control" value="<?php  echo $set['notice']['cancel'];?>" />
                        <div class="help-block">公众平台模板消息编号: TM00850 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[cancel]" value="<?php  echo $set['notice']['cancel'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['cancel'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单支付成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[pay]" class="form-control" value="<?php  echo $set['notice']['pay'];?>" />
                        <div class="help-block">公众平台模板消息编号:  OPENTM204987032  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[pay]" value="<?php  echo $set['notice']['pay'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['pay'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单发货通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[send]" class="form-control" value="<?php  echo $set['notice']['send'];?>" />
                        <div class="help-block">公众平台模板消息编号:  OPENTM202243318  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[send]" value="<?php  echo $set['notice']['send'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['send'];?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单确认收货通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[finish]" class="form-control" value="<?php  echo $set['notice']['finish'];?>" />
                        <div class="help-block">公众平台模板消息编号:  OPENTM202314085  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[finish]" value="<?php  echo $set['notice']['finish'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['finish'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款申请通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[refund]" class="form-control" value="<?php  echo $set['notice']['refund'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00431  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[refund]" value="<?php  echo $set['notice']['refund'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['refund'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[refund1]" class="form-control" value="<?php  echo $set['notice']['refund1'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00430  </div>
                        <?php  } else { ?>
                        <div class="form-control-static"><?php  echo $set['notice']['refund1'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款申请驳回通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[refund2]" class="form-control" value="<?php  echo $set['notice']['refund2'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00432  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[refund2]" value="<?php  echo $set['notice']['refund2'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['refund2'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员升级通知(任务处理通知)</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[upgrade]" class="form-control" value="<?php  echo $set['notice']['upgrade'];?>" />
                        <div class="help-block">请搜索“任务处理通知”公众平台模板消息编号:  OPENTM200605630  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[upgrade]" value="<?php  echo $set['notice']['upgrade'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['upgrade'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">充值成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[recharge_ok]" class="form-control" value="<?php  echo $set['notice']['recharge_ok'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00977</div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[recharge_ok]" value="<?php  echo $set['notice']['recharge_ok'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['recharge_ok'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">充值退款通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[recharge_refund]" class="form-control" value="<?php  echo $set['notice']['recharge_refund'];?>" />
                        <div class="help-block">搜索“退款通知”，公众平台模板消息编号:  TM00004</div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[recharge_refund]" value="<?php  echo $set['notice']['recharge_refund'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['recharge_refund'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现提交通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[withdraw]" class="form-control" value="<?php  echo $set['notice']['withdraw'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00979  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[withdraw]" value="<?php  echo $set['notice']['withdraw'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['withdraw'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[withdraw_ok]" class="form-control" value="<?php  echo $set['notice']['withdraw_ok'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00980  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[withdraw_ok]" value="<?php  echo $set['notice']['withdraw_ok'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['withdraw_ok'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现失败通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.notice')) { ?>
                        <input type="text" name="notice[withdraw_fail]" class="form-control" value="<?php  echo $set['notice']['withdraw_fail'];?>" />
                        <div class="help-block">公众平台模板消息编号:  TM00981  </div>
                        <?php  } else { ?>
                        <input type="hidden" name="notice[withdraw_fail]" value="<?php  echo $set['notice']['withdraw_fail'];?>" />
                        <div class="form-control-static"><?php  echo $set['notice']['withdraw_fail'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                       <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.notice')) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                          <?php  } ?>
                     </div>
            </div>
                       

            </div>
            <script language='javascript'>
                function search_members() {
                    if ($.trim($('#search-kwd').val()) == '') {
                        Tip.focus('#search-kwd', '请输入关键词');
                        return;
                    }
                    $("#module-menus").html("正在搜索....");
                    $.get('<?php  echo $this->createWebUrl('member/query')?>', { 
                        keyword: $.trim($('#search-kwd').val())
                    }, function (dat) {
                        $('#module-menus').html(dat);
                    });
                }
                function select_member(o) {

                    if ($('.multi-item[openid="' + o.openid + '"]').length > 0) {
                        return;
                    }
                    var html = '<div class="multi-item" openid="' + o.openid + '">';
                    html += '<img class="img-responsive img-thumbnail" src="' + o.avatar + '" onerror="this.src=\'./resource/images/nopic.jpg\'; this.title=\'图片未找到.\'">';
                    html += '<div class="img-nickname">' + o.nickname + '</div>';
                    html += '<input type="hidden" value="' + o.openid + '" name="openids[]">';
                    html += '<em onclick="remove_member(this)"  class="close">×</em>';
                    html += '</div>';
                    $("#saler_container").append(html);
                    refresh_members();
                }

                function remove_member(obj) {
                    $(obj).parent().remove();
                    refresh_members();
                }
                function refresh_members() {
                    var nickname = "";
                    $('.multi-item').each(function () {
                        nickname += " " + $(this).find('.img-nickname').html() + "; ";
                    });
                    $('#salers').val(nickname);
                }

            </script>
        </div>     
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     