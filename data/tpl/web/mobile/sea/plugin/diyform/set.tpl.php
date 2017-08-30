<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<form id="setform" action="" method="post" class="form-horizontal form">
    <div class='panel panel-default'>

        <div class='panel-heading'>
            基础设置
        </div>
        <div class='panel-body'>

            <div class="alert alert-danger">警告：当模板中已经添加数据后切换自定义表单模板有可能导致无法使用！</div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员资料</label>

                
				
                <div class="col-sm-9 col-xs-12">
					
		<?php if(cv('diyform.set.save')) { ?>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="0" name="setdata[user_diyform_open]" <?php  if(empty($set['user_diyform_open'])) { ?>checked<?php  } ?>> 关闭
                    </label>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="1" name="setdata[user_diyform_open]" <?php  if($set['user_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
                    </label>

              
                    <select id="user_diyform" name="setdata[user_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px">
		<option value="0" <?php  if($set['user_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                        <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                        <option value="<?php  echo $value['id'];?>" <?php  if($set['user_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>
		<?php  } else { ?>
		<div class="form-control-static">
		       <?php  if($set['user_diyform_open'] == 1) { ?>
			   开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['user_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
			   <?php  } else { ?>
			   关闭
			   <?php  } ?>
		  </div>
		<?php  } ?>
                </div>
                

            </div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销商申请资料</label>

            
                <div class="col-sm-9 col-xs-12">
	<?php if(cv('diyform.set.save')) { ?>
					
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="0" name="setdata[commission_diyform_open]" <?php  if(empty($set['commission_diyform_open'])) { ?>checked<?php  } ?>> 关闭
                    </label>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="1" name="setdata[commission_diyform_open]" <?php  if($set['commission_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
                    </label>

                 
                    <select id="commission_diyform" name="setdata[commission_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
			 <option value="0" <?php  if($set['commission_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                        <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                        <option value="<?php  echo $value['id'];?>" <?php  if($set['commission_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>

				 <?php  } else { ?>
		<div class="form-control-static">
		       <?php  if($set['commission_diyform_open'] == 1) { ?>
			   开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['commission_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
			   <?php  } else { ?>
			   关闭
			   <?php  } ?>
		  </div>
		<?php  } ?>
                </div>
               

            </div>
			
			
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单统一下单表单</label>

             
                <div class="col-sm-9 col-xs-12">
					   <?php if(cv('diyform.set.save')) { ?>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="0" name="setdata[order_diyform_open]" <?php  if(empty($set['order_diyform_open'])) { ?>checked<?php  } ?>> 关闭
                    </label>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="1" name="setdata[order_diyform_open]" <?php  if($set['order_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
                    </label>

                 
                    <select id="commission_diyform" name="setdata[order_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
						<option value="0" <?php  if($set['order_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                        <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                        <option value="<?php  echo $value['id'];?>" <?php  if($set['order_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>    
					  <span class="help-block">&nbsp;&nbsp;全局统一设置，购买任意产品，在确认订单页面都需要填写</span>
					   <?php  } else { ?>
				 <div class="form-control-static">
		       <?php  if($set['order_diyform_open'] == 1) { ?>
			   开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['order_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
			   <?php  } else { ?>
			   关闭
			   <?php  } ?>
		  </div>
					 <?php  } ?>
					 
		
                </div>
            

            </div>

        <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员申请供应商</label>

             
                <div class="col-sm-9 col-xs-12">
                       <?php if(cv('diyform.set.save')) { ?>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="0" name="setdata[supplier_diyform_open]" <?php  if(empty($set['supplier_diyform_open'])) { ?>checked<?php  } ?>> 关闭
                    </label>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="1" name="setdata[supplier_diyform_open]" <?php  if($set['supplier_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
                    </label>

                 
                    <select id="commission_diyform" name="setdata[supplier_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
                        <option value="0" <?php  if($set['supplier_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                        <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                        <option value="<?php  echo $value['id'];?>" <?php  if($set['supplier_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>    
                      <span class="help-block">&nbsp;&nbsp;会员申请供应商表单</span>
                       <?php  } else { ?>
                 <div class="form-control-static">
               <?php  if($set['supplier_diyform_open'] == 1) { ?>
               开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['supplier_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
               <?php  } else { ?>
               关闭
               <?php  } ?>
          </div>
                     <?php  } ?>
                     
        
                </div>
            

            </div>
			

<!--            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单模式</label>

                <?php if(cv('diyform.set.save')) { ?>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="1" name="setdata[diymode]" <?php  if(empty($set['diymode']) || $set['diymode'] == 1) { ?>checked<?php  } ?>> 点击立即购买时填写
                    </label>
                    <label class="radio radio-inline" style="float: left;">
                        <input type="radio" value="2" name="setdata[diymode]" <?php  if($set['diymode'] == 2) { ?>checked<?php  } ?>> 确认订单时填写
                    </label>

                </div> 
                <?php  } ?>

            </div>-->

            <!--div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">发货提醒</label>

                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('diyform.set.save')) { ?>
                    <input type="text" name="tm[send]" class="form-control" value="<?php  echo $set['tm']['send'];?>"/>

                    <div class="help-block">公众平台模板消息编号: OPENTM203331384</div>
                    <?php  if(p('creditshop')) { ?>
                    <div class="help-block">与“积分商城”插件发货提醒模板消息一致，如果公众平台已经添加，无需重复添加，直接复制即可</div>
                    <?php  } ?>
                    <?php  } else { ?>
                    <input type="hidden" name="tm[send]" value="<?php  echo $set['tm']['send'];?>"/>

                    <div class="form-control-static"><?php  echo $set['tm']['send'];?></div>
                    <?php  } ?>
                </div>
            </div-->

            <?php if(cv('diyform.set.save')) { ?>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>

                <div class="col-sm-9">
                    <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"/>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                </div>
            </div>
        </div>
        <?php  } ?>

</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>