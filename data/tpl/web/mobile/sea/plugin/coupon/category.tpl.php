<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
 
     <form action="" method="post">
<div class="panel panel-default">
	<div class='panel-heading'>
		分类管理 <small>排序数字越大越靠前显示</small>
	</div>
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">ID</th>
		<th style="width:80px;">排序</th>
                    <th>分类名称</th>
                    <th style="width:80px;">显示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id='tbody-items'>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
		  <td>
		    <input type="hidden" class="form-control" name="catid[]" value="<?php  echo $row['id'];?>">
                        <?php if(cv('coupon.category.edit')) { ?>
                           <input type="text" class="form-control" name="displayorder[]" value="<?php  echo $row['displayorder'];?>">
                        <?php  } else { ?>
                           <?php  echo $row['name'];?>
                        <?php  } ?>
                    </td>
		
                    <td>
                        <?php if(cv('coupon.category.edit')) { ?>
                           <input type="text" class="form-control" name="catname[]" value="<?php  echo $row['name'];?>">
                        <?php  } else { ?>
                           <?php  echo $row['name'];?>
                        <?php  } ?>
                    </td>
						<td>
						<input type="hidden" class="form-control" name="status[]" value="<?php  echo $row['status'];?>">
						<label class='checkbox checkbox-inline' onclick="$(this).prev(':hidden').val( $(this).find(':checkbox').get(0).checked?'1':'0' ); ">
							<input type='checkbox' <?php  if($row['status']==1) { ?>checked<?php  } ?> />
						</label>
					</td>		
                    <td>
                          <?php if(cv('coupon.category.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('coupon/category', array('op' => 'delete', 'id' => $row['id']))?>"class="btn btn-default btn-sm" onclick="return confirm('确认删除此分类?')" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
                    </td>
                    </td>
                </tr>
                <?php  } } ?> 
              
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
    <div class='panel-footer'>
            <?php if(cv('coupon.category.add')) { ?>
            <input name="button" type="button" class="btn btn-default" value="添加分类" onclick='addCategory()'>
           <?php  } ?>
           <?php if(cv('coupon.category.edit|coupon.category.add')) { ?>
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
         html+='<input type="hidden" class="form-control" name="catid[]" value=""><input type="text" class="form-control" name="dispayorder[]" value="">';
         html+='</td>';
         html+='<td>';
         html+='<input type="text" class="form-control" name="catname[]" value="">';
         html+='</td>';
		 
         html+='<td></td></tr>';;
         $('#tbody-items').append(html);
    }
</script>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>

