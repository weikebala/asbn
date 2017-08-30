<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<script language="javascript">require(['underscore']);</script>
<!-- 导入CSS样式 -->
<link href="../addons/sea/plugin/designer/template/imgsrc/designer.css" rel="stylesheet">
<!-- 头部选项卡 -->
<ul class="nav nav-tabs">
    <li <?php  if($_GPC['op']=='display' || empty($_GPC['op'])) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('choose')?>" >快速选购</a></li>


</ul>
<?php  if($op=='display') { ?>
<!-- 筛选区域 -->
<!-- <div class="panel panel-info">
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
</div> -->
<!-- 页面列表 -->
<div class='panel panel-default'>
    <div class='panel-heading'> 页面管理 <?php  if($pagesnum) { ?>(总数: <?php  echo $pagesnum;?>)<?php  } ?></div>
    <div class='panel-body'>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:60px; text-align: center;">ID</th>
                    <th >页面名称</th>
                    <th style=" text-align: center;">供应商</th>
                    <th style="text-align: center;">页面创建时间</th>
                    <th style=" text-align: center;">最后修改时间</th>
                    <th style="text-align: center;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(!empty($pages)) { ?>
                    <?php  if(is_array($pages)) { foreach($pages as $page) { ?>
                        <tr pageid="<?php  echo $page['id'];?>">
                            <td style="width:60px; text-align: center;"><?php  echo $page['id'];?></td>
                            <td><?php  echo $page['pagename'];?></td>                       
                            <td style=" text-align:  center;"><?php  echo $page['agentname'];?></td>
                            <td style="text-align:  center;"><?php  echo $page['createtime'];?></td>
                            <td style=" text-align:  center;"><?php  echo $page['savetime'];?></td>
                            <td style=" text-align:  center;position:relative">
                               <a href="javascript:;" data-url="<?php  echo $this->createPluginMobileUrl('choose',array('pageid'=>$page['id']))?>" class="js-clip" title="复制链接">复制链接</a>    
                                <?php if(cv('designer.page.edit')) { ?>- <a href="<?php  echo $this->createPluginWebUrl('choose/basic',array('op'=>'change','pageid'=>$page['id']))?>">编辑</a><?php  } ?>
                                <?php if(cv('designer.page.delete')) { ?>- <a href="javascript:;" onclick="delpage(<?php  echo $page['id'];?>)">删除</a><?php  } ?>
                            </td>
                        </tr>
                    <?php  } } ?>
                <?php  } else { ?>
                    <?php if(cv('designer.page.edit')) { ?>
                    <tr> 
                        <td style="text-align: center; line-height: 100px;" colspan="8">亲~您还没有添加自定义页面哦~您可以尝试 ↙ 左下角的 “<a href="<?php  echo $this->createPluginWebUrl('choose/basic',array('op'=>'create'))?>">添加一个新页面</a>”</td>
                    </tr>
                    <?php  } ?>
                <?php  } ?>     
                <?php if(cv('designer.page.edit')) { ?>
                    <tr>
                        <td colspan="8">
                            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('choose/basic',array('op'=>'create'))?>"><i class="fa fa-plus"></i> 添加一个新页面</a>
                            <span></span>
                        </td>
                    </tr>
                <?php  } ?>
                <tr><td colspan="8" style="padding:0px; margin: 0px;"><?php  echo $pager;?></td></tr>
            </tbody>
        </table>
    </div>
</div>
        <!-- 预览 start -->
               <!--  <div id="modal-module-menus2"  class="modal fade" tabindex="-1">
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
                </div> -->
        <!-- 预览 end -->    
<script type="text/javascript">
function delpage(id){
        if(confirm('此操作不可恢复，确认删除？')){
             $.ajax({
                type: 'POST',
                url: "<?php  echo $this->createPluginWebUrl('choose',array('op'=>'api','apido'=>'delpage'))?>",
                data: {pageid:id},
                dataType: 'json',
                success: function(json){
                    console.log(json);
                    if(json.status==1){
                        $("tr[pageid="+id+"]").fadeOut();
                    }else{
                        alert(json);
                    }
                },
                error: function(){
                    alert('操作失败~请刷新页面重试！');
                }
            });
        }
    }
</script>


<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

