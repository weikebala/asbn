<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<form id="setform"  action="" method="post" class="form-horizontal form">
    <div class='panel panel-default'>


		<div class='panel-heading'>
            领券中心设置
        </div>
		<div class='panel-body'>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">直接链接</label>
                <div class="col-sm-9 col-xs-12">
                    <p class='form-control-static'><a href='javascript:;' title='点击复制连接' id='cp'><?php  echo $this->createPluginMobileUrl('coupon')?></a></p>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员中心开启状态</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('coupon.center.save')) { ?>
					<label class="radio-inline "><input type="radio" name="setdata[closemember]" value="0" <?php  if($set['closemember']==0) { ?>checked<?php  } ?>> 开启</label>
					<label class="radio-inline"><input type="radio" name="setdata[closemember]"  value="1" <?php  if($set['closemember']==1) { ?>checked<?php  } ?>> 关闭</label>
					<span class="help-block">是否开启会员中心优惠券</span>
					<?php  } else { ?>
					<div class='form-control-static'>
						<?php  if($set['closemember']==0) { ?>
						开启
						<?php  } else if($set['closemember']==1) { ?>
						关闭
						<?php  } ?>
					</div>
                    <?php  } ?>
                </div>
				
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">领券中心开启状态</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('coupon.center.save')) { ?>
					<label class="radio-inline "><input type="radio" name="setdata[closecenter]" value="0" <?php  if($set['closecenter']==0) { ?>checked<?php  } ?>> 开启</label>
					<label class="radio-inline"><input type="radio" name="setdata[closecenter]"  value="1" <?php  if($set['closecenter']==1) { ?>checked<?php  } ?>> 关闭</label>
					<?php  } else { ?>
					<div class='form-control-static'>
						<?php  if($set['closecenter']==0) { ?>
						开启
						<?php  } else if($set['closecenter']==1) { ?>
						关闭
						<?php  } ?>
					</div>
                    <?php  } ?>
                </div>
			</div>
				
			</div>	
			

            <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">关键词</label>
				<div class="col-sm-9 col-xs-12">
					<?php if(cv('coupon.center.save')) { ?>
					<input type="text" name="setdata[keyword]" class="form-control" value="<?php  echo $set['keyword'];?>" />
                           　<?php  } else { ?>
					<div class='form-control-static'><?php  echo $set['keyword'];?></div>
					<?php  } ?>
				</div>
			</div>

            <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面标题</label>
				<div class="col-sm-9 col-xs-12">
					<?php if(cv('coupon.set.save')) { ?>
					<input type="text" name="setdata[title]" id="title" class="form-control" value="<?php  echo $set['title'];?>" />
					<?php  } else { ?>
					<div class='form-control-static'><?php  echo $set['title'];?></div>
					<?php  } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面图片</label>
				<div class="col-sm-9 col-xs-12">
					<?php if(cv('coupon.center.save')) { ?>
					<?php  echo tpl_form_field_image('setdata[icon]', $set['icon'])?>
					<?php  } else { ?>
					<?php  if(!empty($set['icon'])) { ?>
					<a href='<?php  echo tomedia($set['icon'])?>' target='_blank'>
					   <img src="<?php  echo tomedia($set['icon'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
					</a>
					<?php  } ?>
					<?php  } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面描述</label>
				<div class="col-sm-9 col-xs-12">
					<?php if(cv('coupon.center.save')) { ?>
					<textarea name="setdata[desc]" class="form-control" ><?php  echo $set['desc'];?></textarea>
					<?php  } else { ?>
					<div class='form-control-static'><?php  echo $set['desc'];?></div>
					<?php  } ?>
				</div>
			</div>
			
			 
                  <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板选择</label>
        <div class="col-sm-9 col-xs-12">
			   <?php if(cv('coupon.set.save')) { ?>
            <select class='form-control' name='setdata[style]'>
                <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                <option value='<?php  echo $style;?>' <?php  if($style==$set['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                <?php  } } ?>
            </select>
			<?php  } else { ?>
				 <div class='form-control-static'><?php  echo $set['style'];?></div>
				<?php  } ?>
        </div>
    </div>
			
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">底部版权</label>
                <div class="col-sm-9 col-xs-12">
					<?php if(cv('coupon.center.save')) { ?>
					<textarea name="setdata[copyright]" class="form-control" ><?php  echo $set['copyright'];?></textarea>
					<?php  } else { ?>
					<div class='form-control-static'><?php  echo $set['copyright'];?></div>
					<?php  } ?>
                </div> 
            </div>

        </div>		<div class='panel-heading'>
            幻灯片设置 <small>幻灯片图片尺寸建议 640*320</small>
        </div>
		<div class='panel-body'>

			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片</label>
				<div class="col-sm-9 col-xs-12">
					<table class="table">
						<thead>
						<th style="width:60px;"></th>
						<th>图片</th>
						<th>链接</th>
						<th>操作</th>
						</thead>
						<tbody id="tbody">
							<?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
							<tr class="adv-item">
								<td><a href="javascript:;" class="btn btn-default btn-sm btn-move"><i class="fa fa-arrows"></i></a></td>
								<td>
									<div class="input-group img-item">
										<div class="input-group-addon">
											<img src="<?php  echo tomedia($adv['img'])?>" style="height:20px;width:50px" />
										</div>
										<input type="text" class="form-control" name="adv_img[]" value="<?php  echo $adv['img'];?>" />
										<div class="input-group-btn">
											<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
										</div>
									</div>
								</td>
								<td><input type="text" class="form-control" name="adv_url[]" value="<?php  echo $adv['url'];?>"/></td>
								<td><button type="button" class="btn btn-danger  btn-sm" onclick="removeAdv(this)"><i class="fa fa-remove"></i></button>

								</td>
							</tr>
							<?php  } } ?>
						</tbody>
						<tbody>
							<tr>
								<td colspan="4"><button type="button" class="btn btn-default  btn-sm" onclick="addAdv()"><i class="fa fa-plus"></i> 添加幻灯片</button></td>
							</tr>
					</table>
					<span class="help-block">拖动改变位置</span>
				</div>
			</div>	

			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick='return formcheck()' />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>

		</div>
</form>
<script type="text/javascript" src="resource/js/lib/jquery-ui-1.10.3.min.js"></script>
<script language='javascript'>
	require(['util'], function (u) {
		$('#cp').each(function () {
			u.clip(this, $(this).text());
		});
	});
	$(function () {
bindEvents();
	})
	function removeAdv(obj){
		$(obj).closest('.adv-item').remove();
	}
	function addAdv(){
		var html='<tr class="adv-item">';
html+='<td><a href="javascript:;" class="btn btn-default btn-sm btn-move"><i class="fa fa-arrows"></i></a></td>';
html+='<td>';
html+='<div class="input-group img-item">';
html+='<div class="input-group-addon">';
html+='<img src="" style="height:20px;width:50px" />';
html+='</div>';
html+='<input type="text" class="form-control" name="adv_img[]" />';
html+='<div class="input-group-btn">';
html+='<button type="button" class="btn btn-default btn-select-pic">选择图片</button>';
html+='</div>';
html+='</div>';
html+='</td>';
html+='<td><input type="text" class="form-control" name="adv_url[]" /></td>';
html+='<td><button type="button" class="btn btn-danger  btn-sm" onclick="removeAdv(this)"><i class="fa fa-remove"></i></button>';

html+='</td>';
html+='</tr>';
$('#tbody').append(html);
bindEvents();
	}
	function bindEvents() {
		require(['jquery', 'util'], function ($, util) {
			$('.btn-select-pic').unbind('click').click(function () {
				var imgitem = $(this).closest('.img-item');
				util.image('', function (data) {
					imgitem.find('img').attr('src', data['url']);
					imgitem.find('input').val(data['attachment']);
				});
			});
		});
		$("#tbody").sortable({handle: '.btn-move'});
		
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>