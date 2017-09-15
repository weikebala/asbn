<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html ng-app="myApp">
<head>
<meta charset="utf-8">
<title><?php  echo $share['title'];?></title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<script language="javascript" src="../addons/sea/static/js/dist/jquery-1.11.1.min.js"></script>

<link href="../addons/sea/static/css/font-awesome.min.css" rel="stylesheet">
<link href="../addons/sea/plugin/designer/template/imgsrc/designer.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../addons/sea/static/css/bootstrap.min.css">

</head>
<body >
<input  id="newmid" type="hidden" value="<?php  echo $mid;?>">
    <div ng-controller="MainCtrl">
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


