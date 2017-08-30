<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
 
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="plugin" />
            <input type="hidden" name="p" value="coupon" />
            <input type="hidden" name="method" value="log" />
            <div class="form-group">
              
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">优惠券</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" class="form-control"  name="coupon" value="<?php  echo $_GPC['coupon'];?>" placeholder='可搜索优惠券ID/名称'/> 
                </div>
            </div>
             <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">会员信息</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" class="form-control"  name="realname" value="<?php  echo $_GPC['realname'];?>" placeholder='可搜索会员昵称/会员姓名/会员手机号'/> 
                </div>
            </div>
              <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">类型</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <select name='type' class='form-control'>
                        <option value=''></option>
                        <option value='0' <?php  if($_GPC['type']=='0') { ?>selected<?php  } ?>>消费</option>
                        <option value='1' <?php  if($_GPC['type']=='1') { ?>selected<?php  } ?>>充值</option>
                        <option value='2' <?php  if($_GPC['type']=='2') { ?>selected<?php  } ?>>关注</option>
                    </select>
                  </div>
            </div>
                 <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">是否使用</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <select name='used' class='form-control'>
                        <option value=''></option>
                        <option value='0' <?php  if($_GPC['used']=='0') { ?>selected<?php  } ?>>未使用</option>
                        <option value='1' <?php  if($_GPC['used']=='1') { ?>selected<?php  } ?>>已使用</option>
                    </select>
                  </div>
            </div>
                  <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">获得方式</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <select name='getfrom' class='form-control'>
                        <option value=''></option>
                        <option value='0' <?php  if($_GPC['getfrom']=='0') { ?>selected<?php  } ?>>后台发放</option>
                        <option value='1' <?php  if($_GPC['getfrom']=='5') { ?>selected<?php  } ?>>口令优惠券</option>
                        <option value='1' <?php  if($_GPC['getfrom']=='1') { ?>selected<?php  } ?>>领券中心</option>
                        <option value='2' <?php  if($_GPC['getfrom']=='2') { ?>selected<?php  } ?>>积分商城</option>
		       <option value='2' <?php  if($_GPC['getfrom']=='3') { ?>selected<?php  } ?>>超级海报</option>
			<option value='4' <?php  if($_GPC['getfrom']=='4') { ?>selected<?php  } ?>>活动海报</option>
                    </select>
                  </div>
            </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">获得时间</label>
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
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">使用时间</label>
                    <div class="col-sm-7 col-lg-9 col-xs-12">
                        <div class="col-sm-2">
                            <label class='radio-inline'>
                                <input type='radio' value='0' name='searchtime1' <?php  if($_GPC['searchtime1']=='0') { ?>checked<?php  } ?>>不搜索
                            </label> 
                             <label class='radio-inline'>
                                <input type='radio' value='1' name='searchtime1' <?php  if($_GPC['searchtime1']=='1') { ?>checked<?php  } ?>>搜索
                            </label>
                     </div>
                        <?php  echo tpl_form_field_daterange('time1', array('starttime'=>date('Y-m-d H:i', $starttime1),'endtime'=>date('Y-m-d  H:i', $endtime1)),true);?>
                    </div>
                </div>
<div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                       <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                       <?php if(cv('coupon.coupon.logexport')) { ?>   
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
                    <th style='width:40px;'>ID</th>
                    <th style='width:150px;'>优惠券名称</th>
                    <th style='width:100px;'>会员信息</th>
                    <th style='width:120px;'></th>
                    <th style='width:80px;'>获得方式</th>
                    <th style='width:120px;'>获得时间</th>
	                <th style='width:120px;'>使用时间</th>
                    <th style='width:120px;'>使用单号</th>
                    <th style='width:50px;'>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                      <td><?php  echo $row['id'];?></td>
		    <td><?php  if($row['coupontype']==0) { ?>
				  <label class='label label-success'>消费</label>
						  <?php  } else if($row['coupontype']==1) { ?>
						  <label class='label label-warning'>充值</label>
                          <?php  } else { ?>
                <label class='label label-warning'>关注</label>
					 <?php  } ?> <?php  echo $row['couponname'];?>
					  </td>
                                          <td>
                                                  <?php  if(!empty($row['avatar'])) { ?>
                         <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                       <?php  } ?>
                       <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                                          </td>
                                          <td>
                                              <?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?>
                                          </td>
                     <td><?php  echo $row['gettypestr'];?></td>
		<td><?php  echo $row['gettime'];?></td>			 
                <td><?php  echo $row['usetime'];?></td>
					 
					<td><?php echo empty($row['ordersn'])?'---':$row['ordersn']?></td>
                    <td style="position:relative">
                        <?php if(cv('coupon.log.delete')) { ?>
                        <a class='btn btn-default  btn-sm' href="<?php  echo $this->createPluginWebUrl('coupon/log/delete',array('id' => $row['id']));?>" title="删除" onclick="return confirm('确定要删除该优惠券吗？');"><i class='fa fa-remove'></i></a>
                        <?php  } ?>
                    </td>
 
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
    <div class='panel-footer'>
     
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
