<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation=='post') { ?>

<div class="main">
    <form id="dataform" action="" method="post" class="form-horizontal form" onsubmit='return formcheck()'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                  商品信息     
            </div>
            <div class='panel-body'>
                
                   <ul class="nav nav-arrow-next nav-tabs" id="myTab">
                    <li class="active" ><a href="#tab_basic">商品设置</a></li>
                    <li><a href="#tab_act">活动设置</a></li>
                    <li><a href="#tab_sub">提供商家设置</a></li>
                    <li><a href="#tab_vip">特权设置</a></li>
                    <?php  if(p('verify')) { ?><li><a href="#tab_verify">兑换设置</a></li><?php  } ?>
                    <li><a href="#tab_notice">商家通知设置</a></li>
                    <li><a href="#tab_share">关注及分享设置</a></li>
                </ul> 
            <?php  if(!empty($item['id'])) { ?> 
                <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品连接(点击复制)</label>
                <div class="col-sm-9 col-xs-12">
                    <p class='form-control-static'><a href='javascript:;' title='点击复制连接' id='cp'><?php  echo $this->createPluginMobileUrl('creditshop/detail',array('id'=>$item['id']))?></a></p>
                </div>
             </div>
                <?php  } ?>
                
                <div class="tab-content">
                    <div class="tab-pane  active" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/basic', TEMPLATE_INCLUDEPATH)) : (include template('goods/basic', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_act"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/act', TEMPLATE_INCLUDEPATH)) : (include template('goods/act', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_sub"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/sub', TEMPLATE_INCLUDEPATH)) : (include template('goods/sub', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_vip"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/vip', TEMPLATE_INCLUDEPATH)) : (include template('goods/vip', TEMPLATE_INCLUDEPATH));?></div>
                    <?php  if(p('verify')) { ?><div class="tab-pane" id="tab_verify"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/verify', TEMPLATE_INCLUDEPATH)) : (include template('goods/verify', TEMPLATE_INCLUDEPATH));?></div><?php  } ?>
                    <div class="tab-pane" id="tab_notice"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/notice', TEMPLATE_INCLUDEPATH)) : (include template('goods/notice', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane" id="tab_share"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/share', TEMPLATE_INCLUDEPATH)) : (include template('goods/share', TEMPLATE_INCLUDEPATH));?></div>
            </div>
        <div class='panel-body'>
               
                    <div class="form-group"></div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                       <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                       <?php  } ?>
                       
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('creditshopadv.add|creditshopadv.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
        </div>
        </div>
                     
            </div>
    </form>
</div>
<script language='javascript'>
     window.optionchanged = false;
        require(['bootstrap'],function(){
             $('#myTab a').click(function (e) {
                 e.preventDefault();
                 $(this).tab('show');
             })
     });
    function formcheck(){
        
        if($('select[name=cate]').val()==''){
            $('#myTab a[href="#tab_basic"]').tab('show');
            Tip.focus($('select[name=cate]'),'请选择分类!');
            return false;
        }
        
        if($(':input[name=title]').val()==''){
            $('#myTab a[href="#tab_basic"]').tab('show');
            Tip.focus($(':input[name=title]'),'请填写商品名称!');
            return false;
        }
        return true;
    }
        function search_goods() {
             if( $.trim($('#search-kwd-goods').val())==''){
                 Tip.focus('#search-kwd-goods','请输入关键词');
                 return;
             }
		$("#module-menus-goods").html("正在搜索....")
		$.get('<?php  echo $this->createWebUrl('shop/query')?>', {
			keyword: $.trim($('#search-kwd-goods').val())
		}, function(dat){
			$('#module-menus-goods').html(dat);
		});
	}
	function select_good(o) {
                              $("#goodsid").val(o.id);
							  $("#couponid").val('');
                               $(":input[name=thumb]").val(o.thumb);
                               $(".img-thumbnail").attr('src',o.thumb);
                               $(":input[name=title]").val(o.title);
                                $(":input[name=total]").val(o.total);
                                $(":input[name=price]").val(o.marketprice);
   	               $("#modal-module-menus-goods .close").click();
	}
	
	<?php  if(p('coupon')) { ?>
   function search_coupons() {

        $("#module-menus-coupon").html("正在搜索....")
        $.get('<?php  echo $this->createPluginWebUrl('coupon/coupon',array('op'=>'query'))?>', {
            keyword: $.trim($('#search-kwd').val())
        }, function (dat) {
            $('#module-menus-coupon').html(dat);
        });
    }
    function select_coupon(o) {
    $("#goodsid").val('');
	
         $("#couponid").val(o.id);
		 
         $(":input[name=thumb]").val(o.thumb);
         $(".img-thumbnail").attr('src',o.thumb);
         $(":input[name=title]").val(o.couponname);
         $(":input[name=total]").val(o.total=='-1'?'':o.total);
		 $(":input[name=money]").val(o.money);
		 $(":input[name=credit]").val(o.credit);
		 $(":checkbox[name=usecredit2]").get(0).checked = o.usecredit2=='1';
         $(":input[name=price]").val('');
         $("#modal-module-menus-coupon .close").click();
    }
<?php  } ?>
</script>
 
<?php  } else if($operation == 'display') { ?>
<form action="" method="get" class='form form-horizontal'>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" plugins="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="sea" />
                <input type="hidden" name="do" value="plugin" />
                <input type="hidden" name="p"  value="creditshop" />
                <input type="hidden" name="method"  value="goods" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键词</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索商品标题/提供商户">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">分类</label>
                       <div class="col-xs-12 col-sm-8 col-lg-9">
                           <select class='form-control' name='cate'>
                                <option value=''></option>
                                 <?php  if(is_array($category)) { foreach($category as $cate) { ?>
                                 <option value='<?php  echo $cate['id'];?>' <?php  if($_GPC['cate']==$cate['id']) { ?>selected<?php  } ?>><?php  echo $cate['name'];?></option>
                                 <?php  } } ?>
                            </select>
                     </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">类型</label>
                       <div class="col-xs-12 col-sm-8 col-lg-9">
                       <select name='type' class='form-control'>
                          <option value='' <?php  if($_GPC['type']=='') { ?>selected<?php  } ?>></option>
                          <option value='0' <?php  if($_GPC['type']=='0') { ?>selected<?php  } ?>>兑换</option>
                          <option value='1' <?php  if($_GPC['type']=='1') { ?>selected<?php  } ?> >抽奖</option>
                       </select> 
                     </div>
                </div>
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                       <div class="col-xs-12 col-sm-8 col-lg-9">
                       <select name='status' class='form-control'>
                          <option value='' <?php  if($_GPC['status']=='') { ?>selected<?php  } ?>></option>
                          <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>暂停</option>
                          <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?> >开启</option>
                       </select> 
                     </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"> </label>
                      <div class="col-xs-12 col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
            
    <form action="" method="post">
    <div class='panel panel-default'>
        <div class='panel-heading' >
            商品管理 (数量: <?php  echo $total;?> 条)
     
        </div>
        <div class='panel-body'>

            <table class="table">
                <thead>
                  <tr>
                        <th style="width:60px;">ID</th>
                        <th style="width:80px;">排序</th>
                        <th>商品标题</th>
                        <th style='width:80px;'>类型</th>      
                        <th style='width:150px;'>属性</th>      
                        
                        <th style='width:100px;'>消耗</th>
                  
                        <th style='width:100px;'>参与次数</th>
                        <th style='width:100px;'>浏览次数</th>
                        <th style='width:100px;' >状态</th>
                        <th style="">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                         <td><?php  echo $row['id'];?></td>
                          <td>
                              <?php if(cv('creditshop.goods.edit')) { ?>
                              <input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>">
                               <?php  } else { ?>
                              <?php  echo $row['displayorder'];?>
                              <?php  } ?>
                          </td>
                          <td>
                              <?php  if(!empty($row['subtitle'])) { ?><span class='label label-warning'><?php  echo $row['subtitle'];?></span><?php  } ?>
                              <span class='label label-primary'><?php  echo $category[$row['cate']]['name'];?></span><br/><?php  echo $row['title'];?>
                          </td>
                          <td>
							  <?php  if($pcoupon) { ?>
			  <?php  if($row['goodstype']==1) { ?>
                              <span class='label label-warning'>优惠券</span>
                              <?php  } else { ?>
                              <span class='label label-success'>商品</span>
                              <?php  } ?>
							  <br/>
							  <?php  } ?>
							  
							  <?php  if($row['type']==1) { ?>
                              <span class='label label-danger'>抽奖</span>
                              <?php  } else { ?>
                              <span class='label label-primary'>兑换</span>
                              <?php  } ?>
                               </td>
                         <td> 
                            <label data='<?php  echo $row['istop'];?>' class='label label-default <?php  if($row['istop']==1) { ?>label-info<?php  } else { ?><?php  } ?>'   <?php if(cv('creditshop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $row['id'];?>,'istop')"<?php  } ?>>置顶</label>
                            <label data='<?php  echo $row['isrecommand'];?>' class='label label-default <?php  if($row['isrecommand']==1) { ?>label-info<?php  } ?>' <?php if(cv('creditshop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $row['id'];?>,'isrecommand')"<?php  } ?>>推荐</label>
                            <label data='<?php  echo $row['istime'];?>' class='label label-default <?php  if($row['istime']==1) { ?>label-info<?php  } ?>' <?php if(cv('creditshop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $row['id'];?>,'istime')"<?php  } ?>>限时</label>
                         </td>
                         <td><?php  if($row['credit']>0) { ?>-<?php  echo $row['credit'];?>积分<br/><?php  } ?>
                              <?php  if($row['money']>0) { ?>
                              -<?php  echo $row['money'];?>现金
                              <?php  } ?>
                         </td>
                         <td><?php  echo $row['joins'];?></td>
                         <td><?php  echo $row['views'];?></td>
                           <td>     
                                <label data='<?php  echo $item['status'];?>' class='label  label-default <?php  if($row['status']==1) { ?>label-success<?php  } ?>' <?php if(cv('creditshopshop.goods.edit')) { ?>onclick="setProperty(this,<?php  echo $item['id'];?>,'status')"<?php  } ?>><?php  if($row['status']==1) { ?>开启<?php  } else { ?>暂停<?php  } ?></label>
                               
                         </td>
                         <td>
                             <?php if(cv('creditshop.goods.view|creditshop.goods.edit')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('creditshop/goods',array('op'=>'post','id' => $row['id']));?>" ><i class='fa fa-edit'></i></a><?php  } ?>
                             <?php if(cv('creditshop.goods.delete')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('creditshop/goods',array('op'=>'delete','id' => $row['id']));?>" title='删除' onclick="return confirm('确定要删除该商品吗？');"><i class='fa fa-remove'></i></a><?php  } ?>
                         </td>
            </tr>
                   <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $pager;?>
 
        </div>
        
            <div class='panel-footer'>
                   <?php if(cv('creditshop.goods.edit')) { ?>
                          <input name="submit" type="submit" class="btn btn-primary" value="提交排序">
                           <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                           <?php  } ?>
                           
        <?php if(cv('creditshop.goods.add')) { ?>                   
                          <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('creditshop/goods',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加商品</a>
                            <?php  } ?>
          </div>
      
    </div>
</form>

            <script language='javascript'>
                  function setProperty(obj, id, type) {
                   
                            $(obj).html($(obj).html() + "...");
                   
                            $.post("<?php  echo $this->createPluginWebUrl('creditshop/goods')?>",{'op':'setgoodsproperty',id: id, type: type, data: obj.getAttribute("data")},function (d) {
                                            $(obj).html($(obj).html().replace("...", ""));
                                            if (type == 'status') {
                                                $(obj).html(d.data == '1' ? '显示' : '隐藏');
                                            }
                                            $(obj).attr("data", d.data); 
                                            if (d.result == 1) {
                                                $(obj).toggleClass("label-info");
                                            }
                                        }
                            , "json");
                        }
                </script>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
 
