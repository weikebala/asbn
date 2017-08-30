<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation=='display') { ?>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="plugin" />
            <input type="hidden" name="p" value="commission" />
            <input type="hidden" name="method" value="agent" />
            <input type="hidden" name="op" value="display" />
            <div class="form-group">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">成为加盟商时间</label>
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
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">加盟商等级</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <select name='agentlevel' class='form-control'>
                            <option value=''></option>
                            <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
                            <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['agentlevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                    <div class="col-sm-4">
                        <select name='status' class='form-control'>
                            <option value=''>审核状态</option>
                            <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>未审核</option>
                            <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>>已审核</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name='agentblack' class='form-control'>
                            <option value=''>黑名单状态</option>
                            <option value='0' <?php  if($_GPC['agentblack']=='0') { ?>selected<?php  } ?>>否</option>
                            <option value='1' <?php  if($_GPC['agentblack']=='1') { ?>selected<?php  } ?>>是</option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php if(cv('commission.agent.export')) { ?>
                        <button type="submit" name="export" value="1" class="btn btn-primary">导出 Excel</button>
                        <?php  } ?>
                    </div>
                </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">总数：<?php  echo $total;?></div>
    <div class="panel-body">
        <table class="table table-hover table-responsive">
            <thead class="navbar-inner" >
            <tr>
                <th style='width:80px;'>会员ID</th>
                <th style='width:120px;'>推荐人</th>
                <th style='width:120px;'>粉丝</th>
                <th style='width:110px;'>姓名<br/>手机号码</th>
                <th style='width:80px;'>加盟等级</th>
                <th style='width:80px;'>点击数</th>
                <th style='width:100px;'>累计佣金<br/>打款佣金</th>
                <th style='width:120px;'>下级加盟商</th>
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
                <td><?php  if(empty($row['levelname'])) { ?> <?php echo empty($this->set['levelname'])?'普通等级':$this->set['levelname']?><?php  } else { ?><?php  echo $row['levelname'];?><?php  } ?></td>
                <td><?php  echo $row['clickcount'];?></td>
                <td><?php  echo $row['commission_total'];?><br/><?php  echo $row['commission_pay'];?></td>
                <td>
                    总计：<?php  echo $row['levelcount'];?> 人
                    <?php  if($level>=1 && $row['level1']>0) { ?><br/>一级：<?php  echo $row['level1'];?> 人<?php  } ?>
                    <?php  if($level>=2  && $row['level2']>0) { ?><br/> 二级：<?php  echo $row['level2'];?> 人<?php  } ?>
                    <?php  if($level>=3  && $row['level3']>0) { ?><br/>三级：<?php  echo $row['level3'];?> 人<?php  } ?></td>
                <td>
                    <?php  if($row['status']==0) { ?>
                    <?php  if($row['agentblack']==1) { ?>
                    <span class="label label-default" style='color:#fff;background:black'>黑名单</span>
                    <?php  } else { ?>

                    <?php if(cv('commission.agent.check')) { ?>
                    <a class="label label-default" href="<?php  echo $this->createPluginWebUrl('commission/agent',array('id' => $row['id'],'op'=>'check'))?>" onclick="return confirm('确认要审核此加盟商吗?')">未审核</a>
                    <?php  } else { ?>
                    <span class="label label-default">未审核</span>
                    <?php  } ?>
                    <?php  } ?>
                    <?php  } else { ?>
                    <span class="label label-success">已审核</span>
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
                            <?php if(cv('commission.agent.delete')) { ?><li><a href="<?php  echo $this->createPluginWebUrl('commission/agent/delete',array('id' => $row['id']));?>" title="删除" onclick="return confirm('确定要删除该会员吗？');"><i class='fa fa-remove'></i> &nbsp;删除加盟商</a></li><?php  } ?>

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
<?php  } else if($operation=='detail') { ?>

<form <?php if(cv('commission.agent.edit|commission.agent.check')) { ?>action="" method='post'<?php  } ?> class='form-horizontal'>
<input type="hidden" name="id" value="<?php  echo $member['id'];?>">
<input type="hidden" name="op" value="detail">
<input type="hidden" name="c" value="site" />
<input type="hidden" name="a" value="entry" />
<input type="hidden" name="m" value="sea" />
<input type="hidden" name="p" value="commission" />
<input type="hidden" name="method" value="agent" />
<input type="hidden" name="op" value="detail" />
<div class='panel panel-default'>
    <div class='panel-heading'>
        加盟商详细信息
    </div>
    <div class='panel-body'>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">粉丝</label>
            <div class="col-sm-9 col-xs-12">
                <img src='<?php  echo $member['avatar'];?>' style='width:100px;height:100px;padding:1px;border:1px solid #ccc' />
                <?php  echo $member['nickname'];?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">OPENID</label>
            <div class="col-sm-9 col-xs-12">
                <div class="form-control-static"><?php  echo $member['openid'];?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">真实姓名</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <input type="text" name="data[realname]" class="form-control" value="<?php  echo $member['realname'];?>"  />
                <?php  } else { ?>
                <input type="hidden" name="data[realname]" class="form-control" value="<?php  echo $member['realname'];?>"  />
                <div class='form-control-static'><?php  echo $member['realname'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号码</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <input type="text" name="data[mobile]" class="form-control" value="<?php  echo $member['mobile'];?>"  />
                <?php  } else { ?>
                <input type="hidden" name="data[mobile]" class="form-control" value="<?php  echo $member['mobile'];?>"  />
                <div class='form-control-static'><?php  echo $member['mobile'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">微信号</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <input type="text" name="data[weixin]" class="form-control" value="<?php  echo $member['weixin'];?>"  />
                <?php  } else { ?>
                <input type="hidden" name="data[weixin]" class="form-control" value="<?php  echo $member['weixin'];?>"  />
                <div class='form-control-static'><?php  echo $member['weixin'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">加盟商等级</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <select name='data[agentlevel]' class='form-control'>
                    <option value='0'><?php echo empty($this->set['levelname'])?'普通等级':$this->set['levelname']?></option>
                    <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
                    <option value='<?php  echo $level['id'];?>' <?php  if($member['agentlevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                    <?php  } } ?>
                </select>
                <?php  } else { ?>
                <input type="hidden" name="data[agentlevel]" class="form-control" value="<?php  echo $member['agentlevel'];?>"  />

                <?php  if(empty($member['agentlevel'])) { ?>
                <?php echo empty($this->set['levelname'])?'普通等级':$this->set['levelname']?>
                <?php  } else { ?>
                <?php  echo pdo_fetchcolumn('select levelname from '.tablename('sea_commission_level').' where id=:id limit 1',array(':id'=>$member['agentlevel']))?>
                <?php  } ?>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">累计佣金</label>
            <div class="col-sm-9 col-xs-12">
                <div class='form-control-static'> <?php  echo $member['commission_total'];?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">已打款佣金</label>
            <div class="col-sm-9 col-xs-12">
                <div class='form-control-static'> <?php  echo $member['commission_pay'];?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册时间</label>
            <div class="col-sm-9 col-xs-12">
                <div class='form-control-static'><?php  echo date('Y-m-d H:i:s', $member['createtime']);?></div>
            </div>
        </div>
        <?php  if($member['agenttime']!='1970-01-01 08:00') { ?>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">成为代理时间</label>
            <div class="col-sm-9 col-xs-12">
                <div class='form-control-static'><?php  if(!strexists('1970',$member['agenttime'])) { ?><?php  echo $member['agenttime'];?><?php  } else { ?>----------<?php  } ?></div>
            </div>
        </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">加盟商权限</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.check')) { ?>
                <label class="radio-inline"><input type="radio" name="data[isagent]" value="1" <?php  if($member['isagent']==1) { ?>checked<?php  } ?>>是</label>
                <label class="radio-inline" ><input type="radio" name="data[isagent]" value="0" <?php  if($member['isagent']==0) { ?>checked<?php  } ?>>否</label>
                <?php  } else { ?>
                <input type='hidden' name='data[isagent]' value='<?php  echo $member['isagent'];?>' />
                <div class='form-control-static'><?php  if($member['isagent']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
                <?php  } ?>

            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">审核通过</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.check')) { ?>
                <label class="radio-inline"><input type="radio" name="data[status]" value="1" <?php  if($member['status']==1) { ?>checked<?php  } ?>>是</label>
                <label class="radio-inline" ><input type="radio" name="data[status]" value="0" <?php  if($member['status']==0) { ?>checked<?php  } ?>>否</label>
                <input type='hidden' name='oldstatus' value="<?php  echo $member['status'];?>" />
                <?php  } else { ?>
                <input type='hidden' name='data[status]' value='<?php  echo $member['status'];?>' />
                <div class='form-control-static'><?php  if($member['status']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">强制不自动升级</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <label class="radio-inline" ><input type="radio" name="data[agentnotupgrade]" value="0" <?php  if($member['agentnotupgrade']==0) { ?>checked<?php  } ?>>允许自动升级</label>
                <label class="radio-inline"><input type="radio" name="data[agentnotupgrade]" value="1" <?php  if($member['agentnotupgrade']==1) { ?>checked<?php  } ?>>强制不自动升级</label>
                <span class="help-block">如果强制不自动升级，满足任何条件，此加盟商的级别也不会改变</span>
                <?php  } else { ?>
                <input type="hidden" name="data[agentnotupgrade]" class="form-control" value="<?php  echo $member['agentnotupgrade'];?>"  />
                <div class='form-control-static'><?php  if($member['agentnotupgrade']==1) { ?>强制不自动升级<?php  } else { ?>允许自动升级<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">自选商品</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <label class="radio-inline" ><input type="radio" name="data[agentselectgoods]" value="0" <?php  if($member['agentselectgoods']==0) { ?>checked<?php  } ?>>系统设置</label>
                <label class="radio-inline"><input type="radio" name="data[agentselectgoods]" value="1" <?php  if($member['agentselectgoods']==1) { ?>checked<?php  } ?>>强制禁止</label>
                <label class="radio-inline"><input type="radio" name="data[agentselectgoods]" value="2" <?php  if($member['agentselectgoods']==2) { ?>checked<?php  } ?>>强制开启</label>
                <span class="help-block">系统设置： 跟随系统设置，系统关闭自选则为禁止，系统开启自选则为允许</span>
                <span class="help-block">强制禁止： 无论系统自选商品是否关闭或开启，此加盟商永不能自选商品</span>
                <span class="help-block">强制允许： 无论系统自选商品是否关闭或开启，此加盟商永可以自选商品</span>
                <?php  } else { ?>
                <input type="hidden" name="data[agentselectgoods]" class="form-control" value="<?php  echo $member['agentselectgoods'];?>"  />
                <div class='form-control-static'><?php  if($member['agentnotselectgoods']==1) { ?>
                    强制禁止
                    <?php  } else if($member['agentselectgoods']==2) { ?>
                    强制允许
                    <?php  } else { ?>
                    <?php  if($this->set['select_goods']==1) { ?>系统允许<?php  } else { ?>系统禁止<?php  } ?>
                    <?php  } ?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">黑名单</label>
            <div class="col-sm-9 col-xs-12">
                <input type='hidden' name='oldagentblack' value="<?php  echo $member['agentblack'];?>" />
                <?php if(cv('commission.agent.agentblack')) { ?>
                <label class="radio-inline"><input type="radio" name="data[agentblack]" value="1" <?php  if($member['agentblack']==1) { ?>checked<?php  } ?>>是</label>
                <label class="radio-inline" ><input type="radio" name="data[agentblack]" value="0" <?php  if($member['agentblack']==0) { ?>checked<?php  } ?>>否</label>
                <?php  } else { ?>
                <input type='hidden' name='data[agentblack]' value='<?php  echo $member['agentblack'];?>' />
                <div class='form-control-static'><?php  if($member['agentblack']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit')) { ?>
                <textarea name="content" class='form-control'><?php  echo $member['content'];?></textarea>
                <?php  } else { ?>
                <textarea name="content" class='form-control' style='display:none'><?php  echo $member['content'];?></textarea>
                <div class='form-control-static'><?php  echo $member['content'];?></div>
                <?php  } ?>
            </div>
        </div>

    </div>

    <?php  if($diyform_flag == 1) { ?>
    <div class='panel-heading'>
        自定义表单信息
    </div>
    <div class='panel-body'>
        <!--<span>diyform</span>-->

        <?php  $datas = iunserializer($member['diycommissiondata'])?>
        <?php  if(is_array($fields)) { foreach($fields as $key => $value) { ?>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $value['tp_name']?></label>
            <div class="col-sm-9 col-xs-12">
                <div class="form-control-static">

                    <?php  if($value['data_type'] == 0 || $value['data_type'] == 1 || $value['data_type'] == 2 || $value['data_type'] == 6) { ?>
                    <?php  echo str_replace("\n","<br/>",$datas[$key])?>

                    <?php  } else if($value['data_type'] == 3) { ?>
                    <?php  if(!empty($datas[$key])) { ?>
                    <?php  if(is_array($datas[$key])) { foreach($datas[$key] as $k1 => $v1) { ?>
                    <?php  echo $v1?>
                    <?php  } } ?>
                    <?php  } ?>

                    <?php  } else if($value['data_type'] == 5) { ?>
                    <?php  if(!empty($datas[$key])) { ?>
                    <?php  if(is_array($datas[$key])) { foreach($datas[$key] as $k1 => $v1) { ?>
                    <a target="_blank" href="<?php  echo tomedia($v1)?>"><img style='width:100px;padding:1px;border:1px solid #ccc'  src="<?php  echo tomedia($v1)?>"></a>
                    <?php  } } ?>
                    <?php  } ?>

                    <?php  } else if($value['data_type'] == 7) { ?>
                    <?php  echo $datas[$key]?>

                    <?php  } else if($value['data_type'] == 8) { ?>
                    <?php  if(!empty($datas[$key])) { ?>
                    <?php  if(is_array($datas[$key])) { foreach($datas[$key] as $k1 => $v1) { ?>
                    <?php  echo $v1?>
                    <?php  } } ?>
                    <?php  } ?>
 
                    <?php  } else if($value['data_type'] == 9) { ?>
                    <?php echo $datas[$key]['province']!='请选择省份'?$datas[$key]['province']:''?>-<?php echo $datas[$key]['city']!='请选择城市'?$datas[$key]['city']:''?>
                    <?php  } ?>
                </div>

            </div>
        </div>

        <?php  } } ?>
    </div>
    <?php  } ?>

    <div class='panel-body'>

        <div class="form-group"></div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.agent.edit|commission.agent.check')) { ?>
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                <?php  } ?>
                <input type="button" name="back" onclick='history.back()' <?php if(cv('commission.agent.edit|commission.agent.check')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
            </div>
        </div>


    </div>


</div>

</form>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>

