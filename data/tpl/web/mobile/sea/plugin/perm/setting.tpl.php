<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<div class='alert alert-danger'>
	此功能仅超级管理员可见
</div>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="plugins" />
            <input type="hidden" name="p" value="setting" />
                 <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">搜索</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" class="form-control"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="插件名称/插件标识"/> 
                </div>
            </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-sm-7 col-lg-9 col-xs-12">
                       <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
        </form> 
    </div>
</div>
        <form method='post' class="form-horizontal">
<div class="panel panel-default">
    <div class="panel-heading">总数：<?php  echo $total;?> 插件为关闭状态时只有超级管理员才能使用，安装后默认为关闭</div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                   <th style='width:150px;'>开关</th> 
                   <th style='width:200px;'>插件标识</th>
                   <th  style='width:200px;'>插件排序</th>
                   <th >插件名称</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td>
            <label class='radio-inline'>
                <input type='radio' name='status[<?php  echo $row['id'];?>]' value="1" <?php  if($row['status']==1) { ?>checked<?php  } ?> /> 开启
            </label>
                        <label class='radio-inline'>
                <input type='radio' name='status[<?php  echo $row['id'];?>]' value="0" <?php  if(empty($row['status'])) { ?>checked<?php  } ?> /> 关闭
            </label>
                    </td>
                    <td><?php  echo $row['identity'];?></td>
                    <td><input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
                    <td><input type="text" class="form-control" name="name[<?php  echo $row['id'];?>]" value="<?php  echo $row['name'];?>"></td>
                </tr>
                <?php  } } ?>
                 <tr>
                    <td colspan='3'>
                           <input name="submit" type="submit" class="btn btn-primary" value="批量修改">
                           <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </td>
                </tr>
            </tbody>
        </table>
           <?php  echo $pager;?>
    </div>
</div> 
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
