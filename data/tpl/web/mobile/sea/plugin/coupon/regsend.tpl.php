<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation=='display') { ?>
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
			
<div class="panel panel-info">

<div class="panel panel-default">

    <div class="panel-body">
        <table class="table table-hover table-responsive">
            <thead class="navbar-inner" >
                <tr>
                     <th style='width:50px;'>ID</th>
                     <th>优惠券名称</th>
                    <th >使用条件/优惠</th>
		             <th >已使用/已发出</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                      <td><?php  echo $row['id'];?></td>
                
		    <td><?php  if($row['coupontype']==0) { ?>
				  <label class='label label-success'>购物</label>
						  <?php  } else if($row['coupontype']==1) { ?>
                <label class='label label-warning'>充值</label>
                          <?php  } else { ?>
                <label class='label label-success'>关注</label>
					 <?php  } ?>
					 <br/><?php  echo $row['couponname'];?>
					  </td>
					  <td><?php  if($row['enough']>0) { ?>
						  <label class="label label-danger">满<?php  echo $row['enough'];?>可用</label>
						  <?php  } else { ?>
						    <label class="label label-warning">不限</label>
						  <?php  } ?>
					 
						  <br/><?php  if($row['backtype']==0) { ?>
						  立减 <?php  echo $row['deduct'];?> 元
						  <?php  } else if($row['backtype']==1) { ?>
						  打 <?php  echo $row['discount'];?> 折
						  <?php  } else if($row['backtype']==2) { ?>
						  <?php  if($row['backmoney']>0) { ?>返 <?php  echo $row['backmoney'];?> 余额;<?php  } ?>
						  <?php  if($row['backcredit']>0) { ?>返 <?php  echo $row['backcredit'];?> 积分;<?php  } ?>
						  <?php  if($row['backredpack']>0) { ?>返 <?php  echo $row['backredpack'];?> 红包;<?php  } ?>
						  <?php  } ?>
					 </td>
					 
                    <td>
                                            <?php if(cv('coupon.log.view')) { ?>
                                            <a href="<?php  echo $this->createPluginWebUrl('coupon/log',array('coupon'=>$row['id']))?>">
                                                 <?php  echo $row['usetotal'];?> / <?php  echo $row['gettotal'];?>
                                            </a>
                                            <?php  } else { ?>
                                             <?php  echo $row['usetotal'];?> / <?php  echo $row['gettotal'];?>
                                            <?php  } ?>
					<td><?php  echo date('Y-m-d',$row['createtime'])?></td>
					<td style="position:relative">

    <?php if(cv('coupon.coupon.edit')) { ?>
    <a class='btn btn-default btn-sm' href="<?php  echo $this->createPluginWebUrl('coupon/regsend/post',array('id' => $row['id']));?>" title="编辑" ><i class='fa fa-edit'></i></a>

    <?php  } ?>
    <?php if(cv('coupon.coupon.delete')) { ?>
    <a class='btn btn-default  btn-sm' href="<?php  echo $this->createPluginWebUrl('coupon/regsend/delete',array('id' => $row['id']));?>" title="删除" onclick="return confirm('确定要删除该优惠券吗？');"><i class='fa fa-remove'></i></a>

    <?php  } ?>
    </ul>
</div>


    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
    <div class='panel-footer'>

        <?php if(cv('coupon.regsend.add')) { ?>
            <?php  if($list==null) { ?>
                 <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('coupon/regsend',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加关注优惠券</a>
            <?php  } ?>
        <?php  } ?>
    </div>
</div>
			     </form>
<?php  } else if($operation=='post') { ?>

<form <?php if( ce('coupon.regsend.edit' ,$item) ) { ?>action="" method='post'<?php  } ?> class='form-horizontal'>
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
    <input type="hidden" name="op" value="detail">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="sea" />
    <input type="hidden" name="p" value="coupon" />
    <input type="hidden" name="method" value="regsend" />
    <input type="hidden" name="op" value="post" />
    <div class='panel panel-default'>
        <div class='panel-heading'>
            编辑关注优惠券
        </div>
		
   <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 优惠券名称</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('coupon.coupon' ,$item) ) { ?>
                    <input type="text" name="couponname" class="form-control" value="<?php  echo $item['couponname'];?>"  />
                    <?php  } else { ?>
                    <input type="hidden" name="couponname" class="form-control" value="<?php  echo $item['couponname'];?>"  />
                    <div class='form-control-static'><?php  echo $item['couponname'];?></div>
                    <?php  } ?>
                </div>
        </div>

         <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">使用条件</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('coupon.coupon' ,$item) ) { ?>
                    <input type="text" name="enough" class="form-control" value="<?php  echo $item['enough'];?>"  />
                    <span class='help-block' ><?php  if(empty($type)) { ?>消费<?php  } else { ?>充值<?php  } ?>满多少可用, 空或0 不限制</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  if($item['enough']>0) { ?>满 <?php  echo $item['enough'];?> 可用 <?php  } else { ?>不限制<?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">使用时间限制</label>
                
                    <?php if( ce('coupon.coupon.edit' ,$item) ) { ?>
                    <div class="col-sm-3">
                    <div class='input-group'>
                        <span class='input-group-addon'>
                             <label class="radio-inline" style='margin-top:-5px;' ><input type="radio" name="timelimit" value="0" <?php  if($item['timelimit']==0) { ?>checked<?php  } ?>>获得后</label>
                        </span>
                   
                     <input type='text' class='form-control' style="width:50px;" name='timedays' value="<?php  echo $item['timedays'];?>" />
                     <span class='input-group-addon'>天内有效(空为不限时间使用)</span>
                      </div>
                     </div>
                    
                     <div class="col-sm-2">
                    <div class='input-group'>
                        <span class='input-group-addon'>
                             <label class="radio-inline" style='margin-top:-5px;' ><input type="radio" name="timelimit" value="1" <?php  if($item['timelimit']==1) { ?>checked<?php  } ?>>日期</label>
                        </span>
                         <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d', $starttime),'endtime'=>date('Y-m-d', $endtime)));?>
                          <span class='input-group-addon'>内有效</span>
                      </div>
                     </div>
                       <?php  } else { ?>
                       <div class="col-sm-9 col-xs-12">
                      <div class='form-control-static'>
						  <?php  if($item['timelimit']==0) { ?>
                          <?php  if(!empty($item['timedays'])) { ?>获得后 <?php  echo $item['timedays'];?> 天内有效<?php  } else { ?>不限时间<?php  } ?>
                          <?php  } else { ?>
                          <?php  echo date('Y-m-d',$starttime)?> - <?php  echo date('Y-m-d',$endtime)?>  范围内有效
                          <?php  } ?></div>
                      </div>
                    <?php  } ?>
              
            </div>
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('coupon/consume', TEMPLATE_INCLUDEPATH)) : (include template('coupon/consume', TEMPLATE_INCLUDEPATH));?>

	 
　     </div>
		　
　     <div class='panel-heading'>
            使用说明
        </div>
        <div class='panel-body'>
			
			    <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否使用统一说明 </label>
                <div class="col-sm-9 col-xs-12">
                   <?php if( ce('coupon.coupon' ,$item) ) { ?>
				   <label class="radio-inline" >
					<input type="radio" name="descnoset" value="0" <?php  if($item['descnoset'] == 0) { ?>checked="true"<?php  } ?> /> 使用
				</label>
			   
                         <label class="radio-inline"'>
					<input type="radio" name="descnoset" value="1" <?php  if($item['descnoset'] == 1) { ?>checked="true"<?php  } ?> /> 不使用
				</label>
				   <span class='help-block'>统一说明在<a href="<?php  echo $this->createPluginWebUrl('coupon/set')?>" target='_blank'>【基础设置】</a>中设置，如果使用统一说明，则在优惠券说明前面显示统一说明</span>
						<?php  } else { ?>
						
						<div class='form-control-static'>
						  <?php  if($item['descnoset']==0) { ?>
						  使用
						  <?php  } else if($item['descnoset']==1) { ?>
						 不使用
						  <?php  } else { ?>
						  <?php  } ?>
					  </div>
						<?php  } ?>
                </div>
            </div>
			
						
			<div class="form-group">
	<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用说明</label>
	<div class="col-sm-9 col-xs-12">
                  <?php if( ce('coupon.coupon' ,$item) ) { ?>
                            <?php  echo tpl_ueditor('desc',$item['desc'])?>
                            <?php  } else { ?>
                            <textarea id='desc' style='display:none'><?php  echo $item['desc'];?></textarea>
                            <a href='javascript:preview_html("#desc")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
	</div>
		</div>   </div>
               <div class='panel-heading'>
            推送消息 (发放或用户从领券中心获得后的消息推送，如果标题为空就不推送消息)
        </div>
			<div class='panel-body'>
			
				
				  <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">推送标题</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('coupon.coupon' ,$item) ) { ?>
                    <input type="text" name="resptitle" class="form-control" value="<?php  echo $item['resptitle'];?>"  />
		  <span class="help-block">变量 [nickname] 会员昵称 [total] 优惠券张数</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['resptitle'];?></div>
                    <?php  } ?>
                </div>
            </div>
				  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">推送封面</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('coupon.coupon' ,$item) ) { ?>
                        <?php  echo tpl_form_field_image('respthumb', $item['respthumb'])?>
                        <?php  } else { ?>
                        <input type="hidden" name="respthumb" value="<?php  echo $item['respthumb'];?>"/>
                        <?php  if(!empty($item['thumb'])) { ?>
                        <a href='<?php  echo tomedia($item['respthumb'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($item['respthumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
				
				    <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">推送说明</label>
                <div class="col-sm-9 col-xs-12">
                     <?php if( ce('coupon.coupon' ,$item) ) { ?>
                    <textarea name="respdesc" class='form-control'><?php  echo $item['respdesc'];?></textarea>
					  <span class="help-block">变量 [nickname] 会员昵称 [total] 优惠券张数</span>
                       <?php  } else { ?>
                      <div class='form-control-static'><?php  echo $item['respdesc'];?></div>
                    <?php  } ?>
                </div>
            </div>
				  <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">推送连接</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('coupon.coupon' ,$item) ) { ?>
                    <input type="text" name="respurl" class="form-control" value="<?php  echo $item['respurl'];?>"  />
					<span class='help-block'>消息推送点击的连接，为空默认为优惠券详情</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['respurl'];?></div>
                    <?php  } ?>
                </div>
            </div>	
			</div>

            <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                         <?php if( ce('coupon.coupon' ,$item) ) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if( ce('coupon.regsend' ,$item) ) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>


        </div>


    </div>   
   
</form>
<script language='javascript'>
    
    function showbacktype(type){
 
        $('.backtype').hide();
        $('.backtype' + type).show();
    }
	$(function(){
		
		$('form').submit(function(){
			
			if($(':input[name=couponname]').isEmpty()){
				Tip.focus($(':input[name=couponname]'),'请输入优惠券名称!');
				return false;
			}
			var backtype = $(':radio[name=backtype]:checked').val();
			if(backtype=='0'){
				if($(':input[name=deduct]').isEmpty()){
					Tip.focus($(':input[name=deduct]'),'请输入立减多少!');
					return false;
				}
			}else if(backtype=='1'){
				if($(':input[name=discount]').isEmpty()){
					Tip.focus($(':input[name=discount]'),'请输入折扣多少!');
					return false;
				}
			}else if(backtype=='2'){
				if($(':input[name=backcredit]').isEmpty() && $(':input[name=backmoney]').isEmpty() && $(':input[name=backredpack]').isEmpty()){
					Tip.focus($(':input[name=backcredit]'),'至少输入一种返利!');
					return false;
				}
			}
			return true;
		})
		
	})
</script>
	
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
