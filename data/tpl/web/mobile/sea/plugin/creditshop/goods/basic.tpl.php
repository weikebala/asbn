<?php defined('IN_IA') or exit('Access Denied');?>    
                  <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <input type='text' class='form-control' name='displayorder' value="<?php  echo $item['displayorder'];?>" />
                             <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                             <?php  } ?>
                        </div>
                    </div>
                <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 分类</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <select class='form-control' name='cate'>
                                <option value=''>--请选择分类--</option>
                                 <?php  if(is_array($category)) { foreach($category as $cate) { ?>
                                 <option value='<?php  echo $cate['id'];?>' <?php  if($item['cate']==$cate['id']) { ?>selected<?php  } ?>><?php  echo $cate['name'];?></option>
                                 <?php  } } ?>
                            </select>
                             <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                             <?php  } ?>
                        </div>
                    </div>
<?php  if($pcoupon) { ?>
         <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
                        <div class="col-sm-9 col-xs-12">
                             <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name='goodstype' value="0" <?php  if(empty($item['goodstype'])) { ?>checked<?php  } ?> onclick="$('.goodstype').hide();$('.goodstype0').show();"/> 商品
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name='goodstype' value="1" <?php  if($item['goodstype']==1) { ?>checked<?php  } ?> onclick="$('.goodstype').hide();$('.goodstype1').show();"/> 优惠券
                            </label>
							 <div class='help-block'>设置为优惠券类型，则无需进行领取，兑换或抽中直接发送到优惠券账户</div>
                                <?php  } else { ?>
                             <div class='form-control-static'><?php  if(empty($item['goodstype'])) { ?>商品<?php  } else { ?>优惠券<?php  } ?></div>
                             <?php  } ?>
                        </div>
                    </div>
<?php  } else { ?>
   <input type="hidden" name="goodstype" maxlength="30" value="0"   />
<?php  } ?>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>名称</label>
                  <div class="col-sm-9 col-xs-12">
                          <?php if( ce('creditshop.goods' ,$item) ) { ?>
                        <div class='input-group'>
                            <input type="text" name="title" maxlength="30" value="<?php  echo $item['title'];?>" class="form-control"  />
		        <input type="hidden" id="couponid" name='couponid' maxlength="30" value="<?php  echo $item['couponid'];?>" />
                            <div class='input-group-btn   goodstype goodstype0'  <?php  if($item['goodstype']!=0) { ?>style="display:none"<?php  } ?>>
                                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus-goods').modal();">从商品库中选择</button>
                            </div>
						<?php  if($pcoupon) { ?>
		        <div class='input-group-btn   goodstype goodstype1'  <?php  if($item['goodstype']!=1) { ?>style="display:none"<?php  } ?>>
                                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus-coupon').modal();">从优惠券中选择</button>
                            </div>
						<?php  } ?>
                        </div>
                        <div id="modal-module-menus-goods"  class="modal fade" tabindex="-1">
                            <div class="modal-dialog" style='width: 920px;'>
                                <div class="modal-content">
                                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择商品</h3></div>
                                    <div class="modal-body" >
                                        <div class="row"> 
                                            <div class="input-group"> 
                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd-goods" placeholder="请输入商品名称" />
                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_goods();">搜索</button></span>
                                            </div>
                                        </div>
                                        <div id="module-menus-goods" style="padding-top:5px;"></div>
                                    </div>
                                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                </div>

                            </div>
                        </div>
						  <?php  if($pcoupon) { ?>
		 <div id="modal-module-menus-coupon"  class="modal fade" tabindex="-1">
                            <div class="modal-dialog" style='width: 920px;'>
                                <div class="modal-content">
                                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择优惠券</h3></div>
                                    <div class="modal-body" >
                                        <div class="row"> 
                                            <div class="input-group"> 
                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd-goods" placeholder="请输入优惠券名称" />
                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_coupons();">搜索</button></span>
                                            </div>
                                        </div>
                                        <div id="module-menus-coupon" style="padding-top:5px;"></div>
                                    </div>
                                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                </div>

                            </div>
                        </div>
				<?php  } ?>		  
                      <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['title'];?></div>
                             <?php  } ?>
                             
                    </div>
                </div>
        
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">图片</label>
                        <div class="col-sm-9 col-xs-12">
                                <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <?php  echo tpl_form_field_image('thumb',$item['thumb'])?>
                             <?php  } else { ?>
                               <?php  if(!empty($item['thumb'])) { ?>
                                <a href='<?php  echo tomedia($item['thumb'])?>' target='_blank'>
                                <img src="<?php  echo tomedia($item['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                                </a>
                                <?php  } ?>
                             <?php  } ?>
                        </div>
                    </div>
                  <div class="form-group  goodstype goodstype0"  <?php  if($item['goodstype']!=0) { ?>style="display:none"<?php  } ?>>
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">原价</label>
                        <div class="col-sm-9 col-xs-12">
                                <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <input type='text' class='form-control' name='price' value="<?php  echo $item['price'];?>" />
                             <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['price'];?></div>
                             <?php  } ?>
                        </div>
                    </div>
                <div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">属性</label>
    <div class="col-sm-9 col-xs-12" >
          <?php if( ce('creditshop.goods' ,$item) ) { ?>
        <label for="istop" class="checkbox-inline">
            <input type="checkbox" name="istop" value="1" id="istop" <?php  if($item['istop'] == 1) { ?>checked="true"<?php  } ?> /> 置顶
        </label>
        <label for="isrecommand" class="checkbox-inline">
            <input type="checkbox" name="isrecommand" value="1" id="isrecommand" <?php  if($item['isrecommand'] == 1) { ?>checked="true"<?php  } ?> /> 推荐
        </label>
        <label for="istime" class="checkbox-inline">
            <input type="checkbox" name="istime" value="1" id="istime" <?php  if($item['istime'] == 1) { ?>checked="true"<?php  } ?> /> 限时
        </label>
        <?php  } else { ?> 
        <div class='form-control-static'>
              <?php  if($item['istop']==1) { ?>置顶; <?php  } ?>
              <?php  if($item['isrecommand']==1) { ?>推荐; <?php  } ?>
              <?php  if($item['istime']==1) { ?>限时; <?php  } ?> 
          </div>
          <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">限时</label>
      <?php if( ce('creditshop.goods' ,$item) ) { ?>
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
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品简介</label>
                         <div class="col-sm-9 col-xs-12">
                                 <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <?php  echo tpl_ueditor('goodsdetail',$item['goodsdetail'],array('height'=>'100'))?>  
                             <?php  } else { ?>
                                <textarea id='goodsdetail' name='goodsdetail' style='display:none;'><?php  echo $item['goodsdetail'];?></textarea>
                            <a href='javascript:preview_html("#goodsdetail")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
                        </div>
                    </div>
