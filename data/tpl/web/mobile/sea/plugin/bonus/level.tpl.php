<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $level['id'];?>" />
        <div class='panel panel-default'>
            <div class='panel-heading'>
                代理商等级设置
            </div>
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">等级权重</label>
                    <div class="col-sm-9 col-xs-12">
                        <input class="form-control" type="text" value="<?php  echo $level['level'];?>" name="level">
                        <span class="help-block">等级权重，数字越大级别越高。自动升级必填此项，否则不能正常升级</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 等级名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="levelname" class="form-control" value="<?php  echo $level['levelname'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">代理比例</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class='input-group'>
                                <input type="text" name="agent_money" class="form-control" value="<?php  echo $level['agent_money'];?>" />
                                <span class='input-group-addon'>%</span>
                        </div>
                    </div>
                </div>

                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">升级条件</label>
                    <div class="col-sm-9 col-xs-12">
                        
							
							
							<?php  if(in_array('1', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>一级加盟订单金额满</span>
									<input type="text" name="ordermoney" class="form-control" value="<?php  echo $level['ordermoney'];?>" />
									<span class='input-group-addon'>元</span>
                            </div>
							<?php  } ?>
							 
							
							<?php  if(in_array('2', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>加盟订单数量满</span>
									<input type="text" name="ordercount" class="form-control" value="<?php  echo $level['ordercount'];?>" />
									<span class='input-group-addon'>个</span>
                            </div>
							<?php  } ?>
							
							<?php  if(in_array('3', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>一级加盟订单数量满</span>
									<input type="text" name="ordercount" class="form-control" value="<?php  echo $level['ordercount'];?>" />
									<span class='input-group-addon'>个</span>
                            </div>
							<?php  } ?>
							
							<?php  if(in_array('4', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>自购订单金额满</span>
									<input type="text" name="ordermoney" class="form-control" value="<?php  echo $level['ordermoney'];?>" />
									<span class='input-group-addon'>元</span>
                            </div>
							<?php  }?>
							
							<?php  if(in_array('5', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>自购订单数量满</span>
									<input type="text" name="ordercount" class="form-control" value="<?php  echo $level['ordercount'];?>" />
									<span class='input-group-addon'>个</span>
                            </div>
							<?php  } ?>
							<?php  if(in_array('6', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>下级总人数满</span>
									<input type="text" name="downcount" class="form-control" value="<?php  echo $level['downcount'];?>" />
									<span class='input-group-addon'>个（加盟商+非加盟商）</span>
                            </div>
							<?php  } ?>
							<?php  if(in_array('7', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>一级下级人数满</span>
									<input type="text" name="downcount" class="form-control" value="<?php  echo $level['downcount'];?>" />
									<span class='input-group-addon'>个（加盟商+非加盟商）</span>
                            </div>
							<?php  } ?>
							<?php  if(in_array('8', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>团队总人数满</span>
									<input type="text" name="downcount" class="form-control" value="<?php  echo $level['downcount'];?>" />
									<span class='input-group-addon'>个（加盟商）</span>
                            </div>
							<?php  } ?>
							<?php  if(in_array('9', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>一级团队人数满</span>
									<input type="text" name="downcountlevel1" class="form-control" value="<?php  echo $level['downcountlevel1'];?>" />
									<span class='input-group-addon'>个（加盟商）</span>
                            </div>
							<?php  } ?>
							 
							<?php  if(in_array('10', $leveltype)) { ?>
                            <div class='input-group'>
									<span class='input-group-addon'>已提现佣金总金额满</span>
									<input type="text" name="commissionmoney" class="form-control" value="<?php  echo $level['commissionmoney'];?>" />
									<span class='input-group-addon'>元</span>
                            </div>
							<?php  } ?>
							<?php  if(in_array('11', $leveltype)) { ?>
                            <div class='input-group'>
                                    <span class='input-group-addon'>加盟订单金额满</span>
                                    <input type="text" name="commissionmoney" class="form-control" value="<?php  echo $level['commissionmoney'];?>" />
                                    <span class='input-group-addon'>元</span>
                            </div>
                            <?php  } ?>
							
                        </div>
                        <span class='help-block'>代理商升级条件，不填写默认为不自动升级</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">全球分红</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class="radio-inline">
                            <label class="radio-inline"><input type="radio"  name="premier" value="0" <?php  if($level['premier'] ==0) { ?> checked="checked"<?php  } ?> /> 否</label>
                            <label class="radio-inline"><input type="radio"  name="premier" value="1" <?php  if($level['premier'] ==1) { ?> checked="checked"<?php  } ?> /> 是</label>
                            <span class="help-block">享受全球分红比例</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">全球分红比例</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class='input-group'>
                                <input type="text" name="pcommission" class="form-control" value="<?php  echo $level['pcommission'];?>" />
                                <span class='input-group-addon'>%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">微信消息</label>
                    <div class="col-sm-9 col-xs-12">
                        <input class="form-control" type="text" value="<?php  echo $level['msgtitle'];?>" name="msgtitle">
                        <span class="help-block">微信消息标题</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea class="form-control" name="msgcontent"><?php  echo $level['msgcontent'];?></textarea>
                        <div class="help-block">模板变量: [昵称] [旧等级] [旧分红比例] [新等级] [新分红比例] [时间] </div>
                        <div class="help-block">独立微信消息通知。不填写则默认使用通知设置内容</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
	<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
	</div>
    </form>
</div>
<script language='javascript'>
    $('form').submit(function(){
        if($(':input[name=levelname]').isEmpty()){
            Tip.focus($(':input[name=levelname]'),'请输入等级名称!');
            return false;
        }
        return true;
    })
    $('table')
    </script>
<?php  } else if($operation == 'display') { ?>
            <form action="" method="post" onsubmit="return formcheck(this)">
     <div class='panel panel-default'>
            <div class='panel-heading'>
                代理商等级设置
            </div>
         <div class='panel-body'>
   
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:10%;">等级名称</th>
                        <th style="width:10%;">分红比例</th>
                        <th style="width:70%;">升级条件</th>
                        <th style="width:10%;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['levelname'];?></td>
                        <td><?php  echo $row['agent_money'];?>%</td>
                        <td class="condition">
						
						<?php  if(in_array('1', $set['leveltype'])) { ?><?php  if($row['ordermoney']>0) { ?>一级加盟订单金额满 <?php  echo $row['ordermoney'];?> 元 <?php  } ?><?php  } ?>
						<?php  if(in_array('2', $set['leveltype'])) { ?><?php  if($row['ordercount']>0) { ?>加盟订单数量满 <?php  echo $row['ordercount'];?> 个 <?php  } ?><?php  } ?>
						<?php  if(in_array('3', $set['leveltype'])) { ?><?php  if($row['ordercount']>0) { ?>一级加盟订单数量满 <?php  echo $row['ordercount'];?> 个 <?php  } ?><?php  } ?>
						<?php  if(in_array('4', $set['leveltype'])) { ?><?php  if($row['ordermoney']>0) { ?>自购订单金额满 <?php  echo $row['ordermoney'];?> 元 <?php  } ?><?php  } ?>
						<?php  if(in_array('5', $set['leveltype'])) { ?><?php  if($row['ordercount']>0) { ?>自购订单数量满 <?php  echo $row['ordercount'];?> 个 <?php  } ?><?php  } ?>
						
						<?php  if(in_array('6', $set['leveltype'])) { ?><?php  if($row['downcount']>0) { ?>下级总人数满 <?php  echo $row['downcount'];?> 个（加盟商+非加盟商） <?php  } ?><?php  } ?>
						<?php  if(in_array('7', $set['leveltype'])) { ?><?php  if($row['downcount']>0) { ?>一级下级人数满 <?php  echo $row['downcount'];?> 个（加盟商+非加盟商） <?php  } ?><?php  } ?>
						
						<?php  if(in_array('8', $set['leveltype'])) { ?><?php  if($row['downcount']>0) { ?>团队总人数满 <?php  echo $row['downcount'];?> 个（加盟商） <?php  } ?><?php  } ?>
						<?php  if(in_array('9', $set['leveltype'])) { ?><?php  if($row['downcountlevel1']>0) { ?>一级团队人数满 <?php  echo $row['downcountlevel1'];?> 个（加盟商）<?php  } ?><?php  } ?>
						
						 
						<?php  if(in_array('10', $set['leveltype'])) { ?><?php  if($row['bonusmoney']>0) { ?>已提现佣金总金额满 <?php  echo $row['bonusmoney'];?> 元 <?php  } ?><?php  } ?>
                        <?php  if(in_array('11', $set['leveltype'])) { ?><?php  if($row['commissionmoney']>0) { ?>加盟订单金额满 <?php  echo $row['commissionmoney'];?> 元 <?php  } ?><?php  } ?>
                          </td>
                        <td>
                            <?php if(cv('bonus.level.edit')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('bonus/level', array('op' => 'post', 'id' => $row['id']))?>">编辑</a><?php  } ?>
                            <?php if(cv('bonus.level.delete')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('bonus/level', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此等级吗？');return false;">删除</a></td><?php  } ?>

                    </tr>
                    <?php  } } ?>
                
                </tbody>
            </table>

         </div>
         <div class='panel-footer'>
            <?php if(cv('bonus.level.add')) { ?>
                <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('bonus/level', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新等级</a>
            <?php  } ?>
         </div>
     </div>
         </form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
