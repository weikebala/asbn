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
		  <?php  if($opencommission) { ?>
			<th style='width:120px;'>推荐人</th>	
		  <?php  } ?>
                    <th style='width:120px;'>粉丝ID</th>
                    <th style='width:120px;'>粉丝</th>
                    <th style='width:120px;'>店铺</th>
                    <th style='width:80px;'>店主姓名</th>
                    <th style='width:120px;'>手机号码</th>

                    <th style='width:130px;'>店铺注册时间</th>

                    <th style='width:80px;'>店铺销售总额</th>
                </tr>
            </thead>
            <tbody>
                 <?php 
                  $i=1;
                 ?>
                <?php  if(is_array($newlist)) { foreach($newlist as $key=>$row) { ?>
                <tr>
                    <td><?php  echo $i;?></td>
                    <td>   <?php  echo $row['id'];?></td>
                    <td>
                        <?php  if(!empty($row['avatar'])) { ?>
                        <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                        <?php  } ?>
                        <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>

                    </td>
                    <td>
                    	<?php  if(!empty($row['logo'])) { ?>
                         <img src='<?php  echo $row['logo'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                       <?php  } ?>
                       <?php  if(empty($row['shop_name'])) { ?>
                            <?php  if(empty($row['realname'])) { ?>
                                未设置店名
                            <?php  } else { ?>
                                 <?php  echo $row['realname'];?>的店铺
                            <?php  } ?>
                        <?php  } else { ?>
                            <?php  echo $row['shop_name'];?>
                        <?php  } ?>
                        
                    </td>

                    <td><?php  echo $row['realname'];?>/<?php  echo $row['nickname'];?></td>
                    <td><?php  echo $row['mobile'];?></td>
                    <td><?php  echo date('Y-m-d H:i',$row['agenttime'])?></td>
                    <td><?php  echo floatval($row['ordersell'])?>元</td>
                </tr>
                <?php 
                  $i=$i+1;
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
