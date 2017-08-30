<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>优惠券详情</title>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/coupon/template/mobile/default/images/style.css">
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;overflow-x: hidden;}
    a {text-decoration:none;}
 
	.coupon_num { margin:10px; background:#fff;border:1px solid #eaeaea;padding:10px; text-align:right; font-size:13px; color:#666;}

	.coupon_detail { background:#fff;border:1px solid #eaeaea;padding:5px;margin:5px 10px; }
	.coupon_detail .dtitle { color:#333; font-size:14px; padding:5px; font-weight:bold; border-bottom:1px solid #eaeaea;}
	.coupon_detail .dtitle span { float:right;font-weight:normal;padding:3px;  border-radius:3px; text-align:center; line-height:16px;line-height:16px; }
	.coupon_detail .ddetail img { width:100%;outline-width:0px;  vertical-align:top; display:block}
	.coupon_detail .ddetail p { line-height:100%;}


	.coupon_detail .dgoods { overflow:hidden; padding:5px 0;}
	.coupon_detail .dgoods .good {height:auto; width:46%; padding:0px 2% 10px; float:left;}
    .coupon_detail .dgoods .good img {height:120px; width:100%;}
    .coupon_detail .dgoods .good .name {height:20px; width:100%; font-size:15px; line-height:20px; color:#666; overflow:hidden;}
    .coupon_detail .dgoods .good .price {height:20px; width:100%; color:#f03; font-size:14px;}
    .coupon_detail .dgoods .good .price span {color:#aaa; font-size:12px; text-decoration:line-through;}
 

	.coupon_use {position: fixed;  bottom:0; width:100%; height:40px; line-height: 40px; color:#fff;font-size:14px; text-align: center;z-index:1000}    
	.coupon_use .left { float:left;width:70%;background:rgba(0,0,0,0.5); text-align: center;}
	.coupon_use .right { float:left; width:30%;text-align: center; }

</style>
<div class="page_topbar"> 
	<a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
	<a href="<?php  echo $this->createPluginMobileUrl('coupon')?>" class="btn"><i class="fa fa-home"></i></a>
	<div class="title">优惠券详情</div>
</div>

<div class="coupon_content ">
	<div class="bd bd-<?php  echo $coupon['css'];?>"></div>
	
	<div class="body <?php  echo $coupon['css'];?>">
		<div class="bg png png-<?php  echo $coupon['css'];?>"></div>
		<div class='top'>
			<?php  if(!empty($coupon['thumb'])) { ?>
			<div class='left'><img src='<?php  echo tomedia($coupon['thumb'])?>'/></div>
			<?php  } ?>
			<div class='right' <?php  if(empty($coupon['thumb'])) { ?> style="margin-left:0"<?php  } ?>>
				<div class='inner'  <?php  if(empty($coupon['thumb'])) { ?> style="margin-left:0"<?php  } ?>>
					<div class="name"><?php  echo $coupon['couponname'];?></div>		
					<div class="time"><?php  if($coupon['timestr']=='0') { ?>
			永久有效
			<?php  } else { ?>
		 <?php  if($coupon['timestr']=='1') { ?>
		          即<?php  echo $coupon['gettypestr'];?>日内 <?php  echo $coupon['timedays'];?> 天有效
				  <?php  } else { ?>
			有效期 <?php  echo $coupon['timestr'];?>
			<?php  } ?>
			<?php  } ?>
					
					</div>		
				</div>
			</div>
		</div>

		<div class='enough' ><?php  if($coupon['coupontype']==1) { ?>充值<?php  } else { ?>消费<?php  } ?><?php  if($coupon['enough']>0) { ?>满 ￥<?php  echo $coupon['enough'];?><?php  } else { ?>任意金额<?php  } ?></div>

		<div class='act' >

			<?php  if($coupon['backtype']==0) { ?> 
			   立减 ￥<?php  echo $coupon['deduct'];?> 
			<?php  } else if($coupon['backtype']==1) { ?> 
			   <?php  echo $coupon['discount'];?> 折
			<?php  } else if($coupon['backtype']==2) { ?> 
				返 <?php  if(!empty($coupon['backcredit'])) { ?> <?php  echo $coupon['backcredit'];?> 积分 <?php  } ?>
				<?php  if(!empty($coupon['backmoney'])) { ?> <?php  echo $coupon['backmoney'];?> 余额 <?php  } ?>
				<?php  if(!empty($coupon['backredpack'])) { ?> <?php  echo $coupon['backredpack'];?> 现金 <?php  } ?>
			<?php  } ?>

		</div>
	</div>
	<div class="bd1 bd-<?php  echo $coupon['css'];?> "></div>
		
</div>

<div class='coupon_detail'>
	<div class='dtitle'>
		获得方式 


<?php  if($coupon['getstatus']!='3') { ?><span style='font-weight:normal'><?php  echo $coupon['gettypestr'];?></span><?php  } ?>
		<?php  if($coupon['getstatus']=='0') { ?><span class="ccreditmoney"><?php  echo $coupon['money'];?> 元 + <?php  echo $coupon['credit'];?> 积分</span><?php  } ?>
		<?php  if($coupon['getstatus']=='1') { ?><span class="cmoney"><?php  echo $coupon['money'];?> 元</span><?php  } ?>
		<?php  if($coupon['getstatus']=='2') { ?><span class="ccredit"><?php  echo $coupon['credit'];?> 积分</span><?php  } ?>
		<?php  if($coupon['getstatus']=='3') { ?><span class="cfree">免费领取</span><?php  } ?>
		
		
		
	</div>
	<div class='dtitle'>使用说明 <?php  if($num>0) { ?><span>共 <?php  echo $num;?> 张</span><?php  } ?></div>
	<div class='ddetail'>
		<?php  if(empty($coupon['descnoset'])) { ?>
		<?php  if(empty($coupon['coupontype'])) { ?>
		<?php  echo htmlspecialchars_decode($set['consumedesc'])?>
		<?php  } else { ?>
		<?php  echo htmlspecialchars_decode($set['rechargedesc'])?>
		<?php  } ?>
		<?php  } ?>
		<?php  echo $coupon['desc'];?>
	</div>
</div>
<?php  if($coupon['coupontype']==0) { ?>
<div class='coupon_detail'>
	<div class='dtitle'>推荐商品 <span onclick='getRecommands()'>换一批</span></div>
	<div class='dgoods' id='dgoods'></div>
</div>
<script language='javascript'>
	$(function () {
		getRecommands();
	})
</script>
<?php  } ?>
<script type='text/html' id='tpl_recommand'>
	<%each list as g%>
	<div class="good" data-goodsid="<%g.id%>">
		<img src='<%g.thumb%>'/>
		<div class="name"><%g.title%></div>
		<div class="price">￥<%g.marketprice%> <%if g.productprice>0 && g.marketprice!=g.productprice%><span>￥<%g.productprice%></span><%/if%></div>
	</div>
	<%/each%>
</script> 

<div style='height:50px'>&nbsp;</div>
<div class='coupon_use'>
	<div class='left  <?php  echo $coupon['css'];?>'>
		 <?php  if($coupon['cangetmax']==-1) { ?>
		 无限领取
		 <?php  } else { ?>
		 <?php  if($coupon['canget']) { ?>
		 您还可以<?php  echo $coupon['gettypestr'];?> <?php  echo $coupon['cangetmax'];?> 张
		 <?php  } else { ?>
		 您已<?php  echo $coupon['gettypestr'];?>过
		 <?php  } ?>
		 <?php  } ?>
	</div>
	<div id='btncoupon' class='right <?php  if($coupon['canget']) { ?><?php  echo $coupon['css'];?><?php  } else { ?>past<?php  } ?>' >立即<?php  echo $coupon['gettypestr'];?></div>
	</div>


	<script language='javascript'>
		
		function getRecommands() {
			require(['core', 'tpl'], function (core, tpl) {

				core.json('shop/util', {op: 'recommand'}, function (json) {
					if (json.result.list.length <= 0) {
						$('#dgoods').html('暂时没有同店推荐');
						return;
					}
					$('#dgoods').html(tpl('tpl_recommand', json.result));
					$('#dgoods .good').click(function () {
						location.href = core.getUrl('shop/detail', {id: $(this).data('goodsid')});
					}).find('img').each(function () {
						$(this).height($(this).width());
					});

				});
			});
		}
		function payResult() {
			var btn = $('#btncoupon');
			require(['core', 'tpl','sweetalert'], function (core, tpl,swal) {
				core.pjson('coupon/detail', {
					op: 'payresult',
					'id': '<?php  echo $id;?>',
					logid: window.logid
				}, function (pay_json) {
					btn.html(btn.attr('oldhtml')).removeAttr('oldhtml').removeAttr('submitting');
					if (pay_json.status == 1) {
						var text = "";
						var button = "";
						if(pay_json.result.coupontype==0){
							text = "恭喜您，优惠券到手啦，您想现在就去选商品使用优惠券吗?";
							button = "现在就去选~";
						}
						else{
							text = "恭喜您，优惠券到手啦，您想现在就去充值吗?";
							button = "现在就去充值~";
						}
					 
						swal({  
							title:'',
							text: text,   type: "success",   
							showCancelButton: true,   
							confirmButtonColor: "#DD6B55",   
							confirmButtonText: button,   
							cancelButtonText: "先看看其他的",   
							closeOnConfirm: false,   closeOnCancel: false
						}, function(isConfirm){   
							
							if (isConfirm) {     
							        location.href = pay_json.result.url;	
							} else {     
								location.href = "<?php  echo $this->createPluginMobileUrl('coupon')?>";
							} 
						});				

						return;
					}
					core.tip.show(pay_json.result);
					btn.html(btn.attr('oldhtml')).removeAttr('oldhtml').removeAttr('submitting');
				}, true, true);
			});
		}
		$(function () {


			<?php  if($coupon['canget']) { ?>
			$('#btncoupon').click(function () {
				var btn = $(this);

				if (btn.attr('submitting') == '1') {
					return;
				}
				btn.attr('oldhtml', btn.html()).html('<i class="fa fa-spinner fa-spin"></i> 请稍后..').attr('submitting', 1);
				require(['core', 'tpl'], function (core, tpl) {
					core.pjson('coupon/detail', {'op': 'pay', 'id': '<?php  echo $id;?>'}, function (ret) {
						if (ret.status == '-1') {
							btn.html(btn.attr('oldhtml')).removeAttr('oldhtml').removeAttr('submitting');
							core.tip.show(ret.result);
							return;
						}
						window.logid = ret.result.logid;

						if (ret.result.wechat) {
							var wechat = ret.result.wechat;
							WeixinJSBridge.invoke('getBrandWCPayRequest', {
								'appId': wechat.appid ? wechat.appid : wechat.appId,
								'timeStamp': wechat.timeStamp,
								'nonceStr': wechat.nonceStr,
								'package': wechat.package,
								'signType': wechat.signType,
								'paySign': wechat.paySign,
							}, function (res) {
								if (res.err_msg == 'get_brand_wcpay_request:ok') {
									payResult();
								} else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
									btn.html(btn.attr('oldhtml')).removeAttr('oldhtml').removeAttr('submitting');
									core.tip.show('取消支付');
								} else {
									btn.html(btn.attr('oldhtml')).removeAttr('oldhtml').removeAttr('submitting');
									alert(res.err_msg);
								}
							});
						} else {
							payResult();
						}

					}, true, true);
				});
			});
			<?php  } ?>

		});
	</script>

	<?php  $show_footer = false?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
