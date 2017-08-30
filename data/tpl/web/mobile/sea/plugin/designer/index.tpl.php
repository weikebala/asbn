<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<script language="javascript">require(['underscore']);</script>
<!-- 导入CSS样式 -->
<link href="../addons/sea/plugin/designer/template/imgsrc/designer.css" rel="stylesheet">
<!-- 头部选项卡 -->
<ul class="nav nav-tabs">
    <li <?php  if($_GPC['op']=='display' || empty($_GPC['op'])) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('designer')?>" >店铺装修</a></li>
   <?php  if($_GPC['op']=='post') { ?><li class="active"><a href="#">页面编辑</a></li><?php  } ?>
   <li ><a href="<?php  echo $this->createPluginWebUrl('designer/menu')?>" >自定义菜单</a></li>
</ul>
<?php  if($op=='display') { ?>
<!-- 筛选区域 -->
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="plugin" />
            <input type="hidden" name="p" value="designer" />
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                <div class="col-sm-8 col-lg-9">
                    <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入页面名称进行搜索">
                </div>
                <div class=" col-xs-12 col-sm-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- 页面列表 -->
<div class='panel panel-default'>
    <div class='panel-heading'> 页面管理 <?php  if($pagesnum) { ?>(总数: <?php  echo $pagesnum;?>)<?php  } ?></div>
    <div class='panel-body'>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:60px; text-align: center;">ID</th>
                    <th >页面名称</th>
                    <th style="text-align: center;">页面类型</th>
                    <th style=" text-align: center;">关键字</th>
                    <th style="text-align: center;">页面创建时间</th>
                    <th style=" text-align: center;">最后修改时间</th>
                    <th style="text-align: center;">是否默认</th>
                    <th style="text-align: center;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(!empty($pages)) { ?>
                    <?php  if(is_array($pages)) { foreach($pages as $page) { ?>
                        <tr pageid="<?php  echo $page['id'];?>">
                            <td style="width:60px; text-align: center;"><?php  echo $page['id'];?></td>
                            <td><?php  echo $page['pagename'];?></td>
                            <td style="text-align: center;">
                                <?php  if($page['pagetype']==1) { ?>
                                <label class='label label-primary'>店铺首页</label>
                                <?php  } else if($page['pagetype']==2) { ?>
                                <label class='label label-success'>商品列表</label>
                                <?php  } else if($page['pagetype']==3) { ?>
                                <label class='label label-warning'>商品详细</label>
                                <?php  } else if($page['pagetype']==4) { ?>
                                <label class='label label-danger'>其他自定义</label>
                                <?php  } ?>
                            </td>
                            <td style=" text-align:  center;"><?php  echo $page['keyword'];?></td>
                            <td style="text-align:  center;"><?php  echo $page['createtime'];?></td>
                            <td style=" text-align:  center;"><?php  echo $page['savetime'];?></td>
                            <td style="text-align:  center;" data-id="<?php  echo $page['id'];?>">
                                <?php  if($page['pagetype']!=4) { ?>
                                    <?php  if($page['setdefault']==1) { ?>
                                        <label class='label label-success' style="cursor: pointer;" title="点击关闭" data-do="off" onclick="setdefault(this,<?php  echo $page['id'];?>,<?php  echo $page['pagetype'];?>)">已启用</label>
                                    <?php  } else { ?>
                                        <label class='label label-default' style="cursor: pointer;" title="点击开启" data-do="on" onclick="setdefault(this,<?php  echo $page['id'];?>,<?php  echo $page['pagetype'];?>)">未启用</label>
                                    <?php  } ?>
                                    <?php  } else { ?>-
                                <?php  } ?>
                            </td>
                            <td style=" text-align:  center;position:relative">
                                <a href="javascript:;" onclick="preview(<?php  echo $page['id'];?>)">预览</a> - 
                               <a href="javascript:;" data-url="<?php  echo $this->createPluginMobileUrl('designer',array('pageid'=>$page['id']))?>" class="js-clip" title="复制链接">复制链接</a>	   
                                <?php if(cv('designer.page.edit')) { ?>- <a href="<?php  echo $this->createPluginWebUrl('designer',array('op'=>'post','pageid'=>$page['id']))?>">编辑</a><?php  } ?>
                                <?php if(cv('designer.page.delete')) { ?>- <a href="javascript:;" onclick="delpage(<?php  echo $page['id'];?>)">删除</a><?php  } ?>
                            </td>
                        </tr>
                    <?php  } } ?>
                <?php  } else { ?>
                    <?php if(cv('designer.page.edit')) { ?>
                    <tr> 
                        <td style="text-align: center; line-height: 100px;" colspan="8">亲~您还没有添加自定义页面哦~您可以尝试 ↙ 左下角的 “<a href="<?php  echo $this->createPluginWebUrl('designer', array('op' => 'post'))?>">添加一个新页面</a>”</td>
                    </tr>
                    <?php  } ?>
                <?php  } ?>     
                <?php if(cv('designer.page.edit')) { ?>
                    <tr>
                        <td colspan="8">
                            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('designer', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加一个新页面</a>
                            <span>Tips:自定义页面启用默认后将代替系统默认页面(商城首页、商品列表、商品详细)，同一个类型的页面仅允许设置一个默认页面</span>
                        </td>
                    </tr>
                <?php  } ?>
                <tr><td colspan="8" style="padding:0px; margin: 0px;"><?php  echo $pager;?></td></tr>
            </tbody>
        </table>
    </div>
</div>

        <!-- 预览 start -->
                <div id="modal-module-menus2"  class="modal fade" tabindex="-1">
                    <div class="modal-dialog" style='width: 413px;'>
                                <div class="fe-phone">
                                    <div class="fe-phone-left"></div>
                                    <div class="fe-phone-center">
                                        <div class="fe-phone-top"></div>
                                        <div class="fe-phone-main">
                                            <iframe style="border:0px; width:342px; height:600px; padding:0px; margin: 0px;" src=""></iframe>
                                        </div>
                                        <div class="fe-phone-bottom" style="overflow:hidden;">
                                            <div style="height:52px; width: 52px; border-radius: 52px; margin:20px 0px 0px 159px; cursor: pointer;" data-dismiss="modal" aria-hidden="true" title="点击关闭"></div>
                                        </div>
                                    </div>
                                    <div class="fe-phone-right"></div>
                                </div>
                    </div>
                </div>
        <!-- 预览 end -->    
<script type="text/javascript">
    function preview(pageid){
        var url = "<?php  echo $this->createPluginMobileUrl('designer')?>&preview=1&pageid="+pageid;
        $('#modal-module-menus2').find("iframe").attr("src",url);
        popwin = $('#modal-module-menus2').modal();
    }
    function delpage(id){
        if(confirm('此操作不可恢复，确认删除？')){
             $.ajax({
                type: 'POST',
                url: "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'api','apido'=>'delpage'))?>",
                data: {pageid:id},
                success: function(data){
                    if(data=='success'){
                        $("tr[pageid="+id+"]").fadeOut();
                    }
                    else{
                        alert(data);
                    }
                },
                error: function(){
                    alert('操作失败~请刷新页面重试！');
                }
            });
        }
    }
    function setdefault(t,id,type){
        thisdo = $(t).data("do");
        d = thisdo;
        $.ajax({
            type: 'POST',
            dataType:'json',
            url: "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'api','apido'=>'setdefault'))?>",
            data: {d:d,id:id,type:type},
            success: function(data){
                if(data['result']=='on'){
                    $("td[data-id="+data['id']+"]").find("label").data("do","off").removeClass("label-default").addClass("label-success").text("已启用").attr("title","点击关闭");
                    $("td[data-id="+data['closeid']+"]").find("label").data("do","on").removeClass("label-success").addClass("label-default").text("未启用").attr("title","点击开启");
                }else{
                    $("td[data-id="+data['id']+"]").find("label").data("do","on").removeClass("label-success").addClass("label-default").text("未启用").attr("title","点击开启");
                }
            },
            error: function(){
                alert('操作失败~请刷新页面重试！');
            }
        });
    }
</script>
<?php  } else if($op=='post') { ?>
<!-- 编辑页面 -->
<div class='panel panel-default' ng-app="FoxEditor" style="background: #f2f2f2">
    <div class='panel-heading'> 页面编辑 <?php  if($_GPC['pageid']!='') { ?>(ID: <?php  echo $_GPC['pageid'];?>)<?php  } ?></div>
    <div class='panel-body' ng-controller="FoxController">
           <div class="fe-panel-menu">
                    <div ng-repeat="nav in navs">
                        <nav ng-bind="nav.name" ng-click="addItem(nav.id)"></nav>
                    </div>
            </div>
        <div class="fe">
         
            
            <div class="fe-phone">
                <div class="fe-phone-left"></div>
                <div class="fe-phone-center">
                    <div class="fe-phone-top"></div>
                    <div class="fe-phone-main">
                        <div id="editor">
                            <div ng-repeat="page in pages">
                                <div ng-include="'../addons/sea/plugin/designer/template/temp/show-'+page.temp+'.html'" id="{{page.id}}" mid="{{page.id}}" ng-click="setfocus(page.id,$event)"></div>
                            </div>
                            <div style="height: 50px;" ng-show="pages[0].params.guide==1"></div>
                            <div ng-repeat="Item in Items" class="fe-mod-repeat" ng-mouseover="over(Item.id)" ng-mouseleave="out(Item.id)">
                                <div class="fe-mod-move" ng-mouseover="drag(Item.id)" ng-click="setfocus(Item.id,$event)"></div>
                                <div ng-include="'../addons/sea/plugin/designer/template/temp/show-'+Item.temp+'.html'" class="fe-mod-parent" id="{{Item.id}}" ng-show="Item" mid="{{Item.id}}" on-finish-render-filters></div>
                                <div class="fe-mod-del" ng-click="delItem(Item.id)">移除</div>
                            </div>
                            <!-- 浮动按钮 -->
                            <div class="fe-floatico" ng-show="pages[0].params.floatico==1" ng-style="{'width':pages[0].params.floatwidth,'top':pages[0].params.floattop}" ng-class="{'fe-floatico-right':pages[0].params.floatstyle=='right'}">
                                <img ng-src="{{pages[0].params.floatimg || '../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-7.png'}}" style="height:100%; width: 100%;" ng-click="setfocus('M0000000000000')" />
                            </div>
                            <!-- 关注按钮 -->
                            <div class="fe-guide" ng-click="setfocus('M0000000000000')" ng-show="pages[0].params.guide==1" ng-style="{'display':'block','background-color':pages[0].params.guidebgcolor,'top':'60px','z-index':'890','opacity':pages[0].params.guideopacity}">
                                <div class="fe-guide-faceimg"><img ng-src="../addons/sea/plugin/designer/template/imgsrc/init-data/init-icon.png" ng-style="{'border-radius':pages[0].params.guidefacestyle}" /></div>
                                <div class="fe-guide-sub" ng-style="{'color':pages[0].params.guidenavcolor,'background-color':pages[0].params.guidenavbgcolor}">{{pages[0].params.guidesub ||'立即关注'}}</div>
                                <div class="fe-guide-text"  ng-style="{'font-size':pages[0].params.guidesize,'color':pages[0].params.guidecolor}">
                                    <p ng-class="{'fe-guide-lineheight':pages[0].params.guidetitle2==''}">{{pages[0].params.guidetitle1s || '加关注，做代理。'}}</p>
                                    <p ng-class="{'fe-guide-lineheight':pages[0].params.guidetitle1==''}">{{pages[0].params.guidetitle2s || '关注公众号，享专属服务'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fe-phone-bottom"></div>
                </div>
                <div class="fe-phone-right"></div>
            </div>
            <div class="fe-panel">
                
                <!-- editor start -->
                <div class="fe-panel-editor" ng-show="focus">
                    <div class="fe-panel-editor-ico"></div>
                    <div ng-repeat="Edit in pages">
                        <div ng-include="'edit-'+Edit.temp+'.html'" ng-show="focus==Edit.id" Editid="{{Edit.id}}" ></div>
                    </div>
                    <div ng-repeat="Edit in Items">
                        <div ng-include="'edit-'+Edit.temp+'.html'" ng-show="focus==Edit.id" Editid="{{Edit.id}}" tab-index="-1"></div>
                    </div>
                </div>
                <!-- editor end -->
            </div>
        </div>
        <!-- 页面底部保存栏 -->
        <div class="fe-save">
            <div class="fe-save-main">
                <div class="fe-save-info">
                    <div class="fe-save-info-type fe-save-info-type-ok" data-type="1">
                        <?php  if($datas['pagetype']==1 || empty($datas['pagetype'])) { ?>
                            <div class="fe-save-main-radio fe-save-main-radio2">√</div>
                        <?php  } else { ?>
                            <div class="fe-save-main-radio"></div>
                        <?php  } ?>
                        <div class="fe-save-main-text">商城首页</div>
                    </div>
                    <div class="fe-save-info-type fe-save-info-type-ok" data-type="4">
                        <?php  if($datas['pagetype']==4) { ?>
                            <div class="fe-save-main-radio fe-save-main-radio2">√</div>
                        <?php  } else { ?>
                            <div class="fe-save-main-radio"></div>
                        <?php  } ?>
                        <div class="fe-save-main-text">其他自定义页面</div>
                    </div>
                    <div class="fe-save-info-type" data-type="2">
                        <?php  if($datas['pagetype']==2) { ?>
                            <div class="fe-save-main-radio fe-save-main-radio2">√</div>
                        <?php  } else { ?>
                            <div class="fe-save-main-radio" style="border:2px solid #999; cursor: no-drop;"></div>
                        <?php  } ?>
                        <div class="fe-save-main-text" style="color:#999; cursor: no-drop;">商品列表</div>
                    </div>
                    <div class="fe-save-info-type" data-type="3">
                        <?php  if($datas['pagetype']==3) { ?>
                            <div class="fe-save-main-radio fe-save-main-radio2">√</div>
                        <?php  } else { ?>
                            <div class="fe-save-main-radio" style="border:2px solid #999; cursor: no-drop;"></div>
                        <?php  } ?>
                        <div class="fe-save-main-text" style="color:#999; cursor: no-drop;">商品详细</div>
                    </div>
                    <input name="pagetype" type="hidden" value="<?php  if(empty($datas['pagetype'])) { ?>1<?php  } else { ?><?php  echo $datas['pagetype'];?><?php  } ?>" />
                    <input name="pagename" type="text" style="height: 30px; width: 300px; border: 1px solid #bbb; border-radius: 3px; margin: 4px 10px; outline: none; padding-left: 10px;" placeholder="页面名称：快来给你的页面起一个响亮的名字" value="<?php  echo $datas['pagename'];?>"/>
                </div>
                <div class="fe-save-submit2" ng-click="save(2)">保存并预览</div>
                <div class="fe-save-submit" ng-click="save(1)">保存</div>
            </div>
            <div class="fe-save-fold" onclick="fold()"></div>
            <div class="fe-save-gotop" onclick="$(document.body).animate({scrollTop:0},500)"><i class="fa fa-angle-up"></i><br>返回顶部</div>
             <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('modal', TEMPLATE_INCLUDEPATH)) : (include template('modal', TEMPLATE_INCLUDEPATH));?>
        </div>
    </div>
<!-- editor template  page start -->
<script type="text/ng-template" id="edit-topbar.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-topbar', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-topbar', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-shop.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-shop', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-shop', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-notice.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-notice', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-notice', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-menu.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-menu', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-menu', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-banner.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-banner', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-banner', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-picture.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-picture', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-picture', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-title.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-title', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-title', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-search.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-search', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-search', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-line.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-line', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-line', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-blank.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-blank', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-blank', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-goods.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-goods', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-goods', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-richtext.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-richtext', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-richtext', TEMPLATE_INCLUDEPATH));?></script>
<script type="text/ng-template" id="edit-cube.html"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('temp/edit-cube', TEMPLATE_INCLUDEPATH)) : (include template('temp/edit-cube', TEMPLATE_INCLUDEPATH));?></script>
<!-- editor template page end -->
</div>
<script type="text/javascript" src="../addons/sea/plugin/designer/template/imgsrc/angular.min.js"></script>
<script type="text/javascript" src="../addons/sea/plugin/designer/template/imgsrc/angular-ueditor.js"></script>
<script type="text/javascript" src="../addons/sea/plugin/designer/template/imgsrc/hhSwipe.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.parse.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
// 百度编辑器初始化
var opts = {type: 'image',direct: false,multi: true,tabs: {'upload': 'active','browser': '','crawler': ''},path: '',dest_dir: '',global: false,thumb: false,width: 0};
UE.registerUI('myinsertimage',function(editor, uiName) {
    editor.registerCommand(uiName, {
        execCommand: function() {
            require(['fileUploader'],
            function(uploader) {
                uploader.show(function(imgs) {
                    if (imgs.length == 0) {
                        return;
                    } else if (imgs.length == 1) {
                        editor.execCommand('insertimage', {
                            'src': imgs[0]['url'],
                            '_src': imgs[0]['attachment'],
                            'width': '100%',
                            'alt': imgs[0].filename
                        });
                    } else {
                        var imglist = [];
                        for (i in imgs) {
                            imglist.push({
                                'src': imgs[i]['url'],
                                '_src': imgs[i]['attachment'],
                                'width': '100%',
                                'alt': imgs[i].filename
                            });
                        }
                        editor.execCommand('insertimage', imglist);
                    }
                },
                opts);
            });
        }
    });
    var btn = new UE.ui.Button({
        name: '插入图片',
        title: '插入图片',
        cssRules: 'background-position: -726px -77px',
        onclick: function() {
            editor.execCommand(uiName);
        }
    });
    editor.addListener('selectionchange',
    function() {
        var state = editor.queryCommandState(uiName);
        if (state == -1) {
            btn.setDisabled(true);
            btn.setChecked(false);
        } else {
            btn.setDisabled(false);
            btn.setChecked(state);
        }
    });
    return btn;
},
19);	
</script>

<script>
    $(function(){
        require(['util'], function (util) {
            var preview_id = util.cookie.get('preview_id');
            if(preview_id){
                preview(preview_id);
            }
        });

       $(".fe-save-info-type-ok").click(function(){
           var pagetype = $(this).data("type");
           if(pagetype!='2' || pagetype!='3'){
                $(this).find(".fe-save-main-radio").addClass("fe-save-main-radio2").text("√");
                $(this).siblings().find(".fe-save-main-radio").removeClass("fe-save-main-radio2").text("");
           }
           $("input[name=pagetype]").val(pagetype);
       }); 
    });

    function switchtab(tag,n){
        $("#"+tag+"-"+n).fadeIn().siblings().hide();
        $("#"+tag+"-nav-"+n).addClass("active").siblings().removeClass("active");
    }

    function fold(){
        width= $(".fe-save").width();
        left = $(".fe-save").css("left");
        left = left.replace("px","");
        if(left>=0){
            $(".fe-save").animate({left:0-width+40+"px"},1000);
            $(".fe-save-fold").addClass("fe-save-fold2");
        }else{
            $(".fe-save").animate({left:"0px"},1000);
            $(".fe-save-fold").removeClass("fe-save-fold2");
        }
    }

    function preview(pageid){
        var url = "<?php  echo $this->createPluginMobileUrl('designer')?>&preview=1&pageid="+pageid;
        $('#modal-module-menus3').find("iframe").attr("src",url);
        popwin = $('#modal-module-menus3').modal();
        require(['util'], function (util) {
            util.cookie.set('preview_id','');
        });
    }

    function setcookie(id){
        require(['util'], function (util) {
            util.cookie.set('preview_id',id);
        });
    }

    function clone(myObj){
        if(typeof(myObj) != 'object' || myObj == null) return myObj;
        var newObj = new Object();
        for(var i in myObj){
            newObj[i] = clone(myObj[i]);
        }
        return newObj;
    }
    function cloneArr(arr){
        var newArr = [];
        $(arr).each(function(i,val){ 
            newArr.push(clone(val));
        });
        return newArr;
    }

    function initswipe(jobj){
        var bullets = jobj.next().get(0).getElementsByTagName('a');
        var banner = Swipe(jobj.get(0), {
            auto: 2000,
            continuous: true,
            disableScroll:false,
            callback: function(pos) {
                var i = bullets.length;
                while (i--) {
                    bullets[i].className = '';
                }
                bullets[pos].className = 'cur';
            }
        })
    }
 
    var myModel = angular.module('FoxEditor',['ng.ueditor']);
    myModel.controller('FoxController', ['$scope', function($scope){
            $scope.navs = [
                {id:'notice',name:'公告',params:{color:'',bgcolor:'',notice:'',noticehref:'',scroll:'0'}},
                {id:'banner',name:'轮播',params:{shape:'',align:'center',scroll:'2',bgcolor:''},
                   data:[
                       {id:'B0000000000001',imgurl:'../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-3.jpg',hrefurl:'http://www.baidu.com',sysurl:'url',},
                       {id:'B0000000000002',imgurl:'../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-2.jpg',hrefurl:'http://www.qq.com',sysurl:'url'},
                       {id:'B0000000000003',imgurl:'../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-6.jpg',hrefurl:'http://www.sina.com',sysurl:'url'}
                   ]
                },
                {id:'title',name:'标题',params:{title1:'',title2:'',showtitle2:'1',fontsize1:'18px',fontsize2:'14px',align:'left',color:'#000',}},
                {id:'search',name:'搜索框',params:{placeholder:'搜索：输入关键字在店内搜索',style:'style1','color':'','bgcolor':'','bordercolor':'',searchurl:'<?php  echo $this->createMobileUrl("shop/list")?>',uniacid:'<?php  echo $_W["uniacid"];?>'}},
                {id:'line',name:'辅助线',params:{height:'2px',style:'dashed',color:'#000'}},
                {id:'blank',name:'辅助空白',params:{height:'100px',bgcolor:''}},
                {id:'shop',name:'店招',params:{style:'1',bgimg:'../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-1.jpg',logo:'1',name:'1',menu:'1',navcolor:''},
                   data:['<?php  echo $this->createMobileUrl("shop/index")?>','<?php  echo $this->createMobileUrl("shop/list")?>','<?php  echo $this->createMobileUrl("shop/list",array("isdiscount"=>"1"))?>','<?php  echo $this->createMobileUrl("shop/notice")?>']
                },
                {id:'goods',name:'商品组',params:{style:'50%',showtitle:'0',titlecolor:'',bgcolor:'',showname:'1',title:'',option:'sale-rx',buysub:'buy-3',price:'1',goodhref:'<?php  echo $this->createMobileUrl("shop/detail")?>'},data:[]},
                {id:'richtext',name:'富文本',params:{bgcolor:'',},content:''},
                {id:'menu',name:'按钮组',params:{num:'20%',style:'0',bgcolor:'#fff',},
                    data:[{id:'F0000000000001',imgurl:'',text:'',hrefurl:'',color:''},{id:'F0000000000002',imgurl:'',text:'',hrefurl:'',color:''},{id:'F0000000000003',imgurl:'',text:'',hrefurl:'',color:''},{id:'F0000000000004',imgurl:'',text:'',hrefurl:'',color:''},{id:'F0000000000005',imgurl:'',text:'',hrefurl:'',color:''}]
                },
                {id:'picture',name:'单图',params:{},data:[{id:'P0000000000001',imgurl:'../addons/sea/plugin/designer/template/imgsrc/init-data/init-image-4.jpg',hrefurl:'',option:'0'}]},
                {id: "cube",name: "图片魔方",params: {bgcolor:'',layout: {},showIndex: 0,selection: {},currentPos: {},currentLayout: {isempty: !0}},data:[]}
            ];
            $scope.shop = {uniacid:'<?php  echo $_W["uniacid"];?>'};
            $scope.system = [<?php  echo $system;?>];
            $scope.pages = [<?php  echo $pageinfo;?>];
            $scope.Items = [<?php  echo $data;?>];
 
            $scope.underscore = null;
            require(['underscore'],function(underscore){
                $scope.underscore = underscore;
            });
            $scope.hasCube = function(Item){
             
            	 var has = false;
                 var row=0,col = 0;
            	 for(var i=row;i<4;i++){
                    for(var j=col;j<4;j++){
                      if (!$scope.underscore.isUndefined(Item.params.layout[i][j]) && !Item.params.layout[i][j].isempty) {
                          has = true;
                          break;
                      }
                    }
                }
                return has;
                

            }
            $scope.showSelection = function(Edit, row,col){
             
                Edit.params.currentPos = {row: row,col: col};
                Edit.params.selection = {};
                var maxrow = 4,maxcol = 4,end =false;
                
                for(var i=row;i<=3;i++){
                	
                    if ($scope.underscore.isUndefined(Edit.params.layout[i][col]) || !$scope.underscore.isUndefined(Edit.params.layout[i][col]) && !Edit.params.layout[i][col].isempty) {
                        maxrow = i;
                        end =true;
                    }
                    if(end){
                        break;
                    }
                }
          
                end =false;
                for(var j=col;j<=3;j++){
                    if ( $scope.underscore.isUndefined(Edit.params.layout[row][j]) || !$scope.underscore.isUndefined(Edit.params.layout[row][j]) && !Edit.params.layout[row][j].isempty) {
                        maxcol = j;
                        end =true;
                    } 
                    if(end){
                        break;
                    }
                }
                
                var f = -1,g = 1;
              
                for (var i = row; i < maxrow; i++) {
	                
                    var y = 1;
                    Edit.params.selection[g] = {};
                    for (var j = col; j < maxcol; j++) {
                      if( f >= 0 && f < j || (!$scope.underscore.isUndefined(Edit.params.layout[i][j]) && Edit.params.layout[i][j].isempty   )){
                          Edit.params.selection[g][y] = {
                            rows: g,
                            cols: y
                          };
                          y++;
                      }
                      else{
                          f = j - 1
                      }
                    } 
                    g++;
                }
                
                $(".layout-table li").removeClass("selected");
                $scope.modalobj = $("#"+Edit.id+"-modal-cube-layout").modal({show:true});
                $('#'+Edit.id+'-modal-cube-layout').find(".layout-table").unbind('mouseover').mouseover(function(a) {
                    if ("LI" == a.target.tagName) {
                        $(".layout-table li").removeClass("selected");
                        var c = $(a.target).attr("data-rows"),
                              d = $(a.target).attr("data-cols");
                        $(".layout-table li").filter(function(a, e) {
                            return $(e).attr("data-rows") <= c && $(e).attr("data-cols") <= d
                        }).addClass("selected")
                    }
                });
                
                return true;
            }
            $scope.selectLayout = function(Edit, currentRow, currentCol, rows, cols) {
                if( $scope.underscore.isUndefined(rows) ) {rows= 0;}
                if( $scope.underscore.isUndefined(cols) ) {cols = 0;}
                Edit.params.layout[currentRow][currentCol] = {
                    cols: cols,
                    rows: rows,
                    isempty: false,
                    imgurl: "",
                    classname: "index-" + Edit.params.showIndex
                };
                for (var i = parseInt(currentRow); i < parseInt(currentRow) + parseInt(rows); i++){
                    for (var j = parseInt(currentCol); j < parseInt(currentCol) + parseInt(cols); j++) {
                        if( currentRow != i || currentCol != j)  {
                            delete Edit.params.layout[i][j];
                        } 
            	}
                }
                Edit.params.showIndex++;
                $scope.modalobj.modal('hide');
                $scope.changeItem(Edit, currentRow,currentCol);   
                return true;
            }
            $scope.changeItem = function(Edit,row,col){
                $("#cube-editor td").removeClass("current").filter(function(a, e) {
                    return $(e).attr("x") == row && $(e).attr("y") == col
                }).addClass("current");
                $("#cube_thumb").attr("src", "");
                Edit.params.currentLayout = Edit.params.layout[row][col];
            }
             $scope.delCube = function(Edit,Cid,cols,rows){
                if(Edit && Cid && cols && rows){
                    var len = Edit.params.layout.length;
                    $.each(Edit.params.layout,function(row,a){
                        $.each(Edit.params.layout[row],function(col,b){
                            if(col!='$$hashKey'){
                                if(b.classname==Edit.params.currentLayout.classname){
                                    row  =parseInt(row);col = parseInt(col);
                                    rows  =parseInt(rows);cols = parseInt(cols);
                                     for(var i = row;i<row+rows;i++){
                                         for(var j=col;j<col+cols;j++){
                                            Edit.params.layout[i][j] = {cols: 1,rows: 1,isempty: true,imgurl: "",classname: ""};
                                         }
                                     }
                                }
                            }
                        });
                        
                    });
                }
            }
             
             
            // 1.1 添加一条子级(good,picture,banner)
            $scope.addItemChild =function(type,Mid){
                if(type && Mid){
                    t = '';
                    if(type=='good'){t = 'G';}
                    else if(type=='picture'){t = 'P';}
                    else if(type=='banner'){t = 'B';}
                    var var_id = t+new Date().getTime();
                    var push = {
                        banner:{id:var_id,imgurl:'',hrefurl:'',sysurl:'url'},
                        picture:{id:var_id,imgurl:'',hrefurl:'',option:'0'},
                        good:{}
                    };
                    var Items = $scope.Items;
                    angular.forEach(Items, function(m,index) {
                        if(m.id==Mid){
                            m.data.push(push[type]);
                            //console.log(push[type]);
                        }
                    });
                }
            }

            // 1.1 删除一条子级
            $scope.delItemChild = function(Mid,Cid){
                if(confirm("此操作不可逆，确认移除？")){
                    var Items = $scope.Items;
                    angular.forEach(Items, function(m,index1) {
                        if(m.id==Mid){
                            angular.forEach(m.data, function(c,index2) {
                                if(c.id==Cid){
                                    m.data.splice(index2,1);
                                }
                            });
                        }
                    });
                }
            }

            // 1.1 上传图片
            $scope.uploadImgChild = function(Mid,Cid,Type){
                require(['jquery', 'util'], function($, util){
                    util.image('',function(data){
                            var Items = $scope.Items;
                            angular.forEach(Items, function(m,index1) {
                                if(m.id==Mid){
                                    if(Type=='cube'){
                                        m.params.currentLayout.imgurl = data['url'];
                                        $("div[mid="+Mid+"]").mouseover();
                                        
                                    }else{
                                        angular.forEach(m.data, function(c,index2) {
                                            if(c.id==Cid){
                                                c.imgurl = data['url'];
                                                $("div[mid="+Mid+"]").mouseover();
                                                //console.log(Items);
                                            }
                                        });
                                    }
                                }
                            });
                    });
                });
            }
           
            $scope.chooseUrlCube = function(Mid,Cid){
                var Items = $scope.Items;
                angular.forEach(Items, function(m) {
                    if(m.id==Mid){
                        m.params.currentLayout.url = 'http://www.qq.com';
                        $("div[mid="+Mid+"]").mouseover();
                    }
                });
            }
            // 1.1 选择链接
            $scope.chooseUrl = function(Mid,Cid,T){
                $('#floating-link').attr({"Mid":Mid,"Cid":Cid,T:T});
                $('#floating-link').modal();
            }
            $scope.chooseLink = function(type,hid){
                var Mid = $('#floating-link').attr("Mid");
                var Cid =  $('#floating-link').attr("Cid");
                var T =  $('#floating-link').attr("T");
                var url = $("#fe-tab-link-"+type+" #fe-tab-link-li-"+hid).data("href");
                if(url && Mid && Cid){
                    angular.forEach($scope.Items, function(m,index1) {
                        if(m.id==Mid){
                            if(T=='cube'){
                                m.params.currentLayout.url = url;
                                $("div[mid="+Mid+"]").mouseover();
                            }else{
                                angular.forEach(m.data, function(c,index2) {
                                    if(c.id==Cid){
                                        c.hrefurl = url;
                                    }
                                });
                            }
                        }
                    });
                    $('#floating-link').attr({"Mid":'',"Cid":'',T:''});
                    $('#floating-link .close').click();
                }
            }
            $scope.temp = {
                notcie:[]
            };
            $scope.ajaxselect =function(type){
                val = $("#select-"+type+"-kw").val();
                mid = $("#floating-link").attr("mid");
                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'api','apido'=>'selectlink'))?>",
                    data: {kw:val,type:type},
                    success: function(data){
                        $scope.temp[type]=data;
                        $("div [mid="+mid+"]").mouseover();
                    },
                    error: function(){
                        alert('查询失败！请刷新页面。');
                    }
                });
            }
            
            $scope.focus = 'M0000000000000';

            $scope.keyword = function(val,Eid){
                $.ajax({
                    type: 'post',
                    url: "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'api','apido'=>'selectkeyword'))?>",
                    data: {kw:val,pid:"<?php  echo $pageid;?>"},
                    success: function(data){
                        if(data != 'ok'){
                            window.dosave = '1';
                            $("div[Editid="+Eid+"]").find(".keyword").css('border',"#f01 solid 1px");
                        }else{
                            window.dosave = '0';
                            $("div[Editid="+Eid+"]").find(".keyword").css('border',"#ddd solid 1px");
                        }
                    },
                    error: function(){
                        alert('查询商品信息失败！请刷新页面。');
                    }
                });
            }

            $scope.selectgood = function(Mid){
                kw = $("#secect-kw").val();
                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'api','apido'=>'selectgood'))?>",
                    data: {kw:kw},
                    success: function(data){
                        $scope.selectGoods = [];
                        angular.forEach(data, function(d,i) {
                            Sid = 'S'+new Date().getTime();
                            $scope.selectGoods.push({id:Sid+i,name:data[i].title,img:data[i].thumb,goodid:data[i].id,pricenow:data[i].marketprice,priceold:data[i].productprice,sales:data[i].sales,unit:data[i].unit});
                        });
                        $("div[mid="+Mid+"]").mouseover();
                    },
                    error: function(){
                        alert('查询商品信息失败！请刷新页面。');
                    }
                });
            }

            $scope.pushGood = function(Mid,Sid){
                var repaction =  $('#floating-good').attr("action");
                var repGid =  $('#floating-good').attr("Gid");
                angular.forEach($scope.Items, function(m,index1) {
                    if(m.id==Mid){
                        angular.forEach($scope.selectGoods, function(s,index2) {
                            if(s.id==Sid){
                                if(repaction=='replace' && repGid){
                                    // 执行替换
                                    angular.forEach(m.data, function(r,index3) {
                                        if(r.id==repGid){
                                            var Gid = 'G'+new Date().getTime();
                                            r.id = Gid;
                                            r.img = s.img;
                                            r.goodid = s.goodid;
                                            r.name = s.name;
                                            r.priceold = s.priceold;
                                            r.pricenow = s.pricenow;
                                            r.sales = s.sales;
                                            r.unit = s.unit;
                                            $('#floating-good .close').click();
                                        }
                                    });
                                }
                                else if(!repaction){
                                    var Gid = 'G'+new Date().getTime();
                                    // 执行添加
                                    m.data.push({id:Gid,img:s.img,goodid:s.goodid,name:s.name,priceold:s.priceold,pricenow:s.pricenow});
                                }
                            }
                        });
                    }
                });
            }
            $scope.selectGoods = [];
            
            $scope.load = function(){}
            $scope.changeImg = function(Mid,n){
                width = parseInt($(".fe-mod-move").width());
                height = (width* parseInt( n.replace("%","") ) /100)-16;
                $("div[mid="+Mid+"] .fe-mod-8-main-img img").height(height);
            };
            $scope.setimg = function(Mid,n){
                width = $(".fe-mod-move").width();
                n = n.replace("%","");
                n = n/100;
                $("div[mid="+Mid+"] .fe-mod-12 img").height(width*n-30);
            }
            $scope.setfocus = function(Mid,e){
                $scope.focus = Mid;
                ccc = $("div[id="+Mid+"]").offset().top; 
                ddd = (ccc-280)>=0?(ccc-280):0;
                $(".fe-panel-editor").css("margin-top",ddd+"px");
                $(document.body).animate({scrollTop:ccc-100},500);
            }
            $scope.drag = function(Mid){
                var container = $("#editor");                
                var del = container.find(".fe-mod-move");
                del.off("mousedown").mousedown(function(e) {
                    $scope.focus = Mid;
                    if(e.which != 1 || $(e.target).is("textarea") || window.kp_only) return;
                    e.preventDefault(); 
                    var x = e.pageX;
                    var y = e.pageY;
                    var _this = $(this).parent(); 
                    var w = _this.width();
                    var h = _this.height();
                    var w2 = w/2;
                    var h2 = h/2;
                    var p = _this.position();
                    var left = p.left;
                    var top = p.top;
                    window.kp_only = true;
                    _this.before('<div id="kp_widget_holder"></div>');
                    var wid = $("#kp_widget_holder");
                    var nod = $(".fe-mod-nodrag");
                    wid.css({"border":"2px dashed #ccc", "height":_this.outerHeight(true)});
                    _this.css({"width":w, "height":h, "position":"absolute", opacity: 0.8, "z-index": 900, "left":left, "top":top});
                    $(document).mousemove(function(e) {
                        $scope.focus = Mid;
                        e.preventDefault();
                        var l = left + e.pageX - x;
                        var t = top + e.pageY - y;
                        _this.css({"left":l, "top":t});
                        var ml = l+w2;
                        var mt = t+h2;
                        del.parent().not(_this).not(wid).each(function(i) {
                            var obj = $(this);
                            var p = obj.position();
                            var a1 = p.left;
                            var a2 = p.left + obj.width();
                            var a3 = p.top;
                            var a4 = p.top + obj.height();
                            if(a1 < ml && ml < a2 && a3 < mt && mt < a4) {
                                if(!obj.next("#kp_widget_holder").length) {
                                    wid.insertAfter(this);
                                }else{
                                    wid.insertBefore(this);
                                }
                                return;
                            }
                        });
                    });
                    $(document).mouseup(function() {
                        $(document).off('mouseup').off('mousemove');
                        $(container).each(function() {
                            var obj = $(this).children();
                            var len = obj.length;
                            if(len == 1 && obj.is(_this)) {
                                $("<div></div>").appendTo(this).attr("class", "kp_widget_block").css({"height":100});
                            }
                            else if(len == 2 && obj.is(".kp_widget_block")){
                                $(this).children(".kp_widget_block").remove();
                            }
                        });
                        var p = wid.position();
                        _this.animate({"left":p.left, "top":p.top}, 100, function() {
                            _this.removeAttr("style");
                            wid.replaceWith(_this);
                            window.kp_only = null;
                            var arr = [];
                            $(".fe-mod-repeat").find(".fe-mod-parent").each(function(i,val) {
                                arr[i] = val.id;
                            });
                            var newarr = [];
                            angular.forEach(arr, function(aid){
                                angular.forEach($scope.Items, function(obj){
                                    if(obj.id== aid){
                                        newarr.push(obj);
                                        return false;
                                    }
                                });
                            });	
                            $scope.Items = newarr;
                        });
                    });
                });
            }
            
            $scope.addItem = function(Nid){
                var Mid = 'M'+new Date().getTime();
                var Navs = $scope.navs;
                angular.forEach(Navs, function(n,index) {
                    if(n.id==Nid){
                        newparams = !clone(n.params)?'':clone(n.params);
                        newdata = !n.data?'':cloneArr(n.data);
                        newother = !clone(n.other)?'':clone(n.other);
                        newcontent = !clone(n.content)?'':clone(n.content);
                        if(Nid=='cube'){
                            for (row = 0; row < 4; row++) { 
                                for (newparams.layout[row] = {}, col = 0; col < 4; col++) {
                                    newparams.layout[row][col] = {cols: 1,rows: 1,isempty: !0,imgurl: "",classname: ""};
                                }
                            }
                        }
                        var newitem = {id:Mid,temp:Nid,params:newparams,data:newdata,other:newother,content:newcontent};
                        var insertindex = -1;
                        if($scope.focus!=''){
                              var Items = $scope.Items;
                                angular.forEach(Items, function(a,index) {
                                    if(a.id==$scope.focus){
                                        insertindex = index;
                                    }
                              });
                        }
                        if(insertindex==-1){
                            $scope.Items.push(newitem);
                        }
                        else{
                           $scope.Items.splice(insertindex+1, 0, newitem);             
                        }
                        //$("div[id="+newitem.id+"]").trigger('ng-click');
                        setTimeout(function(){
                       $scope.setfocus(newitem.id,null);     
                        },100);
                       
                        //console.log($scope.Items);
                    }
                });
            }

            $scope.delItem = function(id){
                if(confirm("此操作不可逆，确认移除？")){
                    var Items = $scope.Items;
                    angular.forEach(Items, function(a,index) {
                        if(a.id==id){
                            Items.splice(index,1);
                            $scope.focus = '';
                        }
                    });
                }
            }
            $scope.over = function(id){$("div[id="+id+"]").parent().find(".fe-mod-del").stop().show();}
            $scope.out = function(id){$("div[id="+id+"]").parent().find(".fe-mod-del").stop().hide();}
            $scope.save = function(n){
               var pageid = "<?php  echo $pageid;?>";
               var items = cloneArr($scope.Items );
               angular.forEach(items, function(m,index1) {
                   if(m.temp=='richtext'){
                        m.content = escape(m.content);
                   }
               });
               var datas = angular.toJson(items);
               var pageinfo = angular.toJson($scope.pages);
               var pagename = $("input[name=pagename]").val();
               var pagetype = $("input[name=pagetype]").val();
               if(!pagename){
                   alert('请给你的页面起一个响亮的名字吧');
                   return;
               }
               if(!pagetype){
                   alert('你还没有选择页面的类型哦~');
                   return;
               }
               if(window.dosave=='1'){
                   alert('触发关键字已存在！请重新填写。');
                   $scope.focus = 'M0000000000000';
                   return;
               }
               $(".fe-save-submit").text('保存中...').addClass("fe-save-disabled").data('saving','1');
               $(".fe-save-submit2").css("color","#bbb");
               if($(".fe-save-submit").data('saving')==1){
                    $.ajax({
                        type: 'POST',
                        url: "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'api','apido'=>'savepage'))?>",
                        data: {pageid: pageid,datas:datas,pagetype:pagetype,pagename:pagename,pageinfo:pageinfo},
                        success: function(data){
                            if(n==2){
                                alert("保存成功！正在生成览页面...");
                                setcookie(data);
                                if(!pageid){
                                    location.href = "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'post'))?>&pageid="+data;
                                }else{
                                    preview(data);
                                }
                            }else{
                                alert("保存成功！");
                                if(!pageid){
                                    location.href = "<?php  echo $this->createPluginWebUrl('designer',array('op'=>'post'))?>&pageid="+data;
                                }
                            }
                            $(".fe-save-submit").text('保存').removeClass("fe-save-disabled").data('saving','0');
                            $(".fe-save-submit2").css("color","#4bb5fb")
                        }
                        ,error: function(){
                            alert('保存失败请重试');
                            $(".fe-save-submit").text('保存').removeClass("fe-save-disabled").data('saving','0');
                            $(".fe-save-submit2").css("color","#4bb5fb")
                        }
                    });
               }
            }

            $scope.addGood = function(action,Mid,Gid){
                $('#floating-good').modal();
                $('#floating-good').attr({'action':action,'Gid':Gid});
            }

            $scope.delGood = function(Mid,Gid){
                if(confirm("此操作不可逆，确认移除？")){
                    var Items = $scope.Items;
                    angular.forEach(Items, function(m,index1) {
                        if(m.id==Mid){
                            angular.forEach(m.data, function(g,index2) {
                                if(g.id==Gid){
                                    m.data.splice(index2,1);
                                }
                            });
                        }
                    });
                }
            }

            $scope.shopImg = function(Mid){
                require(['jquery', 'util'], function($, util){
                    util.image('',function(data){
                       var Items = $scope.Items;
                       angular.forEach(Items, function(m,index1) {
                           if(m.id==Mid){
                               m.params.bgimg = data['url'];
                               $("div[mid="+Mid+"]").mouseover();
                           }
                       });
                    });
                });
            }
            
            $scope.pageImg = function(Mid,type){
                require(['jquery', 'util'], function($, util){
                    util.image('',function(data){
                        if(type=='floatimg'){
                            $scope.pages[0].params.floatimg = data['url'];
                        }else{
                            $scope.pages[0].params.img = data['url'];
                        }
                       $("div[mid="+Mid+"]").trigger("click");
                    });
                });
            }

            $scope.$on('ngRepeatFinished',function(ngRepeatFinishedEvent){
                $('.fe-mod-2 .swipe').each(function(){
                        initswipe($(this));
                 })
                 $('.fe-mod-8-main-img img').each(function(){
                     $(this).height($(this).width());    
                 });
                 $('.fe-mod-12 img').each(function(){
                     $(this).height($(this).width());    
                 });
            });
    }]);

    myModel.directive('stringHtml' , function(){
        return function(scope , el , attr){
            if(attr.stringHtml){
                scope.$watch(attr.stringHtml , function(html){
                    el.html(html || '');
                });
            }
        };
    });  

    myModel.directive("onFinishRenderFilters",function($timeout){
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

<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

