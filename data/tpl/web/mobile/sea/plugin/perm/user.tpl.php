<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'post') { ?>
<div class="main">
    <form id="dataform" action="" method="post" class="form-horizontal form" >
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class='panel panel-default'>
            <div class='panel-heading'>
                操作员设置
            </div>
            <div class='panel-body'>
                 <div class="form-group">
                     <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 操作员用户名</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('perm.user' ,$item) ) { ?>
                        <input type="text" name="username" class="form-control" value="<?php  echo $item['username'];?>" <?php  if(!empty($item)) { ?>readonly<?php  } ?>/>
							   		<span class='help-block'>您可以直接输入系统已存在用户，且保证用户密码正确才能添加</span>
                               <?php  } else { ?>
                               <div class='form-control-static'><?php  echo $item['username'];?></div>
                               <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>  操作员密码</label>
                    <div class="col-sm-9 col-xs-12">
                              <?php if( ce('perm.user' ,$item) ) { ?>
                        <input type="password" name="password" class="form-control" value="" autocomplete="off" />
                          <?php  } else { ?>
                               <div class='form-control-static'>********</div>
                               <?php  } ?>
                    </div>
                </div>
              
                
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属角色</label>
                    <div class="col-sm-9 col-xs-12">
                         <?php if( ce('perm.user' ,$item) ) { ?>
                        <input type='hidden' id='roleid' name='roleid' value="<?php  echo $role['id'];?>" />
                        <div class='input-group'>
                            <input type="text" name="role" maxlength="30" value="<?php  echo $role['rolename'];?>" id="role" class="form-control" readonly />
                            <div class='input-group-btn'>
                                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus1').modal();">选择角色</button>
                                <button class="btn btn-danger" type="button" onclick="$('#roleid').val('');$('#role').val('');">清除选择</button>
                            </div>
                        </div>
						<span class='help-block'>如果您选择了角色，则此用户本身就继承了此角色的所有权限</span>
                        <div id="modal-module-menus1"  class="modal fade" tabindex="-1">
                            <div class="modal-dialog" style='width: 920px;'>
                                <div class="modal-content">
                                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择角色</h3></div>
                                    <div class="modal-body" >
                                        <div class="row">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd1" placeholder="请输入角色名称" />
                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_roles();">搜索</button></span>
                                            </div>
                                        </div>
                                        <div id="module-menus1" style="padding-top:5px;"></div>
                                    </div>
                                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                </div>

                            </div>
                        </div>
                          <?php  } else { ?>
                               <div class='form-control-static'><?php  echo $role['rolename'];?></div>
                               <?php  } ?>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 姓名</label>
                    <div class="col-sm-9 col-xs-12">
                              <?php if( ce('perm.user' ,$item) ) { ?>
                        <input type="text" name="realname" class="form-control" value="<?php  echo $item['realname'];?>" />
                          <?php  } else { ?>
                               <div class='form-control-static'><?php  echo $item['realname'];?></div>
                               <?php  } ?>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('perm.user' ,$item) ) { ?>
                        <input type="text" name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" />
                           <?php  } else { ?>
                               <div class='form-control-static'><?php  echo $item['mobile'];?></div>
                               <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                             <?php if( ce('perm.user' ,$item) ) { ?>
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
                 <?php if( ce('perm.user' ,$item) ) { ?>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <span class='form-control-static'>用户可以在此角色权限的基础上附加其他权限</span>
                    </div>
                </div>
                 <?php  } ?>
                
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('perms', TEMPLATE_INCLUDEPATH)) : (include template('perms', TEMPLATE_INCLUDEPATH));?>
                 <?php if( ce('perm.user' ,$item) ) { ?>
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
                         <?php if( ce('perm.user' ,$item) ) { ?>
                            <input type="hidden" name="uid" value="<?php  echo $item['uid'];?>" />
                        <input type="button" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('perm.user.add|perm.user.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
                </div>
                
                
            </div>
        </div>
        <div class="form-group col-sm-12">
         
        </div>
    </form>
</div>
<script language='javascript'>
 
   $(function(){
     
        $('#dataform').ajaxForm();
        
        $(':input[name=submit]').click(function(){
            if($(this).attr('submitting')=='1'){
                return;
            }
      
           if ($(':input[name=username]').isEmpty()) {
                Tip.focus($(':input[name=username]'), '请填写用户名!');
                return;
            }
            <?php  if(empty($item)) { ?>
              if ($(':input[name=password]').isEmpty()) {
                Tip.focus($(':input[name=password]'), '请输入用户密码!');
                return;
            }
            <?php  } ?> 
    
            $(this).attr('submitting','1').removeClass('btn-primary');
            $('#dataform').ajaxSubmit(function(data){
                 data = eval("(" +  data  +")");
                if(data.result!=1){
                      $(this).removeAttr('submitting').addClass('btn-primary');
                      Tip.select($(':input[name=username]'), data.message );
                      return;
                }
                location.href= "<?php  echo $this->createPluginWebUrl('perm/user')?>";
            })
        })
           
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
                <input type="hidden" name="method"  value="user" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索操作名帐号/姓名/手机号">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">角色</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <select name="roleid" class='form-control'>
                            <option value="" <?php  if($_GPC['status']=='') { ?> selected<?php  } ?>></option>
                            <option value="" <?php  if($_GPC['status']=='0') { ?> selected<?php  } ?>>无角色</option>
                            <?php  if(is_array($roles)) { foreach($roles as $role) { ?>
                            <option value="<?php  echo $role['id'];?>" <?php  if($_GPC['roleid']== $role['id']) { ?> selected<?php  } ?>><?php  echo $role['rolename'];?></option>
                            <?php  } } ?>
                            
                        </select>  </div>
                     
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
            操作员管理
        </div>
        <div class='panel-body'>

            <table class="table">
                <thead>
                    <tr>
                        <th>登录ID</th>
                        <th>角色</th>
                        <th>姓名</th>
                        <th>手机</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['username'];?></td>
                        <td><?php echo !empty($row['rolename'])?$row['rolename']:'无'?></td>
                        <td><?php  echo $row['realname'];?></td>
                        <td><?php  echo $row['mobile'];?></td>
                        <td>
                            <?php  if($row['status']==1) { ?>
                            <span class='label label-success'>启用</span>
                            <?php  } else { ?>
                            <span class='label label-danger'>禁用</span>
                            <?php  } ?>
                        </td>
                        <td>
                            <?php if(cv('perm.user.view|perm.user.edit')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('perm/user', array('op' => 'post', 'id' => $row['id']))?>"><i class="fa fa-edit"></i></a><?php  } ?>
                            <?php if(cv('perm.user.delete')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('perm/user', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此操作员吗？');
                                    return false;"><i class="fa fa-remove"></i></a><?php  } ?>
                        
                        </td>
                    </tr>
                    <?php  } } ?>
                 
                </tbody>
            </table>
            <?php  echo $pager;?>

        </div>
             <?php  if('perm.user.add') { ?>
                    <div class='panel-footer'>
                                 <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('perm/user', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新操作员</a>
                    </div>
                    <?php  } ?>
 
    </div>
</form>



<?php  } ?>
<script language='javascript'>
 
                function search_roles() {
		$("#module-menus1").html("正在搜索....")
		$.get('<?php  echo $this->createPluginWebUrl('perm/role',array('op'=>'query'));?>', {
			keyword: $.trim($('#search-kwd1').val())
		}, function(dat){
			$('#module-menus1').html(dat);
		});
	}
	function select_role(o) {
		$("#roleid").val(o.id);
		$("#role").val( o.rolename );
                                var perms = o.perms.split(',');
                                $(':checkbox')
                                $(':checkbox').removeAttr('disabled').removeAttr('checked').each(function(){
                                    
                                    var _this = $(this);
                                    var perm = '';
                                    if( _this.data('group') ){
                                        perm+=_this.data('group');
                                    }
                                    if( _this.data('child') ){
                                        perm+="." +_this.data('child');
                                    }
                                    if( _this.data('op') ){
                                        perm+="." +_this.data('op');
                                    }
                                    if( $.arrayIndexOf(perms,perm)!=-1){
                                        $(this).attr('disabled',true).get(0).checked =true;
                                    }
                                     
                                });
		$(".close").click();
	}
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
 
