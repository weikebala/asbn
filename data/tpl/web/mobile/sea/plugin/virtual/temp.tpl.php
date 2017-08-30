<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'post') { ?>
    <div class="main">
        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
            <input type="hidden" name="tp_id" value="<?php  echo $item['id'];?>" />
            <div class='panel panel-default'>
                <div class='panel-heading'><?php  if(empty($_GPC['id'])) { ?>新建<?php  } else { ?>编辑 (id:<?php  echo $_GPC['id'];?>)<?php  } ?> - 虚拟物品模板</div>
                <div class='panel-body'>
                         <?php if( ce('virtual.temp' ,$item) ) { ?>
                    <?php  if(!empty($_GPC['id'])) { ?>
                        <div class="alert alert-danger">警告：当模板中已经添加数据后改变模板结构有可能导致无法使用！</div>
                    <?php  } ?>
                    <?php  } ?>
                    
                        <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" > 分类</label>
                        <div class="col-sm-9 col-xs-12" style="width:707px;">
                            <?php if( ce('virtual.temp' ,$item) ) { ?>
                            <select name="cate" class="form-control">
                                <option value=""></option>
                                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                                <option value="<?php  echo $c['id'];?>" <?php  if($item['cate']==$c['id']) { ?>selected<?php  } ?>><?php  echo $c['name'];?></option>
                                <?php  } } ?>
                            </select>
                            <?php  } else { ?>
                                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                                    <?php  if($item['cate']==$c['id']) { ?><?php  echo $c['name'];?><?php  } ?>
                                <?php  } } ?>
                            <?php  } ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span> 模版名称</label>
                        <div class="col-sm-9 col-xs-12" style="width:707px;">
                             <?php if( ce('virtual.temp' ,$item) ) { ?>
                            <input type="text" name="tp_title" class="form-control" value="<?php  echo $item['title'];?>" placeholder="模版名称，例：话费充值卡" />
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['title'];?></div>
                            <?php  } ?>
                        </div> 
                    </div>
                     <?php  $key="key";?>
                     <?php  $name= $item['fields']['key'];?>
                     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tp_type', TEMPLATE_INCLUDEPATH)) : (include template('tp_type', TEMPLATE_INCLUDEPATH));?>

                    <?php  if(is_array($item['fields'])) { foreach($item['fields'] as $key => $name) { ?>
                       <?php  if($key!='key') { ?>
                            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tp_type', TEMPLATE_INCLUDEPATH)) : (include template('tp_type', TEMPLATE_INCLUDEPATH));?>
                        <?php  } ?>
                    <?php  } } ?>
  
                    <div id="type-items"></div>
                    <?php  if($datacount<=0) { ?>
                      <?php if( ce('virtual.temp' ,$item) ) { ?>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                        <div class="col-sm-9 col-xs-12">
                            <a class="btn btn-default btn-add-type" href="javascript:;" onclick="addType();"><i class="fa fa-plus" title=""></i> 增加一条键</a>
                        </div>
                    </div>
                      <?php  } ?>
                      <?php  } ?>


                    

                      <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('virtual.temp' ,$item) ) { ?>
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            <?php  } ?>
                            <a href="<?php  echo $this->createPluginWebUrl('virtual')?>"  <?php if( ce('virtual.temp' ,$item) ) { ?>style='margin-left:10px;'<?php  } ?>><span class="btn btn-default" style='margin-left:10px;'>返回列表</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<script language='javascript'>
    var kw = 1;
    function addType() {
        $(".btn-add-type").button("loading");
        $.ajax({
            url: "<?php  echo $this->createPluginWebUrl('virtual/temp',array('op'=>'addtype','addt'=>'type'))?>&kw="+kw,
            cache: false
        }).done(function (html) {
            $(".btn-add-type").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }
    
    function removeType(obj) {
        $(obj).parent().remove();
    } 
    
    $('form').submit(function(){
        var check = true;
        $("input[type=text]").each(function(){
            var val = $(this).val();
            if(!val){
                Tip.focus($(this),'不能为空!');
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        var o={}; // 判断重复
        $("input[mk=1]").each(function(){
            if(!(o[$(this).val()])){
                o[$(this).val()] = true;
            }else{
                var val = $(this).val();
                $("input[mk=1]").each(function(){
                   if($(this).val()==val){
                       $(this).css("border-color","#f01");
                   }else{
                       $(this).css("border-color","#ccc");
                   }
                });
                alert("啊哦，红圈里的数据 不能重复哦~！");
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        return check;
    });
 
    </script>

<?php  } else if($operation == 'display') { ?>
        <!-- 筛选区域 -->
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="./index.php" method="get" class="form-horizontal" role="form">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="sea" />
                    <input type="hidden" name="do" value="plugin" />
                    <input type="hidden" name="p" value="virtual" />
                    <input type="hidden" name="method" value="temp" />
                    <input type="hidden" name="op" value="display" />
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                        <div class="col-sm-8 col-lg-9">
                            <input class="form-control" name="keyword"  type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入模板名称进行搜索">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                        <div class="col-sm-8 col-lg-9">
                            <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='panel panel-default'>
            <div class='panel-heading'> 虚拟物品模版列表</div>
            <div class='panel-body'>
                <?php  if(empty($items)) { ?>
                    <?php  if(empty($_GPC['keyword'])) { ?>
                        <p style="line-height: 40px;">还没有添加模板哦~</p>
                    <?php  } else { ?>
                        <p style="line-height: 40px;">未检索到与“<?php  echo $_GPC['keyword'];?>”相关的模板</p>
                    <?php  } ?>
                <?php  } else { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style='width:100px;'>ID</th>
                                <th >模版名称</th>
                                <th style="width:200px">已使用/总共数据</th>
                                <th >操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(is_array($items)) { foreach($items as $item) { ?>
                                <tr>
                                    <td><?php  echo $item['id'];?></td>
                                    <td><label class='label label-primary'><?php  echo $category[$item['cate']]['name']?></label> <?php  echo $item['title'];?></td>
                                    <td>
                                        <?php if(cv('virtual.data.view')) { ?>
                                        <a href="<?php  echo $this->createPluginWebUrl('virtual/data', array('typeid'=>$item['id']))?>" title="点击查看/编辑"><?php  echo $item['usedata'];?> / <?php  echo $item['alldata'];?> 详细</a>
                                        <?php  } else { ?>
                                         <?php  echo $item['usedata'];?> / <?php  echo $item['alldata'];?>
                                        <?php  } ?>
                                    </td>
                                    <td>
                                        <?php if(cv('virtual.temp.edit|virtual.temp.view')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('virtual/temp', array('op' => 'post', 'id' => $item['id']))?>"><i class='fa fa-edit'></i></a><?php  } ?>
                                        <?php if(cv('virtual.data.view')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('virtual/data', array('typeid' => $item['id']))?>" title='查看已有数据'><i class='fa fa-list'></i></a><?php  } ?>
                                        <?php if(cv('virtual.data.add')) { ?><a class='btn btn-primary' href="<?php  echo $this->createPluginWebUrl('virtual/data', array('op' => 'post', 'typeid' => $item['id']))?>" title='添加数据'><i class='fa fa-plus'></i></a><?php  } ?>
                                        <?php if(cv('virtual.temp.edit')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('virtual/temp', array('op' => 'delete', 'id' => $item['id']))?>" onclick="return confirm('确认删除此模版吗？');return false;" title='删除模板'><i class='fa fa-remove'></i></a><?php  } ?>
                                    </td>
                                </tr>
                            <?php  } } ?>
                            <?php  if(!empty($pager)) { ?>
                                <tr>
                                    <td colspan="4"><?php  echo $pager;?> </td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            <?php  } ?>
            <?php if(cv('virtual.temp.add')) { ?>
                <div class='panel-footer'>
                    <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('virtual/temp', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新模版</a>
                    <span style="line-height:32px;background-size:15839px; font-size:12px; margin-left: 10px;">温馨提示：点击数据可以查看与编辑哦~~</span>
                </div>
            <?php  } ?>
        </div>
 
<?php  } else if($operation == 'addtype') { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span></label>
                    <div class="col-sm-9 col-xs-12" style="width:5%">
                        <a class="btn btn-default" href='javascript:;' onclick='removeType(this)'><i class='icon icon-remove fa fa-times'></i> 删除</a>
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:15%">
                        <input type="text" name="tp_kw[]" class="form-control" value="<?php  echo $group['groupname'];?>" placeholder="键值，例：keywords<?php  echo $kw;?>" />
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:40%">
                        <input type="text" name="tp_value[]" class="form-control" value="<?php  echo $group['groupname'];?>" placeholder="请在此输入对应的值" />
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:30%; ">
                        <?php  echo tpl_form_field_color('tp_color[]', $value=$settings['maincolor'])?>
                    </div>
                </div>
<?php  } else if($operation == 'postdata') { ?>
    <form id="dataform" action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class='panel panel-default'>
            <div class='panel-heading'><?php  if(empty($_GPC['id'])) { ?>添加数据 (模板id:<?php  echo $_GPC['typeid'];?>)<?php  } else { ?>编辑数据 (模板id:<?php  echo $_GPC['typeid'];?> 数据id:<?php  echo $_GPC['id'];?>)<?php  } ?></div>
            <input type="hidden" name="typeid" value="<?php  echo $item['id'];?>"/>
            <div class='panel-body'>
                <div class="alert alert-danger"><?php  if(empty($_GPC['id'])) { ?>您正在向模板:“<?php  echo $item['title'];?> (id:<?php  echo $item['id'];?>)” 添加数据<?php  } else { ?>您正在编辑模板id:<?php  echo $_GPC['typeid'];?>数据id:<?php  echo $_GPC['id'];?>的内容<?php  } ?><br>Tips:主键自动填充只适用于以下格式：10000001(纯数字)、C00000001(一位字母开头的数字) 其他格式请手动填写或者Excel导入。</div>
                <table class="table">
                    <thead>
                        <tr>
                            <?php  if(is_array($item['fields'])) { foreach($item['fields'] as $fields) { ?>
                            <th><?php  echo $fields['name'];?> (<?php  echo $fields['keyword'];?>) <?php  if($fields['keyword']=='key') { ?>主键 <?php  if(empty($_GPC['id'])) { ?><a style="float: right;" href="javascript:;" onclick="autonum()">自动填充</a><?php  } ?><?php  } ?></th>
                            <?php  } } ?>
                            <th style="width: 50px;">操作</th>
                        </tr>
                    </thead>
                    <tbody id="type-items">
                        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tp_data', TEMPLATE_INCLUDEPATH)) : (include template('tp_data', TEMPLATE_INCLUDEPATH));?>
                    </tbody>
                </table>
                <?php  if(empty($_GPC['id'])) { ?>
                    <div class="input-group " style="width:260px; float: left; margin-left: 8px;">
                        <span class="input-group-addon">增加</span>
                        <input type="text" name="numlist" value="1" class="form-control" style="padding:0px; text-align: center;">
                        <span class="input-group-addon" style="border-left: 0px;">条数据</span>
                        <span class="btn btn-default btn-add-type btn-add-type2" style="float: left; border-radius: 0px 4px 4px 0px; border-left: 0px;" onclick="addType();"><i class="fa fa-plus" title="" ></i> 确认增加</span>
                    </div> 
                    <div class="col-sm-9 col-xs-12" style="float: left; width: auto; ">
                            <a class="btn btn-default btn-add-type" href="javascript:;" onclick="autonum()" style="margin-right: 10px;"><i class="fa fa-angle-double-down" title=""></i> 主键自动填充</a>
                            <a class="btn btn-primary" href="javascript:;" style="margin-right: 10px;" onclick="$('#modal-import').modal()"><i class="fa fa-plus" title=""></i> Excel导入</a>
                            <a class="btn btn-primary" href="<?php  echo $this->createPluginWebUrl('virtual/import',array('op'=>'temp','id'=>$item['id']))?>" style="margin-right: 10px;" ><i class="fa fa-download" title=""></i> 下载Excel模板文件</a>
                    </div>
                <?php  } ?>
            </div>
            <?php if(cv('virtual.temp.add')) { ?>
                <div class='panel-footer' style="height:auto; overflow: hidden;">
                    <input type="submit" name="submit" value="保存数据" class="btn btn-primary col-lg-1"  />
                    <a class="btn btn-default btn-add-type" href="<?php  echo $this->createPluginWebUrl('virtual',array('op'=>'list','typeid'=>$item['id']))?>" style="margin-left: 10px;"><i class="fa fa-list" title=""></i> 查看已有数据</a>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            <?php  } ?>
        </div>
    </form>

        <div id="modal-import" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:600px;margin:0px auto;">
                 <form id="importform" class="form-horizontal form" action="<?php  echo $this->createPluginWebUrl('virtual/import')?>" method="post" enctype="multipart/form-data">
                <input type='hidden' name='typeid' value="<?php  echo $item['id'];?>" />
                <input type='hidden' name='op' value='import' />
                     
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h3>上传数据</h3>
                    </div>
                    <div class="modal-body">
                          <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style='width: 150px'>选择EXCEL:</label>
                            <div class="col-sm-9 col-xs-12" style='width: 380px'>
                                   <input type="file" name="excelfile" class="form-control" />
                            </div>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style='width: 150px'>注意:</label>
                            <div class="col-sm-9 col-xs-12" style='width: 380px'>
                                <span style="line-height: 36px; font-size: 12px;">如果遇到数据重复则将进行数据更新（在数据未使用的情况下）</span>
                            </div>
                        </div>
                        <div id="module-menus"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary span2" name="cancelsend" value="yes">确认导入</button>
                        <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                    </div>
                </div>
            </div>
                </form>
        </div>
<script language='javascript'>
$(function(){
    
    $('#importform').submit(function(){
        if(!$(":input[name=excelfile]").val()){
            alert("您还未选择Excel文件哦~");
            return false;
        }
    })

    $('#dataform').submit(function(){
        var check = true;
        $("input[type=text]").each(function(){
            var val = $(this).val();
            if(!val){
                Tip.focus($(this),'不能为空!');
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        var o={}; // 判断重复
        $("input[mk=1]").each(function(){
            if(!(o[$(this).val()])){
                o[$(this).val()] = true;
            }else{
                var val = $(this).val();
                $("input[mk=1]").each(function(){
                   if($(this).val()==val){
                       $(this).css("border-color","#f01");
                   }else{
                       $(this).css("border-color","#ccc");
                   }
                });
                alert("啊哦，红圈里的数据 不能重复哦~！");
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        return check;
    });
})
    var kw = 1;
    function addType() {
        numlist = $("input[name=numlist]").val();
        if(numlist>50){
            alert("每次最多增加50条数据哦~");
            return false;
        }
        $(".btn-add-type2").button("loading");
        $.ajax({
            url: "<?php  echo $this->createPluginWebUrl('virtual',array('op'=>'addtype','addt'=>'data','typeid'=>$_GPC['typeid']))?>&kw="+kw+"&numlist="+numlist,
            cache: false
        }).done(function (html) {
            $(".btn-add-type2").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }    
    function removeType(obj) {
        $(obj).parent().parent().remove();
    } 
    
    function autonum(){
        var val = $("input[mk=1]").val();
        var num =val.replace(/[^0-9]/,'')
        var num2 = 1+num;
        var eng = val.replace(num,'');
        
        
        if(!val){
            Tip.focus($("input[mk=1]"),'请先录入一个值!');
            reurun;
        }
        $("input[mk=1]").each(function(i){
            if(i>0){
                vval = 1+parseInt(num2)+i;
                str= ""+vval;
                str = str.substring(1,str.length)
                $(this).val(eng+str);
            }
        });
    }
</script>

<?php  } else if($operation == 'list') { ?>
        <!-- 筛选区域 -->
        <div class="panel panel-info">
            <div class="panel-heading">筛选</div>
            <div class="panel-body">
                <form action="./index.php" method="get" class="form-horizontal" role="form">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="sea" />
                    <input type="hidden" name="do" value="plugin" />
                    <input type="hidden" name="p" value="virtual" />
                    <input type="hidden" name="op" value="list" />
                    <input type="hidden" name="typeid" value="<?php  echo $type['id'];?>" />
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                        <div class="col-sm-8 col-lg-9">
                            <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入主键(key)进行搜索">
                        </div>
                        <div class=" col-xs-12 col-sm-2 col-lg-2">
                            <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='panel panel-default'>
            <div class='panel-heading'> 数据列表(总数:<?php  echo $total;?>; 模板名称:<?php  echo $type['title'];?>)</div>
            <div class='panel-body'>
                <table class="table">
                    <thead>
                        <tr>
                            <th style='width:50px;'>编号</th>
                            <?php  $colsoan=0?>
                            <?php  if(is_array($type['fields'])) { foreach($type['fields'] as $fields) { ?>
                                <th style='text-align: center;'><?php  echo $fields['name'];?> (<?php  echo $fields['keyword'];?>) <?php  $colspan++?></th>
                            <?php  } } ?>
                            <th style='text-align: center;'>状态</th>
                            <th>购买者</th>
                            <th>购买时间</th>
                            <th>订单号</th>
                            <th>购买价格</th>
                            <th>辑编 / 删除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(is_array($items)) { foreach($items as $item) { ?>
                            <tr>
                                <td><?php  echo $item['id'];?></td>
                                <?php  $datas = json_decode($item['fields'],ture)?>
                                <?php  if(is_array($datas)) { foreach($datas as $data) { ?>
                                    <td style='text-align: center;'>
                                        <?php  foreach($data as $key => $val){ echo '<p style="padding:0px; margin:0px; width:auto;" title="'.$data[$key].'">'.$data[$key].'</p>'; } ?>
                                    </td>
                                <?php  } } ?>
                                <td style='width:60px; text-align: center'>
                                    <?php  if(empty($item['openid'])) { ?><span style="color:green">未使用</span><?php  } else { ?><span style="color:red;">已使用</span><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?><p style="padding:0px; margin:0px; width:auto;" title="<?php  echo $item['openid'];?>"><?php  echo $item['openid'];?></p><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?><?php  echo $item['usetime'];?><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?><?php  echo $item['orderid'];?><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?><?php  echo $item['price'];?><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?>
                                        <?php if(cv('virtual.temp.edit|virtual.temp.view')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('virtual', array('op' => 'postdata', 'id' => $item['id'],'typeid'=>$item['typeid']))?>" title="<?php if(cv('virtual.temp.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class='fa fa-edit'></i></a><?php  } ?>
                                        <?php if(cv('virtual.temp.edit')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('virtual', array('op' => 'deletedata','typeid'=>$item['typeid'],'id' => $item['id']))?>" onclick="return confirm('确认删除此条数据吗？');return false;" title='删除'><i class='fa fa-remove'></i></a><?php  } ?>
                                    <?php  } else { ?>
                                        <span style="width: 100%;">-</span>
                                    <?php  } ?>
                                </td>
                            </tr>
                        <?php  } } ?>
                        <?php  if(!empty($pager)) { ?>
                            <tr>
                                <td colspan="<?php  echo $colspan+7?>"><?php  echo $pager;?></td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
            <div class='panel-footer'>
                    <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('virtual')?>"><i class="fa fa-reply"></i> 返回列表</a> 
                    <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('virtual', array('op' => 'postdata','typeid'=>$_GPC['typeid']))?>"><i class="fa fa-plus"></i> 添加数据</a>
            </div>
        </div>
 
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
