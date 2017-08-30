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
<?php  if($operation == "display") { ?>
<div class="panel panel-default">
    <div class="panel-heading">奖励详情</div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style='width:5%;'>会员id</th>
                    <th style='width:10%;'>粉丝</th>
                    <th style='width:10%;'>姓名</th>
                    <th style='width:10%;'>电话</th>
                    <th style='width:10%;'>账户余额</th>
                    <th style='width:10%;'>分红金额</th>
                    <th style='width:10%;'>账户积分</th>
                    <th style='width:10%;'>分红积分</th>
                    <th style='width:10%;'>打款方式</th>
                    <th style='width:15%;'>时间</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($logs)) { foreach($logs as $row) { ?>
                <tr>
                    <td><?php  echo $row['member_id'];?></td>
                    <td><img style="width:30px;height:30px;padding1px;border:1px solid #ccc" src="<?php  echo $row['avatar'];?>">
<?php  echo $row['nickname'];?> </td>
                    <td><?php  echo $row['realname'];?></td>
                    <td><?php  echo $row['mobile'];?></td>
                    <td><?php  echo $row['credit2'];?></td>
                    <td><?php  echo $row['money'];?></td>
                    <td><?php  echo $row['credit1'];?></td>
                    <td><?php  echo $row['integral'];?></td>
                    <td><?php  if($row['paystatus']==1) { ?>微信钱包<?php  } else { ?>账户余额<?php  } ?></td>
                    <td><?php  echo date("Y-m-d H:i:s", $row['ctime'])?></td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php  } else { ?>
<div class="panel panel-default">
    <div class="panel-heading">奖励总金额：<?php  if(!empty($totalmoney)) { ?><?php  echo $totalmoney;?>元<?php  } else { ?>0元<?php  } ?></div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style='width:10%;'>id</th>
                    <th style='width:10%;'>分红金额</th>
                    <th style='width:10%;'>分红人数</th>
                    <th style='width:10%;'>分红方式</th>
                    <th style='width:16%;'>打款方式</th>
                    <th style='width:16%;'>操作方式</th>
                    <th style='width:16%;'>分红时间</th>
                    <th style='width:24%;'>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td><?php  echo $row['money'];?></td>
                    <td><?php  echo $row['total'];?></td>
                    <td><?php echo empty($row['type']) ? "手动" : "自动"?></td>
                    <td>
                        <?php echo empty($row['paystatus']) ? "账户余额" : "微信钱包"?>
                        <?php  if($row['sendpay_error']==1) { ?>(打款失败)<?php  } ?>
                    </td>
					 <td>
                        <?php  if($row['isglobal']==1) { ?>
                            全球分红
                        <?php  } else { ?>
                            代理分红
                        <?php  } ?>
                    </td>
                    <td><?php  echo date("Y-m-d H:i:s", $row['ctime'])?></td>
                    <td>
                        <div class="col-sm-3 col-lg-2"><a class="btn btn-default" href="<?php  echo $this->createPluginWebUrl('bonus/detail', array('sn' => $row['send_bonus_sn']))?>" data-original-title="" title="">
                        查看明细
                        </a></div>
                        <?php  if($row['sendpay_error']==1) { ?>
                        <div class="col-sm-3 col-lg-2"><a class="btn btn-default" href="<?php  echo $this->createPluginWebUrl('bonus/detail', array('sn' => $row['send_bonus_sn'],"op" => "afresh"))?>" data-original-title="" title="">
                        重新发放
                        </a></div>
                        <?php  } ?>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>