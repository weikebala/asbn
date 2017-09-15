<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品详情</label>
	<div class="col-sm-9 col-xs-12">
                  <?php if( ce('shop.goods' ,$item) ) { ?>
                            <?php  echo tpl_ueditor('content',$item['content'])?>
                            <?php  } else { ?>
                            <textarea id='detail' style='display:none'><?php  echo $item['content'];?></textarea>
                            <a href='javascript:preview_html("#detail")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
	</div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品文字介绍</label>
    <div class="col-sm-9 col-xs-12">
        <textarea name="content_text" style="width: 500px"><?php  echo $item['content_text'];?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品介绍图片</label>
    <div class="col-sm-9 col-xs-12 detail-logo">
        <?php if( ce('shop.goods' ,$item) ) { ?>
        <?php  echo tpl_form_field_image('jiesao_thumb', $item['jiesao_thumb'])?>
        <span class="help-block">建议尺寸: 75*90  </span>
        <?php  } else { ?>
        <?php  if(!empty($item['jiesao_thumb'])) { ?>
        <a href='<?php  echo tomedia($item['jiesao_thumb'])?>' target='_blank'>
        <img src="<?php  echo tomedia($item['jiesao_thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
        </a>
        <?php  } ?>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品购买提醒</label>
    <div class="col-sm-9 col-xs-12">
        <textarea name="buy_warn" style="width: 500px"><?php  echo $item['buy_warn'];?></textarea>
    </div>
</div>