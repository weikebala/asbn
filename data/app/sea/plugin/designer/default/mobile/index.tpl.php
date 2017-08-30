<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html ng-app="myApp">
<head>
<meta charset="utf-8">
<title><?php  echo $share['title'];?></title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<script>var require = {urlArgs: 'v=<?php  echo date('YmdHis');?>'};</script>
<script language="javascript" src="../addons/sea/static/js/require.js"></script>
<script language="javascript" src="../addons/sea/static/js/app/config.js"></script>
<script language="javascript" src="../addons/sea/static/js/dist/jquery-1.11.1.min.js"></script>
<script language="javascript" src="../addons/sea/static/js/dist/jquery.gcjs.js"></script>
<link href="../addons/sea/static/css/font-awesome.min.css" rel="stylesheet">
<link href="../addons/sea/plugin/designer/template/imgsrc/designer.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../addons/sea/template/mobile/default/static/css/style.css">
<link rel="stylesheet" type="text/css" href="../addons/sea/static/css/bootstrap.min.css">
<style>
body {margin:0px; background:#f9f9f9; }
.fe-mod:hover{border:2px dashed rgba(0,0,0,0); cursor:default;}
.fe-mod,.fe-mod:hover {border:0px;}
.fe-mod-cube td {height:auto;}
</style>
</head>
<body >
<?php  if($shop!=null) { ?>
<style type="text/css">
body {margin:0px; width:100%;background:#f4f4f4; font-family:'微软雅黑';}

.top {overflow:hidden; background:#fff; border-bottom:1px solid #ddd;}
.top .bgimg {height:auto; position:relative;}
.top .bgimg img {width:100%; position: relative; }
.top .bgimg .shopimg {height:66px; width:66px; background:#ccc; position:absolute; left:10px; bottom:-35px; border:1px solid #fff; box-shadow:0px 0px 2px rgba(0,0,0,0.1); }
.top .bgimg .shopimg img {height:66px; width:66px;}
.top .bgimg .shopname {height:40px; width:auto; position:absolute; left:90px; bottom:0px; font-size:16px; line-height:40px; font-size:18px; color:#fff; text-shadow:2px 2px 2px rgba(0,0,0,0.2);}
.top .bgimg .set {height:24px; width:24px; position:absolute; top:10px; right:10px; font-size:24px; color:#fff; text-align:center; line-height:24px;}
.top .nav {height:40px; padding:0px 0px 5px 100px; text-align:center;}
.top .nav .sub {height:40px; <?php  if($shop['selectcategory']==1) { ?>width:23%;<?php  } else { ?>width:30%;<?php  } ?>border-left:1px solid #ddd; float:right;}
.top .nav .sub span {font-size:18px; color:#000; line-height:22px;}
.top .nav .sub nav {font-size:12px; color:#999;}

    .goods {height:auto; min-height:100px; width:100%; background:#fff; overflow:hidden;float:left;padding-bottom:40px;} 
    .goods .good {overflow:hidden; width:46%; padding:0px 2% 10px; float:left;}
    .goods .good .img {width:100%;overflow:hidden;}
    .goods .good .img img {width:100%;}
    .goods .good .name {height:20px; width:100%; font-size:15px; line-height:20px; color:#666; overflow:hidden;}
    .goods .good .price {height:20px; width:100%; color:#f03; font-size:14px;}
    .goods .good .price span {color:#aaa; font-size:12px; text-decoration:line-through;}
    
      .banner {overflow:hidden;position:relative;height:auto;}
     .banner  .main_image{width:100%;position:relative;top:0;left:0;}
  .banner .main_image ul{}
  .banner .main_image li{float:left;}
  .banner .main_image li img{display:block;width:100%;}
  .banner .main_image li a{display:block;width:100%;}

    div.flicking_con{position:absolute;bottom:10px;z-index:1;width:100%;height:12px;}
    div.flicking_con .inner { width:100%;height:9px;text-align:center;}
    div.flicking_con a{position:relative; width:10px;height:9px;background:url('../addons/sea/template/mobile/default/static/images/dot.png') 0 0 no-repeat;display:inline-block;text-indent:-1000px}
    div.flicking_con a.on{background-position:0 -9px}
    #index_loading { width:94%;padding:10px;color:#666;text-align: center;float:left;}
    .search {height:40px; width:97%; margin:5px; background:#fff; color:#ccc; line-height:40px; font-size:14px; text-align:center;}
       .title {height:40px; width:94%; background:#fff; padding:0px 3%; font-size:16px; color:#666; line-height:40px;}
        .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin:10px 0 54px;}
</style>
<div class="top">
   <div class="bgimg">
		<img src="<?php  if($sysset['dzbg']!='') { ?><?php  echo $sysset['dzbg'];?><?php  } else { ?>../addons/sea/plugin/commission/template/mobile/default/static/images/bg.png<?php  } ?>" />
        <div class="shopimg"><img src="<?php  echo $shop['logo'];?>"></div>
        <div class="shopname">爱尚彼岸<?php  echo $shop['name'];?></div>
    </div>
    <div class="nav">
        <div class="sub" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/shares')?>'">
              <span><i class="fa fa-qrcode"></i></span>
            <nav >二维码</nav>
        </div>
        <div class="sub" id='fav'>
            <span><i class="fa fa-star-o"></i></span>
            <nav>收藏本店</nav>
        </div>
		<!--<div class="sub">
            <nav style="height:23px;line-height:23px">加盟商</nav>
            <nav>收藏本店</nav>
        </div>-->
    </div>
</div>
<div id='cover'><img src='../addons/sea/plugin/commission/images/favorite.png' style='width:100%;' /></div>
<script type="text/javascript">
$(function(){
	$('#fav').click(function(){
		$('#cover').fadeIn(200).unbind('click').click(function(){
			$(this).fadeOut(100);
		});
	});
});
</script>
<?php  } ?>
<input  id="newmid" type="hidden" value="<?php  echo $mid;?>">
<!-- update 11-25 -->
<script type="text/javascript" src="../addons/sea/static/js/bar.min.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/sea/static/js/bar.min.css">
<script type="text/javascript">
    $(function(){
        $.mCustomScrollbar.defaults.theme="light-2"; //set "light-2" as the default theme
        $("#scroll").mCustomScrollbar({
            axis:"x",
            advanced:{autoExpandHorizontalScroll:true}
        });
    });
</script>
<style type="text/css">
    .h-fl-nav {
        height: 36px;
        background: #FAFAFA;
		
    }
    .com-relative {
        position: relative;
    }
    .fl-nv-data {
        overflow: hidden;
        height: 36px;
        width:71%;
    }
    .fl-nv-data li {
        float: left;
        height: 36px;
        line-height: 38px; padding: 0rem 6px;

    }

    .fl-com-lk{
        color: #666;
        font-size: 15px;

        float: left;
        height: 34px;
        line-height: 34px;
        display: inline-block;

        text-decoration: none;
    }
    .fl-lk-on {
        border-bottom: 2px solid #271C1C;
    }
    .fl-nv-data li .fl-lk-on{
        color: #271C1C;
    }
</style>
<!-- end updte 11-25- -->

    <div ng-controller="MainCtrl">
        <!-- 浮动按钮 -->
        <div class="fe-floatico" style="position: fixed;" ng-style="{'width':pages[0].params.floatwidth,'top':pages[0].params.floattop}" ng-class="{'fe-floatico-right':pages[0].params.floatstyle=='right'}" ng-show="pages[0].params.floatico==1">
            <a href="{{pages[0].params.floathref || 'javascript:;'}}">
                <img ng-src="{{pages[0].params.floatimg || '../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-7.png'}}" style="width:100%;" />
            </a>
        </div>
        <!-- 关注按钮 -->
        <?php  if($guide['followed']!=1) { ?>
            <div style="height: 50px;" ng-show="pages[0].params.guide==1"></div>
            <a href="<?php  echo $guide['followurl'];?>">
                <div class="fe-guide" style="position: fixed;" ng-style="{'display':'block','background-color':pages[0].params.guidebgcolor,'opacity':pages[0].params.guideopacity}" ng-show="pages[0].params.guide==1">
                    <div class="fe-guide-faceimg" ng-style="{'border-radius':pages[0].params.guidefacestyle}">
                        <img src="<?php  echo $guide['logo'];?>" ng-style="{'border-radius':pages[0].params.guidefacestyle}" />
                    </div>
                    <div class="fe-guide-sub" ng-style="{'color':pages[0].params.guidenavcolor,'background-color':pages[0].params.guidenavbgcolor}">{{pages[0].params.guidesub ||'立即关注'}}</div>
                    <div class="fe-guide-text"  ng-style="{'font-size':pages[0].params.guidesize,'color':pages[0].params.guidecolor}">
                        <p <?php  if(empty($guide['title2'])) { ?> style="line-height:40px;"<?php  } ?>><?php  echo $guide['title1'];?></p>
                        <p <?php  if(empty($guide['title1'])) { ?> style="line-height:40px;"<?php  } ?>><?php  echo $guide['title2'];?></p>
                    </div>
                </div>
            </a>
        <?php  } ?>
        <?php  if($category) { ?>
        <div class="h-fl-nav d-f com-relative scrollbox">
            <p style="margin:0;width:19%">
                <a href="<?php  if($set['shop']['btnlink']) { ?><?php  echo $set['shop']['btnlink'];?><?php  } else { ?>http://<?php  echo $_SERVER['SERVER_NAME'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=shop&m=sea&p=index<?php  } ?>" class="fl-com-lk <?php  if($_GPC['cid']==null) { ?>fl-lk-on<?php  } ?>"><?php  if($set['shop']['btnname']) { ?><?php  echo $set['shop']['btnname'];?><?php  } else { ?>首页<?php  } ?></a>
            </p>
            <ul class="d-f fl-nv-data" id="scroll">
                <?php  if(is_array($category)) { foreach($category as $key => $vo) { ?>
                <li <?php  if($vo['id']==$_GPC['cid']) { ?>class="curreny"<?php  } ?>>
                    <a href="<?php  echo $vo['activity_url'];?>&cid=<?php  echo $vo['id'];?>" class="fl-com-lk <?php  if($vo['id']==$_GPC['cid']) { ?>fl-lk-on<?php  } ?>"><?php  echo $vo['name'];?></a>
                </li>
                <?php  } } ?>

            </ul>
            <p onclick="window.location.href='http://<?php  echo $_SERVER['SERVER_NAME'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=shop&m=sea&p=search'" style="margin:0;position: absolute;right: 0;top: 0;line-height: 20px;width:10%;background:white;height:36px;text-align: center">
                <i style="margin-top: 6px;margin-right: 6px;font-size:20px" class="fa fa-search"></i>
            </p>
        </div>
        <?php  } ?>
        <div ng-repeat="Item in Items" class="fe-mod-repeat">
            <div ng-include="'../addons/sea/plugin/designer/template/temp/show-'+Item.temp+'.html'" class="fe-mod-parent" id="{{Item.id}}" mid="{{Item.id}}" on-finish-render-filters></div>
        </div>
        <div ng-show="Items==''" style="line-height: 300px; text-align: center; font-size: 14px; color: #999;">
            <div id="core_loading" style="top:50%;left:50%;margin-left:-35px;margin-top:-50%;position:absolute;width:80px;height:60px;"><img src="../addons/sea/static/images/loading.svg" width="80" /></div>
        </div>
        <div style="height: 50px;" ng-show="pages[0].params.footer==2"></div>
    </div>

<script type="text/javascript" src="../addons/sea/plugin/designer/template/imgsrc/angular.min.js"></script>
<?php  $_W['angular_loaded']=true?>
<script type="text/javascript" src="../addons/sea/plugin/designer/template/imgsrc/hhSwipe.js"></script>

<script type="text/javascript">
    function initswipe(jobj){
        var bullets = jobj.next().get(0).getElementsByTagName('a');
        var banner = Swipe(jobj.get(0), {
            auto: 4000,
            continuous: true,
            disableScroll:false,
            callback: function(pos) {
                var i = bullets.length;
                while (i--) {
                    $(bullets[i]).css("opacity",0.4);
                }
                $(bullets[pos]).css("opacity",0.6);
            }
        })
    }
    var app = angular.module('myApp', []);
    app.controller('MainCtrl', ['$scope', function($scope){
            $scope.shop = {
                uniacid:'<?php  echo $_W["uniacid"];?>'
            };
            $scope.cols = [0,1,2,3];
            $scope.size = $(document.body).width()/4;
            $scope.pages = [<?php  echo $pageinfo;?>];
            $scope.system = [<?php  echo $system;?>];
            $scope.Items = [<?php  echo $data;?>];
            $scope.show = '1';

            $scope.hasCube = function(Item){

            	 var has = false;
                 var row=0,col = 0;
            	 for(var i=row;i<4;i++){
                    for(var j=col;j<4;j++){
                      if (Item.params.layout[i][j] && !Item.params.layout[i][j].isempty) {
                          has = true;
                          break;
                      }
                    }
                }
                return has;


            }

            $scope.$on('ngRepeatFinished',function(){
                $('.fe-mod-2 .swipe').each(function(){
                        initswipe($(this));
                 });
                 $('.fe-mod-8-main-img img').each(function(){
                     $(this).height($(this).width());
                 });
                 $('.fe-mod-12 img').each(function(){
                     $(this).height($(this).width());
                 });
                 $('.fe-mod-cube table  tr').each(function(){
                 	if( $(this).children().length<=0){
                 		$(this).html('<td></td>');
                 	}
                 });
            });


    }]);

    app.directive('stringHtml' , function(){
        return function(scope , el , attr){
            if(attr.stringHtml){
                scope.$watch(attr.stringHtml , function(html){
                    el.html(html || '');
                });
            }
        };
    });
    app.directive("onFinishRenderFilters",function($timeout){
        return{
            restrict: 'A',
            link: function(scope,element,attr){
                if(scope.$last === true){
                    $timeout(function(){
                        scope.$emit('ngRepeatFinished');
                    });
                }
            }
        };
    });
</script>

<?php  if($footertype==1) { ?>
    <?php  $show_footer=true;$footer_current ='first'?>
<?php  } else if($footertype==2) { ?>
    <?php  $show_footer=false;?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('designer/menu', TEMPLATE_INCLUDEPATH)) : (include template('designer/menu', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
    <?php  $show_footer=false;?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>


