<?php defined('IN_IA') or exit('Access Denied');?><style>
    .red {
        color: red;
    }
</style>
<input type="hidden" name="kid" value="<?php  echo $reply['id'];?>"/>

<div class="panel panel-default">
    <div class="panel-heading">
        基本设置
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 活动名称：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="title" class="form-control span7"
                       placeholder="" name="title" value="<?php  echo $reply['title'];?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动开始时间：</label>

            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_date('starttime',$reply['starttime'],true)?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动结束时间：</label>

            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_date('endtime',$reply['endtime'],true)?>
            </div>
        </div>





        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动版权：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="copyright" class="form-control span7"
                       placeholder="" name="copyright" value="<?php  echo $reply['copyright'];?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动版权链接URL(http://)：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="copyright_url" class="form-control span7"
                       placeholder="" name="copyright_url" value="<?php  echo $reply['copyright_url'];?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动热线：</label>

            <div class="col-sm-9 col-xs-12">

                <input type="text" id="hot_tel" class="form-control span7"
                       placeholder="" name="hot_tel" value="<?php  echo $reply['hot_tel'];?>">
            </div>
        </div>







        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>关注引导图文介绍链接：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="follow_url" class="form-control span7"
                       placeholder="" name="follow_url" value="<?php  echo $reply['follow_url'];?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>砍价成功对话框提示文字：</label>

            <div class="col-sm-9 col-xs-12">
                <textarea style="height: 60px;" name="kj_dialog_tip" class="form-control span7" cols="60"><?php  if($reply['kj_dialog_tip'] ) { ?><?php  echo $reply['kj_dialog_tip'];?><?php  } else { ?>手气真大，砍掉了这么多！！<?php  } ?></textarea>
                <div class="help-block">每条文字直接请以回车换行进行分隔！页面显示会随机取其中一条文字！</div>
            </div>

        </div>




        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动首页用户参加提示文字：</label>

            <div class="col-sm-9 col-xs-12">
			        <textarea style="height: 60px;" name="u_fist_tip" class="form-control span7" cols="60"><?php  if($reply['u_fist_tip'] ) { ?><?php  echo $reply['u_fist_tip'];?><?php  } else { ?>快给自己来一刀吧，下手就得狠点啊！<?php  } ?></textarea>
                <div class="help-block">每条文字直接请以回车换行进行分隔！页面显示会随机取其中一条文字！</div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动首页用户已参加提示文字：</label>

            <div class="col-sm-9 col-xs-12">
                <textarea style="height: 60px;" name="u_already_tip" class="form-control span7" cols="60"><?php  if($reply['u_already_tip'] ) { ?><?php  echo $reply['u_already_tip'];?><?php  } else { ?>继续找朋友帮你砍吧，砍到死为止！<?php  } ?></textarea>
                <div class="help-block">每条文字直接请以回车换行进行分隔！页面显示会随机取其中一条文字！</div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>好友帮砍限制：</label>

            <div class="col-sm-9 col-xs-12">
                <div class="col-sm-9 col-xs-12">
                    <input type="number" id="friend_help_limit" class="form-control span7"
                           placeholder="" name="friend_help_limit" value="<?php  echo $reply['friend_help_limit'];?>">
                    <div class="help-block">限制砍价人员的功能，比如你帮A砍过，就不能在帮其他人砍了。设置可以改变的数字，填几，就限制可以帮助几个人砍价。</div>

                </div>

            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>砍价页面好友砍价提示文字：</label>

            <div class="col-sm-9 col-xs-12">
                <textarea style="height: 60px;" name="fk_fist_tip" class="form-control span7" cols="60"><?php  if($reply['fk_fist_tip'] ) { ?><?php  echo $reply['fk_fist_tip'];?><?php  } else { ?>看他不爽，给他来一刀吧！<?php  } ?></textarea>
                <div class="help-block">每条文字直接请以回车换行进行分隔！页面显示会随机取其中一条文字！</div>
            </div>

        </div>



        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>砍价页面好友已帮砍价提示文字：</label>

            <div class="col-sm-9 col-xs-12">
                <textarea style="height: 60px;" name="fk_already_tip" class="form-control span7" cols="60"><?php  if($reply['fk_already_tip'] ) { ?><?php  echo $reply['fk_already_tip'];?><?php  } else { ?>你朋友他说了，谢谢你给他的那一刀！<?php  } ?></textarea>
                <div class="help-block">每条文字直接请以回车换行进行分隔！页面显示会随机取其中一条文字！</div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>排行帮列表头部提示文字：</label>

            <div class="col-sm-9 col-xs-12">
                <textarea style="height: 60px;" name="rank_tip" class="form-control span7" cols="60"><?php  if($reply['rank_tip'] ) { ?><?php  echo $reply['rank_tip'];?><?php  } else { ?>继续砍。。。。。这还不够，砍到0为止，哈哈！<?php  } ?></textarea>
                <div class="help-block">每条文字直接请以回车换行进行分隔！页面显示会随机取其中一条文字！</div>
            </div>
        </div>




        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>砍价规则设置：</label>

            <div class="col-sm-9 col-xs-12">


                <table class='table'>

                    <thead>
                    <tr>
                        <th>大于金额数(请倒叙设置如 1000、800)</th>
                        <th>砍价范围从</th>
                        <th>到</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody id="rule_items">


                    <?php  if(is_array($rule_items)) { foreach($rule_items as $rule_item) { ?>
                    <tr >
                        <td><input name="rule_pice[]" type="text"
                                   class="form-control span3" value="<?php  echo $rule_item['rule_pice'];?>"
                                /></td>
                        <td><input name="rule_start[]" type="text"
                                   class="form-control span3" value="<?php  echo $rule_item['rule_start'];?>"
                                /></td>

                        <td><input name="rule_end[]" type="text"
                                   class="form-control span1" value="<?php  echo $rule_item['rule_end'];?>"
                                /></td>

                        <td>
                            <input  name="rule_id[]" type="hidden" value="<?php  echo $rule_id['id'];?>" />
                            <a href='javascript:;' onclick='removeRuleItem(this)'><i
                                    class='glyphicon glyphicon-remove'></i> 删除</a></td>
                    </tr>

                    <?php  } } ?>

                    </tbody>

                </table>





                <a href="javascript:;" onclick="addRuleItem();"><i class="glyphicon glyphicon-plus" title="添加规则"></i>添加规则</a>



            </div>
        </div>






    </div>

</div>


<div class="panel panel-default">
    <div class="panel-heading">
        商品设置
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品名称：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="p_name" class="form-control span7"
                       placeholder="" name="p_name" value="<?php  echo $reply['p_name'];?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>活动商品宣传图：</label>

            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('p_pic',$reply['p_pic']);?>
                建议宽*高(645*600)
            </div>
        </div>



        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品缩略图：</label>

            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('p_preview_pic',$reply['p_preview_pic']);?>
                建议宽*高(200*200)
            </div>
        </div>




        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品库存：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="p_kc" class="form-control span7"
                       placeholder="" name="p_kc" value="<?php  echo $reply['p_kc'];?>">
            </div>
        </div>



        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品原价：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="p_y_price" class="form-control span7"
                       placeholder="" name="p_y_price" value="<?php  echo $reply['p_y_price'];?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品最低价：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="p_low_price" class="form-control span7"
                       placeholder="" name="p_low_price" value="<?php  echo $reply['p_low_price'];?>">
                <div class="help-block">注意:支付方式如果选择立即支付，商品最低价不要是0元！</div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>运费：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="yf_price" class="form-control span7"
                       placeholder="" name="yf_price" value="<?php  echo $reply['yf_price'];?>">
            </div>
        </div>



        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>支付方式：</label>

            <div class="col-sm-9 col-xs-12">
                <select name="pay_type" class="form-control" >
                    <option value="1" <?php  if($reply['pay_type']==1) { ?>selected='selected'<?php  } ?>>立即支付</option>
                    <option value="2" <?php  if($reply['pay_type']==2) { ?>selected='selected'<?php  } ?> >货到付款</option>
                </select>
            </div>
        </div>



        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>型号款式：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="p_model" class="form-control span7"
                       placeholder="" name="p_model" value="<?php  if($reply['p_model']) { ?><?php  echo $reply['p_model'];?><?php  } else { ?>长款|中款|小款<?php  } ?>">
                <div class="help-block">款式之间请以"|"进行分割！例如: 长款|中款|小款</div>
            </div>

        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品详细链接URL(http://)：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="p_url" class="form-control span7"
                       placeholder="" name="p_url" value="<?php  echo $reply['p_url'];?>">
            </div>
        </div>



        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>商品简介说明</label>

            <div class="col-sm-9 col-xs-12">

                <textarea style="height: 60px;" id="p_intro" name="p_intro"
                          class="form-control span7" cols="60"><?php  echo $reply['p_intro'];?></textarea>


            </div>
        </div>















    </div>

</div>


<div class="panel panel-default">
    <div class="panel-heading">
        图文设置
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>图文标题：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="new_title" class="form-control span7" placeholder="" name="new_title"
                       value="<?php  echo $reply['new_title'];?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>图文 图标：</label>

            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('new_icon',$reply['new_icon']);?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>图文描述：</label>

            <div class="col-sm-9 col-xs-12">
			<textarea style="height: 60px;" name="new_content"
                      class="form-control span7" cols="60"><?php  echo $reply['new_content'];?></textarea>
            </div>
        </div>


    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        分享设置
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>分享标题：</label>

            <div class="col-sm-9 col-xs-12">
                <input type="text" id="share_title" class="form-control span7" placeholder="" name="share_title"
                       value="<?php  echo $reply['share_title'];?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>分享图标：</label>

            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('share_icon',$reply['share_icon']);?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class='red'>*</span>分享描述：</label>

            <div class="col-sm-9 col-xs-12">
			<textarea style="height: 60px;" name="share_content"
                      class="form-control span7" cols="60"><?php  echo $reply['share_content'];?></textarea>
            </div>
        </div>


    </div>
</div>


<script>

    require(['jquery', 'util'], function ($, u) {
        $(function () {
            u.editor($('#p_intro')[0]);
        });
    });


    function addRuleItem() {
        var html = "<tr>";
        html += '<td><input name="rule_pice[]" type="text" class="form-control span3" value="" /></td>';
        html += '<td><input name="rule_start[]" type="text" class="form-control span3" value="" /></td>';
        html += '<td><input name="rule_end[]" type="text" class="form-control span1" value="" /></td>';
        html += '<td> <input  name="rule_id[]" type="hidden" value="" />&nbsp;<a href="javascript:;" onclick="removeRuleItem(this)" ><i class="glyphicon glyphicon-remove"></i> 删除</a></td>';
        html += "</tr>";
        $("#rule_items").append(html);
    }

    function removeRuleItem(obj) {
        $(obj).parent().parent().remove();
    }


</script>

