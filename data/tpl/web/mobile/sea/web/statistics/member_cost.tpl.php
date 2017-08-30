<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/statistics/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/statistics/tabs', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-info">
    <div class="panel-heading">会员消费排行</div>
    <div class="panel-body">

        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="statistics" />
            <input type="hidden" name="p" value="member_cost" />
                <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">会员名/手机号</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                      <input name="realname" type="text"  class="form-control" value="<?php  echo $_GPC['realname'];?>">
                </div>
            </div>
               <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">类型</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <label class="radio-inline"><input type="radio" name="orderby" value="ordercount" <?php  if($_GPC['orderby'] == 'ordercount') { ?>checked<?php  } ?>>订单数</label>
                    <label class="radio-inline"><input type="radio" name="orderby" value="ordermoney" <?php  if(empty($_GPC['orderby']) || $_GPC['orderby'] == 'ordermoney') { ?>checked<?php  } ?>>消费金额</label>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <button class="btn btn-default" ><i class="fa fa-search"></i> 搜索</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    <button type="submit" name="export" value='1' class="btn btn-primary">导出 Excel</button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
          <table class="table table-hover">
            <thead>
                <tr>
                    <th style='width:80px;'>排行</th>
                    <th>粉丝</th>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>等级</th>
                    <th>消费金额</th>
                    <th>订单数</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $key => $item) { ?>
                <tr>
                   <td><?php  if(($pindex -1)* $psize + $key + 1<=3) { ?>
                             <labe class='label label-danger' style='padding:8px;'>&nbsp;<?php  echo ($pindex -1)* $psize + $key + 1?>&nbsp;</labe>
                            <?php  } else { ?>
                             <labe class='label label-default'  style='padding:8px;'>&nbsp;<?php  echo ($pindex -1)* $psize + $key + 1?>&nbsp;</labe>
                           <?php  } ?>
                    </td>
                    <td><img src="<?php  echo $item['avatar'];?>" style='padding:1px;width:30px;height:30px;border:1px solid #ccc' />
                        <?php  echo $item['nickname'];?></td>
                    <td><?php  echo $item['realname'];?></td>
                    <td><?php  echo $item['mobile'];?></td>
                    <td><?php  if(empty($item['levelname'])) { ?> <?php echo empty($shop['levelname'])?'普通会员':$shop['levelname']?> <?php  } else { ?><?php  echo $item['levelname'];?><?php  } ?></td>
                    <td><?php  echo $item['ordermoney'];?></td>
                    <td><?php  echo $item['ordercount'];?></td>
                </tr>
                <?php  } } ?>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
