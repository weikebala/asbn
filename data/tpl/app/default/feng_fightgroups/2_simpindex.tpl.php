<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php  if(!empty($share_data['sname'])) { ?><?php  echo $share_data['sname'];?><?php  } else { ?>拼团商城<?php  } ?></title>
		<?php  echo register_jssdk(false);?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-store">
		<meta http-equiv="Expires" content="0">
		<LINK href="<?php echo S_URL;?>css/newcomm.css?v=1" rel="stylesheet">
		<LINK href="<?php echo S_URL;?>css/style_366c9ef.css?v=1" rel="stylesheet">
		<LINK href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo S_URL;?>alert/css/alert2.css" />
		<?php  if($showtype==2) { ?><link rel="stylesheet" type="text/css" href="<?php echo S_URL;?>css/index2.css" /><?php  } ?>
		<script type="text/javascript" src="<?php echo S_URL;?>alert/js/alert.js"></script>
		
		<style type="text/css">
			.rmd-types{overflow:hidden;background:#fff;padding-bottom:12px;}
.rmd-types a{float:left;width:25%;padding-top:16px;}
.rmd-types a img{display:block;width:40px;height:40px;margin:0 auto 12px;}
.rmd-types a span{display:block;line-height:1em;text-align:center;font-size:12px;color:#2f2f2f;}
			.g_core:before,.cat_item span:before{background-image:url(http://static.paipaiimg.com/fd/qqpai/tuan/img/bg_list_v3.png?t=20141215173530);background-repeat:no-repeat;-webkit-background-size:195px 87px;background-size:195px 87px}
			.cat{position:relative;background-color:#FFFFFF;border-bottom:1px solid #E2E2E2;overflow:hidden;border-top:1px solid #E2E2E2}
			.cat:after{content:'';display:block;clear:both;height:0;visibility:hidden}
			.cat_item{position:relative;float:left;width:25%;padding:7px 5px;border-bottom:1px solid #DEDEDE;margin-bottom:-1px;-webkit-box-sizing:border-box;box-sizing:border-box}
			.cat_item span{display:block;width:100%;height:30px;line-height:30px;-webkit-box-sizing:border-box;box-sizing:border-box;position:relative;text-align:center;-webkit-border-radius:4px;border-radius:4px}
			.cat_item span:after{content:'';position:absolute;top:6px;right:-5px;width:1px;height:17px;overflow:hidden;background-color:#DEDEDE}
			.cat_item span:nth-child(4n):after{display:none}
			.cat_item span:before{content:'';display:inline-block;width:20px;height:20px;vertical-align:-5px;margin-right:5px}
			.cat_all span:before{background-position:-0px -0px}
			.cat_food span:before{background-position:-25px -0px}
			.cat_baby span:before{background-position:-50px -0px}
			.cat_qiang span:before{background-position:-75px -0px}
			.cat_digital span:before{background-position:-100px -0px}
			.cat_life span:before{background-position:-125px -0px}
			.cat_new span:before{background-position:-150px -0px}
			.cat_hot span:before{background-position:-175px -0px}
			.cat_cur span{color:#fff}
			.cat_cur.cat_all span{background-color:#78C057}
			.cat_cur.cat_all span:before{background-position:-0px -25px}
			.cat_cur.cat_food span{background-color:#F0B073}
			.cat_cur.cat_food span:before{background-position:-25px -25px}
			.cat_cur.cat_baby span{background-color:#FF64BA}
			.cat_cur.cat_baby span:before{background-position:-50px -25px}
			.cat_cur.cat_qiang span{background-color:#D87660}
			.cat_cur.cat_qiang span:before{background-position:-75px -25px}
			.cat_cur.cat_digital span{background-color:#55A8D0}
			.cat_cur.cat_digital span:before{background-position:-100px -25px}
			.cat_cur.cat_life span{background-color:#92D0A5}
			.cat_cur.cat_life span:before{background-position:-125px -25px}
			.cat_cur.cat_new span{background-color:#F04F54}
			.cat_cur.cat_new span:before{background-position:-150px -25px}
			.cat_cur.cat_hot span{background-color:#4BA59B}
			.cat_cur.cat_hot span:before{background-position:-175px -25px}
			.cat_wrap{/*height:89px*/}
			.cat_fixed{position:fixed;top:40px;width:100%;max-width:640px;-webkit-box-sizing:border-box;box-sizing:border-box;z-index:10;border-bottom:1px solid #E0E0E0;-webkit-animation-duration:.2s;animation-duration:.2s;-webkit-animation-fill-mode:both;animation-fill-mode:both}
			@-webkit-keyframes slideDown{0%{-webkit-transform:translateY(-89px);}
			100%{-webkit-transform:translateY(0);}}@keyframes slideDown{0%{transform:translateY(-89px);}
			100%{transform:translateY(0);}}.cat_down{-webkit-animation-name:slideDown;animation-name:slideDown}
			@-webkit-keyframes slideUp{0%{-webkit-transform:translateY(0);}
			100%{-webkit-transform:translateY(-89px);}}@keyframes slideUp{0%{transform:translateY(0);}
			100%{transform:translateY(-89px);}}.cat_up{-webkit-animation-name:slideUp;animation-name:slideUp}
			.box_swipe {overflow: hidden; position: relative;}
.box_swipe ul {overflow: hidden; position: relative;margin:0;padding:0;}
.box_swipe ul > li {float:left; width:100%; position: relative; text-align:center;}
.box_swipe ul > li a{color:#FFF; text-decoration:none;}
.box_swipe ul > li .title{position: absolute; bottom: 0px; display: block; width: 100%; height:20px; padding:0 10px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color:#FFF; z-index:100;}
.box_swipe>ol{height:20px; position: relative; z-index:10; margin-top:-20px; text-align:center; padding-right:15px;}
.box_swipe>ol>li{display:inline-block; margin-bottom:1px; width:8px; height:8px; background-color:#757575; border-radius: 8px;}
.box_swipe>ol>li.on{background-color:#ffffff;}
#go-top,
.go-top {
	display: block;
	width: 42px;
	height: 42px;
	position: fixed;
	right: 20px;
	bottom: 64px;
	z-index: 999;
	background: url(//cdn.yangkeduo.com/assets/img/go_top-b8dda2a315.png) no-repeat;
	background-size: contain;
	opacity: 0;
	-webkit-transition: bottom .8s ease, opacity .6s ease;
	webkit-transition: bottom .8s ease, opacity .6s ease
}

#go-top span,
.go-top span {
	position: absolute;
	bottom: 7px;
	width: 100%;
	display: block;
	height: 12px;
	line-height: 12px;
	text-align: center;
	font-size: 10px;
	color: #333
}
.lockDiv{width:100%;height:100%;background-color:#000000;position:fixed;top:0px;left:0px;opacity:0.8;z-index: 30;} 
.headline{margin:0 3.125%;display:-webkit-box;-webkit-box-align:center;height:40px;position:relative}
.headline>div{-webkit-box-flex:1;padding-left:.5625rem;height:40px;overflow:hidden;position:relative;-webkit-backface-visibility:hidden}
.headline>div ul{-webkit-transform:translateZ(0);-webkit-backface-visibility:hidden}
.headline>div ul a{display:-webkit-box;-webkit-box-align:center;font-size:13px;color:rgba(32,35,37,.8);height:40px}
.headline>div ul a em{display:block;color:#009FF0;font-size:13px;padding:0 .21875rem;border-color:#009FF0;-webkit-border-radius:.0625rem;border-radius:.0625rem}
.headline>div ul a strong{font-weight:400;margin-left:.28125rem;height:1.125rem;-webkit-box-flex:1;display:-webkit-box;-webkit-box-pack:center;-webkit-box-align:start;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden}
.headline .headline-mask{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1}
 .header{padding-top:1.25rem;height:55px;position:absolute;top:0;left:0;width:100%;z-index:5;display:-webkit-box;-webkit-box-align:center;font-size:.8125rem;overflow:visible}
 .header:before{content:'';width:100%;left:0;top:0;height:4.6875rem;position:absolute;background:-webkit-gradient(linear,0 0,0 100%,from(rgba(0,0,0,.3)),to(transparent));pointer-events:none}
 .header .locate{padding-left:.625rem;padding-right:.375rem;min-width:3.125rem;height:1.875rem;line-height:1.875rem;position:relative;color:#fff;display:-webkit-box;-webkit-box-pack:center;-webkit-box-align:start;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden}
 .header .locate span{display:inline-block;min-width:2.1875rem;height:1.875rem;padding-right:.5625rem;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAYCAMAAAClZq98AAAANlBMVEUAAAD////////////////////////////////////////////////////////////////////xY8b8AAAAEXRSTlMAR/iE9tsb76sYxmlfTjY0JYmlTN0AAABxSURBVCjPnc1BDoAgDADBqiCIoPL/z4rB2MPWxLiXHjpp5VvZh7iI3Z5c2tosteVn0wyu7UK7EKsqmqu1I1UwHZWqiuZ+J5Mqy4yDCBUNFQ0VzZuioaKhoqHKMFBPNFQ0VDRUNFQ0VDRUNFQwVof86wSpDw9eXHcGEQAAAABJRU5ErkJggg==) right center no-repeat;background-size:auto .3125rem;-webkit-background-size:auto .3125rem}
 .header .search{-webkit-box-flex:1;height:100%;position:relative;overflow:hidden}
 .header .search a{height:100%;display:-webkit-box;-webkit-box-align:center;-webkit-box-sizing:border-box;box-sizing:border-box;color:rgba(0,0,0,.6);background-color:rgba(255,255,255,.4);-webkit-border-radius:.125rem;border-radius:.125rem}
 .header .search a span{position:relative;display:inline-block;min-height:1rem;padding-left:2.0625rem;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAQAAADZc7J/AAABdklEQVR4AaWR34sSYRSGHzRNhNyFASGCIjAs9EJChkCi0b10dyElfzBNRJgQWUp1sRHVnSnOH71wOMzF1zfz+eM5d+d9z/udmYOFEnV8enRo4nEgTeZsiUmK73Qpshf3WRBb6w/PcdJgnQwsGdNnwIx/Se+aXPb4TmwbLqlAQgGf3xoxylheX7+hyv8UiTTiJSksdLxMGmPd7xwLTRWrpHOHlbjGWJiLdEU2j8W1pYRBSe9+houl+FoY1PVwbi7EOcTA129z0xDnBwx60u7j5pE4v2LQkfYAJ/qxc/sRZ7h5Ic4JBp601xRw8V6crzDhhwhtsqmwEZ+Xdp5fjh3eWH6hcpe/Ioak0yKWeoKVtspD8vZxXf9nig681ogvPDSUewyJk3qXFpFnmpg+E/CUB9TwiVhr1xkBAVtiRzkiPEJ25gArwv0joEybER/5xidCulSBHG8dEQ5sEdHhEZERMYVTI2qnRgRwWsQzOCZiklziaGoE6Ou3mtaUaNtUeDMAAAAASUVORK5CYII=) .625rem center no-repeat;-webkit-background-size:1rem auto;background-size:1rem auto}
 .header .header-placeholder{position:relative;width:.9375rem;height:100%}
.divider{width:100%;height:.625rem;background-color:#f6f6f6}
.divider:after{background-color:#D2D2D2}
.r1bt{border-top:1px solid rgba(32,35,37,.15)}
.r1bb{border-bottom:1px solid rgba(32,35,37,.15)}
.r1bl{border-left:1px solid rgba(32,35,37,.15)}
.r1br{border-right:1px solid rgba(32,35,37,.15)}
.r1b{border:1px solid rgba(32,35,37,.15)}
.g_mark{display:inline-block;width:38px;height:15px;line-height:15px;-webkit-border-radius:15px;border-radius:15px;color:#fff;font-size:12px;text-align:center;margin-right:8px}
.g_mark1{background-color:#F0373D}
.g_mark2{background-color:#8EBD27}
.g_mark3{background-color:#04BE02}
.g_mark4{background-color:#C7254E}
		</style>
		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
		<script language="javascript" src="<?php echo S_URL;?>js/swipe.js"></script>
		<script type="text/javascript">
			var nextPage = 2; //下一次加载的页码,因为之前已经通过index.php加载了第一页的内容
			var flag = 2; //标志变量,为了避免重复加载相同的数据,用于判断是否和nextPage相等,true时允许加载数据.
			$(document).ready(function() {
				$(window).scroll(function() {
					var scrollTop = $(this).scrollTop();
					var scrollHeight = $(document).height();

					var h = getScrollTop();
					if(h>200){
						$('.go-top').show();
					}else{
						$('.go-top').hide();
					}
					var windowHeight = $(this).height();
					if (scrollTop + windowHeight == scrollHeight) {
						
						if(flag==nextPage){
							flag++;
							getMoreRecru(nextPage);
						}
					}
				});
				//在页面上展示下一页
				function getMoreRecru(page) {
					var ajxurl = "<?php  echo $this->createMobileUrl('indexajax',array('gid'=>$cid)).'&pages='?>" + page;
					$.ajax({
						type: "GET",
						url: ajxurl,
						dataType: 'json',
						beforeSend: function(XMLHttpRequest) {
							$("#loading").html('正在加载中...').fadeIn();
						},
						success: function(data) {
							if (data.success) {
								if (data.list.length > 0) {
									for (var i in data.list) {
										var info = data.list[i];
										var goff = 0
										if(parseFloat(info.gprice) != 0 && parseFloat(info.mprice)!= 0){
											goff = ((parseFloat(info.gprice).toFixed(2)/parseFloat(info.mprice).toFixed(2))*10).toFixed(1)+"折";
										}else{
											goff = "未打折";
										}
										var str='';
										if(info.group_level_status==2){
											str='阶梯团,低至￥'+info.p+'元';
										}else{
											str='<span>'+info.groupnum +'人团</span><b><span>¥ </span>'+info.gprice+'</b>';
										}
										if(info.isshow==3){
											<?php  if($showtype==2) { ?>
											var more ='<div style="background-color: white;"> <a href="<?php  echo $this->createMobileUrl('goodsdetails')?>&id=' + info.id + '"><div class="rank_g rank_high" style="overflow-x: hidden;margin-bottom: 0px;"><div class="rank_g_img"><img src="'+info.gimg+'"  class="imgLoading_goods_list_0"></div><div class="rank_g_info"><p class="rank_g_name">'+info.gname+'</p></div><div class="rank_core"><div class="rank_g_volume">已售 <b>'+info.salenum +'</b> 件</div><div class="rank_g_core"><div style="position: absolute;right: 30px;width:200px;height: 200px;z-index: 1;top: -100px;"><img  alt="" width="130" height="130" src="<?php echo S_URL;?>image/shouqing.png"/></div><div class="rank_g_price" style="width: 46%;">'+str+'</div><div class="rank_g_btn">去开团</div></div> </div></div> </a></div>';
											<?php  } else { ?>
											var more = '<div><div class="tuan_g"> <a href="<?php  echo $this->createMobileUrl('goodsdetails')?>&id=' + info.id + '"><div class="tuan_g_img"><img src="'+info.gimg+'"><span class="tuan_mark tuan_mark2"> <b style="position: relative;top: .5em;">'+goff+'</b></span> </div><div class="tuan_g_info"><p class="tuan_g_name">'+info.gname+'</p><p class="tuan_g_cx">'+info.gdesc+'</p></div><div class="tuan_g_core"><div style="position: absolute;right: 30px;width:200px;height: 200px;z-index: 999;top: -100px;"><img  alt="" width="130" height="130" src="<?php echo S_URL;?>image/shouqing.png"/></div><div class="tuan_g_price">'+str+'</div><div class="tuan_g_btn">去开团</div></div><div class="tuan_g_mprice">市场价：<del>￥'+info.mprice+'</del></div> </a></div></div>';
											<?php  } ?>
										}else{
											<?php  if($showtype==2) { ?>
											var more ='<div style="background-color: white;"><a href="<?php  echo $this->createMobileUrl('goodsdetails')?>&id=' + info.id + '"><div class="rank_g rank_high" style="overflow-x: hidden;margin-bottom: 0px;"><div class="rank_g_img"><img src="'+info.gimg+'"  class="imgLoading_goods_list_0"></div><div class="rank_g_info"><p class="rank_g_name">'+info.gname+'</p></div><div class="rank_core"><div class="rank_g_volume">已售 <b>'+info.salenum +'</b> 件</div><div class="rank_g_core"><div class="rank_g_price" style="width: 46%;">'+str+'</div><div class="rank_g_btn">去开团</div></div> </div></div></a></div>';
											<?php  } else { ?>
											var more = '<div><div class="tuan_g"><a href="<?php  echo $this->createMobileUrl('goodsdetails')?>&id=' + info.id + '"><div class="tuan_g_img"><img src="'+info.gimg+'"><span class="tuan_mark tuan_mark2"> <b style="position: relative;top: .5em;">'+goff+'</b></span> </div><div class="tuan_g_info"><p class="tuan_g_name">'+info.gname+'</p><p class="tuan_g_cx">'+info.gdesc+'</p></div><div class="tuan_g_core"><div class="tuan_g_price">'+str+'</div><div class="tuan_g_btn">去开团</div></div><div class="tuan_g_mprice">市场价：<del>￥'+info.mprice+'</del></div></a></div></div>';
											<?php  } ?>
										}
										
										$("#more").append(more);
									
									}
									nextPage += 1;
									
									$("#loading").fadeOut();
								} else {
									$('#loading').html('没有更多内容了...').fadeIn();
									flag--;
								}
							} else {
								$('#loading').html('没有更多内容了...').fadeIn();
								flag--;
							}
						},
						error:function(){
						alert("数据加载失败");
						flag--;
					}
					});
				}
			});
			function getScrollTop() {  
				var scrollPos;  
				if (window.pageYOffset) {  
				scrollPos = window.pageYOffset; }  
				else if (document.compatMode && document.compatMode != 'BackCompat'){
					scrollPos = document.documentElement.scrollTop; }
		        else if (document.body) { scrollPos = document.body.scrollTop; }   
		        return scrollPos;   
			}
		</script>
	</head>
	<style type="text/css">@charset "UTF-8";.trip-search{position:relative;z-index:1000;-webkit-box-sizing:border-box;box-sizing:border-box;width:100%}.trip-search-form{display:-webkit-box;box-sizing:border-box;padding:10px 0;width:100%;background-color:#DBDBDB;font-size:14px}.trip-search-form input{display:block;-webkit-box-sizing:border-box;box-sizing:border-box;margin:0;padding:0;height:29px;outline:0;border:0;-webkit-appearance:none;-webkit-tap-highlight-color:rgba(255,255,255,0)}.trip-search-form input[type=text]::-webkit-input-placeholder{color:rgba(32,35,37,0.4)}.trip-search-form .trip-search-wrapper{position:relative;display:-webkit-box;margin:0 10px;-webkit-box-flex:1}.trip-search-form .trip-search-input-wrapper{display:-webkit-box;-webkit-box-flex:1}.trip-search-form .trip-search-input{z-index:0;padding:0 34px 0 32px;outline:0;-webkit-border-radius:3px;border-radius:3px;background:#fff url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8BAMAAADI0sRBAAAAIVBMVEUAAAAgIyUgIyUgIyUgIyUgIyUgIyUgIyUgIyUgIyUgIyVV4xJrAAAAC3RSTlMATUYCPhEhCTMpGjuHLEgAAADISURBVDjLYxgFIxYwRzoJeQbjlE4SBAKhBByyJYJgIFKAVZZVUVAz3DxSUVAVq3SRoJgBkDITFMKq3VEoAEwHCTpgkWUTFIVaIiiGRdpIEObkRCEDTOmFQgiFCzClGyVhLE7BBiwuE4X7EJvbFMVhLHZBBUxpQWF40AsKENBNwG6SXb5QyADhbwKhRnKYMyNizBlvfAs2400tghIG+NJao6AzvpRqISiCVTvzCkdBj8UMzCDteACHoAje7NIohFea051hFIxIAABnih+zn4WKWQAAAABJRU5ErkJggg==") 2px 0 no-repeat;background-size:30px 30px;color:#202325;font-size:15px;-webkit-box-flex:1}.trip-search-form .trip-search-input:focus{outline:0;-webkit-tap-highlight-color:rgba(255,255,255,0);-webkit-focus-ring-color:transparent}.trip-search-form .trip-search-submit{display:none;width:60px;-webkit-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;background:#f8f8f8;background:#f8f8f8;color:#13334d;text-align:center;cursor:pointer;-webkit-user-select:none}.trip-search-form .trip-search-disabled{background:#f8f8f8;color:#e0e0e0;text-shadow:1px 1px 1px #fdfdfd}.trip-search-form .trip-search-cancel{display:none;width:60px;background:0;color:white;text-align:center;font-size:16px;cursor:pointer;-webkit-user-select:none}.trip-search-form .trip-search-delete{position:absolute;top:0;right:0;z-index:10;display:-webkit-box;width:34px;height:100%;background:#fff;-webkit-box-align:center;-webkit-box-pack:center;-webkit-tap-highlight-color:rgba(255,255,255,0);-webkit-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0}.trip-search-form .trip-search-delete b{display:block;margin:0 auto;width:29px;height:29px;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8BAMAAADI0sRBAAAAJFBMVEUAAACysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrIIg5e5AAAAC3RSTlMAcffkx0IcAopiuTB56aAAAADDSURBVDjL7ZO9DgFBFIVHBNGpNEqh2UYkotgXkEwjFAoNWo1GoddpdB5CZXeIOC/H3FiKO5vzALtf+82Zv3uvKSkuteOwO5nm2UOMD+klbOsWglsF9RxfRsGDo0wnoeM3+NHXtmH/2u2UbgKvtXftK3BWugo8TAe4mS0wUHrpTQVo+TV3pU8QJUvwVNpC4hKGUzqGxCWMVOkIEpcwEqL55vxq/GH8W/SnjklJSEFJO7Bm0swy3aONzMdAs/dDtDAlheUNgke1MOUMlfgAAAAASUVORK5CYII=) no-repeat;background-size:30px}.trip-search-active{padding-right:0}.trip-search-active .trip-search-wrapper{margin-right:0}.trip-search-active .trip-search-input{border-right:0;-webkit-border-radius:3px 0 0 3px;border-radius:3px 0 0 3px}.trip-search-active .trip-search-cancel{display:block}.trip-search-active .trip-search-submit{display:block}.trip-search-active .trip-search-delete{right:60px}.trip-nosearchbtn .trip-search-input{-webkit-border-radius:3px;border-radius:3px}.trip-nosearchbtn .trip-search-delete{right:0}.trip-showsearchbtn .trip-search-input{border-right:0;-webkit-border-radius:3px 0 0 3px;border-radius:3px 0 0 3px}.trip-showsearchbtn .trip-search-submit{display:block}</style>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template(followed, TEMPLATE_INCLUDEPATH)) : (include template(followed, TEMPLATE_INCLUDEPATH));?>
	<body id="main" style="overflow-x: hidden;">
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('menu', TEMPLATE_INCLUDEPATH)) : (include template('menu', TEMPLATE_INCLUDEPATH));?>
		<?php  if($reslut=='success') { ?>
		<?php  if($ordertype==1) { ?>
		<script>
			 new TipBox({type:'error',str:'代付失败,团已满，已转入微信退款流程!',setTime:5000});
		</script>
		<?php  } else { ?>
		<script>
			 new TipBox({type:'error',str:'团已满，已转入微信退款流程!',setTime:5000});
		</script>
		<?php  } ?>
		
		<?php  } ?>
		<!--<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('labels', TEMPLATE_INCLUDEPATH)) : (include template('labels', TEMPLATE_INCLUDEPATH));?>	style="display: block;<?php  if($this->module['config']['goodstip'] == 2) { ?>top: 46px;<?php  } ?>"-->
		<div class="container"  avalonctrl="root">
			<?php  if($advs) { ?>
			<div id="banner_box" class="box_swipe">
				<ul>
					<?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
					<li>
						<a href="<?php  if($adv['link']=='http://') { ?>#<?php  } else { ?><?php  echo $adv['link'];?><?php  } ?>">
							<img src="<?php  echo tomedia($adv['thumb']);?>" style='width:100%;' />
						</a>

					</li>
					<?php  } } ?>
				</ul>
				<!--<ol>
					<?php  $slideNum = 1;?> <?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
					<li<?php  if($slideNum==1 ) { ?> class="on" <?php  } ?>></li>
						<?php  $slideNum++;?> <?php  } } ?>
				</ol>-->
			</div>
			<script>
				$(function() {
				        new Swipe($('#banner_box')[0], {
				            speed:500,
				            auto:3000,
				            callback: function(){
				                var lis = $(this.element).next("ol").children();
				                lis.removeClass("on").eq(this.index).addClass("on");
				            }
				        });
				    });
			</script>
			<?php  } ?>
			<?php  if($this->module['config']['searchstatus'] == 1) { ?>
			<section class="trip-search trip-nosearchbtn" data-spm="1998854396">
				<form class="trip-search-form" action="index.php" method="get">
					<input type="hidden" name="i" value="<?php  echo $_W['uniacid'];?>" />
		            <input type="hidden" name="c" value="entry" />
		            <input type="hidden" name="m" value="feng_fightgroups" />
		            <input type="hidden" name="do" value="index" />
		            <input type="hidden" name="op" value="search" />
					<div class="trip-search-wrapper">
						<div class="trip-search-input-wrapper">
							<input type="search" class="trip-search-input ac-input" autocomplete="false" placeholder="请输入搜索词" value="<?php  echo $_GPC['keyword'];?>" name="keyword">
						</div> 
					</div> 
				</form> 
			</section>
			<?php  } ?>
			<?php  if($this->module['config']['ditype']!=2) { ?>
			<?php  if($category) { ?>
			<div class="j-rmd-types rmd-types">
				<?php  if(is_array($category)) { foreach($category as $itme) { ?>
	            <a href="<?php  echo $this->createMobileUrl('index', array('op'=>'display' ,'gid'=>$itme['id']));?>">
	                <img src="<?php  echo tomedia($itme['thumb']);?>" alt="">
	                <span><?php  echo $itme['name'];?></span>
	            </a>
	            <?php  } } ?>
	    	</div>
	    	<?php  } ?>
	    	<?php  } ?>
	    	<div class="divider r1bt r1bb trip_home_section_divider_4"></div>
	    	<?php  if($showtype==2) { ?>
			<section class="main-view" style="display: block;" data-unuse="1">
				<div avalonctrl="goods_list_0">
				<div class="goods-list-wrapper" id="more">
					<?php  if($goodses) { ?>
					<?php  if(is_array($goodses)) { foreach($goodses as $goodsid => $goods) { ?>
					<div style="background-color: white;"> 
						<a href="<?php  echo $this->createMobileUrl('goodsdetails', array('id'=>$goods['id']));?>">
				        <div class="rank_g rank_high" style="overflow-x: hidden;margin-bottom: 0px;">
				            <div class="rank_g_img">
				                <img src="<?php  echo tomedia($goods['gimg']);?>"  class="imgLoading_goods_list_0">
				            </div>
				            <div class="rank_g_info">
				                <p class="rank_g_name"><?php  echo $goods['gname'];?></p>
				            </div>
				            <div class="rank_core">
				                <div class="rank_g_volume">
				                    已售 <b><?php  echo $goods['salenum'];?></b> 件
				                </div>
				                <!--ms-if-->
				                <div class="rank_g_core">
				                	<?php  if($goods['isshow']==3) { ?><div style="position: absolute;right: 30px;width:200px;height: 200px;z-index: 999;top: -100px;"><img  alt="" width="130" height="130" src="<?php echo S_URL;?>image/shouqing.png"/></div><?php  } ?>
				                    <div class="rank_g_price" style="width: 46%;">
				                        <span><?php  if($goods['group_level_status']==2) { ?>阶梯团,低至￥<?php  echo $goods['p'];?>元<?php  } else { ?><?php  echo $goods['groupnum'];?>人团<?php  } ?></span>
				                        <?php  if($goods['group_level_status']!=2) { ?><b><span>¥ </span><?php  echo $goods['gprice'];?></b><?php  } ?>
				                    </div>
				                    <div class="rank_g_btn">去开团</div>
				                </div>
				            </div>
				        </div>
				        </a>
				    </div>
				    <?php  } } ?>
				    <?php  } else { ?>
					<div style="width:100%;line-height: 50px;text-align: center;z-index: 999;">
					没有商品信息
					</div>
					<?php  } ?>
				</div>
				<div id="loading" style="line-height: 50px;width:100%;text-align: center;z-index: 999;display: none;">
					上拉加载更多
				</div>
				</div>
			</section>
			<?php  } else { ?>
			<section class="main-view" style="display: block;" data-unuse="1">
				<div id="more" class="tuan" style="padding-top: 10px; display: block;min-height: 220px;" data-unuse="1">
					<?php  if($goodses) { ?>
					<?php  if(is_array($goodses)) { foreach($goodses as $goodsid => $goods) { ?>
					<div>
						<div class="tuan_g" data-vtuan="0" data-cat="1" data-num="12058">
							<a href="<?php  echo $this->createMobileUrl('goodsdetails', array('id'=>$goods['id']));?>">
								<div class="tuan_g_img">
									<img src="<?php  echo tomedia($goods['gimg']);?>">
									<span class="tuan_mark tuan_mark2 ">
                                <b style="position: relative;top: .5em;">
                                	<?php  if(floatval($goods['gprice'])-0 > 0.000001 && floatval($goods['mprice'])> 0.000001) { ?>  
										<?php  echo sprintf("%.1f", ($goods['gprice']/$goods['mprice'])*10)."折";?> 
									<?php  } else { ?>  
	  									<?php  echo "未打折";?>
									<?php  } ?>
                                	</b>
									</span>
								</div>
								<div class="tuan_g_info">
										<?php  if($goods['isnew']==1) { ?><span class="g_mark g_mark1"><?php  echo $this->module['config']['tag1']?></span><?php  } ?>
										<?php  if($goods['ishot']==1) { ?><span class="g_mark g_mark2"><?php  echo $this->module['config']['tag2']?></span><?php  } ?>
										<?php  if($goods['isrecommand']==1) { ?><span class="g_mark g_mark3"><?php  echo $this->module['config']['tag3']?></span><?php  } ?>
										<?php  if($goods['isdiscount']==1) { ?><span class="g_mark g_mark4"><?php  echo $this->module['config']['tag4']?></span><?php  } ?>
									<p class="tuan_g_name">	<?php  echo $goods['gname'];?></p>
									<p class="tuan_g_cx"><?php  echo $goods['gdesc'];?></p>
								</div>
								<div class="tuan_g_core">
									<?php  if($goods['isshow']==3) { ?><div style="position: absolute;right: 30px;width:200px;height: 200px;z-index: 999;top: -100px;"><img  alt="" width="130" height="130" src="<?php echo S_URL;?>image/shouqing.png"/></div><?php  } ?>
									<div class="tuan_g_price">
										<span><?php  if($goods['group_level_status']==2) { ?>阶梯团,低至￥<?php  echo $goods['p'];?>元<?php  } else { ?><?php  echo $goods['groupnum'];?>人团<?php  } ?></span>
				                        <?php  if($goods['group_level_status']!=2) { ?><b><span>¥ </span><?php  echo $goods['gprice'];?></b><?php  } ?>
									</div>
									<div class="tuan_g_btn">去开团</div>
								</div>
								<div class="tuan_g_mprice">市场价：
									<del>￥ <?php  echo $goods['mprice'];?></del>
								</div>
							</a>
						</div>
					</div>
					<?php  } } ?>
					<?php  } else { ?>
					<div style="width:100%;line-height: 50px;text-align: center;z-index: 999;">
					没有商品信息
					</div>
					<?php  } ?>
				</div>
				<div id="loading" style="width:100%;line-height: 50px;text-align: center;z-index: 999;display: none;">
					上拉加载更多
				</div>
			</section>	
			<?php  } ?>
		</div>
		<div class="go-top go_top_goods_list_0" style="bottom: 64px; opacity: 1;display: none;" onclick="BackTop();"><span>顶部</span></div>
		<!--二维码-->
		
<div class="alert_box" id="checkalert" style="position: fixed;top:30px;z-index: 10000;left:9%;width: 82%;max-width:530px;background:white;padding: 5% 0 3%;border-radius: 5%;display: none;">
		<img src="<?php echo S_URL;?>image/exit.png" class="exit" id='off' style="width: 10%;float: right;margin-right: -5%;margin-top: -10%;">
		<div style="text-align: center;font-size: 18px;font-weight: 600;">
			长按二维码进群，拉人快速成团
		</div>
		<input type="hidden" id="qrcodepath" name="qrcodepath" value="<?php  echo $qrcodepath;?>">
		<div id="qrcode" style="text-align: center;">
			<?php  if($qrcode) { ?>
			<img src='<?php  echo $_W['attachurl'];?><?php  echo $qrcode;?>'>
			<?php  } else { ?>
			暂无二维码
			<?php  } ?>
		</div>
		<div style="text-align: center;" id="ma">
				
		</div>
		<div style="text-align: center;font-size: 18px;">
		</div>
</div>
<!--二维码-->
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
	</body>
	<script>
		wx.ready(function (){
		var shareData = {
			title: "<?php  echo $share_data['share_title'];?>",
			desc: "<?php  echo $share_data['share_desc'];?>",
			link: "<?php  echo $to_url;?>",
			imgUrl: "<?php  echo $_W['attachurl'];?><?php  echo $shareimage;?>",
		};
	//分享朋友
		wx.onMenuShareAppMessage({
		    title: shareData.title,
		  	desc: shareData.desc,
		  	link: shareData.link,
		  	imgUrl:shareData.imgUrl,
		  	trigger: function (res) {
		  	},
		  	success: function (res) {
		    	window.location.href =adurl;
		  	},
		  	cancel: function (res) {
		  	},
		  	fail: function (res) {
		  	}
		});
	//朋友圈
		wx.onMenuShareTimeline({
		  	title: shareData.title,
		  	link: shareData.link,
		  	imgUrl:shareData.imgUrl,
		  	trigger: function (res) {
		  	},
		  	success: function (res) {
		    	window.location.href =adurl;
		  	},
		  	cancel: function (res) {
		  	},
		  	fail: function (res) {
		    	alert(JSON.stringify(res));
		  	}
		});
	});
	
	function BackTop(){
		window.scrollTo(0,0);
	}
	function show(){
		$("#checkalert").show();
		$("#main").addClass("lockDiv");
	}
	$("#off").bind("click", function(){
		$("#main").removeClass("lockDiv");
		$("#checkalert").hide();
	});
	</script>
	<!--缓冲-->
	<!--<script type="text/javascript">
		document.onreadystatechange = subSomething;//当页面加载状态改变的时候执行这个方法. 
		function subSomething() 
		{ 
			if(document.readyState != 'complete'){
				
			}
		} 
	</script>-->
	
</html>