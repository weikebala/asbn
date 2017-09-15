<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op'=>'display'));?>">商品列表</a>
	</li>
	<li><a href="<?php  echo $this->createWebUrl('goods', array('op'=>'edit'));?>">添加商品</a>
	</li>
	<li <?php  if($op == 'recycle') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op'=>'recycle'));?>">商品回收站</a>
	</li>
	<!--<li <?php  if($op == 'check') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op'=>'check'));?>">待审商品</a>
	</li>-->
</ul>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="feng_fightgroups" />
                <input type="hidden" name="do" value="goods" />
                <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">所属商家</label>
					 <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<select name="merchantid" class="form-control">
							<option value="" <?php  if(empty($_GPC['merchantid'])) { ?>selected="selected"<?php  } ?>>所有</option>
							<option value="self" <?php  if($_GPC['merchantid']=='self') { ?>selected="selected"<?php  } ?>><?php  echo $_W['account']['name'];?></option>
							<?php  if(is_array($merchants)) { foreach($merchants as $row) { ?>
					            <option value="<?php  echo $row['id'];?>" <?php  if($_GPC['merchantid']==$row['id']) { ?>selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
				        </select>
					</div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商品名称</label>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可模糊查询商品名称">
                    </div>
				</div>
                <div class="form-group">
                    
                </div>
                <?php  if($this->module['config']['ditype']!=2) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">分类</label>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <select name="pay_type" class="form-control">
                            <option value="">不限</option>
                            <?php  if(is_array($category)) { foreach($category as $key => $type) { ?>
                            <option value="<?php  echo $type['id'];?>" <?php  if($_GPC['pay_type'] == $type['id']) { ?> selected="selected" <?php  } ?>><?php  echo $type['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="col-sm-3 col-lg-2"><button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
                <?php  } else { ?>
                <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商品分类</label>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					 <?php  echo tpl_form_field_category_2level('category', $category, $childs, $goods['category_parentid'], $goods['category_childid'])?>
					</div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                        <div class="col-sm-3 col-lg-2"><button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        </div>
				</div>
				<?php  } ?>
            </form>
   </div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">商品列表</div>
		<form action="" method="post" onsubmit="return formcheck(this)">
		<div class="table-responsive panel-body">
			<table class="table table-hover" style="min-width: 300px;">
				<thead class="navbar-inner">
					<tr>
						<th class="col-sm-1">显示顺序</th>
						<th class="col-sm-2">名称</th>
						<th class="col-sm-1">图片</th>
						<!--<th class="col-sm-1">分类</th>-->
						<th class="col-sm-1">商品库存</th>
						<th class="col-sm-1">销量</th> 
						<th class="col-sm-1">团购价</th>
						<th class="col-sm-1">单买价</th>
						<th class="col-sm-1">起团人数</th>
						<th class="col-sm-2">所属商家</th>
						<th style="width: 270px;">状态(点击可修改)</th>
						
						<th class="text-right" style="width: 90px;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($goodses)) { foreach($goodses as $goodsid => $goods) { ?>
					<tr>
						<td><input type="text" class="form-control" name="displayorder[<?php  echo $goods['id'];?>]" value="<?php  echo $goods['displayorder'];?>"></td>
						<td><?php  echo $goods['gname'];?></td>
						<td>
							<image src="<?php  echo tomedia($goods['gimg']);?>" style="max-width: 48px; max-height: 48px; border: 1px dotted gray">
						</td>
						<!--<td><?php  echo $goods['category']['name'];?></td>-->
						<td><?php  echo $goods['gnum'];?></td>
						<td><?php  echo $goods['salenum'];?></td>
						<td><?php  echo $goods['gprice'];?>元</td>
						<td><?php  echo $goods['oprice'];?>元</td>
						<td><?php  echo $goods['groupnum'];?>人</td>
						<td><?php  if(empty($goods['merchant']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $goods['merchant']['name'];?><?php  } ?></td>
						<td>
						<?php  if($this->module['config']['goodstip'] == 2) { ?>
						<label data='<?php  echo $goods['isnew'];?>' class='label label-default <?php  if($goods['isnew']==1) { ?>label-info<?php  } else { ?><?php  } ?>' onclick="setProperty(this,<?php  echo $goods['id'];?>,'new')"><?php  if($this->module['config']['tag1']) { ?><?php  echo $this->module['config']['tag1'];?><?php  } else { ?>上新<?php  } ?></label>
						<label data='<?php  echo $goods['ishot'];?>' class='label label-default <?php  if($goods['ishot']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $goods['id'];?>,'hot')"><?php  if($this->module['config']['tag2']) { ?><?php  echo $this->module['config']['tag2'];?><?php  } else { ?>疯抢<?php  } ?></label>
						<label data='<?php  echo $goods['isrecommand'];?>' class='label label-default <?php  if($goods['isrecommand']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $goods['id'];?>,'recommand')"><?php  if($this->module['config']['tag3']) { ?><?php  echo $this->module['config']['tag3'];?><?php  } else { ?>推荐<?php  } ?></label>
						<label data='<?php  echo $goods['isdiscount'];?>' class='label label-default <?php  if($goods['isdiscount']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $goods['id'];?>,'discount')"><?php  if($this->module['config']['tag4']) { ?><?php  echo $this->module['config']['tag4'];?><?php  } else { ?>优惠<?php  } ?></label>
						<label data='<?php  echo $goods['isshow'];?>' class='label label-default <?php  if($goods['isshow']==3) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $goods['id'];?>,'isshow2')">售罄</label>
						<?php  } ?>
						<?php  if($op == 'display') { ?>
						<label data='<?php  echo $goods['isshow'];?>' class='label  label-default <?php  if($goods['isshow']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $goods['id'];?>,'isshow')"><?php  if($goods['isshow']==1) { ?>上架<?php  } else { ?>下架<?php  } ?></label>
						<?php  } ?>
						</td>
						<td class="text-right">
							<?php  if($op == 'display') { ?>
							<a href="<?php  echo $this->createWebUrl('goods', array('op'=>'edit', 'id'=>$goods['id']));?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
							<a href="<?php  echo $this->createWebUrl('goods',array('op'=>'redel','id'=>$goods['id']));?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="删除"><i class="fa fa-times"></i>
							</a>
							<?php  } else { ?>
							<a href="<?php  echo $this->createWebUrl('goods', array('op'=>'return', 'id'=>$goods['id']));?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="还原">还原</a>
							<a href="<?php  echo $this->createWebUrl('goods',array('op'=>'delete','id'=>$goods['id']));?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="删除">删除
							</a>
							<?php  } ?>
						</td>
					</tr>
					<?php  } } ?>
					<?php  if(empty($goodses)) { ?>		
					<tr>
						<td colspan="12">
							尚未添加商品
						</td>
					</tr>
					<?php  } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
	</div>
	</form>
</div>
</div>
<script type="text/javascript">
	require(['bootstrap'],function($){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});

	var category = <?php  echo json_encode($children)?>;
	function setProperty(obj,id,type){
		$(obj).html($(obj).html() + "...");
		$.post("<?php  echo $this->createWebUrl('setgoodsproperty')?>"
			,{id:id,type:type, data: obj.getAttribute("data")}
			,function(d){
				$(obj).html($(obj).html().replace("...",""));
				if(type=='isshow'){
				 $(obj).html( d.data=='1'?'上架':'下架');
				}
				$(obj).attr("data",d.data);
				if(d.result==1){
					$(obj).toggleClass("label-info");
				}
			}
			,"json"
		);
	}

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>