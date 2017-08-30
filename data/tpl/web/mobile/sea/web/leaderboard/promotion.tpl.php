<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/leaderboard/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/leaderboard/tabs', TEMPLATE_INCLUDEPATH));?>

<div class="clearfix">

<div class="panel panel-default">
    <div class="panel-heading">总数：<?php  echo $total;?>   </div>
    <div class="panel-body">
        <table class="table table-hover" style="overflow:visible;">
            <thead class="navbar-inner">
            <tr>
                <th style='width:80px;'>排行</th>
                <th style='width:80px;'>会员ID</th>
                <?php  if($opencommission) { ?>
                <th style='width:120px;'>推荐人</th>
                <?php  } ?>

                <th style='width:120px;'>粉丝</th>
                <th style='width:80px;'>会员姓名</th>
                <th style='width:120px;'>手机号码</th>
                <th style='width:120px;'>会员等级/分组</th>
                <th style='width:130px;'>注册时间</th>

                <th style='width:80px;'>推广总金额</th>

                <th style='width:100px'>关注</th>

            </tr>
            </thead>
            <tbody>
            <?php 
              $i=1;
            ?>
            <?php  if(is_array($newlist)) { foreach($newlist as $row) { ?>

            <tr>
                <td>   <?php  echo $i;?></td>
                <td>   <?php  echo $row['id'];?></td>
                <?php  if($opencommission) { ?>
                <td  <?php  if(!empty($row['agentid'])) { ?>title='ID: <?php  echo $row['agentid'];?>'<?php  } ?>>
                <?php  if(empty($row['agentid'])) { ?>
                <?php  if($row['isagent']==1) { ?>
                <label class='label label-primary'>总店</label>
                <?php  } else { ?>
                <label class='label label-default'>暂无</label>
                <?php  } ?>
                <?php  } else { ?>

                <?php  if(!empty($row['agentavatar'])) { ?>
                <img src='<?php  echo $row['agentavatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                <?php  } ?>
                <?php  if(empty($row['agentnickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['agentnickname'];?><?php  } ?>
                <?php  } ?>

                </td>
                <?php  } ?>

                <td>
                    <?php  if(!empty($row['avatar'])) { ?>
                    <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                    <?php  } ?>
                    <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>

                </td>
                <td><?php  echo $row['realname'];?></td>
                <td><?php  echo $row['mobile'];?></td>
                <td><?php  if(empty($row['levelname'])) { ?>普通会员<?php  } else { ?><?php  echo $row['levelname'];?><?php  } ?>
                    <br/><?php  if(empty($row['groupname'])) { ?>无分组<?php  } else { ?><?php  echo $row['groupname'];?><?php  } ?></td>

                <td><?php  echo date('Y-m-d H:i',$row['createtime'])?></td>

                <td><?php  echo $row['ordersum'];?></td>
                <td>
                    <?php  if($row['isblack']==1) { ?>
                    <span class="label label-default" style='color:#fff;background:black'>黑名单</span>
                    <?php  } else { ?>
                    <?php  if(empty($row['followed'])) { ?>
                    <?php  if(empty($row['uid'])) { ?>
                    <label class='label label-default'>未关注</label>
                    <?php  } else { ?>
                    <label class='label label-warning'>取消关注</label>
                    <?php  } ?>
                    <?php  } else { ?>
                    <label class='label label-success'>已关注</label>
                    <?php  } ?><?php  } ?>

                </td>


                </td>
            </tr>
            <?php 
              $i++;
            ?>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
</div>

<script language='javascript'>

         function search_members() {
             if( $.trim($('#search-kwd-notice').val())==''){
                 Tip.focus('#search-kwd-notice','请输入关键词');
                 return;
             }
		$("#module-menus-notice").html("正在搜索....")
		$.get('<?php  echo $this->createPluginWebUrl('commission/agent')?>', {
			keyword: $.trim($('#search-kwd-notice').val()),'op':'query',selfid:"<?php  echo $id;?>"
		}, function(dat){
			$('#module-menus-notice').html(dat);
		});
	}
	function select_member(o) {
		$("#agentid").val(o.id);
                  $("#parentagentavatar").show();
                  $("#parentagentavatar").find('img').attr('src',o.avatar);
		$("#parentagent").val( o.nickname+ "/" + o.realname + "/" + o.mobile );
		$("#modal-module-menus-notice .close").click();
	}

    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
