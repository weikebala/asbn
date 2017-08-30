<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class='panel panel-default'>
            <div class='panel-heading'>
                角色设置
            </div>
            <div class='panel-body'>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 角色</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('perm.role' ,$item) ) { ?>
                        <input type="text" name="rolename" class="form-control" value="<?php  echo $item['rolename'];?>" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['rolename'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                         <?php if( ce('perm.role' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
                        </label>
                        <label class='radio-inline'> 
                            <input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
                        </label>
                        <span class="help-block">如果禁用，则当前角色的操作员全部会禁止使用</span>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('perms', TEMPLATE_INCLUDEPATH)) : (include template('perms', TEMPLATE_INCLUDEPATH));?>
                         <?php if( ce('perm.role' ,$item) ) { ?>
                 <?php  } else { ?>
                 <script language='javascript'>
                     $(function(){
                         $(':checkbox').attr('disabled',true);
                     })
                     </script>
                     <?php  } ?>
                    <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('perm.role' ,$item) ) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('perm.role.add|perm.role.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
            </div>
        </div>
    
    </form>
</div>
<script language='javascript'>
 
    $('form').submit(function(){
        if($(':input[name=rolename]').isEmpty()){
            Tip.focus($(':input[name=rolename]'),'请输入角色名称!');
            return false;
        }
        return true;
    })
    </script>
<?php  } else if($operation == 'display') { ?>
        <form action="" method="get" class='form form-horizontal'>
                   <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="sea" />
                <input type="hidden" name="do" value="plugin" />
                <input type="hidden" name="p"  value="perm" />
                <input type="hidden" name="method"  value="role" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索角色名称">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                           <select name="status" class='form-control'>
                           <option value="" <?php  if($_GPC['status']=='') { ?> selected<?php  } ?>></option>
                            <option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>启用</option>
                            <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>禁用</option>
                        </select>  </div>
                     <div class="col-xs-12 col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
              
            </form>
        </div>
    </div>
                   
     <div class='panel panel-default'>
            <div class='panel-heading'>
                角色设置
            </div>
         <div class='panel-body'>

            <table class="table">
                <thead>
                    <tr>
                        <th>角色名称</th>
                        <th>操作员数量</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['rolename'];?></td>
                        <td><?php  echo $row['usercount'];?></td>                            
                                 <td>
                                    <?php  if($row['status']==1) { ?>
                                    <span class='label label-success'>启用</span>
                                    <?php  } else { ?>
                                    <span class='label label-danger'>禁用</span>
                                    <?php  } ?>
                                </td>
                        <td>
                          <?php if(cv('perm.role.edit|perm.role.view')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('perm/role', array('op' => 'post', 'id' => $row['id']))?>"><i class="fa fa-edit"></i></a><?php  } ?>
                          <?php if(cv('perm.role.delete')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('perm/role', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此门店吗？');return false;"><i class="fa fa-remove"></i></a><?php  } ?>
                        </td>

                    </tr>
                    <?php  } } ?>
               
                </tbody>
            </table>
   <?php  echo $pager;?>
         </div>
              <?php  if('perm.role.add') { ?>
                 <div class='panel-footer'>
                              <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('perm/role', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新角色</a>
                 </div>
                    <?php  } ?>
                  
         
     </div>
       </form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
