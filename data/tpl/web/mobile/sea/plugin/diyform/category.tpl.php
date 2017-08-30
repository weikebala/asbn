<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
 
     <form action="" method="post">
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>分类名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id='tbody-items'>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td>
                        <?php if(cv('diyform.category.edit')) { ?>
                           <input type="text" class="form-control" name="catname[<?php  echo $row['id'];?>]" value="<?php  echo $row['name'];?>">
                        <?php  } else { ?>
                           <?php  echo $row['name'];?>
                        <?php  } ?>
                    </td>
                    <td>
                          <?php if(cv('diyform.category.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('diyform/category', array('op' => 'delete', 'id' => $row['id']))?>"class="btn btn-default btn-sm" onclick="return confirm('确认删除此分类?')" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
                    </td>
                    </td>
                </tr>
                <?php  } } ?> 
              
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
    <div class='panel-footer'>
            <?php if(cv('diyform.category.add')) { ?>
            <input name="button" type="button" class="btn btn-default" value="添加分类" onclick='addCategory()'>
           <?php  } ?>
           <?php if(cv('diyform.category.edit|diyform.category.add')) { ?>
            <input name="submit" type="submit" class="btn btn-primary" value="保存分类">
           <?php  } ?>
    </div>
</div>
</form>
<script>
    function addCategory(){
         var html ='<tr>';
         html+='<td><i class="fa fa-plus"></i></td>';
         html+='<td>';
         html+='<input type="text" class="form-control" name="catname[new]" value="">';
         html+='</td><td></td></tr>';;
         $('#tbody-items').append(html);
    }
    require(['bootstrap'], function ($) {
        $('.btn').hover(function () {
            $(this).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });
</script>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

