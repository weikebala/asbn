<?php defined('IN_IA') or exit('Access Denied');?><script language="javascript">
    $(function() {
        $("#hascommission").click(function() {
            var obj = $(this);
            if (obj.get(0).checked) {
                $("#commission_div").show();
            } else {
                $("#commission_div").hide();
            }
        });
    })
</script>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否参与加盟</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( ce('shop.goods' ,$item) ) { ?>
       <label class="radio-inline">
            <input type="radio"  value="0" name="nocommission" <?php  if($item['nocommission']==0) { ?>checked<?php  } ?> /> 参与加盟
        </label>
        <label class="radio-inline">
            <input type="radio"  value="1" name="nocommission" <?php  if($item['nocommission']==1) { ?>checked<?php  } ?> /> 不参与加盟
        </label>
        <span class="help-block">如果不参与加盟，则不产生加盟佣金</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['nocommission']==1) { ?>不参与加盟<?php  } else { ?>参与加盟<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">显示"我要加盟"按钮</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( ce('shop.goods' ,$item) ) { ?>
       <label class="radio-inline">
            <input type="radio"  value="0" name="hidecommission" <?php  if($item['hidecommission']==0) { ?>checked<?php  } ?> /> 显示
        </label>
        <label class="radio-inline">
            <input type="radio"  value="1" name="hidecommission" <?php  if($item['hidecommission']==1) { ?>checked<?php  } ?> /> 隐藏
        </label>
        <span class="help-block">如果隐藏了按钮，在参与加盟的情况下，按钮只是隐藏，分享其他人购买后依然产生加盟佣金</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['nocommission']==1) { ?>不参与加盟<?php  } else { ?>参与加盟<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">海报图片</label>
    <div class="col-sm-9 col-xs-12">
           <?php if( ce('shop.goods' ,$item) ) { ?>
        <?php  echo tpl_form_field_image('commission_thumb', $item['commission_thumb'])?>
        <span class='help-block'>尺寸: 640*640，如果为空默认缩略图片</span>
         <?php  } else { ?>
                            <?php  if(!empty($item['commission_thumb'])) { ?>
                                  <a href='<?php  echo tomedia($item['commission_thumb'])?>' target='_blank'>
                            <img src="<?php  echo tomedia($item['commission_thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                                  </a>
                            <?php  } ?>
                        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">独立规则</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( ce('shop.goods' ,$item) ) { ?>
       <label class="checkbox-inline">
        <input type="checkbox" id="hascommission" value="1" name="hascommission" <?php  if($item['hascommission']==1) { ?>checked<?php  } ?> />启用独立佣金比例
    </label>
        <span class="help-block">启用独立佣金设置，此商品拥有独自的佣金比例,不受加盟商等级比例及默认设置限制</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['hascommission']==1) { ?>启用独立佣金设置<?php  } else { ?>不启用独立佣金设置<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
 
<div id="commission_div" <?php  if(empty($item['hascommission'])) { ?>style="display:none"<?php  } ?> >
   
     <div class='alert alert-danger'>
        如果比例为空，则使用固定规则，如果都为空则无加盟佣金
    </div>
    <?php  if($com_set['level']>=1) { ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">一级加盟</label>
        <div class="col-sm-4 col-xs-12">
                     <?php if( ce('shop.goods' ,$item) ) { ?>
            <div class="input-group">
                <input type="text" name="commission1_rate" id="commission1_rate" class="form-control" value="<?php  echo $item['commission1_rate'];?>" />
                <div class="input-group-addon">% 固定</div>
                 <input type="text" name="commission1_pay" id="commission1_pay" class="form-control" value="<?php  echo $item['commission1_pay'];?>" />
                <div class="input-group-addon">元</div>
            </div>
                     <?php  } else { ?>
                     <div class='form-control-static'>比例: <?php  echo $item['commission1_rate'];?>% 固定: <?php  echo $item['commission1_pay'];?> 元</div>
                     <?php  } ?>
        </div>
    </div>
    <?php  } ?>
     <?php  if($com_set['level']>=2) { ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">二级加盟</label>
        <div class="col-sm-4 col-xs-12">
                <?php if( ce('shop.goods' ,$item) ) { ?>
            <div class="input-group">
                <input type="text" name="commission2_rate" id="commission2_rate" class="form-control" value="<?php  echo $item['commission2_rate'];?>" />
                <div class="input-group-addon">% 固定</div>
                <input type="text" name="commission2_pay" id="commission2_pay" class="form-control" value="<?php  echo $item['commission2_pay'];?>" />
                <div class="input-group-addon">元</div>
            </div>
                <?php  } else { ?>
                     <div class='form-control-static'>比例: <?php  echo $item['commission2_rate'];?>% 固定: <?php  echo $item['commission2_pay'];?> 元</div>
                     <?php  } ?>
        </div>
    </div>
     <?php  } ?>
      <?php  if($com_set['level']>=3) { ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">三级加盟</label>
        <div class="col-sm-4 col-xs-12">
                <?php if( ce('shop.goods' ,$item) ) { ?>
            <div class="input-group">
               <input type="text" name="commission3_rate" id="commission3_rate" class="form-control" value="<?php  echo $item['commission3_rate'];?>" />
                <div class="input-group-addon">% 固定</div>
                <input type="text" name="commission3_pay" id="commission3_pay" class="form-control" value="<?php  echo $item['commission3_pay'];?>" />
                <div class="input-group-addon">元</div>
            </div>
                   <?php  } else { ?>
                     <div class='form-control-static'>比例: <?php  echo $item['commission3_rate'];?>% 固定: <?php  echo $item['commission3_pay'];?> 元</div>
                     <?php  } ?>
        </div>
    </div>
      <?php  } ?>
</div>