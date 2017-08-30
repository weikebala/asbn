<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('exhelpercommon', TEMPLATE_INCLUDEPATH)) : (include template('exhelpercommon', TEMPLATE_INCLUDEPATH));?>

<?php  if($_GPC['op']=='list') { ?>
<div class="panel panel-default">
	<div class="panel-heading"><i class="fa fa-copy"></i> <?php  if($cate==1) { ?>快递单模版列表<?php  } else if($cate==2) { ?>发货单模版列表<?php  } ?></div>
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:60px;">ID</th>
					<th><?php  if($cate==1) { ?>快递单<?php  } else if($cate==2) { ?>发货单<?php  } ?>模版名称</th>
					<?php  if($cate==1) { ?>
						<th>快递类型</th>
					<?php  } ?>
					<th>是否默认(只能设置一个)</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<tr>
					<td><?php  echo $row['id'];?></td>
					<td><?php  echo $row['expressname'];?></td>
					<?php  if($cate==1) { ?>
						<td><?php  if(empty($row['expresscom'])) { ?>其他快递<?php  } else { ?><?php  echo $row['expresscom'];?><?php  } ?></td>
					<?php  } ?>
					<td>
						<?php  if($row['isdefault']==1) { ?>
						<span class='label label-success'>已设为默认</span> 
						<?php  } else { ?>
						<span class='label label-default'>未设为默认</span>
						<?php  } ?>
					</td>
					<td style="text-align:left;">
						<?php  if($cate==1) { ?>
							<?php if(cv('exhelper.exptemp1.view|exhelper.exptemp1.edit')) { ?>
								<a href="<?php  echo $this->createPluginWebUrl('exhelper/express', array('op'=>'post','cate'=>$cate,'id'=>$row['id']))?>" class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"></i></a>
							<?php  } ?>
						<?php  } else if($cate==2) { ?>
							<?php if(cv('exhelper.exptemp2.view|exhelper.exptemp2.edit')) { ?>
								<a href="<?php  echo $this->createPluginWebUrl('exhelper/express', array('op'=>'post','cate'=>$cate,'id'=>$row['id']))?>" class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"></i></a>
							<?php  } ?>
						<?php  } ?>
						
						<?php  if($cate==1) { ?>
							<?php if(cv('exhelper.exptemp1.delete')) { ?>
								<a href="<?php  echo $this->createPluginWebUrl('exhelper/express', array('op'=>'delete', 'type'=>$cate,'id'=>$row['id']))?>" class="btn btn-default btn-sm" onclick="return confirm('确认删除此快递单?')" title="删除"><i class="fa fa-times"></i></a>
							<?php  } ?>
						<?php  } else if($cate==2) { ?>
							<?php if(cv('exhelper.exptemp2.delete')) { ?>
								<a href="<?php  echo $this->createPluginWebUrl('exhelper/express', array('op'=>'delete', 'type'=>$cate,'id'=>$row['id']))?>" class="btn btn-default btn-sm" onclick="return confirm('确认删除此快递单?')" title="删除"><i class="fa fa-times"></i></a>
							<?php  } ?>
						<?php  } ?>
						
						<?php  if($cate==1) { ?>
							<?php if(cv('exhelper.exptemp1.setdefault')) { ?>
								<?php  if(empty($row['isdefault'])) { ?>
									<a href="<?php  echo $this->createPluginWebUrl('exhelper/express', array('op'=>'setdefault', 'type'=>$cate,'id' => $row['id']))?>" class="btn btn-default btn-sm" onclick="return confirm('确认设置默认?')" title="设置默认"><i class="fa fa-check"></i></a> 
								<?php  } ?> 
							<?php  } ?>
						<?php  } else if($cate==2) { ?>
							<?php if(cv('exhelper.exptemp2.setdefault')) { ?>
								<?php  if(empty($row['isdefault'])) { ?>
									<a href="<?php  echo $this->createPluginWebUrl('exhelper/express', array('op'=>'setdefault', 'type'=>$cate,'id' => $row['id']))?>" class="btn btn-default btn-sm" onclick="return confirm('确认设置默认?')" title="设置默认"><i class="fa fa-check"></i></a> 
								<?php  } ?> 
							<?php  } ?>
						<?php  } ?>

					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>
		<script>
			require(['bootstrap'], function($) {
				$('.btn').hover(function() {
					$(this).tooltip('show');
				}, function() {
					$(this).tooltip('hide'); 
				});
			});
		</script>
	</div>
	<div class="panel-footer">
		<?php  if($cate==1) { ?>
			<?php if(cv('exhelper.exptemp1.add')) { ?>
				<a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('exhelper/express',array('op'=>'post','cate'=>$cate))?>"><i class='fa fa-plus'></i>添加快递单</a>
			<?php  } ?>
		<?php  } else if($cate==2) { ?>
			<?php if(cv('exhelper.exptemp2.add')) { ?>
				<a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('exhelper/express',array('op'=>'post','cate'=>$cate))?>"><i class='fa fa-plus'></i>添加发货单</a>
			<?php  } ?>
		<?php  } ?>
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /> 
	</div>
</div>

<?php  } else if($_GPC['op']=='post') { ?>
<script language='javascript' src="../addons/sea/plugin/exhelper/static/js/designer.js"></script>
<script language='javascript' src="../addons/sea/plugin/exhelper/static/js/jquery.contextMenu.js"></script>
<link href="../addons/sea/plugin/exhelper/static/js/jquery.contextMenu.css" rel="stylesheet">
<style type='text/css'>
#container {border: 1px solid #ccc;position: relative; background: #fff; overflow: hidden;}
.items label {width: 120px; margin: 0; float: left;}
#container .bg {position: absolute; width: 100%; z-index: 0;}
#container .drag {position: absolute; min-width: 120px; min-height: 25px; border: 1px solid #aaa; z-index: 1; top: 10px; left: 100px; background: #fff; cursor: move;}
#container .rRightDown, .rLeftDown, .rLeftUp, .rRightUp, .rRight, .rLeft, .rUp, .rDown { position: absolute; width: 7px; height: 7px; z-index: 1; font-size: 0;}
.rRightDown, .rLeftDown, .rLeftUp, .rRightUp, .rRight, .rLeft, .rUp, .rDown {position: absolute; background: #428bca; width: 6px; height: 6px; z-index: 5; font-size: 0;}
.rLeftDown, .rRightUp {cursor: ne-resize;}
.rRightDown, .rLeftUp {cursor: nw-resize;}
.rRight, .rLeft {cursor: e-resize;}
.rUp, .rDown {cursor: n-resize;}
.rRightDown {bottom: -3px; right: -3px; background: #2a6496;} 
.rLeftDown {bottom: -3px; left: -3px;}
.rRightUp {top: -3px; right: -3px;}
.rLeftUp {top: -3px; left: -3px;}
.rRight {right: -3px; top: 50%; margin-top: -3px;}
.rLeft {left: -3px; top: 50%; margin-top: -3px;}
.rUp {top: -3px; left: 50%;}
.rDown {bottom: -3px; left: 50%}
.context-menu-layer {z-index: 9999;}
.context-menu-list {z-index: 9999;}
.items .checkbox-inline, .col-xs-12 .checkbox-inline {margin: 0; float: left; width: 100px;}  
.edit-left {min-height: 592px; width: 420px; float: left; }
.edit-right {min-height: 570px; width: auto; margin-left: 440px;}
</style>
<div class="main">
	<form id='dataform' action="" method="post" class="form-horizontal form">
		<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
		<input type="hidden" name="cate" value="<?php  echo $cate;?>" />
		<input type="hidden" id="datas" name="datas" value="" />
		<input type="hidden" id="expresscom" name="expresscom" value="" />
		<div class="panel panel-default">
			<div class="panel-heading"><?php  if($cate==1) { ?>快递单<?php  } else if($cate==2) { ?>发货单<?php  } ?>模版编辑</div>
			<div class="panel-body">
				<div>
						<div class="input-group">
							<div class="input-group-addon" style="border-right:none"><?php  if($cate==1) { ?>快递单<?php  } else if($cate==2) { ?>发货单<?php  } ?>名称</div>
							<input type="text" name="expressname" class="form-control" value="<?php  echo $item['expressname'];?>" />
							<div class="input-group-addon" style="border-right:none; border-left: none;"> 单据宽度</div>
							<input type="number" name="width" class="form-control" value="<?php  if(!empty($item['width'])) { ?><?php  echo $item['width'];?><?php  } else { ?>250<?php  } ?>" onchange="pagesize()" />
							<div class="input-group-addon" style="border-right:none; border-left: none;">mm(毫米) 单据高度</div>
							<input type="number" name="height" class="form-control" value="<?php  if(!empty($item['height'])) { ?><?php  echo $item['height'];?><?php  } else { ?>150<?php  } ?>" onchange="pagesize()" />
							<div class="input-group-addon" style="border-right:none; border-left: none;">mm(毫米)</div>
							<div class="input-group-addon" style="border-right:none;"><?php  if($cate==1) { ?>发货单<?php  } else if($cate==2) { ?>发货单<?php  } ?>底图</div>
							<input id="bg" type="text" name="bg" class="form-control" value="<?php  echo $item['bg'];?>" />
							<span style="background: #fff;" class="input-group-addon btn btn-default " onclick="changeBG()">选择图片</span>
							<span style="background: #fff;" class="input-group-addon btn btn-default " onclick="changeBG(1)">清除图片</span>
						</div>
						<?php  if($cate==1) { ?>
							<div class="input-group" style="margin-top: 10px; width: 300px;">
								<div class="input-group-addon" style="border-right:none">快递类型</div>
								<select id="express" name="express" class="form-control">
									<option <?php  if($item['express']=='') { ?>selected=""<?php  } ?> data-name="" value="" >其他快递</option>
									<option <?php  if($item['express']=='shunfeng') { ?>selected=""<?php  } ?> data-name="顺丰" value="shunfeng">顺丰</option>
									<option <?php  if($item['express']=='shentong') { ?>selected=""<?php  } ?> data-name="申通" value="shentong">申通</option>
									<option <?php  if($item['express']=='yunda') { ?>selected=""<?php  } ?> data-name="韵达快运" value="yunda">韵达快运</option>
									<option <?php  if($item['express']=='tiantian') { ?>selected=""<?php  } ?> data-name="天天快递" value="tiantian">天天快递</option>
									<option <?php  if($item['express']=='yuantong') { ?>selected=""<?php  } ?> data-name="圆通速递" value="yuantong">圆通速递</option>
									<option <?php  if($item['express']=='zhongtong') { ?>selected=""<?php  } ?> data-name="中通速递" value="zhongtong">中通速递</option>
									<option <?php  if($item['express']=='ems') { ?>selected=""<?php  } ?> data-name="ems快递" value="ems">ems快递</option>
									<option <?php  if($item['express']=='huitongkuaidi') { ?>selected=""<?php  } ?> data-name="汇通快运" value="huitongkuaidi">汇通快运</option>
									<option <?php  if($item['express']=='quanfengkuaidi') { ?>selected=""<?php  } ?> data-name="全峰快递" value="quanfengkuaidi">全峰快递</option>
									<option <?php  if($item['express']=='zhaijisong') { ?>selected=""<?php  } ?> data-name="宅急送" value="zhaijisong">宅急送</option>
									<option <?php  if($item['express']=='aae') { ?>selected=""<?php  } ?> data-name="aae全球专递" value="aae">aae全球专递</option>
									<option <?php  if($item['express']=='anjie') { ?>selected=""<?php  } ?> data-name="安捷快递" value="anjie">安捷快递</option>
									<option <?php  if($item['express']=='anxindakuaixi') { ?>selected=""<?php  } ?> data-name="安信达快递" value="anxindakuaixi">安信达快递</option>
									<option <?php  if($item['express']=='biaojikuaidi') { ?>selected=""<?php  } ?> data-name="彪记快递" value="biaojikuaidi">彪记快递</option>
									<option <?php  if($item['express']=='bht') { ?>selected=""<?php  } ?> data-name="bht" value="bht">bht</option>
									<option <?php  if($item['express']=='baifudongfang') { ?>selected=""<?php  } ?> data-name="百福东方国际物流" value="baifudongfang">百福东方国际物流</option>
									<option <?php  if($item['express']=='coe') { ?>selected=""<?php  } ?> data-name="中国东方（COE）" value="coe">中国东方（COE）</option>
									<option <?php  if($item['express']=='changyuwuliu') { ?>selected=""<?php  } ?> data-name="长宇物流" value="changyuwuliu">长宇物流</option>
									<option <?php  if($item['express']=='datianwuliu') { ?>selected=""<?php  } ?> data-name="大田物流" value="datianwuliu">大田物流</option>
									<option <?php  if($item['express']=='debangwuliu') { ?>selected=""<?php  } ?> data-name="德邦物流" value="debangwuliu">德邦物流</option>
									<option <?php  if($item['express']=='dhl') { ?>selected=""<?php  } ?> data-name="dhl" value="dhl">dhl</option>
									<option <?php  if($item['express']=='dpex') { ?>selected=""<?php  } ?> data-name="dpex" value="dpex">dpex</option>
									<option <?php  if($item['express']=='dsukuaidi') { ?>selected=""<?php  } ?> data-name="d速快递" value="dsukuaidi">d速快递</option>
									<option <?php  if($item['express']=='disifang') { ?>selected=""<?php  } ?> data-name="递四方" value="disifang">递四方</option>
									<option <?php  if($item['express']=='fedex') { ?>selected=""<?php  } ?> data-name="fedex（国外）" value="fedex">fedex（国外）</option>
									<option <?php  if($item['express']=='feikangda') { ?>selected=""<?php  } ?> data-name="飞康达物流" value="feikangda">飞康达物流</option>
									<option <?php  if($item['express']=='fenghuangkuaidi') { ?>selected=""<?php  } ?> data-name="凤凰快递" value="fenghuangkuaidi">凤凰快递</option>
									<option <?php  if($item['express']=='feikuaida') { ?>selected=""<?php  } ?> data-name="飞快达" value="feikuaida">飞快达</option>
									<option <?php  if($item['express']=='guotongkuaidi') { ?>selected=""<?php  } ?> data-name="国通快递" value="guotongkuaidi">国通快递</option>
									<option <?php  if($item['express']=='ganzhongnengda') { ?>selected=""<?php  } ?> data-name="港中能达物流" value="ganzhongnengda">港中能达物流</option>
									<option <?php  if($item['express']=='guangdongyouzhengwuliu') { ?>selected=""<?php  } ?> data-name="广东邮政物流" value="guangdongyouzhengwuliu">广东邮政物流</option>
									<option <?php  if($item['express']=='gongsuda') { ?>selected=""<?php  } ?> data-name="共速达" value="gongsuda">共速达</option>
									<option <?php  if($item['express']=='hengluwuliu') { ?>selected=""<?php  } ?> data-name="恒路物流" value="hengluwuliu">恒路物流</option>
									<option <?php  if($item['express']=='huaxialongwuliu') { ?>selected=""<?php  } ?> data-name="华夏龙物流" value="huaxialongwuliu">华夏龙物流</option>
									<option <?php  if($item['express']=='haihongwangsong') { ?>selected=""<?php  } ?> data-name="海红" value="haihongwangsong">海红</option>
									<option <?php  if($item['express']=='haiwaihuanqiu') { ?>selected=""<?php  } ?> data-name="海外环球" value="haiwaihuanqiu">海外环球</option>
									<option <?php  if($item['express']=='jiayiwuliu') { ?>selected=""<?php  } ?> data-name="佳怡物流" value="jiayiwuliu">佳怡物流</option>
									<option <?php  if($item['express']=='jinguangsudikuaijian') { ?>selected=""<?php  } ?> data-name="京广速递" value="jinguangsudikuaijian">京广速递</option>
									<option <?php  if($item['express']=='jixianda') { ?>selected=""<?php  } ?> data-name="急先达" value="jixianda">急先达</option>
									<option <?php  if($item['express']=='jjwl') { ?>selected=""<?php  } ?> data-name="佳吉物流" value="jjwl">佳吉物流</option>
									<option <?php  if($item['express']=='jymwl') { ?>selected=""<?php  } ?> data-name="加运美物流" value="jymwl">加运美物流</option>
									<option <?php  if($item['express']=='jindawuliu') { ?>selected=""<?php  } ?> data-name="金大物流" value="jindawuliu">金大物流</option>
									<option <?php  if($item['express']=='jialidatong') { ?>selected=""<?php  } ?> data-name="嘉里大通" value="jialidatong">嘉里大通</option>
									<option <?php  if($item['express']=='jykd') { ?>selected=""<?php  } ?> data-name="晋越快递" value="jykd">晋越快递</option>
									<option <?php  if($item['express']=='kuaijiesudi') { ?>selected=""<?php  } ?> data-name="快捷速递" value="kuaijiesudi">快捷速递</option>
									<option <?php  if($item['express']=='lianb') { ?>selected=""<?php  } ?> data-name="联邦快递（国内）" value="lianb">联邦快递（国内）</option>
									<option <?php  if($item['express']=='lianhaowuliu') { ?>selected=""<?php  } ?> data-name="联昊通物流" value="lianhaowuliu">联昊通物流</option>
									<option <?php  if($item['express']=='longbanwuliu') { ?>selected=""<?php  } ?> data-name="龙邦物流" value="longbanwuliu">龙邦物流</option>
									<option <?php  if($item['express']=='lijisong') { ?>selected=""<?php  } ?> data-name="立即送" value="lijisong">立即送</option>
									<option <?php  if($item['express']=='lejiedi') { ?>selected=""<?php  } ?> data-name="乐捷递" value="lejiedi">乐捷递</option>
									<option <?php  if($item['express']=='minghangkuaidi') { ?>selected=""<?php  } ?> data-name="民航快递" value="minghangkuaidi">民航快递</option>
									<option <?php  if($item['express']=='meiguokuaidi') { ?>selected=""<?php  } ?> data-name="美国快递" value="meiguokuaidi">美国快递</option>
									<option <?php  if($item['express']=='menduimen') { ?>selected=""<?php  } ?> data-name="门对门" value="menduimen">门对门</option>
									<option <?php  if($item['express']=='ocs') { ?>selected=""<?php  } ?> data-name="OCS" value="ocs">OCS</option>
									<option <?php  if($item['express']=='peisihuoyunkuaidi') { ?>selected=""<?php  } ?> data-name="配思货运" value="peisihuoyunkuaidi">配思货运</option>
									<option <?php  if($item['express']=='quanchenkuaidi') { ?>selected=""<?php  } ?> data-name="全晨快递" value="quanchenkuaidi">全晨快递</option>
									<option <?php  if($item['express']=='quanjitong') { ?>selected=""<?php  } ?> data-name="全际通物流" value="quanjitong">全际通物流</option>
									<option <?php  if($item['express']=='quanritongkuaidi') { ?>selected=""<?php  } ?> data-name="全日通快递" value="quanritongkuaidi">全日通快递</option>
									<option <?php  if($item['express']=='quanyikuaidi') { ?>selected=""<?php  } ?> data-name="全一快递" value="quanyikuaidi">全一快递</option>
									<option <?php  if($item['express']=='rufengda') { ?>selected=""<?php  } ?> data-name="如风达" value="rufengda">如风达</option>
									<option <?php  if($item['express']=='santaisudi') { ?>selected=""<?php  } ?> data-name="三态速递" value="santaisudi">三态速递</option>
									<option <?php  if($item['express']=='shenghuiwuliu') { ?>selected=""<?php  } ?> data-name="盛辉物流" value="shenghuiwuliu">盛辉物流</option>
									<option <?php  if($item['express']=='sue') { ?>selected=""<?php  } ?> data-name="速尔物流" value="sue">速尔物流</option>
									<option <?php  if($item['express']=='shengfeng') { ?>selected=""<?php  } ?> data-name="盛丰物流" value="shengfeng">盛丰物流</option>
									<option <?php  if($item['express']=='saiaodi') { ?>selected=""<?php  } ?> data-name="赛澳递" value="saiaodi">赛澳递</option>
									<option <?php  if($item['express']=='tiandihuayu') { ?>selected=""<?php  } ?> data-name="天地华宇" value="tiandihuayu">天地华宇</option>
									<option <?php  if($item['express']=='tnt') { ?>selected=""<?php  } ?> data-name="tnt" value="tnt">tnt</option>
									<option <?php  if($item['express']=='ups') { ?>selected=""<?php  } ?> data-name="ups" value="ups">ups</option>
									<option <?php  if($item['express']=='wanjiawuliu') { ?>selected=""<?php  } ?> data-name="万家物流" value="wanjiawuliu">万家物流</option>
									<option <?php  if($item['express']=='wenjiesudi') { ?>selected=""<?php  } ?> data-name="文捷航空速递" value="wenjiesudi">文捷航空速递</option>
									<option <?php  if($item['express']=='wuyuan') { ?>selected=""<?php  } ?> data-name="伍圆" value="wuyuan">伍圆</option>
									<option <?php  if($item['express']=='wxwl') { ?>selected=""<?php  } ?> data-name="万象物流" value="wxwl">万象物流</option>
									<option <?php  if($item['express']=='xinbangwuliu') { ?>selected=""<?php  } ?> data-name="新邦物流" value="xinbangwuliu">新邦物流</option>
									<option <?php  if($item['express']=='xinfengwuliu') { ?>selected=""<?php  } ?> data-name="信丰物流" value="xinfengwuliu">信丰物流</option>
									<option <?php  if($item['express']=='yafengsudi') { ?>selected=""<?php  } ?> data-name="亚风速递" value="yafengsudi">亚风速递</option>
									<option <?php  if($item['express']=='yibangwuliu') { ?>selected=""<?php  } ?> data-name="一邦速递" value="yibangwuliu">一邦速递</option>
									<option <?php  if($item['express']=='youshuwuliu') { ?>selected=""<?php  } ?> data-name="优速物流" value="youshuwuliu">优速物流</option>
									<option <?php  if($item['express']=='youzhengguonei') { ?>selected=""<?php  } ?> data-name="邮政包裹挂号信" value="youzhengguonei">邮政包裹挂号信</option>
									<option <?php  if($item['express']=='youzhengguoji') { ?>selected=""<?php  } ?> data-name="邮政国际包裹挂号信" value="youzhengguoji">邮政国际包裹挂号信</option>
									<option <?php  if($item['express']=='yuanchengwuliu') { ?>selected=""<?php  } ?> data-name="远成物流" value="yuanchengwuliu">远成物流</option>
									<option <?php  if($item['express']=='yuanweifeng') { ?>selected=""<?php  } ?> data-name="源伟丰快递" value="yuanweifeng">源伟丰快递</option>
									<option <?php  if($item['express']=='yuanzhijiecheng') { ?>selected=""<?php  } ?> data-name="元智捷诚快递" value="yuanzhijiecheng">元智捷诚快递</option>
									<option <?php  if($item['express']=='yuntongkuaidi') { ?>selected=""<?php  } ?> data-name="运通快递" value="yuntongkuaidi">运通快递</option>
									<option <?php  if($item['express']=='yuefengwuliu') { ?>selected=""<?php  } ?> data-name="越丰物流" value="yuefengwuliu">越丰物流</option>
									<option <?php  if($item['express']=='yad') { ?>selected=""<?php  } ?> data-name="源安达" value="yad">源安达</option>
									<option <?php  if($item['express']=='yinjiesudi') { ?>selected=""<?php  } ?> data-name="银捷速递" value="yinjiesudi">银捷速递</option>
									<option <?php  if($item['express']=='zhongtiekuaiyun') { ?>selected=""<?php  } ?> data-name="中铁快运" value="zhongtiekuaiyun">中铁快运</option>
									<option <?php  if($item['express']=='zhongyouwuliu') { ?>selected=""<?php  } ?> data-name="中邮物流" value="zhongyouwuliu">中邮物流</option>
									<option <?php  if($item['express']=='zhongxinda') { ?>selected=""<?php  } ?> data-name="忠信达" value="zhongxinda">忠信达</option>
									<option <?php  if($item['express']=='zhimakaimen') { ?>selected=""<?php  } ?> data-name="芝麻开门" value="zhimakaimen">芝麻开门</option>
								</select>
							</div>
						<?php  } ?>
				</div>
			</div>
		</div>
		
			<div class="panel" style="height: auto; overflow: hidden; background: none;">
				<?php  if($cate==1) { ?>
					<?php if(cv('exhelper.exptemp1.add|exhelper.exptemp1.edit')) { ?>
						<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('print_tpl_items', TEMPLATE_INCLUDEPATH)) : (include template('print_tpl_items', TEMPLATE_INCLUDEPATH));?>
					<?php  } ?>
				<?php  } else if($cate==2) { ?>
					<?php if(cv('exhelper.exptemp2.add|exhelper.exptemp2.edit')) { ?>
						<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('print_tpl_items', TEMPLATE_INCLUDEPATH)) : (include template('print_tpl_items', TEMPLATE_INCLUDEPATH));?>
					<?php  } ?>
				<?php  } ?>
				<div class="edit-right">
					<div id="container" style="width:<?php  if(!empty($item['width'])) { ?><?php  echo $item['width'];?><?php  } else { ?>250<?php  } ?>mm; height: <?php  if(!empty($item['height'])) { ?><?php  echo $item['height'];?><?php  } else { ?>150<?php  } ?>mm;">
						<img id="bgimg" src="<?php  echo $item['bg'];?> " <?php  if(empty($item['bg'])) { ?> style="display: none;"<?php  } ?> /> 
										<?php  if(is_array($datas)) { foreach($datas as $k => $d) { ?>
											<div class="drag" cate="<?php  echo $d['cate'];?>" index="<?php  echo $k;?>" items="<?php  echo $d['items'];?>" item-string="<?php  echo $d['string'];?>" item-font="<?php  echo $d['font'];?>" item-size="<?php  echo $d['size'];?>" item-color="<?php  echo $d['color'];?>" item-bold="<?php  echo $d['bold'];?>" item-pre="<?php  echo $d['pre'];?>" item-last="<?php  echo $d['last'];?>" item-align="<?php  echo $d['align'];?>"
											style="font-size:<?php  echo $d['size'];?>pt; z-index:<?php  echo $k;?>;left:<?php  echo $d['left'];?>;top:<?php  echo $d['top'];?>;width:<?php  echo $d['width'];?>;height:<?php  echo $d['height'];?>; text-align:<?php  if($d['align']=='' || $d['align']==1) { ?>left<?php  } else if($d['align']==2) { ?>center<?php  } else if($d['align']==3) { ?>right<?php  } ?>" item-virtual="<?php  echo $d['virtual'];?>" cate="$d['cate']">
												<?php  if($d['cate']==1) { ?>
												<div class="text" style="<?php  if(!empty($d['font'])) { ?>font-family: <?php  echo $d['font'];?>;<?php  } ?> font-size:<?php  if(!empty($d['size'])) { ?><?php  echo $d['size'];?><?php  } else { ?>10<?php  } ?>pt;<?php  if(!empty($d['color'])) { ?>color: <?php  echo $d['color'];?>;<?php  } ?><?php  if(!empty($d['bold'])) { ?>font-weight:bold;<?php  } ?>">
													<?php  echo $d['pre'];?><?php  echo $d['string'];?><?php  echo $d['last'];?>
												</div>
												<?php  } else if($d['cate']==2) { ?>
													<div class="text-table" style="
														padding: 10px; <?php  if(!empty($d['font'])) { ?>font-family: <?php  echo $d['font'];?>;<?php  } ?> 
														font-size:<?php  if(!empty($d['size'])) { ?><?php  echo $d['size'];?><?php  } else { ?>10<?php  } ?>pt;
														<?php  if(!empty($d['color'])) { ?>color: <?php  echo $d['color'];?>;<?php  } ?>"> 
														<?php  
															$strings = explode(',',$d['string']); 
															$virtuals = explode(',',$d['virtual']); 
															$stringsnum = count($strings);
														?>
														<table border="1" style="width:100%">
															<tr style="font-weight: bold;">
																<?php  if(is_array($strings)) { foreach($strings as $i => $s) { ?>
																	<td><?php  echo $s;?></td>
																<?php  } } ?>
															</tr>
															<?php  
																for ($x=1; $x<5; $x++) {
															?>
															<tr>
																<?php  if(is_array($virtuals)) { foreach($virtuals as $i => $v) { ?>
																	<td><?php  if($v!=='') { ?>
																				<?php  if($v=='number') { ?>
																					<?php  echo $x;?>
																				<?php  } else { ?>
																					<?php  echo $v;?><?php  echo $i;?>
																				<?php  } ?>
																			<?php  } else { ?>
																				<?php  echo $v;?>
																			<?php  } ?>
																	</td> 
																<?php  } } ?>
															</tr>
															<?php  } ?>
															<tr>
																<td colspan="<?php  echo $stringsnum;?>">提示: 以上表格数据为虚拟数据，打印时将替换为订单数据且打印时此行不会出现。</td>
															</tr>
														</table>
													</div>
												<?php  } ?>
												<div class="rRightDown"> </div>
												<div class="rLeftDown"> </div>
												<div class="rRightUp"> </div>
												<div class="rLeftUp"> </div>
												<div class="rRight"> </div>
												<div class="rLeft"> </div>
												<div class="rUp"> </div>
												<div class="rDown"></div>
											</div>
										<?php  } } ?>
					</div>
				</div>
			</div>
			<div class='panel-body'>
					<div class="form-group">
						<div class="col-sm-9 col-xs-12">
							<a href="#"><span  class="btn btn-default" style="float: left; margin-right: 10px;"><i class="fa fa-reply"></i> 返回列表</span></a>
							
							<?php  if($cate==1) { ?>
								<?php if(cv('exhelper.exptemp1.add|exhelper.exptemp1.edit')) { ?>
									<input type="button" name="btnsave" value="保 存" class="btn btn-primary col-lg-1 btnsave" onclick="save(false)" />
									<input type="button" name="btnpreview" value="保存并预览" class="btn btn-success col-lg-1 btnsave" onclick="save(true)" style="margin-left:10px;" />
								<?php  } ?>
								<?php if(cv('exhelper.exptemp1.setdefault')) { ?>
									<div style="float: left; margin-left: 10px;">
										<label class="radio-inline">
											<input type="radio" name='isdefault' value="1" <?php  if($item[ 'isdefault']==1) { ?>checked<?php  } ?> /> 设为默认打印模版
										</label>
										<label class="radio-inline">
											<input type="radio" name='isdefault' value="0" <?php  if($item[ 'isdefault']==0) { ?>checked<?php  } ?> /> 不设为默认打印模版
										</label>
									</div>
								<?php  } else { ?>
									 <?php  if($item[ 'isdefault']==1) { ?><span class="help-block">默认模版</span><?php  } ?>
								<?php  } ?>
							<?php  } else if($cate==2) { ?>
								<?php if(cv('exhelper.exptemp2.add|exhelper.exptemp2.edit')) { ?>
									<input type="button" name="btnsave" value="保 存" class="btn btn-primary col-lg-1 btnsave" onclick="save(false)" />
									<input type="button" name="btnpreview" value="保存并预览" class="btn btn-success col-lg-1 btnsave" onclick="save(true)" style="margin-left:10px;" />
								<?php  } ?>
								<?php if(cv('exhelper.exptemp2.setdefault')) { ?>
									<div style="float: left; margin-left: 10px;">
										<label class="radio-inline">
											<input type="radio" name='isdefault' value="1" <?php  if($item[ 'isdefault']==1) { ?>checked<?php  } ?> /> 设为默认打印模版
										</label>
										<label class="radio-inline">
											<input type="radio" name='isdefault' value="0" <?php  if($item[ 'isdefault']==0) { ?>checked<?php  } ?> /> 不设为默认打印模版
										</label>
									</div>
								<?php  } else { ?>
									 <?php  if($item[ 'isdefault']==1) { ?><span class="help-block">默认模版</span><?php  } ?>
								<?php  } ?>
							<?php  } ?>
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /> 
							
							
						</div>
					</div>
					
				</div>
	</form>
	</div>
	<script language='javascript' src="../addons/sea/plugin/exhelper/static/js/LodopFuncs.js"></script>
	<script src='http://<?php  if(empty($printset["ip"])) { ?>8000<?php  } else { ?><?php  echo $printset["ip"];?><?php  } ?>:<?php  if(empty($printset["port"])) { ?>8000<?php  } else { ?><?php  echo $printset["port"];?><?php  } ?>/CLodopfuncs.js'></script>
	<script language='javascript'>
		function pagesize(){
				var _width = $("input[name=width]").val();
			 	var _height = $("input[name=height]").val();
			 	if(_width<10){
			 		alert("最低宽度不小于10");
			 		$("input[name=width]").val("10");
			 		return;
			 	}
			 	if(_width>400){
			 		alert("最大宽度不大于400");
			 		$("input[name=width]").val("400");
			 		return;
			 	}
			 	$("#container").height(_height+"mm").width(_width+"mm");
		}
		function delInput(){
			var _index = currentDrag.attr("index");
			$(".drag").each(function(){
				var index = $(this).attr("index");
				if(index==_index){
					$(this).remove();
				}
			});
			$(".deleteinput").hide(); 
		} 
		function addInput(n) {
			var index = $('#container .drag').length + 1;
			if(n==1){
				var data = '<div class="drag" cate="2" style="width: auto; height: auto; padding: 10px;" index="' + index + '" style="z-index:' + index + '" fields="" item-size="12" item-font="微软雅黑" item-align="1">';
					  data+='<div class="text-table">';
					  data+='请在左侧先选择列';
					  data+='</div>';
					  data+='<div class="rRightDown"> </div><div class="rLeftDown"> </div><div class="rRightUp"> </div><div class="rLeftUp"> </div><div class="rRight"> </div><div class="rLeft"> </div><div class="rUp"> </div><div class="rDown"></div>';
					  data+='</div>';
				var drag = $(data)
			}else{
				var drag = $('<div class="drag" cate="1" index="' + index + '" style="z-index:' + index + '" fields="" item-size="12" item-font="微软雅黑" item-align="1"><div class="text" style="font-size:12pt"></div><div class="rRightDown"> </div><div class="rLeftDown"> </div><div class="rRightUp"> </div><div class="rLeftUp"> </div><div class="rRight"> </div><div class="rLeft"> </div><div class="rUp"> </div><div class="rDown"></div></div>');
			}
			$('#container').append(drag);
			bindEvents(drag);
			setCurrentDrag(drag);
		}
		function changeBG(n) {
			if(n){
				$("#bgimg").attr("src","").hide(); 
				$("#bg").val("");
			}else{
				util.image('', function(data) {
					$("#bgimg").attr("src",data.url).show(); 
					$("#bg").val(data.url);
				});
			}
		}
		var currentDrag = false;

		function bindEvents(obj) {
			var index = obj.attr('index');
			var rs = new Resize(obj, {
				Max: true,
				mxContainer: "#container"
			});
			rs.Set($(".rRightDown", obj), "right-down");
			rs.Set($(".rLeftDown", obj), "left-down");
			rs.Set($(".rRightUp", obj), "right-up");
			rs.Set($(".rLeftUp", obj), "left-up");
			rs.Set($(".rRight", obj), "right");
			rs.Set($(".rLeft", obj), "left");
			rs.Set($(".rUp", obj), "up");
			rs.Set($(".rDown", obj), "down");
			new Drag(obj, {
				Limit: true,
				mxContainer: "#container"
			});
			$('.drag .remove').unbind('click').click(function() {
				$(this).parent().remove();
			});
			$.contextMenu({
				selector: '.drag[index=' + index + ']',
				callback: function(key, options) {
					var index = $(this).attr('index');
					if (key == 'next') {
						var nextdiv = $(this).next('.drag');
						if (nextdiv.length > 0) {
							nextdiv.insertBefore($(this));
						}
					}
					else if (key == 'prev') {
						var prevdiv = $(this).prev('.drag');
						if (prevdiv.length > 0) {
							$(this).insertBefore(prevdiv);
						}
					}
					else if (key == 'last') {
						var len = $('.drag').length;
						if (index >= len - 1) {
							return;
						}
						var last = $('#container .drag:last');
						if (last.length > 0) {
							$(this).insertAfter(last);
						}
					}
					else if (key == 'first') {
						var index = $(this).index();
						if (index <= 1) {
							return;
						}
						var first = $('#container .drag:first');
						if (first.length > 0) {
							$(this).insertBefore(first);
						}
					}
					else if (key == 'delete') {
						$(this).remove();
						$('.items').hide();
						$(".item-tip").show();
						$(".deleteinput").hide();
					}
					var n = 1;
					$('.drag').each(function() {
						$(this).css("z-index", n);
						n++;
					})
				},
				items: {"next": {name: "调整到上层"},"prev": {name: "调整到下层"},"last": {name: "调整到最顶层"},"first": {name: "调整到最低层"},"delete": {name: "删除元素"}}
			});
			obj.unbind('mousedown').mousedown(function() {
				setCurrentDrag(obj);
			});
		}
		var timer = 0;
		function setCurrentDrag(obj) {
			currentDrag = obj;
			var cate = obj.attr('cate');
			bindItems();
			$(".item-tip").hide();
			$('.items').show();
			$(".deleteinput").show();
			if(cate==1){
				$(".cate1").show();
				$(".cate2").hide();
			}
			if(cate==2){
				$(".cate2").show();
				$(".cate1").hide(); 
			}
			$('.drag').css('border', '1px solid #aaa');
			obj.css('border', '1px solid #428bca');
		}
		function bindItems() {
			var items = currentDrag.attr('items') || "";
			var values = items.split(',');
			$('.items').find(':checkbox').each(function() {
				$(this).get(0).checked = false;
			});
			$('#item-font').val('');
			$('#item-size').val('');
			$('#item-bold').val('');
			for (var i in values) {
				if (values[i] != '') {
					$('.items').find(":checkbox[value='" + values[i] + "']").get(0).checked = true;
				}
			}
			$('#item-font').val(currentDrag.attr('item-font') || '');
			$('#item-size').val(currentDrag.attr('item-size') || '');
			$('#item-bold').val(currentDrag.attr('item-bold') || '');
			$('#item-pre').val(currentDrag.attr('item-pre') || '');
			$('#item-last').val(currentDrag.attr('item-last') || '');
			$('#item-align').val(currentDrag.attr('item-align') || '');
			var itemcolor = $('#item-color');
			var input = itemcolor.find('input:first');
			var picker = itemcolor.find('.sp-preview-inner');
			var color = currentDrag.attr('item-color') || '#000';
			input.val(color);
			picker.css({
				'background-color': color
			});
			timer = setInterval(function() {
				var cate = currentDrag.attr("cate");
				if(cate==1){
					currentDrag.attr('item-color', input.val()).find('.text').css('color', input.val());
				}
				if(cate==2){
					currentDrag.attr('item-color', input.val()).find('.text-table').css('color', input.val());
				}
				currentDrag.attr('item-pre', $('#item-pre').val());
				currentDrag.attr('item-last', $('#item-last').val());
				var pre = currentDrag.attr('item-pre') || "";
				var last = currentDrag.attr('item-last') || "";
				var string = currentDrag.attr('item-string') || "";
				currentDrag.find('.text').html(pre + string + last);
			}, 10);
		}
		$(function() {
			$('#dataform').ajaxForm();
			$('.drag').each(function() {
				bindEvents($(this));
			})
			
			$('.items .checkbox-inline').click(function(e) {
			    if( $(e.target).find('input').length>0){
			    	return;
			    }
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var values = [];
					var titles = [];
					var datas = [];
					var vd = [];
					$('.items').find(':checkbox:checked').each(function() {
						var _titles = $(this).attr('title');
						var _values = $(this).val();
						var _vd = $(this).data('vd');
						titles.push(_titles);
						values.push(_values);
						vd.push(_vd);
						datas.push({"value":_values,"title":_titles,"vd":_vd});
					});
					if(cate==1){
						currentDrag.attr('items', values.join(',')).attr('item-string', titles.join(',')).find('.text').text(titles.join(','));
					}
					if(cate==2){
						var _table = '';
						_table += '<table border="1" style="width:100%">';
						_table+='<tr style="font-weight:bold">';
						$.each(datas, function(i,data) {
							_table+='<td>&nbsp;'+data.title+'&nbsp;</td>';
						});
						_table+='</tr>';
						for(i=1;i<5;i++){
							_table+='<tr>';
							$.each(datas, function(ii,data) {
								if(data.vd!=''){
									if(data.vd=='number'){
										_table+='<td>'+i+'</td>'; 
									}else{
										_table+='<td>'+data.vd+i+'</td>';
									}
								}else{
									_table+='<td>'+data.vd+'</td>';
								}
							});
							_table+='</tr>';
						}
						_table += '<tr><td colspan="'+datas.length+'">提示: 以上表格数据为虚拟数据，打印时将替换为订单数据且打印时此行不会出现。</td></tr>';
						_table += '</table>';
						currentDrag.attr('items', values.join(',')).attr({'item-string': titles.join(','),'item-virtual': vd.join(',')}).find('.text-table').html(_table);
					}
				}
			});
			$('#item-font').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-font', data);
					if (data == '') {
						data = "微软雅黑";
					}
					if(cate==1){
						currentDrag.attr('item-font', data).find(".text").css('font-family', data);
					}
					if(cate==2){
						currentDrag.attr('item-font', data).find(".text-table").css('font-family', data);
					}
				}
			});
			$('#item-align').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-align', data);
					if (data == '') {
						data = "1";
					}
					var str = '';
					if (data == 1) {
						str = "left";
					}
					if (data == 2) {
						str = "center";
					}
					if (data == 3) {
						str = "right";
					}
					
					if(cate==1){
						currentDrag.attr('item-font', data).find(".text").css('text-align', str);
					}
					if(cate==2){
						currentDrag.attr('item-font', data).find(".text-table").css('text-align', str);
					}
				}
			});
			$('#item-size').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-size', data);
					if (data == '') {
						data = 12;
					}
					if(cate==1){
						currentDrag.find(".text").css('font-size', data + "pt");
					}
					if(cate==2){
						currentDrag.find(".text-table").css('font-size', data + "pt");
					}
				}
			});
			$('#item-bold').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-bold', data);
					if(cate==1){
						if (data == 'bold') {
							currentDrag.css('font-weight', 'bold');
						} else {
							currentDrag.find(".text").css('font-weight', 'normal');
						}
					}
					if(cate==2){
						if (data == 'bold') {
							currentDrag.css('font-weight', 'bold');
						} else {
							currentDrag.find(".text-table").css('font-weight', 'normal');
						}
					}
				}
			});
		});

		function save(ispreview) {
			if ($(':input[name=expressname]').isEmpty()) {
				Tip.focus($(':input[name=expressname]'), '请填写快递单名称!');
				return;
			}
			var data = [];
			$('.drag').each(function() {
				var obj = $(this);
				var d = {
					left: obj.css('left'),
					top: obj.css('top'),
					width: obj.css('width'),
					height: obj.css('height'),
					items: obj.attr('items'),
					font: obj.attr('item-font'),
					size: obj.attr('item-size'),
					color: obj.attr('item-color'),
					bold: obj.attr('item-bold'),
					string: obj.attr('item-string'),
					pre: obj.attr('item-pre'),
					last: obj.attr('item-last'),
					align: obj.attr('item-align'),
					cate: obj.attr('cate'),
					virtual: obj.attr('item-virtual')
				};
				data.push(d);
			});
			<?php  if($cate==1) { ?>
				$("#expresscom").val($("#express").find("option:selected").data("name"));
			<?php  } ?>
			$('#datas').val(JSON.stringify(data));
			$('.btnsave').button('loading');
			$('#dataform').ajaxSubmit(function(data) {
				$('.btnsave').button('reset');
				data = eval("(" + data + ")");
				$(':hidden[name=id]').val(data.id);
				if (ispreview) {
					previews();
				} else {
					location.href = "<?php  echo $this->createPluginWebUrl('exhelper/express',array('op'=>'list','cate'=>$cate))?>";
				}
			})
			return;
		}

		function previews() {
			var LODOP=getCLodop();
			alert("保存成功！正在生成预览。。。");
			var Width = $("input[name=width]").val()+"pt";
			var Height = $("input[name=height]").val()+"pt";
			LODOP.PRINT_INITA(0,0,Width,Height,"快递单预览"); //1188
			LODOP.ADD_PRINT_HTM(0, 0, 869, 480, $("#container").html());
			LODOP.PREVIEW();
		}
	</script>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>