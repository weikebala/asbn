<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'post') { ?>
<div class="main">
    <form <?php if( ce('verify.store' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class='panel panel-default'>
            <div class='panel-heading'>
                核销门店设置
            </div>
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 门店名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('verify.store' ,$item) ) { ?>
                        <input type="text" name="storename" class="form-control" value="<?php  echo $item['storename'];?>" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['storename'];?></div>
                        <?php  } ?>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">门店地址</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( ce('verify.store' ,$item) ) { ?>
                        <input type="text" name="address" class="form-control" value="<?php  echo $item['address'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['address'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">门店电话</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( ce('verify.store' ,$item) ) { ?>
                        <input type="text" name="tel" class="form-control" value="<?php  echo $item['tel'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['tel'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">门店位置</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( ce('verify.store' ,$item) ) { ?>
                        <?php  echo tpl_form_field_coordinate('map',array('lng'=>$item['lng'],'lat'=>$item['lat']))?>
                               <?php  } else { ?>
                        <div class='form-control-static'>lng=<?php  echo $item['lng'];?>,lat=<?php  echo $item['lat'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( ce('verify.store' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
                        </label>
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                      <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('verify.store' ,$item) ) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('verify.store.add|verify.store.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
                      
                      
                
            </div>
        </div>
       
    </form>
</div>
<script language='javascript'>
    $('form').submit(function(){
        if($(':input[name=storename]').isEmpty()){
            Tip.focus($(':input[name=storename]'),'请输入门店名称!');
            return false;
        }
        return true;
    })
    </script>
<?php  } else if($operation == 'display') { ?>
               <form action="" method="post" onsubmit="return formcheck(this)">
     <div class='panel panel-default'>
            <div class='panel-heading'>
                核销门店设置
            </div>
         <div class='panel-body'>

            <table class="table">
                <thead>
                    <tr>
                        <th>门店名称</th>
                        <th>门店地址</th>
                        <th>门店电话</th>
                        <th>核销员数量</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['storename'];?></td>
                        <td><?php  echo $row['address'];?></td>
                           <td><?php  echo $row['tel'];?></td>                            
                           <td><?php  echo $row['salercount'];?></td>                            
                                 <td>
                                    <?php  if($row['status']==1) { ?>
                                    <span class='label label-success'>启用</span>
                                    <?php  } else { ?>
                                    <span class='label label-danger'>禁用</span>
                                    <?php  } ?>
                                </td>
                        <td>
                          <?php if(cv('verify.store.edit|verify.store.view')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('verify/store', array('op' => 'post', 'id' => $row['id']))?>"><i class='fa fa-edit'></i></a><?php  } ?>
                          <?php if(cv('verify.store.delete')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('verify/store', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此门店吗？');return false;"><i class='fa fa-remove'></i></a><?php  } ?></td>

                    </tr>
                    <?php  } } ?>
                 
                </tbody>
            </table>
  
         </div>
          <?php if(cv('verify.store.add')) { ?>
           <div class='panel-footer'>
                            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('verify/store', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新门店</a>
         </div>
          <?php  } ?>
     </div>
       </form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>