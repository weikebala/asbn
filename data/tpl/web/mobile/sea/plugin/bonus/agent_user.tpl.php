<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
 
<div class="panel panel-default">
    <div class='panel-body'>
    <div style='height:100px;width:110px;float:left;'>
         <img src='<?php  echo $member['avatar'];?>' style='width:100px;height:100px;border:1px solid #ccc;padding:1px' />
    </div>
    <div style='float:left;height:100px;overflow: hidden'>
        昵称: <?php  echo $member['nickname'];?><br/>
        姓名: <?php  echo $member['realname'];?> <br/>
        手机号: <?php  echo $member['mobile'];?> /  微信号: <?php  echo $member['weixin'];?><br/>
        下线人数: 总共 <span style='color:red'><?php  echo $member['agentcount'];?></span> 人 
    </div>
        </div>
</div>
<form method='get' class='form-horizontal'>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="plugin" />
            <input type="hidden" name="p" value="bonus" />
            <input type="hidden" name="method" value="agent" />
            <input type="hidden" name="op" value="user" />
            <input type="hidden" name="id" value="<?php  echo $agentid;?>" />
           <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">成为代理时间</label>
                <div class="col-sm-7 col-lg-9 col-xs-12">
                    <div class="col-sm-2">
                        <label class='radio-inline'>
                            <input type='radio' value='0' name='searchtime' <?php  if($_GPC['searchtime']=='0') { ?>checked<?php  } ?>>不搜索
                        </label> 
                         <label class='radio-inline'>
                            <input type='radio' value='1' name='searchtime' <?php  if($_GPC['searchtime']=='1') { ?>checked<?php  } ?>>搜索
                        </label>
                 </div>
                    <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d  H:i', $endtime)),true);?>
                </div>
            </div>
            <div class="form-group">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">ID</label>
            <div class="col-sm-8 col-lg-9 col-xs-12">
                <input type="text" class="form-control"  name="mid" value="<?php  echo $_GPC['mid'];?>"/> 
            </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">会员信息</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" class="form-control"  name="realname" value="<?php  echo $_GPC['realname'];?>" placeholder='可搜索昵称/名称/手机号'/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">是否关注</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                       <select name='followed' class='form-control'>
                        <option value=''></option>
                        <option value='0' <?php  if($_GPC['followed']=='0') { ?>selected<?php  } ?>>未关注</option>
                        <option value='1' <?php  if($_GPC['followed']=='1') { ?>selected<?php  } ?>>已关注</option>
                        <option value='2' <?php  if($_GPC['followed']=='2') { ?>selected<?php  } ?>>取消关注</option>
                    </select>
                </div>
            </div>
              <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">推荐人</label>
                <div class="col-sm-3">
                    <select name='parentid' class='form-control'>
                        <option value=''></option>
                        <option value='0' <?php  if($_GPC['parentid']=='0') { ?>selected<?php  } ?>>总店</option>
                    </select>
                </div>
                 <div class="col-sm-6">
                    <input type="text"  class="form-control" name="parentname" value="<?php  echo $_GPC['parentname'];?>" placeholder='推荐人昵称/姓名/手机号'/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                <div class="col-sm-3 col-lg-2"><button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button></div>
            </div>
 
      
    </div>
     </form>
 
<div class="panel panel-default">
    <div class="panel-heading">总数：<?php  echo $total;?></div>
    <div class="panel-body">
        <table class="table table-hover"   style="overflow:visible;">
            <thead class="navbar-inner">
                <tr>
                     <th style='width:80px;'>会员ID</th>
                     <th style='width:120px;'>推荐人</th>
                    <th style='width:120px;'>粉丝</th>
                    <th style='width:110px;'>姓名<br/>手机号码</th>
                    <th style='width:80px;'>分销等级</th>
                    <th style='width:80px;'>点击数</th>
                    <th style='width:100px;'>累计佣金<br/>打款佣金</th>
                    <th style='width:120px;'>下级分销商</th>
                    <th style='width:100px;'>状态<?php if(cv('commission.agent.check')) { ?><br/>（点击审核)<?php  } ?></th>
                    <th style='width:200px;'>时间</th>
                     <th style='width:70px'>关注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                      <td><?php  echo $row['id'];?></td>
                      <td  <?php  if(!empty($row['agentid'])) { ?>title='ID: <?php  echo $row['agentid'];?>'<?php  } ?>>
                           <?php  if(empty($row['agentid'])) { ?>
                           <?php  if($row['isagent']==1) { ?>
				      <label class='label label-primary'>总店</label>
				      <?php  } else { ?>
				       <label class='label label-default'>暂无</label>
				      <?php  } ?>
                          <?php  } else { ?>
                          <img src='<?php  echo $row['parentavatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['parentname'];?>
                          <?php  } ?>
                      </td>
                    <td> 
                    <?php  if(!empty($row['avatar'])) { ?>
                         <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                       <?php  } ?>
                       <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                        
                    </td>
                    
                    <td><?php  echo $row['realname'];?> <br/> <?php  echo $row['mobile'];?></td>
<td>
	<?php  if($row['isagent']==1) { ?>
	<?php  if(empty($row['levelname'])) { ?> 
	<?php echo empty($this->set['levelname'])?'普通等级':$this->set['levelname']?><?php  } else { ?><?php  echo $row['levelname'];?><?php  } ?>
	<?php  } else { ?>
			-
			<?php  } ?>

</td>
                    <td> 	<?php  if($row['isagent']==1) { ?>
						<?php  echo $row['clickcount'];?>
						<?php  } else { ?>
			-
			<?php  } ?>
					</td>
                    <td>
						<?php  if($row['isagent']==1 && $row['status']==1) { ?>
						<?php  echo $row['commission_total'];?><br/><?php  echo $row['commission_pay'];?>
					
						<?php  } else { ?>
			-
			<?php  } ?>
					</td>
                    <td>
						<?php  if($row['isagent']==1) { ?>
                        总计：<?php  echo $row['levelcount'];?> 人
                        <?php  if($level>=1 && $row['level1']>0) { ?><br/>一级：<?php  echo $row['level1'];?> 人<?php  } ?>
                        <?php  if($level>=2  && $row['level2']>0) { ?><br/> 二级：<?php  echo $row['level2'];?> 人<?php  } ?>
                        <?php  if($level>=3  && $row['level3']>0) { ?><br/>三级：<?php  echo $row['level3'];?> 人<?php  } ?>
					
						<?php  } else { ?>
			-
			<?php  } ?>
					</td>
                    <td>
						<?php  if($row['isagent']==1) { ?>
                        <?php  if($row['status']==0) { ?>
                                <?php  if($row['agentblack']==1) { ?>
                                  <span class="label label-default" style='color:#fff;background:black'>黑名单</span>
                                <?php  } else { ?>
                                  
                                   <?php if(cv('commission.agent.check')) { ?>
                                   <a class="label label-default" href="<?php  echo $this->createPluginWebUrl('commission/agent',array('id' => $row['id'],'op'=>'check'))?>" onclick="return confirm('确认要审核此分销商吗?')">未审核</a>
                                   <?php  } else { ?>
                                  <span class="label label-default">未审核</span>
                                  <?php  } ?>
                                <?php  } ?>
                        <?php  } else { ?>
                        <span class="label label-success">已审核</span>
                        <?php  } ?>
				<?php  } else { ?>
			-
			<?php  } ?>		
			 
                    </td>
                    <td>注册时间：<?php  echo date('Y-m-d H:i',$row['createtime'])?><br/>
                              代理时间：<?php  if(!empty($row['agenttime'])) { ?><?php  echo date('Y-m-d H:i',$row['agenttime'])?><?php  } ?> 
                    </td>
                       <td>  <?php  if(empty($row['followed'])) { ?>
                      <?php  if(empty($row['uid'])) { ?>
                        <label class='label label-default'>未关注</label>
                        <?php  } else { ?>
                        <label class='label label-warning'>取消关注</label>
                        <?php  } ?>
                        <?php  } else { ?>
                    <label class='label label-success'>已关注</label>    
                    <?php  } ?></td>
                    <td  style="overflow:visible;">
                        
                        <div class="btn-group btn-group-sm">
                                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="javascript:;">操作 <span class="caret"></span></a>
                                   <ul class="dropdown-menu dropdown-menu-left" role="menu" style='z-index: 99999'>
                         <?php if(cv('member.member.view')) { ?><li><a href="<?php  echo $this->createWebUrl('member',array('op'=>'detail', 'id' => $row['id']));?>" title='会员信息'><i class='fa fa-user'></i> 会员信息</a></li>	<?php  } ?>
                                    <?php if(cv('commission.agent.view')) { ?><li><a href="<?php  echo $this->createPluginWebUrl('commission/agent/detail',array('id' => $row['id']));?>" title='详细信息'><i class='fa fa-edit'></i> 详细信息</a>	</li>	<?php  } ?>
                        <?php if(cv('commission.agent.order')) { ?><li><a  href="<?php  echo $this->createWebUrl('order',array('op'=>'display','agentid' => $row['id']));?>" title='推广订单'><i class='fa fa-list'></i> 推广订单</a></li><?php  } ?>
                        <?php if(cv('commission.agent.user')) { ?><li><a  href="<?php  echo $this->createPluginWebUrl('commission/agent/user',array('id' => $row['id']));?>"  title='推广下线'><i class='fa fa-users'></i> 推广下线</a></li><?php  } ?>
                        <?php if(cv('commission.agent.agentblack')) { ?>
                          <?php  if($row['agentblack']==1) { ?> 
                          <li><a href="<?php  echo $this->createPluginWebUrl('commission/agent/agentblack',array('id' => $row['id'],'black'=>0));?>" title='取消黑名单'><i class='fa fa-minus-square'></i> 取消黑名单</a></li>
                           <?php  } else { ?>
                           <li><a href="<?php  echo $this->createPluginWebUrl('commission/agent/agentblack',array('id' => $row['id'],'black'=>1));?>" title='设置黑名单'><i class='fa fa-minus-circle'></i> 设置黑名单</a></li>
                           <?php  } ?>
                        <?php  } ?>
                        <?php if(cv('commission.agent.delete')) { ?><li><a href="<?php  echo $this->createPluginWebUrl('commission/agent/delete',array('id' => $row['id']));?>" title="删除" onclick="return confirm('确定要删除该会员吗？');"><i class='fa fa-remove'></i> &nbsp;删除分销商</a></li><?php  } ?>
                
                                </ul>
                            </div>

               
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
