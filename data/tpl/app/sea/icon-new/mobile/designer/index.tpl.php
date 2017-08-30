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
    }
    .fl-nv-data li {
        float: left;
        height: 36px;
        line-height: 36px; padding: 0rem 6px;

    }

    .fl-com-lk{
        color: #666;
        font-size: 13px;

        float: left;
        height: 34px;
        line-height: 36px;
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
            <ul class="d-f fl-nv-data" id="scroll">
                <li>
                    <a href="" class="fl-com-lk fl-lk-on">首页</a>
                </li>
                <?php  if(is_array($category)) { foreach($category as $key => $vo) { ?>
                <li>
                    <a href="<?php  echo $vo['url'];?>" class="fl-com-lk"><?php  echo $vo['name'];?></a>
                </li>
                <?php  } } ?>

            </ul>
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


