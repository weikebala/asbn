<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.input-group{
    width: 40%;
    float: left;
    margin-left: 90px
}
.col-md-2 {
    width: 120px;
}
</style>
<div class="panel panel-info">
    <div class="panel-heading">条件</div>
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="op" value="sub_bonus" />
            <input type="hidden" name="everyonemoney" value="<?php  echo $everyonemoney;?>" />
            <input type="hidden" name="bonus_money" value="<?php  echo $bonus_money;?>" />
            <input type="hidden" name="starttime_order" value="<?php  echo $starttime_order;?>" />
            <input type="hidden" name="endtime_order" value="<?php  echo $endtime_order;?>" />
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">订单总金额</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <span style='color:red'><?php  echo $ordermoney;?></span>&nbsp;元
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">共计分红人数</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <span style='color:red'><?php  echo $total;?></span>&nbsp;人
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">共计分红金额</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <span style='color:red'><?php  echo $totalmoney;?></span>&nbsp;元
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">打款方式</label>
                    <div class="col-sm-9 col-xs-12">
                    <div class="input-group" style="margin-left:0">
                      <?php  if($set['paymethod']==0) { ?>打款到站内余额<?php  } ?>
                      <?php  if($set['paymethod']==1) { ?>打款到微信钱包<?php  } ?>
                    </div>
                </div>
            </div>
            <?php  if($set['sendmethod'] == 1) { ?>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                    <div class="input-group" style="margin-left:0">
                      已选择自动打款不能操作
                    </div>
                </div>
            </div>
            <?php  } else { ?>
            <div class="form-group" style="text-align: center;">
                <?php if(cv('bonus.sendall.bont')) { ?>
                <div class="col-sm-3 col-lg-2"><button class="btn btn-default" style="background-color: #428bca;color:#fff;width:200px;">全球分红发放</button></div>
                <?php  } ?>
            </div>
            <?php  } ?>
         </form> 
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">分红总金额：<?php  if(!empty($totalmoney)) { ?><?php  echo $totalmoney;?>元<?php  } else { ?>0元<?php  } ?></div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style='width:14%;'>id</th>
                    <th style='width:14%;'>姓名</th>
                    <th style='width:14%;'>真实姓名</th>
                    <th style='width:14%;'>级别</th>
                    <th style='width:14%;'>手机号</th>
                    <th style='width:14%;'>已分红</th>
                    <th style='width:14%;'>待分红</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td>
                        <?php  if(!empty($row['avatar'])) { ?>
                        <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                        <?php  } ?>
                        <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                    </td>
                    <td><?php  echo $row['realname'];?></td>
                    <td><?php  echo $row['levelname'];?></td>
                    <td><?php  echo $row['mobile'];?></td>
                    <td>
                        <?php  echo $row['commission_pay'];?>
                    </td>
                    <td><?php  echo $row['commission_ok'];?></td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>