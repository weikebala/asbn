<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
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
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品兑换成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('creditshop.notice.save')) { ?>
                        <input type="text" name="tm[new]" class="form-control" value="<?php  echo $set['tm']['new'];?>" />
                        <div class="help-block">通知公众平台模板消息编号: OPENTM205041965  或 OPENTM207024290 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="tm[new]" value="<?php  echo $set['tm']['new'];?>" />
                        <div class="form-control-static"><?php  echo $set['tm']['new'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('creditshop.notice.save')) { ?>

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
                        <span class='help-block'>商品兑换后商家通知，可以指定多个人，如果不填写则不通知</span>
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
            </div>
            <div class='panel-heading'>
                买家通知
            </div>
            <div class='panel-body'>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">中奖结果通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('creditshop.notice.save')) { ?>
                        <input type="text" name="tm[award]" class="form-control" value="<?php  echo $set['tm']['award'];?>" />
                        <div class="help-block">公众平台模板消息编号: OPENTM204632492 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="tm[award]" value="<?php  echo $set['tm']['award'];?>" />
                        <div class="form-control-static"><?php  echo $set['tm']['award'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">奖品兑换成功通知</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('creditshop.notice.save')) { ?>
                        <input type="text" name="tm[exchange]" class="form-control" value="<?php  echo $set['tm']['exchange'];?>" />
                        <div class="help-block">公众平台模板消息编号: OPENTM207327376 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="tm[exchange]" value="<?php  echo $set['tm']['exchange'];?>" />
                        <div class="form-control-static"><?php  echo $set['tm']['exchange'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">发货提醒</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('creditshop.notice.save')) { ?>
                        <input type="text" name="tm[send]" class="form-control" value="<?php  echo $set['tm']['send'];?>" />
                        <div class="help-block">公众平台模板消息编号: OPENTM203331384 </div>
                        <?php  } else { ?>
                        <input type="hidden" name="tm[send]" value="<?php  echo $set['tm']['send'];?>" />
                        <div class="form-control-static"><?php  echo $set['tm']['send'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                 	  
                 <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('creditshop.notice.save')) { ?>
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