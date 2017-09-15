<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'post') { ?>
<div class="main">

    <form  <?php if( ce('creditshop.category' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form" enctype="multipart/form-data" >

        <div class="panel panel-default">
            <div class="panel-heading">
                商品分类
            </div>
            <div class="panel-body">

                <?php  if(!empty($item)) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类连接(点击复制)</label>
                    <div class="col-sm-9 col-xs-12">
                        <p class='form-control-static'><a href='javascript:;' title='点击复制连接' id='cp'>
                                <?php  echo $this->createPluginMobileUrl('creditshop/list',array('cate'=>$item['id']))?>
                            </a>
                        </p>
                    </div>
                </div>
                <?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('creditshop.category' ,$item) ) { ?>
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>分类名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('creditshop.category' ,$item) ) { ?>
                        <input type="text" name="catename" class="form-control" value="<?php  echo $item['name'];?>" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['name'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类图片</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('creditshop.category' ,$item) ) { ?>
                        <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
                        <span class="help-block">建议尺寸: 100*100，或正方型图片 </span>
                        <?php  } else { ?>
                        <?php  if(!empty($item['thumb'])) { ?>
                        <a href='<?php  echo tomedia($item['thumb'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($item['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否首页推荐</label>
                        <div class="col-sm-9 col-xs-12">
                             <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name='isrecommand' value="0" <?php  if(empty($item['isrecommand'])) { ?>checked<?php  } ?> /> 否
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name='isrecommand' value="1" <?php  if($item['isrecommand']==1) { ?>checked<?php  } ?> /> 是
                            </label>
                                <?php  } else { ?>
                             <div class='form-control-static'><?php  if(empty($item['isrecommand'])) { ?>是<?php  } else { ?>否<?php  } ?></div>
                             <?php  } ?>
                        </div>
                    </div>
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('creditshop.category' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='enabled' value=1' <?php  if($item['enabled']==1) { ?>checked<?php  } ?> /> 是
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='enabled' value=0' <?php  if($item['enabled']==0) { ?>checked<?php  } ?> /> 否
                        </label>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  if(empty($item['enabled'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group"></div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('creditshop.category' ,$item) ) { ?>
                        <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return formcheck()" />
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                        <input type="button" name="back" onclick='history.back()' <?php if(cv('creditshop.category.add|creditshop.category.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default col-lg-1" />
                    </div>
                </div>

            </div>
        </div>

    </form>
</div> 
<script language='javascript'>
    require(['util'], function (u) {
        $('#cp').each(function () {
            u.clip(this, $(this).text());
        });
    })
    $('form').submit(function () {
        if ($(':input[name=catename]').isEmpty()) {
            Tip.focus(':input[name=catename]', '请输入分类名称!');
            return false;
        }
        return true;
    });
</script>
<?php  } else if($operation == 'display') { ?>
     <form action="" method="post">
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:30px;">ID</th>
                    <th style='width:80px'>显示顺序</th>					
                    <th>标题</th>
                    <th>状态</th>
                    <th >操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td>
                        <?php if(cv('creditshop.category.edit')) { ?>
                           <input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>">
                        <?php  } else { ?>
                           <?php  echo $row['displayorder'];?>
                        <?php  } ?>
                    </td>
                    
                    <td><img src='<?php  echo tomedia($row['thumb'])?>' style='width:30px;height:30px;padding:1px;border:1px solid #ccc' /> <?php  echo $row['name'];?></td>
                       <td>
                                    <?php  if($row['enabled']==1) { ?>
                                    <span class='label label-success'>显示</span>
                                    <?php  } else { ?>
                                    <span class='label label-danger'>隐藏</span>
                                    <?php  } ?>
                                </td>
                    <td style="text-align:left;">
                        <?php if(cv('creditshop.category.view|creditshop.category.edit')) { ?><a href="<?php  echo $this->createPluginWebUrl('creditshop/category', array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" 
                                                               title="<?php if(cv('creditshop.category.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-edit"></i></a><?php  } ?>
                        <?php if(cv('creditshop.category.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('creditshop/category', array('op' => 'delete', 'id' => $row['id']))?>"class="btn btn-default btn-sm" onclick="return confirm('确认删除此分类?')" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
                    </td>
                </tr>
                <?php  } } ?> 
                <tr>
                    <td colspan='5'>
                        <?php if(cv('creditshop.category.add')) { ?>
                          <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('creditshop/category',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加分类</a>
                          <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                       <?php  } ?>
                        <?php if(cv('creditshop.category.edit')) { ?>
                          <input name="submit" type="submit" class="btn btn-primary" value="提交排序">
                        <?php  } ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
</form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>

