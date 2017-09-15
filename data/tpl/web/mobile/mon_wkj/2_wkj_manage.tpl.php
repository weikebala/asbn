<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="main">
    <ul class="nav nav-tabs">
        <li
        <?php  if($operation== 'display') { ?> class="active"<?php  } ?>><a
            href="<?php  echo $this->createWebUrl('kjManage');?>">微砍价活动管理</a></li>
        <li
        <?php  if($operation == 'post') { ?> class="active"<?php  } ?>> <a
            href="<?php  echo create_url('platform/reply/post',array('m'=>'mon_wkj'));?>">添加砍价活动</a></li>


    </ul>


    <div class="panel panel-default">
        <div class="table-responsive panel-body">




            <div class="row">

                <?php  if(is_array($list)) { foreach($list as $row) { ?>


                            <div class="thumbnail" style="width: 350px;height: 400px;float: left">
                                <img src="<?php  echo $_W['attachurl'];?><?php  echo $row['p_pic'];?>" alt="<?php  echo $row['p_name'];?>" style="height: 200px;width: 340px">
                                <div class="caption">
                                    <h3><?php  echo $row['title'];?></h3>
									活动链接:<?php  echo MonUtil::str_murl($this->createMobileUrl ( 'auth',array('kid'=>$row['id'],'au'=>Value::$REDIRECT_USER_INDEX),true))?></br>
                                    开始时间：<?php  echo date("Y-m-d H:i", $row['starttime'])?></br>
                                    结束时间：<?php  echo date("Y-m-d H:i", $row['endtime'])?></br>
                                    <p><a href="<?php  echo create_url('platform/reply/post', array( 'm' => 'mon_wkj','rid'=>$row['rid']))?>" class="btn btn-default" role="button"><i class="glyphicon glyphicon-edit"></i>编辑</a>
                                        <a href="<?php  echo $this->createWebUrl('joinUser', array( 'kid' => $row['id']))?>" class="btn btn-default" role="button"><i class="glyphicon glyphicon-list"></i>参与用户</a>
                                        <a href="<?php  echo $this->createWebUrl('orderList', array( 'kid' => $row['id']))?>" class="btn btn-default" role="button"><i class="glyphicon glyphicon-list"></i>订单</a>
                                        <a href="<?php  echo $this->createWebUrl('kjManage', array( 'id' => $row['id'], 'op' => 'delete'))?>" class="btn btn-default" role="button"  onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="glyphicon glyphicon-remove"></i>删除</a></p>
                                </div>
                            </div>

                <?php  } } ?>
                <?php  echo $pager;?>

            </div>





        </div>

    </div>


</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>