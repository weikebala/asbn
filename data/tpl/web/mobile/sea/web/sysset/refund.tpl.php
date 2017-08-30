<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
	<table class='table' style='float:left;border:1px solid #ccc;'>
		<tr style='background:#efefef; height:50px; font-weight:900;'>
			<td style="width:50px">ID</td>
			<td style="width:150px">退货地址名称</td>
			<td style="width:80px">联系人</td>
			<td style="width:100px">手机号</td>
			<td style="width:100px">省</td>
			<td style="width:100px">市</td>
			<td style="width:100px">县（区）</td>
			<td style="width:200px">详细地址</td>
			<td style="width:70px">是否默认</td>
			<td style="width:100px">供货商</td>
			<td style="width: 80px">操作</td>
		</tr>
		<?php  if(is_array($list)) { foreach($list as $key => $refund) { ?>
		<tr>
			<td><?php  echo $refund['id'];?></td>
			<td><?php  echo $refund['title'];?></td>
			<td><?php  echo $refund['name'];?></td>
			<td><?php  echo $refund['mobile'];?></td>
			<td><?php  echo $refund['province'];?></td>
			<td><?php  echo $refund['city'];?></td>
			<td><?php  echo $refund['area'];?></td>
			<td><?php  echo $refund['address'];?></td>
			<td><label class='label  label-default <?php  if($refund['isdefault']==1) { ?>label-info<?php  } ?>'><?php  if($refund['isdefault']==1) { ?>是<?php  } else { ?>否<?php  } ?></label></td>
			<td><?php  echo $refund['username'];?>/<?php  echo $refund['realname'];?></td>
			<td>
				<a href="<?php  echo $this->createWebUrl('sysset',array('id' => $refund['id'],'op'=>'refund_add','wwe'=>'edit'))?>" class="btn btn-sm btn-default" title="编辑"><i class="fa fa-pencil"></i></a>
				<a href="<?php  echo $this->createWebUrl('sysset/sysset', array('id' => $refund['id'], 'wwe' => 'delete'))?>" onclick="return confirm('确认删除此商品？');return false;" class="btn btn-default  btn-sm" title="删除"><i class="fa fa-times"></i></a>
			
			</td>
		</tr>
		<?php  } } ?>
   </table>
<?php  echo $pager;?>
 <a href="<?php  echo $this->createWebUrl('sysset',array('op'=>'refund_add'))?>" style="margin-top:10px;" class="btn btn-default"  title="添加退货地址"><i class='fa fa-plus'></i> 添加退货地址</a>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     
