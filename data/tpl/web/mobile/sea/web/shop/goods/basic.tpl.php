<?php defined('IN_IA') or exit('Access Denied');?>﻿<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('shop.goods' ,$item) ) { ?>
        <input type="text" name="displayorder" id="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
        <span class='help-block'>数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
        <?php  } ?>
    </div>
</div>
<!-- 供货商start -->
<?php  if(p('supplier')) { ?>
  <?php  if($perm_role == 0) { ?>
  <div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">供货商</label>
      <div class="col-sm-9 col-xs-12">
        <select name='supplier_uid' class='form-control' id="supplier_uid">
          <option value="">
              请选择供货商
          </option>
          <?php  if(is_array($result)) { foreach($result as $row) { ?>
          <option value="<?php  echo $row['uid'];?>" <?php  if($item['supplier_uid']==$row['uid']) { ?>selected="selected"<?php  } ?>><?php  echo $row['realname'];?>/<?php  echo $row['username'];?></option>
          <?php  } } ?>
        </select>
          <span class='help-block'>选择供货商</span>
      </div>
  </div>
  <?php  } ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#supplier_uid').change(function(){
      if ($('#supplier_uid').val() != ''){
        $('#dispatchprice').attr('readonly','readonly');
        $('#dispatchtype1').attr('checked',true);
        $('#dispatchtype2').attr('checked',false);
        $('#type_dispatch_isshow').hide();
        //alert($('input[name="dispatchtype"]').val());
      }else{
        $('#type_dispatch_isshow').show();
        $('#dispatchprice').removeAttr('readonly');
      }
    });
  });
</script>
<?php  } ?>

<!-- 供货商end -->
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>商品名称</label>
    <div class="col-sm-9 col-xs-12">
         <?php if( ce('shop.goods' ,$item) ) { ?>
        <input type="text" name="goodsname" id="goodsname" class="form-control" value="<?php  echo $item['title'];?>" />
            <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['title'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>分类</label>
    <div class="col-sm-8 col-xs-12">
        <?php  if($shopset['catlevel']==3) { ?>
             <?php if( ce('shop.goods' ,$item) ) { ?>
             <?php  echo tpl_form_field_category_3level('category', $parent, $children, $item['pcate'], $item['ccate'], $item['tcate'])?>
             <?php  } else { ?>
              <div class='form-control-static'>
                   <?php  echo pdo_fetchcolumn('select name from '.tablename('sea_category').' where id=:id limit 1',array(':id'=>$item['pcate']))?> -
                   <?php  echo pdo_fetchcolumn('select name from '.tablename('sea_category').' where id=:id limit 1',array(':id'=>$item['ccate']))?> -
                   <?php  echo pdo_fetchcolumn('select name from '.tablename('sea_category').' where id=:id limit 1',array(':id'=>$item['tcate']))?>
              </div>
             <?php  } ?>

        <?php  } else { ?>
            <?php if( ce('shop.goods' ,$item) ) { ?>
            <?php  echo tpl_form_field_category_2level('category', $parent, $children, $item['pcate'], $item['ccate'])?>
            <?php  } else { ?>
              <div class='form-control-static'>
                   <?php  echo pdo_fetchcolumn('select name from '.tablename('sea_category').' where id=:id limit 1',array(':id'=>$item['pcate']))?> -
                   <?php  echo pdo_fetchcolumn('select name from '.tablename('sea_category').' where id=:id limit 1',array(':id'=>$item['ccate']))?>
              </div>
            <?php  } ?>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">品牌</label>
      <div class="col-sm-9 col-xs-12">
        <select name='brandid' class='form-control' id="brandid">
          <option value="">
              请选择品牌
          </option>
          <?php  if(is_array($brand)) { foreach($brand as $row) { ?>
          <option value="<?php  echo $row['id'];?>" <?php  if($item['brandid']==$row['id']) { ?>selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
          <?php  } } ?>
        </select>
          <span class='help-block'>选择品牌</span>
      </div>
  </div>

<link href="../addons/sea/static/js/dist/select2/select2.css" rel="stylesheet">
<link href="../addons/sea/static/js/dist/select2/select2-bootstrap.css" rel="stylesheet">
<script language="javascript" src="../addons/sea/static/js/dist/select2/select2.min.js"></script>
<script language="javascript" src="../addons/sea/static/js/dist/select2/select2_locale_zh-CN.js"></script>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">其他分类</label>
    <div class="col-sm-8 col-xs-12">

            <?php if( ce('shop.goods' ,$item) ) { ?>

               <select id="cates" name='cates[]' class="form-control" multiple="" >
                <?php  if(intval($shopset['catlevel'])==3) { ?>
                        <?php  if(is_array($category)) { foreach($category as $p) { ?>
                                    <?php  if(empty($p['parentid'])) { ?>
                                        <?php  if(is_array($children[$p['id']])) { foreach($children[$p['id']] as $c) { ?>
                                           <?php  if(is_array($children[$c['id']])) { foreach($children[$c['id']] as $t) { ?>
                                             <option value="<?php  echo $t['id'];?>" <?php  if(is_array($cates) && in_array($t['id'],$cates)) { ?>selected<?php  } ?> ><?php  echo $p['name'];?>-<?php  echo $c['name'];?>-<?php  echo $t['name'];?></option>
                                           <?php  } } ?>
                                        <?php  } } ?>
                                    <?php  } ?>
                                <?php  } } ?>
                                <?php  } else { ?>
                                        <?php  if(is_array($category)) { foreach($category as $p) { ?>
                                            <?php  if(empty($p['parentid'])) { ?>
                                                <?php  if(is_array($children[$p['id']])) { foreach($children[$p['id']] as $c) { ?>
                                                   <option value="<?php  echo $c['id'];?>" <?php  if(is_array($cates) && in_array($c['id'],$cates)) { ?>selected<?php  } ?> ><?php  echo $p['name'];?>-<?php  echo $c['name'];?></option>
                                                <?php  } } ?>
                                            <?php  } ?>
                                        <?php  } } ?>
                             <?php  } ?>
                  </select>

            <?php  } else { ?>

              <div class='form-control-static'>
                         <?php  if(intval($shopset['catlevel'])==3) { ?>
                            <?php  if(is_array($category)) { foreach($category as $p) { ?>
                                <?php  if(empty($p['parentid'])) { ?>
                                    <?php  if(is_array($children[$p['id']])) { foreach($children[$p['id']] as $c) { ?>
                                       <?php  if(is_array($children[$c['id']])) { foreach($children[$c['id']] as $t) { ?>
                                         <?php  if(is_array($cates) && in_array($t['id'],$cates)) { ?><?php  echo $p['name'];?>-<?php  echo $c['name'];?>-<?php  echo $t['name'];?>; <?php  } ?>
                                       <?php  } } ?>
                                    <?php  } } ?>
                                <?php  } ?>
                            <?php  } } ?>
                            <?php  } else { ?>
                                    <?php  if(is_array($category)) { foreach($category as $p) { ?>
                                        <?php  if(empty($p['parentid'])) { ?>
                                            <?php  if(is_array($children[$p['id']])) { foreach($children[$p['id']] as $c) { ?>
                                               <?php  if(is_array($cates) && in_array($c['id'],$cates)) { ?><?php  echo $p['name'];?>-<?php  echo $c['name'];?>; <?php  } ?>
                                            <?php  } } ?>
                                        <?php  } ?>
                                    <?php  } } ?>
                         <?php  } ?>
            </div>
         <?php  } ?>

    </div>
</div>
<script language="javascript">
    $(function(){
            $('#cates').select2({
              search:true,
              placeholder: "请选择其他商品分类",
              allowClear: true
           });
    })
    </script>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品类型</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('shop.goods' ,$item) ) { ?>
         <div style="float: left" id="ttttype">
            <label for="isshow3" class="radio-inline"><input type="radio" name="type" value="1" id="isshow3" <?php  if(empty($item['type']) || $item['type'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#product').show();$('#type_virtual').hide()" /> 实体商品</label>
            <label for="isshow4" class="radio-inline"><input type="radio" name="type" value="2" id="isshow4"  <?php  if($item['type'] == 2) { ?>checked="true"<?php  } ?>  onclick="$('#product').hide();$('#type_virtual').hide()" /> 虚拟商品</label>
            <?php  if(p('virtual')) { ?>
            <label for="isshow5" class="radio-inline"><input type="radio" name="type" value="3" id="isshow5"  <?php  if($item['type'] == 3) { ?>checked="true"<?php  } ?>  onclick="$('#type_virtual').show();" /> 虚拟物品(卡密)</label>
            <?php  } ?>
        </div>
        <?php  if(p('virtual')) { ?>
        <div style="width: auto; float: left; margin-left: 10px;  <?php  if($item['type'] != 3) { ?>display: none;<?php  } ?>" id="type_virtual">
            <select class="form-control tpl-category-parent" id="virtual" name="virtual">
                <option value="0">多规格虚拟物品</option>
                <?php  if(is_array($virtual_types)) { foreach($virtual_types as $virtual_type) { ?>
                    <option value="<?php  echo $virtual_type['id'];?>" <?php  if($item['virtual'] == $virtual_type['id']) { ?>selected="true"<?php  } ?>><?php  echo $virtual_type['usedata'];?>/<?php  echo $virtual_type['alldata'];?> | <?php  echo $virtual_type['title'];?></option>
                <?php  } } ?>
            </select>
            <span>提示：直接选中虚拟物品模板即可，选择多规格需在商品规格页面设置</span>
        </div>
        <?php  } ?>

        <?php  } else { ?>
         <div class='form-control-static'><?php  if(empty($item['type']) || $item['type'] == 1) { ?>
             实体物品
             <?php  } else if($item['type']==2) { ?>
             虚拟物品
             <?php  } else if($item['type']==3) { ?>
             虚拟物品(卡密)
             <?php  } ?></div>
         <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品单位</label>
    <div class="col-sm-6 col-xs-6">
          <?php if( ce('shop.goods' ,$item) ) { ?>
        <input type="text" name="unit" id="unit" class="form-control" value="<?php  echo $item['unit'];?>" />
        <span class="help-block">如: 个/件/包</span>
        <?php  } else { ?>
           <div class='form-control-static'><?php  echo $item['unit'];?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品属性</label>
    <div class="col-sm-9 col-xs-12" >
          <?php if( ce('shop.goods' ,$item) ) { ?>
        <label for="isrecommand" class="checkbox-inline">
            <input type="checkbox" name="isrecommand" value="1" id="isrecommand" <?php  if($item['isrecommand'] == 1) { ?>checked="true"<?php  } ?> /> 推荐
        </label>
        <label for="isnew" class="checkbox-inline">
            <input type="checkbox" name="isnew" value="1" id="isnew" <?php  if($item['isnew'] == 1) { ?>checked="true"<?php  } ?> /> 新上
        </label>
        <label for="ishot" class="checkbox-inline">
            <input type="checkbox" name="ishot" value="1" id="ishot" <?php  if($item['ishot'] == 1) { ?>checked="true"<?php  } ?> /> 热卖
        </label>
        <label for="isdiscount" class="checkbox-inline">
            <input type="checkbox" name="isdiscount" value="1" id="isdiscount" <?php  if($item['isdiscount'] == 1) { ?>checked="true"<?php  } ?> /> 促销
        </label>
        <label for="issendfree" class="checkbox-inline">
            <input type="checkbox" name="issendfree" value="1" id="issendfree" <?php  if($item['issendfree'] == 1) { ?>checked="true"<?php  } ?> /> 包邮
        </label>
        <label for="istime" class="checkbox-inline">
            <input type="checkbox" name="istime" value="1" id="istime" <?php  if($item['istime'] == 1) { ?>checked="true"<?php  } ?> /> 限时卖
        </label>
        <label for="isnodiscount" class="checkbox-inline">
            <input type="checkbox" name="isnodiscount" value="1" id="isnodiscount" <?php  if($item['isnodiscount'] == 1) { ?>checked="true"<?php  } ?> /> 不参与会员折扣
        </label>
          <?php  } else { ?> <div class='form-control-static'>
              <?php  if($item['isnew']==1) { ?>新品; <?php  } ?>
              <?php  if($item['ishot']==1) { ?>热卖; <?php  } ?>
              <?php  if($item['isrecommand']==1) { ?>推荐; <?php  } ?>
              <?php  if($item['isdiscount']==1) { ?>促销; <?php  } ?>
              <?php  if($item['issendfree']==1) { ?>包邮; <?php  } ?>
              <?php  if($item['istime']==1) { ?>限时卖; <?php  } ?>
              <?php  if($item['isnodiscount']==1) { ?>不参与折扣; <?php  } ?>
          </div>
          <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">限时卖时间</label>
      <?php if( ce('shop.goods' ,$item) ) { ?>
    <div class="col-sm-4 col-xs-6">

        <?php echo tpl_form_field_date('timestart', !empty($item['timestart']) ? date('Y-m-d H:i',$item['timestart']) : date('Y-m-d H:i'), 1)?>
    </div>
    <div class="col-sm-4 col-xs-6">
        <?php echo tpl_form_field_date('timeend', !empty($item['timeend']) ? date('Y-m-d H:i',$item['timeend']) : date('Y-m-d H:i'), 1)?>
    </div>
      <?php  } else { ?>
       <div class="col-sm-6 col-xs-6">
           <div class='form-control-static'>
               <?php  if($item['istime']==1) { ?>
               <?php  echo date('Y-m-d H:i',$item['timestart'])?> - <?php  echo date('Y-m-d H:i',$item['timeend'])?>
               <?php  } ?>
           </div>
       </div>
      <?php  } ?>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品图片</label>
    <div class="col-sm-9 col-xs-12 detail-logo">
             <?php if( ce('shop.goods' ,$item) ) { ?>
        <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
        <span class="help-block">建议尺寸: 640 * 640 ，或正方型图片 </span>
          <?php  } else { ?>
                            <?php  if(!empty($item['thumb'])) { ?>
                            <a href='<?php  echo tomedia($item['thumb'])?>' target='_blank'>
                            <img src="<?php  echo tomedia($item['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                             </a>
                            <?php  } ?>
                        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">其他图片</label>
    <div class="col-sm-9 col-xs-12">
           <?php if( ce('shop.goods' ,$item) ) { ?>
        <?php  echo tpl_form_field_multi_image('thumbs',$piclist)?>
            <span class="help-block">建议尺寸: 640 * 640 ，或正方型图片 </span>
            <?php  } else { ?>
             <?php  if(is_array($piclist)) { foreach($piclist as $p) { ?>
             <a href='<?php  echo tomedia($p)?>' target='_blank'>
               <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
             </a>
             <?php  } } ?>
            <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品编号</label>
    <div class="col-sm-4 col-xs-12">
          <?php if( ce('shop.goods' ,$item) ) { ?>
        <input type="text" name="goodssn" id="goodssn" class="form-control" value="<?php  echo $item['goodssn'];?>" />
          <?php  } else { ?>
           <div class='form-control-static'><?php  echo $item['goodssn'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class=" col-sm-3 col-md-2 control-label">商品条码</label>
    <div class="col-sm-4 col-xs-12">
           <?php if( ce('shop.goods' ,$item) ) { ?>
        <input type="text" name="productsn" id="productsn" class="form-control" value="<?php  echo $item['productsn'];?>" />
            <?php  } else { ?>
           <div class='form-control-static'><?php  echo $item['productsn'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品价格</label>
    <div class="col-sm-9 col-xs-12">
         <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group form-group">

            <span class="input-group-addon">现价</span>
            <input type="text" name="marketprice" id="marketprice" class="form-control" value="<?php  echo $item['marketprice'];?>" />
            <span class="input-group-addon">元</span>
        </div>
          <?php  } else { ?>
           <div class='form-control-static'>现价：<?php  echo $item['marketprice'];?> 元</div>
        <?php  } ?>
    <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group form-group">
            <span class="input-group-addon">原价</span>
            <input type="text" name="productprice" id="productprice" class="form-control" value="<?php  echo $item['productprice'];?>" />
            <span class="input-group-addon">元</span>
        </div>
           <?php  } else { ?>
           <div class='form-control-static'>原价：<?php  echo $item['productprice'];?> 元</div>
        <?php  } ?>
		
            <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group form-group">
            <span class="input-group-addon">成本</span>
            <input type="text" name="costprice" id="costprice" class="form-control" value="<?php  echo $item['costprice'];?>" />
            <span class="input-group-addon">元</span>
        </div>
           <?php  } else { ?>
           <div class='form-control-static'>成本：<?php  echo $item['costprice'];?> 元</div>
        <?php  } ?>
		
           <?php if( ce('shop.goods' ,$item) ) { ?>
        <span class='help-block'>尽量填写完整，有助于于商品销售的数据分析</span>
        <?php  } ?>
		<?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group form-group">
            <span class="input-group-addon">税率</span>
            <input type="text" name="customs" id="customs" class="form-control" value="<?php  echo $item['customs'];?>" />
            <span class="input-group-addon">%（百分制）</span>
        </div>
           <?php  } else { ?>
           <div class='form-control-static'>税率：<?php  echo $item['customs'];?> ‰</div>
        <?php  } ?>
        <?php  if($bonus_start == 1) { ?>
          <?php if( ce('bonus.goods' ,$item) ) { ?>
          <div class="input-group form-group">
              <span class="input-group-addon">分红金额</span>
              <input type="text" name="bonusmoney" class="form-control" value="<?php  echo $item['bonusmoney'];?>" />
              <span class="input-group-addon">元</span>
          </div>
             <?php  } else { ?>
             <div class='form-control-static'>分红金额<?php  echo $item['bonusmoney'];?> 元</div>
          <?php  } ?>
             <?php if( ce('bonus.goods' ,$item) ) { ?>
          <span class='help-block'>填写分红金额，不填写则为现价计算</span>
          <?php  } ?>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">重量</label>
    <div class="col-sm-6 col-xs-12">
        <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="weight" id="weight" class="form-control" value="<?php  echo $item['weight'];?>" />
            <span class="input-group-addon">克</span>
        </div>
		<div class='help-block'>商品重量设置空或0，则为包邮，如启用多规格，多规格内也需进行设置</div>
        <?php  } else { ?>
         <div class='form-control-static'><?php  echo $item['weight'];?> 克</div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">库存</label>
    <div class="col-sm-6 col-xs-12">
             <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="total" id="total" class="form-control" value="<?php  echo $item['total'];?>" />
            <span class="input-group-addon">件</span>
        </div>
        <span class="help-block">商品的剩余数量, 如启用多规格<?php  if(p('virtual')) { ?>或为虚拟卡密产品<?php  } ?>，则此处设置无效，请移至“商品规格”<?php  if(p('virtual')) { ?>或“虚拟物品插件”<?php  } ?>中设置</span>
        <?php  } else { ?>
         <div class='form-control-static'><?php  echo $item['total'];?> 件</div>
        <?php  } ?>
    </div>
</div>


<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">减库存方式</label>
    <div class="col-sm-9 col-xs-12">
              <?php if( ce('shop.goods' ,$item) ) { ?>
        <label for="totalcnf1" class="radio-inline"><input type="radio" name="totalcnf" value="0" id="totalcnf1" <?php  if(empty($item) || $item['totalcnf'] == 0) { ?>checked="true"<?php  } ?> /> 拍下减库存</label>
        &nbsp;&nbsp;&nbsp;
        <label for="totalcnf2" class="radio-inline"><input type="radio" name="totalcnf" value="1" id="totalcnf2"  <?php  if(!empty($item) && $item['totalcnf'] == 1) { ?>checked="true"<?php  } ?> /> 付款减库存</label>
        &nbsp;&nbsp;&nbsp;
        <label for="totalcnf3" class="radio-inline"><input type="radio" name="totalcnf" value="2" id="totalcnf3"  <?php  if(!empty($item) && $item['totalcnf'] == 2) { ?>checked="true"<?php  } ?> /> 永不减库存</label>
        <?php  } else { ?>

        <div class='form-control-static'>
           <?php  if(empty($item) || $item['totalcnf'] == 0) { ?>拍下减库存<?php  } ?>
           <?php  if(!empty($item) && $item['totalcnf'] == 1) { ?>付款减库存<?php  } ?>
           <?php  if(!empty($item) && $item['totalcnf'] == 2) { ?>永不减库存<?php  } ?>
         </div>

        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">单次最多购买量</label>
    <div class="col-sm-6 col-xs-12">
               <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="maxbuy" id="maxbuy" class="form-control" value="<?php  echo $item['maxbuy'];?>" />
            <span class="input-group-addon">件</span>

        </div>
			   <span class="help-block">用户单次购买此商品数量限制</span>
                    <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['maxbuy'];?> 件</div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">用户最多购买量</label>

    <div class="col-sm-6 col-xs-12">
            <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="usermaxbuy" class="form-control" value="<?php  echo $item['usermaxbuy'];?>" />
            <span class="input-group-addon">件</span>
        </div>
			<span class="help-block">用户购买过的此商品数量限制</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['usermaxbuy'];?> 件</div>
        <?php  } ?>

    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">已出售数</label>
    <div class="col-sm-6 col-xs-12">
              <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="sales" id="sales" class="form-control" value="<?php  echo $item['sales'];?>" />
            <span class="input-group-addon">件</span>
        </div>
			    <span class="help-block">物品虚拟出售数，会员下单此数据就增加, 无论是否支付</span>
            <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['sales'];?> 件</div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">赠送积分</label>
    <div class="col-sm-6 col-xs-12">
            <?php if( ce('shop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="credit" id="credit" class="form-control" value="<?php  echo $item['credit'];?>" />
            <span class="input-group-addon">分</span>
        </div>
        <p class="help-block">会员购物赠送的积分, 如果不填写或填写0，则默认为不赠送积分，如果带%则为按成交价格的比例计算积分</p>
		<p class="help-block">如: 购买2件，设置10 积分, 不管成交价格是多少， 则购买后获得20积分</p>
		<p class="help-block">如: 购买2件，设置10%积分, 成交价格2 * 200= 400， 则购买后获得 40 积分（400*10%）</p>
               <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['credit'];?> 分</div>
        <?php  } ?>
    </div>
</div>
<?php  if($com_set['upgrade_by_good'] && !empty($com_set['level'])) { ?>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">加盟商</label>
    <div class="col-sm-6 col-xs-12">
        <select name='commission_level_id' class='form-control'>
            <option value="0">请选择加盟商等级</option>
            <?php  if(is_array($commissionLevels)) { foreach($commissionLevels as $level) { ?>
                <option value="<?php  echo $level['id'];?>" <?php  if($item['commission_level_id'] == $level['id']) { ?>selected="selected"<?php  } ?>><?php  echo $level['levelname'];?></option>
            <?php  } } ?>
        </select>
        <span class='help-block'>购买此商品成为指定的加盟商等级</span>
    </div>
</div>
<?php  } ?>

<div class="form-group" id="dispatch_info" <?php  if(($item['type'] == 2 || $item['type'] == 3)) { ?>style="display: none;"<?php  } ?>>
<label class="col-xs-12 col-sm-3 col-md-2 control-label">运费设置</label>
<div class="col-sm-6 col-xs-6">
    <?php if( ce('shop.goods' ,$item) ) { ?>
    <label class="radio-inline" style="float: left;"><input type="radio" name="dispatchtype" value="1" <?php  if($item['dispatchtype'] == 1) { ?>checked="true"<?php  } ?> <?php  if(p('supplier')) { ?><?php  if($perm_role == 1) { ?>checked="true"<?php  } ?><?php  } ?> id="dispatchtype1" /> 统一邮费</label>

    <div class="input-group form-group" style="width: 180px; float: left; margin: 0px 20px 0px 10px;">

        <input type="text" name="dispatchprice" id="dispatchprice" class="form-control" value="<?php  echo $item['dispatchprice'];?>" <?php  if(p('supplier')) { ?><?php  if($perm_role == 1) { ?>readonly='readonly'<?php  } ?><?php  } ?>/>
        <span class="input-group-addon">元</span>
    </div>
    <?php  if(p('supplier')) { ?>
    <?php  if($perm_role == 0) { ?>
    <div id="type_dispatch_isshow">
    <label class="radio-inline" style="float: left;"><input type="radio" name="dispatchtype" value="0" <?php  if(empty($item['dispatchtype'])) { ?>checked="true"<?php  } ?>   id="dispatchtype2"/> 运费模板</label>

    <div style="width: auto; float: left; margin-left: 10px;"  id="type_dispatch">
        <select class="form-control tpl-category-parent" id="dispatchid" name="dispatchid">
            <option value="0">默认模板</option>
            <?php  if(is_array($dispatch_data)) { foreach($dispatch_data as $dispatch_item) { ?>
            <option value="<?php  echo $dispatch_item['id'];?>" <?php  if($item['dispatchid'] == $dispatch_item['id']) { ?>selected="true"<?php  } ?>><?php  echo $dispatch_item['dispatchname'];?></option>
            <?php  } } ?>
        </select>
    </div>
    </div>
    <?php  } ?>
    <?php  } ?>
    <?php  } else { ?>
    <div class='form-control-static'><?php  if(empty($item['dispatchtype'])) { ?>运费模板 <?php  if($item['dispatchid'] == 0) { ?>默认模板<?php  } else { ?><?php  if(is_array($dispatch_data)) { foreach($dispatch_data as $dispatch_item) { ?><?php  if($item['dispatchid'] == $dispatch_item['id']) { ?><?php  echo $dispatch_item['dispatchname'];?><?php  } ?><?php  } } ?><?php  } ?><?php  } else { ?>统一邮费<?php  } ?></div>
    <?php  } ?>
</div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否支持货到付款</label>
    <div class="col-sm-6 col-xs-6">
        <?php if( ce('shop.goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="cash" value="1" <?php  if(empty($item['cash']) || $item['cash'] == 1) { ?>checked="true"<?php  } ?>  /> 不支持</label>
        <label class="radio-inline"><input type="radio" name="cash" value="2" <?php  if($item['cash'] == 2) { ?>checked="true"<?php  } ?>   /> 支持</label>
           <?php  } else { ?>
           <div class='form-control-static'><?php  if(empty($item['cash']) || $item['cash'] == 1) { ?>不支持<?php  } else { ?>支持<?php  } ?></div>
         <?php  } ?>
    </div>
</div>
<?php  if(p('supplier')) { ?>
<?php  if($perm_role == 0) { ?>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否上架</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( ce('shop.goods' ,$item) ) { ?>
        <label for="isshow1" class="radio-inline"><input type="radio" name="status" value="1" id="isshow1" <?php  if($item['status'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
        &nbsp;&nbsp;&nbsp;
        <label for="isshow2" class="radio-inline"><input type="radio" name="status" value="0" id="isshow2"  <?php  if($item['status'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
        <span class="help-block"></span>

            <?php  } else { ?>
                            <div class='form-control-static'><?php  if(empty($item['status'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
                        <?php  } ?>

    </div>
</div>
<?php  } ?>
<?php  } ?>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否参与单品满减</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( ce('shop.goods' ,$item) ) { ?>
        <label for="isshow1" class="radio-inline"><input type="radio" name="is_dudect" value="1" <?php  if($item['is_dudect'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
        &nbsp;&nbsp;&nbsp;
        <label for="isshow2" class="radio-inline"><input type="radio" name="is_dudect" value="0" id="isshow2"  <?php  if($item['is_dudect'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
        <span class="help-block"></span>

            <?php  } else { ?>
                            <div class='form-control-static'><?php  if(empty($item['is_dudect'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
                        <?php  } ?>

    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">详情页推荐商品</label>
    <div class="col-sm-9 col-xs-12">
        <input type="text" name="recom_goods" id="recom_goods" class="form-control" value="<?php  echo $item['recom_goods'];?>" />
        <span class="input-group-addon">商品详情页只显示4个推荐商品,商品间半角逗号隔开(,)</span>
    </div>
</div>
