<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/tabs', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="resource/js/lib/jquery-ui-1.10.3.min.js"></script>
<?php  if($operation == 'post') { ?>
<style type='text/css'>
    .tab-pane {padding:20px 0 20px 0;}
</style>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php  if(empty($item['id'])) { ?>添加商品<?php  } else { ?>编辑商品<?php  } ?>
            </div>
            <div class="panel-body">
                <ul class="nav nav-arrow-next nav-tabs" id="myTab">
                    <li class="active" ><a href="#tab_basic">基本信息</a></li>
                    <li><a href="#tab_des">商品描述</a></li>
                    <li><a href="#tab_param">自定义属性</a></li>
                    <li><a href="#tab_option">商品规格</a></li>
                    <li><a href="#tab_discount">会员权限及折扣设置</a></li>
					<li><a href="#tab_share">分享及关注设置</a></li>
                    <li><a href="#tab_others">其他设置</a></li>

                    <?php  if(p('verify')) { ?>
					<li><a href="#tab_verify">线下核销设置</a></li>
                    <?php  } ?>
                    <?php  if(!empty($com_set['level'])) { ?>
                    <li><a href="#tab_sell">加盟设置</a></li>
                    <?php  } ?>
                    <?php  if(p('sale')) { ?>
					<li><a href="#tab_sale">营销设置</a></li>
                    <?php  } ?>
                    <li><a href="#tab_detaildiy">详情页店铺信息设置</a></li>
                    <?php  if(p('diyform')) { ?>
					<li><a href="#tab_diyform">自定义表单</a></li>
                    <?php  } ?>
                </ul> 
                <div class="tab-content">
                    <div class="tab-pane  active" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/basic', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/basic', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_des"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/des', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/des', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_param"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/param', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/param', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_option"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/option', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/option', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_discount"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/discount', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/discount', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_share"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/share', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/share', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_others"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/others', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/others', TEMPLATE_INCLUDEPATH));?></div>

                    <div class="tab-pane" id="tab_detaildiy"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/goods/detaildiy', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/goods/detaildiy', TEMPLATE_INCLUDEPATH));?></div>

                    <?php  if(p('verify')) { ?>
                    <div class="tab-pane" id="tab_verify"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('verify/goods', TEMPLATE_INCLUDEPATH)) : (include template('verify/goods', TEMPLATE_INCLUDEPATH));?></div>
                    <?php  } ?>

                    <?php  if(p('commission') && !empty($com_set['level'])) { ?>
                    <div class="tab-pane" id="tab_sell"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('commission/goods', TEMPLATE_INCLUDEPATH)) : (include template('commission/goods', TEMPLATE_INCLUDEPATH));?></div>
                    <?php  } ?> 

                    <?php  if(p('sale')) { ?>
                    <div class="tab-pane" id="tab_sale"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/goods', TEMPLATE_INCLUDEPATH)) : (include template('sale/goods', TEMPLATE_INCLUDEPATH));?></div>
                    <?php  } ?>

                    <?php  if(p('diyform')) { ?>
                    <div class="tab-pane" id="tab_diyform"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/goods', TEMPLATE_INCLUDEPATH)) : (include template('diyform/goods', TEMPLATE_INCLUDEPATH));?></div>
                    <?php  } ?>

                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
			<?php if( ce('shop.goods' ,$item) ) { ?>
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return formcheck()" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			<?php  } ?>
			<input type="button" name="back" onclick='history.back()' <?php if(cv('shop.goods.add|shop.goods.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />

        </div>
    </form>
</div>

<script type="text/javascript">
	window.type = "<?php  echo $item['type'];?>";
	window.virtual = "<?php  echo $item['virtual'];?>";

	$(function () {

		$(':radio[name=type]').click(function () {
			window.type = $("input[name='type']:checked").val();
			window.virtual = $("#virtual").val();
            if(window.type=='1'){
                $('#dispatch_info').show();
            } else {
                $('#dispatch_info').hide();
            }
			if (window.type == '3') {
				if ($('#virtual').val() == '0') {
					$('.choosetemp').show();
				}
			}
		})
	})
			var category = <?php  echo json_encode($children)?>;
	window.optionchanged = false;
	require(['bootstrap'], function () {
		$('#myTab a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		})
	});

	require(['util'], function (u) {
		$('#cp').each(function () {
			u.clip(this, $(this).text());
		});
	})

	function formcheck() {
		window.type = $("input[name='type']:checked").val();
		window.virtual = $("#virtual").val();

		if ($("#goodsname").isEmpty()) {
		$('#myTab a[href="#tab_basic"]').tab('show');
				Tip.focus("#goodsname", "请输入商品名称!");
				return false;
		}
		<?php  if($shopset['catlevel'] == 3) { ?>
		if ($("#category_third").val() == '0') {
		$('#myTab a[href="#tab_basic"]').tab('show');
				Tip.focus("#category_third", "请选择完整商品分类!");
				return false;
		}
		<?php  } else { ?>
		if ($("#category_child").val() == '0') {
			$('#myTab a[href="#tab_basic"]').tab('show');
			Tip.focus("#category_child", "请选择完整商品分类!");
			return false;
		}

		<?php  } ?>

		<?php  if(empty($id)) { ?>
		if ($.trim($(':input[name="thumb"]').val()) == '') {
		$('#myTab a[href="#tab_basic"]').tab('show');
				Tip.focus(':input[name="thumb"]', '请上传缩略图.');
				return false;
		}
		<?php  } ?>
				var full = true;
		if (window.type == '3') {

			if (window.virtual != '0') {  //如果单规格，不能有规格

				if ($('#hasoption').get(0).checked) {

					$('#myTab a[href="#tab_option"]').tab('show');
					util.message('您的商品类型为：虚拟物品(卡密)的单规格形式，需要关闭商品规格！');
					return false;
				}
			}
			else {

				var has = false;
				$('.spec_item_virtual').each(function () {
					has = true;
					if ($(this).val() == '' || $(this).val() == '0') {
						$('#myTab a[href="#tab_option"]').tab('show');
						Tip.focus($(this).next(), '请选择虚拟物品模板!');
						full = false;
						return false;
					}
				});
				if (!has) {
					$('#myTab a[href="#tab_option"]').tab('show');
					util.message('您的商品类型为：虚拟物品(卡密)的多规格形式，请添加规格！');
					return false;
				}
			}
		}
		if (!full) {
			return false;
		}

		full = checkoption();
		if (!full) {
			return false;
		}
		if (optionchanged) {
			$('#myTab a[href="#tab_option"]').tab('show');
			alert('规格数据有变动，请重新点击 [刷新规格项目表] 按钮!');
			return false;
		}
		return true;
	}

	function checkoption() {

		var full = true;
		if ($("#hasoption").get(0).checked) {
			$(".spec_title").each(function (i) {
				if ($(this).isEmpty()) {
					$('#myTab a[href="#tab_option"]').tab('show');
					Tip.focus(".spec_title:eq(" + i + ")", "请输入规格名称!", "top");
					full = false;
					return false;
				}
			});
			$(".spec_item_title").each(function (i) {
				if ($(this).isEmpty()) {
					$('#myTab a[href="#tab_option"]').tab('show');
					Tip.focus(".spec_item_title:eq(" + i + ")", "请输入规格项名称!", "top");
					full = false;
					return false;
				}
			});
		}
		if (!full) {
			return false;
		}
		return full;
	}

</script>

<?php  } else if($operation == 'display') { ?>

<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="sea" />
                <input type="hidden" name="do" value="shop" />
                <input type="hidden" name="p"  value="goods" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <select name="status" class='form-control'>
							<option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>></option>
                            <option value="1" <?php  if($_GPC['status']== '1') { ?> selected<?php  } ?>>上架</option>
                            <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>下架</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商品类型</label>

                  <div class="col-xs-12 col-sm-8 col-lg-9">
                    <label for="isnew" style="font-weight:100; margin-left:10px;">
                         <input type="checkbox"  <?php  if($_GPC['product_attr']['isnew'] == '1') { ?> checked<?php  } ?> name="product_attr[isnew]" value="1" id="isnew" />
                            新品
                    </label>
                    <label for="ishot" style="font-weight:100; margin-left:10px;">
                         <input type="checkbox"  <?php  if($_GPC['product_attr']['ishot'] == '1') { ?> checked<?php  } ?> name="product_attr[ishot]" value="1" id="ishot" />
                            热卖          
                    </label>
                    <label for="isrecommand" style="font-weight:100; margin-left:10px;">
                        <input type="checkbox"   <?php  if($_GPC['product_attr']['isrecommand'] == '1') { ?> checked<?php  } ?> name="product_attr[isrecommand]" value="1" id="isrecommand" />
                        推荐                            
                    </label>
                    <label for="isdiscount" style="font-weight:100; margin-left:10px;">
                         <input type="checkbox"  <?php  if($_GPC['product_attr']['isdiscount'] == '1') { ?> checked<?php  } ?> name="product_attr[isdiscount]" value="1" id="isdiscount" />
                            促销                           
                    </label>
                     <label for="issendfree" style="font-weight:100; margin-left:10px;">
                          <input type="checkbox"  <?php  if($_GPC['product_attr']['issendfree'] == '1') { ?> checked<?php  } ?> name="product_attr[issendfree]" value="1" id="issendfree" />
                            包邮                            
                     </label>
                     <label for="istime" style="font-weight:100; margin-left:10px;">
                          <input type="checkbox" <?php  if($_GPC['product_attr']['istime'] == '1') { ?> checked<?php  } ?> name="product_attr[istime]" value="1" id="istime" />
                            限时                            
                     </label>
                     <label for="isnodiscount" style="font-weight:100; margin-left:10px;">
                         <input type="checkbox" <?php  if($_GPC['product_attr']['isnodiscount'] == '1') { ?> checked<?php  } ?> name="product_attr[isnodiscount]" value="1" id="isnodiscount" />
                            不参与折扣                            
                     </label>
                  </div>
                </div>
                <?php  if(p('supplier')) { ?>
                 <?php  if($perm_role == 0) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">供应商</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <select name="supplier_uid" class='form-control'>
							<option value="-1">所有供货商</option>
							<option value="0" <?php  if($_GPC['supplier_uid'] === '0') { ?> selected<?php  } ?>>平台</option>
							<?php  if(is_array($suppliers)) { foreach($suppliers as $item) { ?>
							<option value="<?php  echo $item['uid'];?>" <?php  if($item['uid'] == $_GPC['supplier_uid']) { ?> selected<?php  } ?>><?php  echo $item['realname'];?>/<?php  echo $item['username'];?></option>
							<?php  } } ?>
                        </select>
                    </div>
                </div>
                <?php  } ?>
                <?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label">分类</label>
                    <div class="col-sm-8 col-xs-12">
                        <?php  if(intval($shopset['catlevel'])==3) { ?>
						<?php  echo tpl_form_field_category_3level('category', $parent, $children, $params[':pcate'], $params[':ccate'], $params[':tcate'])?>
						<?php  } else { ?>
						<?php  echo tpl_form_field_category_2level('category', $parent, $children, $params[':pcate'], $params[':ccate'])?>
						<?php  } ?>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>

                <div class="form-group">
                </div>
            </form>
        </div>
    </div>
    <style>
        .label{cursor:pointer;}
    </style>
	<div class="panel panel-default">
        <div class="panel-body">
			<a class='btn btn-default' href="<?php  echo $this->createWebUrl('shop/goods',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加商品</a>
        </div>
	</div>
    <form action="" method="post">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th style="width:60px;">ID</th>
							<th style="width:70px;">排序</th>
							<th style="width:60px;">商品</th>
							<th  style="width:260px;">&nbsp;</th>
							<th  style="width:240px;" >商品属性</th>
							<th >价格</th>
							<th >库存</th>
							<th >实际销量</th>
							<th >商品编码</th>
							<th >商品条码</th>
							<th >状态(点击可修改)</th>
							<th style="">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr>
							
							<td><input type="checkbox" name="goodsid[]" value="<?php  echo $item['id'];?>" class="">&nbsp<?php  echo $item['id'];?></td>
							<td>
								<?php if(cv('shop.goods.edit')) { ?>
								<input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]" value="<?php  echo $item['displayorder'];?>">
								<?php  } else { ?>
								<?php  echo $item['displayorder'];?> 
								<?php  } ?>
							</td>
							<td title="<?php  echo $item['title'];?>">
								<img src="<?php  echo tomedia($item['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
							</td>
							<td title="<?php  echo $item['title'];?>" class='tdedit'>
								<?php  if(!empty($category[$item['pcate']])) { ?>
								<span class="text-danger">[<?php  echo $category[$item['pcate']]['name'];?>]</span>
								<?php  } ?>
								<?php  if(!empty($category[$item['ccate']])) { ?>
								<span class="text-info">[<?php  echo $category[$item['ccate']]['name'];?>]</span>
								<?php  } ?>
								<?php  if(!empty($category[$item['tcate']]) && intval($shopset['catlevel'])==3) { ?>
								<span class="text-info">[<?php  echo $category[$item['tcate']]['name'];?>]</span>
								<?php  } ?>
								<br/>
								<?php if(cv('shop.goods.edit')) { ?>

								<span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item['title'];?></span> </span>
								<div class="input-group goodstitle" style="display:none" data-goodsid="<?php  echo $item['id'];?>">
									<input type='text' class='form-control' value="<?php  echo $item['title'];?>"   />
									<div class="input-group-btn">
										<button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['id'];?>' data-type="title"><i class="fa fa-check"></i></button>
									</div>
								</div>
								<?php  } else { ?>
								<?php  echo $item['title'];?>
								<?php  } ?>
							</td>
							<td>

								<label data='<?php  echo $item['isnew'];?>' class='label label-default <?php  if($item['isnew']==1) { ?>label-info<?php  } else { ?><?php  } ?>'   <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'new')"<?php  } ?>>新品</label>
								<label data='<?php  echo $item['ishot'];?>' class='label label-default <?php  if($item['ishot']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'hot')"<?php  } ?>>热卖</label>
								<label data='<?php  echo $item['isrecommand'];?>' class='label label-default <?php  if($item['isrecommand']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'recommand')"<?php  } ?>>推荐</label>
								<label data='<?php  echo $item['isdiscount'];?>' class='label label-default <?php  if($item['isdiscount']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'discount')"<?php  } ?>>促销</label>
								<br/>
								<label data='<?php  echo $item['issendfree'];?>' class='label label-default <?php  if($item['issendfree']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'sendfree')"<?php  } ?>>包邮</label>
								<label data='<?php  echo $item['istime'];?>' class='label label-default <?php  if($item['istime']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'time')"<?php  } ?>>限时卖</label>
								<label data='<?php  echo $item['isnodiscount'];?>' class='label label-default <?php  if($item['isnodiscount']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'nodiscount')"<?php  } ?>>不参与折扣</label>


							</td>
							<td class='tdedit'>
								<?php  if($item['hasoption']==1) { ?>
								<?php if(cv('shop.goods.edit')) { ?>
								<span class='tip' title='多规格不支持快速修改'><?php  echo $item['marketprice'];?></span>
								<?php  } else { ?>
								<?php  echo $item['marketprice'];?>
								<?php  } ?>
								<?php  } else { ?>
								<?php if(cv('shop.goods.edit')) { ?>

								<span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item['marketprice'];?></span> </span>
								<div class="input-group" style="display:none" data-goodsid="<?php  echo $item['id'];?>">
									<input type='text' class='form-control' value="<?php  echo $item['marketprice'];?>"   />
									<div class="input-group-btn">
										<button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['id'];?>' data-type="marketprice"><i class="fa fa-check"></i></button>
									</div>
								</div>
								<?php  } else { ?>
								<?php  echo $item['marketprice'];?>
								<?php  } ?><?php  } ?>

							</td>

							<td class='tdedit'>
								<?php  if($item['hasoption']==1) { ?>
								<?php if(cv('shop.goods.edit')) { ?>
								<span class='tip' title='多规格不支持快速修改'><?php  echo $item['total'];?></span>
								<?php  } else { ?>
								<?php  echo $item['total'];?>
								<?php  } ?>
								<?php  } else { ?>
								<?php if(cv('shop.goods.edit')) { ?>

								<span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item['total'];?></span> </span>
								<div class="input-group" style="display:none" data-goodsid="<?php  echo $item['id'];?>">
									<input type='text' class='form-control' value="<?php  echo $item['total'];?>"   />
									<div class="input-group-btn">
										<button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['id'];?>' data-type="total"><i class="fa fa-check"></i></button>
									</div>
								</div>

								<?php  } else { ?>
								<?php  echo $item['total'];?>
								<?php  } ?><?php  } ?>

							</td>


							<td><?php  echo $item['salesreal'];?></td>
							<td class='tdedit'>
								<?php  if($item['hasoption']==1) { ?>
								<?php if(cv('shop.goods.edit')) { ?>
								<span class='tip' title='多规格不支持快速修改'><?php  echo $item['goodssn'];?></span>
								<?php  } else { ?>
								<?php  echo $item['goodssn'];?>
								<?php  } ?>
								<?php  } else { ?>
								<?php if(cv('shop.goods.edit')) { ?>

								<span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item['goodssn'];?></span> </span>
								<div class="input-group" style="display:none" data-goodsid="<?php  echo $item['id'];?>">
									<input type='text' class='form-control' value="<?php  echo $item['goodssn'];?>"   />
									<div class="input-group-btn">
										<button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['id'];?>' data-type="goodssn"><i class="fa fa-check"></i></button>
									</div>
								</div>
								<?php  } else { ?>
								<?php  echo $item['goodssn'];?>
								<?php  } ?><?php  } ?>

							</td>
							<td class='tdedit'>
								<?php  if($item['hasoption']==1) { ?>
								<?php if(cv('shop.goods.edit')) { ?>
								<span class='tip' title='多规格不支持快速修改'><?php  echo $item['productsn'];?></span>
								<?php  } else { ?>
								<?php  echo $item['productsn'];?>
								<?php  } ?>
								<?php  } else { ?>
								<?php if(cv('shop.goods.edit')) { ?>

								<span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item['productsn'];?></span> </span>
								<div class="input-group" style="display:none" data-goodsid="<?php  echo $item['id'];?>">
									<input type='text' class='form-control' value="<?php  echo $item['productsn'];?>"   />
									<div class="input-group-btn">
										<button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['id'];?>' data-type="productsn"><i class="fa fa-check"></i></button>
									</div>
								</div>
								<?php  } else { ?>
								<?php  echo $item['productsn'];?>
								<?php  } ?><?php  } ?>

							</td>
							<td>

                                <?php  if(p('supplier')) { ?>
                                <?php  if($_W['isfounder'] == 1) { ?>
                                    <label data='<?php  echo $item['status'];?>' class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'status')"<?php  } ?>><?php  if($item['status']==1) { ?>上架<?php  } else { ?>下架<?php  } ?></label>
                                    <label data='<?php  echo $item['type'];?>' class='label  label-default <?php  if($item['type']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'type')"<?php  } ?>><?php  if($item['type']==1) { ?>实体物品<?php  } else { ?>虚拟物品<?php  } ?></label>
                                <?php  } else { ?>
                                    <?php  $roleid = pdo_fetchcolumn('select id from' . tablename('sea_perm_role') . ' where status1=1')?>
                                    <?php  $userroleid = pdo_fetchcolumn('select roleid from' . tablename('sea_perm_user') . ' where uid=' . $_W['uid'])?>
                                    <?php  if($roleid == $userroleid) { ?>
                                        <label data='<?php  echo $item['status'];?>' class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' >
                                    <?php  } else { ?>
                                        <label data='<?php  echo $item['status'];?>' class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'status')"<?php  } ?>>
                                    <?php  } ?>
                                    <?php  if($item['status']==1) { ?>上架<?php  } else { ?>下架<?php  } ?>
                                    </label>
                                    <label data='<?php  echo $item['type'];?>' class='label  label-default <?php  if($item['type']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'type')"<?php  } ?>><?php  if($item['type']==1) { ?>实体物品<?php  } else { ?>虚拟物品<?php  } ?></label>
                                <?php  } ?>
                            <?php  } else { ?>
                                <label data='<?php  echo $item['status'];?>' class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'status')"<?php  } ?>><?php  if($item['status']==1) { ?>上架<?php  } else { ?>下架<?php  } ?></label>
                                <label data='<?php  echo $item['type'];?>' class='label  label-default <?php  if($item['type']==1) { ?>label-info<?php  } ?>' <?php if(cv('shop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'type')"<?php  } ?>><?php  if($item['type']==1) { ?>实体物品<?php  } else { ?>虚拟物品<?php  } ?></label>
                            <?php  } ?>

							</td>
							<td style="position:relative;">
								<?php if(cv('shop.goods.edit|shop.goods.view')) { ?><a href="<?php  echo $this->createWebUrl('shop/goods', array('id' => $item['id'], 'op' => 'post'))?>"class="btn btn-sm btn-default" title="<?php if(cv('shop.goods.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-pencil"></i></a><?php  } ?>
								<a href="<?php  echo $this->createWebUrl('shop/goods', array('id' => $item['id'], 'op' => 'copy'))?>" onclick="return confirm('确认复制？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="复制"><i class="fa fa-file-text-o"></i></a>
								<a href="javascript:;" data-url="<?php  echo $this->createMobileUrl('shop/detail', array('id' => $item['id']))?>"  title="复制连接" class="btn btn-default btn-sm js-clip"><i class="fa fa-link"></i></a>
								<?php if(cv('shop.goods.delete')) { ?><a href="<?php  echo $this->createWebUrl('shop/goods', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('确认删除此商品？');return false;" class="btn btn-default  btn-sm" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
							</td>
						</tr>
						<?php  } } ?>
						<tr>
							<td><input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"></td>
							<td colspan='11'>
								<?php  if($_W['role'] == founder) { ?>
									<input type="submit" name="submit" class="btn btn-primary" value="批量上架" onclick="return confirm('确认修改下架状态吗？');return false;">
									<input type="submit" name="submit" class="btn btn-primary" value="批量下架" onclick="return confirm('确认修改上架状态吗？');return false;">
									<?php  } else { ?>
								<?php  } ?>
								<input type="submit" name="submit" class="btn btn-primary" value="批量删除" onclick="return confirm('确认删除所选商品吗？');return false;">
								<input name="submit" type="submit" class="btn btn-primary" value="提交排序">
								<?php if(cv('shop.goods.add')) { ?>
								<a class='btn btn-default' href="<?php  echo $this->createWebUrl('shop/goods',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加商品</a>
								<?php  } ?>
								<?php if(cv('shop.goods.edit')) { ?>
								<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								<?php  } ?>

							</td>
						</tr>

						</tr>
					</tbody>
				</table>
				<?php  echo $pager;?>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	function fastChange(id, type, value) {
		
		$.ajax({
			url: "<?php  echo $this->createWebUrl('shop/goods')?>",
			type: "post",
			data: {op: 'change', id: id, type: type, value: value},
			cache: false,
			success: function () {

			}
		})
	}
	$(function () {
		$("form").keypress(function(e) {
			if (e.which == 13) {
			  return false;
			}
		  });

		$('.tdedit input').keydown(function (event) {
			if (event.keyCode == 13) {
			     var group = $(this).closest('.input-group');
				 var type = group.find('button').data('type');
				var goodsid = group.find('button').data('goodsid');
				var val = $.trim($(this).val());
				if(type=='title' && val==''){
					return;
				}
				group.prev().show().find('span').html(val);
				group.hide();
				fastChange(goodsid,type,val);
			}
		})
		$('.tdedit').mouseover(function () {
			$(this).find('.fa-pencil').show();
		}).mouseout(function () {
			$(this).find('.fa-pencil').hide();
		});
		$('.fa-edit-item').click(function () {
			var group = $(this).closest('span').hide().next();

			group.show().find('button').unbind('click').click(function () {
				var type = $(this).data('type');
				var goodsid = $(this).data('goodsid');
				var val = $.trim(group.find(':input').val());
				if(type=='title' && val==''){
					Tip.show(group.find(':input'), '请输入名称!');
					return;
				}
				group.prev().show().find('span').html(val);
				group.hide();
				fastChange(goodsid,type,val);
			});
		})
	})
			var category = <?php  echo json_encode($children)?>;
	function setProperty(obj, id, type) {
		$(obj).html($(obj).html() + "...");
		$.post("<?php  echo $this->createWebUrl('shop/goods')?>"
				, {'op': 'setgoodsproperty', id: id, type: type, data: obj.getAttribute("data")}
		, function (d) {
			$(obj).html($(obj).html().replace("...", ""));
			if (type == 'type') {
				$(obj).html(d.data == '1' ? '实体物品' : '虚拟物品');
			}
			if (type == 'status') {
				$(obj).html(d.data == '1' ? '上架' : '下架');
			}
			$(obj).attr("data", d.data);
			if (d.result == 1) {
				$(obj).toggleClass("label-info");
			}
		}
		, "json"
				);
	}

</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>

