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
            <input type="hidden" name="p" value="changeAgent" />
            <input type="hidden" name="method" value="index" />
            <input type="hidden" name="op" value="display" />
            <div class="form-group">
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
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">代理商等级</label>
                    <div class="col-sm-5">
                        <select name='agentlevels' class='form-control'>
                            <option value=''>全部</option>
                            <option value="0" <?php  if($_GPC['agentlevels']=='0') { ?>selected<?php  } ?>>加盟商</option>
                            <option value="1" <?php  if($_GPC['agentlevels']=='1') { ?>selected<?php  } ?>>渠道商</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name='agentlevel' class='form-control'>
                            <option value=''></option>
                            <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
                            <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['agentlevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">区域代理</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <select name='bonus_area' class='form-control'>
                            <option value=''>全部等级</option>
                            <option value='1' <?php  if($_GPC['bonus_area']=='1') { ?>selected<?php  } ?>>省级代理</option>
                            <option value='2' <?php  if($_GPC['bonus_area']=='2') { ?>selected<?php  } ?>>市级代理</option>
                            <option value='3' <?php  if($_GPC['bonus_area']=='3') { ?>selected<?php  } ?>>区级代理</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">区域选择</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <?php  echo tpl_fans_form('reside',array('province' => $_GPC['reside']['province'],'city' => $_GPC['reside']['city'],'district' => $_GPC['reside']['district']));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php if(cv('bonus.agent.export')) { ?>
                        <!-- <button type="submit" name="export" value="1" class="btn btn-primary">导出 Excel</button> -->
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

                <th style='width:3%;'></th>
                <th style='width:5%;'>会员ID</th>
                <th style='width:10%;'>推荐人</th>
                <th style='width:10%;'>粉丝</th>
                <th style='width:10%;'>姓名<br/>手机号码</th>
                <th style='width:10%;'>等级</th>
                <th style='width:10%;'>区域代理</th>
                <th style='width:10%;;'>累计分红佣金<br/>发放分红佣金</th>
                <th style='width:10%;;'>下级总数</th>
                <th style='width:5%;'>关注</th>
                <th style='width:17%;'>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td><input type="checkbox" class="changeAgentCheckBox" value="<?php  echo $row['id'];?>"/></td>
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
                <td><?php  if($row['agentlevels']==1) { ?>
                    <label class='label label-primary'>渠道商</label>
                    <?php  } else { ?>
                    <label class='label label-default'>加盟商</label>
                    <?php  } ?>
                </td>
                <td>
                    <?php  if($row['bonus_area'] == 0) { ?>无<?php  } ?>
                    <?php  if($row['bonus_area'] == 1) { ?>省级代理：<?php  echo $row['bonus_province'];?><?php  } ?>
                    <?php  if($row['bonus_area'] == 2) { ?>市级代理：<?php  echo $row['bonus_city'];?><?php  } ?>
                    <?php  if($row['bonus_area'] == 3) { ?>区级代理：<?php  echo $row['bonus_district'];?><?php  } ?>
                </td>
                <td><?php  echo $row['commission_total'];?><br/><?php  echo $row['commission_pay'];?></td>
                <td>
                    总计：<?php  echo $row['levelcount'];?> 人
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
                        <?php  if($row['agentlevels']!=1) { ?>
                        <a class="btn btn-default"  href="<?php  echo $this->createPluginWebUrl('changeAgent/index/changeAgentLevels',array('id' => $row['id'],'type'=>up))?>">升级为渠道商 </a>
                        <?php  } else { ?>
                        <a class="btn btn-default"  href="<?php  echo $this->createPluginWebUrl('changeAgent/index/changeAgentLevels',array('id' => $row['id'],'type'=>down))?>">降级为加盟商 </a>
                        <?php  } ?>
                    </div>


                    <?php  if($row['agentlevels']!=1) { ?>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="javascript:;">更改推荐人 <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu" style='z-index: 99999'>
                            <?php  if(is_array($agentList)) { foreach($agentList as $row2) { ?>
                            <li class="changeAgent"><a href="<?php  echo $this->createPluginWebUrl('changeAgent/index/changeAgent',array('id' => $row['id'],'agentid'=>$row2['id']))?>"><?php  echo $row2['realname'];?></a></li>
                            <?php  } } ?>
                        </ul>
                    </div>
                    <?php  } ?>
                </td>
            </tr>
            <?php  } } ?>
            <tr>
                <td colspan="11">
                    <div class="form-group">
                        <div class="col-sm-1">
                            <button class="btn btn-default" id="batchChangeAgentAllButton">全选</button>
                            <button class="btn btn-default" id="batchChangeAgentNotAllButton">反选</button>
                        </div>
                        <div class="col-sm-2">
                            <select id='changeAgentLevelList' class='form-control'>
                                <option value=''>请选择渠道商：</option>
                                <?php  if(is_array($agentList)) { foreach($agentList as $row2) { ?>
                                <option value='<?php  echo $row2['id'];?>'><?php  echo $row2['realname'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-default" id="batchChangeAgentSubmitButton">更改推荐人</button>
                        </div>

                        <div class="col-sm-1">

                        </div>

                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-1">
                            <!--<a href="" target="_blank">下载导入模板</a>-->
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //$(".changeAgentCheckBox").attr("checked",false);
        $("#batchChangeAgentAllButton").click(function(){
            $(".changeAgentCheckBox").prop("checked",true);
        });
        $("#batchChangeAgentNotAllButton").click(function(){
            $(".changeAgentCheckBox").each(function(){
                $(this).prop("checked", !$(this).is(":checked"));
            });
        });
        $("#batchChangeAgentSubmitButton").click(function(){
            willCheckedIdString=$.param($(".changeAgentCheckBox:checked"));
            willCheckedIdString=willCheckedIdString.replace(/&/g,'');
            willCheckedIdString=willCheckedIdString.replace(/=/g,',');
            willCheckedIdString=willCheckedIdString.replace(/^,/g,'');
            if(willCheckedIdString==""){
                alert("请勾选需要更改的粉丝！");
                return;
            }
            agentId=$("#changeAgentLevelList").val();
            if(agentId==""){
                alert("请选择渠道商！");
                return;
            }
            url='<?php  echo $this->createPluginWebUrl("changeAgent/index/batchChangeAgent")?>'+'&agentId='+agentId+'&ids='+willCheckedIdString;
            location.href=url;
        });
    });
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>