<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<script  src="../addons/upgrade_client/template/style/dist/bootstrap/js/bootstrap.min.js"></script>
<div class="main">
	<ul class="nav nav-tabs">
		<li class="active" ><a href="<?php  echo $this->createWebUrl('list');?>">系统升级</a></li>
	</ul>
	<div class="panel panel-default">
		<div class="panel-heading">
			系统升级信息
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="jumbotron" style="padding:2px;margin-bottom:2px;" >					
					<p class="text-left" style="font-size:16px;"><strong><i class="glyphicon glyphicon-cloud" aria-hidden="true"></i>  升级说明：</strong><?php  echo $upgrade['set']['introduce'];?></p>
					<p class="text-left alert-dange" style="font-size:16px;"><strong><i class="glyphicon glyphicon-cloud" aria-hidden="true"></i>  重要说明：</strong><?php  echo $upgrade['set']['remark'];?></p>
				</div>
			</div>
			<hr>
			<div>
				
			</div>
				<h4 class="col-md-6">升级包列表</h4>
			<hr>
			<div class="table-responsive col-md-12">
				<table class="table">
					<tr>
						<th>编号</th>
						<th class="col-md-3">包名</th>
						<th>版本</th>
						<th>描述</th>
						<th>添加时间</th>
						<th class="col-md-3">操作</th>
					</tr>
					<?php  if(is_array($upgrade['packagelist'])) { foreach($upgrade['packagelist'] as $v) { ?>
					<tr>
						<td><?php  echo $v['id'];?></td>
						<td><?php  echo $v['package_name'];?></td>
						<td id="up_downgrade_version"><?php  echo $v['package_version'];?></td>
						
						<td><a tabindex="0" type="button" role="button"  class="btn btn-default" data-toggle="popover" data-trigger="focus"  data-placement="left"  title="<?php  echo $v['package_name'];?>" data-content="<?php  echo $v['package_describe'];?>">查看详细</a></td>
						<td><?php  echo date('Y-m-d',$v['addtime'])?></td>
						<td>
						<?php  if($_W['role'] =='founder') { ?>
						<?php  if($version_num < $v['package_version']) { ?>
						<a type="button" id="client_upgrade<?php  echo $v['id'];?>" class="btn btn-success" readonly="readonly" onclick="up_client(this,<?php  echo $v['id'];?>);">版本升级</a>
						<?php  } else { ?>
						<a type="button" id="client_upgrade<?php  echo $v['id'];?>" class="btn btn-danger" readonly="readonly" disabled="disabled"">版本过低</a>
						<a type="button" id="up_downgrade" class="btn btn-success" readonly="readonly" >版本降级</a>
						<?php  } ?>
						<?php  } else { ?>
						<a type="button" class="btn btn-danger" readonly="readonly" disabled="disabled"">无权操作</a>
						<?php  } ?>
						</td>
						</tr>
						<?php  } } ?>
						<div class="progress upgrade-hidden"  id="upgrade">
							<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" id="up_progress" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" >
							</div>
						</div>
					</table>

				</div>
				<style type="text/css">
					.upgrade-hidden{
						display: none;
					}
					.upgrade-display{
						display: inline ;
					}
				</style>
					
			</div>
		</div>  
	</div>
<script type="text/javascript">
    $("#up_downgrade").bind("click",function(){
    	var version = $("#up_downgrade_version").html();
    	$("#up_downgrade").html('降级中...');
    	$.ajax({
    		url:"<?php  echo $this->createWebUrl('list',array('op'=>'up_downgrade'))?>",
    		type:'post',
    		dataType:'json',
    		data:{version:version},
    		success:function(ret){
    			if (ret == 1) {
    				$("#up_downgrade").html('降级成功');
    			}else{
    				$("#up_downgrade").html('降级失败');
    			}
    			location.reload();
    		}
    	});
    });
	$(function () {
	    $('[data-toggle="popover"]').popover({
	    	html:true
	    	});
	})

	function up_client(obj,id){
		if (confirm('请确保程序数据库已经备份！')) {
			$("#upgrade").removeClass('upgrade-hidden');
			get_progress(obj);
			var up = $(obj);
			up.html('升级中...');
			$.ajax({
				url: "<?php  echo $this->createWebUrl('list',array('op'=>'download'))?>",
				type: 'post',
				dataType: 'json',
				data: {id: id}
			});
		}
	}

	function get_progress(obj){
		$.ajax({
			url: "<?php  echo $this->createWebUrl('list',array('op'=>'upload_progress'))?>",
			success:function(upload_progress){
				if (upload_progress <= 100) {
					$('#up_progress').width(upload_progress+'%');
					if (upload_progress < 100) {
						setTimeout(get_progress(obj), 100);
					}else{
						$(obj).html('升级成功');
						location.reload();
					}
					
				}
				
			}
		});
	}
</script>
<script>
  $(".dropdown").click(function(){
    if($(this).hasClass("open")){
		$(this).removeClass("open");
    }else{
		$(this).addClass("open");
	}
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
