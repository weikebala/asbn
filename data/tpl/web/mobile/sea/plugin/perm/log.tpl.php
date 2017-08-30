<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'post') { ?>
<div class="main">
    <form id="dataform" action="" method="post" class="form-horizontal form" >
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class='panel panel-default'>
            <div class='panel-heading'>
            
            </div>
            <div class='panel-body'>
                 <div class="form-group">
                   <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 权限设置</label>
                   <div class="col-sm-9 col-xs-12">
                         <label class='radio-inline'>
                             <input type='radio' name='type' value='0' <?php  if(empty($item['type'])) { ?>checked<?php  } ?>/> 基于用户
                         </label>
                        <label class='radio-inline'>
                             <input type='radio' name='type' value='1'  <?php  if($item['type']==1) { ?>checked<?php  } ?> /> 基于公众号
                         </label>
                          <span class='help-block'>基于用户：此用户下所有的公众号拥有统一的插件权限</span>
                         <span class='help-block'>基于公众号：只此公众号拥有的权限，公众号所属用户的其他公众号按用户权限</span>
                    </div>
                
                </div>
                
                 <div class="form-group type-user"  <?php  if($item['type']==1) { ?>style='display:none'<?php  } ?>>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>  选择用户</label>
                    <div class="col-sm-5">
                        <input type='hidden' id='uid' name='uid' value="<?php  echo $user['uid'];?>" />
                        <div class='input-group'>
                            <input type="text" name="user" maxlength="30" value="<?php  echo $user['username'];?>" id="user" class="form-control" readonly />
                            <div class='input-group-btn'>
                                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus').modal();">选择用户</button>
                                <button class="btn btn-danger" type="button" onclick="$('#uid').val('');$('#user').val('');">清除选择</button>
                            </div>
                        </div>
                        <div id="modal-module-menus"  class="modal fade" tabindex="-1">
                            <div class="modal-dialog" style='width: 920px;'>
                                <div class="modal-content">
                                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择用户</h3></div>
                                    <div class="modal-body" >
                                        <div class="row"> 
                                            <div class="input-group"> 
                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="请输入用户名/姓名/手机号" />
                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_users();">搜索</button></span>
                                            </div>
                                        </div>
                                        <div id="module-menus" style="padding-top:5px;"></div>
                                    </div>
                                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group type-wechat" <?php  if(empty($item['type'])) { ?>style='display:none'<?php  } ?>>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>  选择公众号</label>
                    <div class="col-sm-5">
                        <input type='hidden' id='acid' name='acid' value="<?php  echo $account['acid'];?>" />
                        <div class='input-group'>
                            <input type="text" name="account" maxlength="30" value="<?php  echo $account['name'];?>" id="account" class="form-control" readonly />
                            <div class='input-group-btn'>
                                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus1').modal();">选择公众号</button>
                                <button class="btn btn-danger" type="button" onclick="$('#acid').val('');$('#account').val('');">清除选择</button>
                            </div>
                        </div>
                        <div id="modal-module-menus1"  class="modal fade" tabindex="-1">
                            <div class="modal-dialog" style='width: 920px;'>
                                <div class="modal-content">
                                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择公众号</h3></div>
                                    <div class="modal-body" >
                                        <div class="row">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd1" placeholder="请输入公众号名/用户名" />
                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_wechats();">搜索</button></span>
                                            </div>
                                        </div>
                                        <div id="module-menus1" style="padding-top:5px;"></div>
                                    </div>
                                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group form-plugins">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">开放插件</label>
                    <div class="col-sm-9 col-xs-12">
                         <label class='checkbox-inline'>
                             <input type='checkbox' name='plugins[]' class='plugin-all' value=''/> 全选
                         </label>
                        <br/>
                        
                         <?php  if(is_array($plugins)) { foreach($plugins as $plugin) { ?>
                         <label class='checkbox-inline'>
                             <input type='checkbox' name='plugins[]' class='plugin-item' value='<?php  echo $plugin['identity'];?>' <?php  if(in_array($plugin['identity'],$item_plugins)) { ?> checked<?php  } ?> /> <?php  echo $plugin['name'];?>
                         </label>
                        <?php  } } ?>
                    </div>
                </div>
                
                
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script language='javascript'>
    function checkAll(obj){
          var allcheck = true;
           $('.plugin-item').each(function(){
                if(!$(this).get(0).checked){
                     allcheck =false;
                     return false;
                }
            });
            $(".plugin-all").get(0).checked = allcheck;
    }
 $(function(){
     $('.plugin-item').click(function(){
          checkAll();
     });
     $('.plugin-all').click(function(){
         var check = $(this).get(0).checked;
        $('.plugin-item').each(function(){
            $(this).get(0).checked = check;
         });
     })
     $(":radio[name=type]").click(function(){
         if($(this).val()=='0'){
             $('.type-wechat').hide();
             $('.type-user').show();
         }
         else{
              $('.type-wechat').show();
             $('.type-user').hide();
         }
     })
 })
   $('form').submit(function(){
       var type =$(":radio[name=type]:checked").val();
       if(type=='0'){
        if ($(':input[name=user]').isEmpty()) {
             Tip.focus($(':input[name=user]'), '请选择用户!');
             return false;
        }
    }else{
        if ($(':input[name=account]').isEmpty()) {
             Tip.focus($(':input[name=account]'), '请选择公众号!');
             return  false;
        }
    }
        return true;
       
   })
  
</script>
<?php  } else if($operation == 'display') { ?>
<form action="" method="get" class='form form-horizontal'>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" plugins="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="sea" />
                <input type="hidden" name="do" value="plugin" />
                <input type="hidden" name="p"  value="perm" />
                <input type="hidden" name="method"  value="log" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键词</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索操作员用户名/操作内容">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">按时间</label>
                     <div class="col-sm-2">
                       <select name='searchtime' class='form-control'>
                          <option value='' <?php  if(empty($_GPC['searchtime'])) { ?>selected<?php  } ?>>不搜索</option>
                          <option value='1' <?php  if($_GPC['searchtime']==1) { ?>selected<?php  } ?> >搜索</option>
                       </select> 
                     </div>
                    <div class="col-sm-7 col-lg-9 col-xs-12">
                        <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d  H:i', $endtime)),true);?>
                    </div>
                </div>
                
                   <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">操作类型</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                           <select name="logtype" class='form-control'>
                                <option value=''></option>
                               <?php  if(is_array($types)) { foreach($types as $t) { ?>
                               <option value='<?php  echo $t['value'];?>' <?php  if($_GPC['logtype']==$t['value']) { ?>selected<?php  } ?>><?php  echo $t['text'];?></option>
                               <?php  } } ?>
                        </select>  </div>
                     <div class="col-xs-12 col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
              
            </form>
        </div>
    </div>
    
    <div class='panel panel-default'>
        <div class='panel-heading' >
            操作日志 (数量: <?php  echo $total;?>  条)
     
        </div>
        <div class='panel-body'>

            <table class="table">
                <thead>
                    <tr>
                        <th style='width:120px;'>日志ID</th>
                        <th style='width:120px;'>操作员</th>
                        <th style='width:200px;' >类型</th>
                        <th>操作内容</th>
                        <th>操作IP</th>
                        <th>操作时间</th>
                        
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['id'];?></td>
                        <td><?php  echo $row['username'];?></td>
                        <td><?php  echo $row['name'];?></td>
                        <td><?php  echo $row['op'];?></td>
                        <td><?php  echo $row['ip'];?></td>
                        <td><?php  echo date('Y-m-d H:i:s', $row['createtime'])?></td>
                        
                        <td>
                            <?php if(cv('perm.log.delete')) { ?>
                            <a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('perm/log', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此操作员吗？');return false;"><i class="fa fa-remove"></i></a></td>
                        <?php  } ?>
                    </tr>
                    <?php  } } ?>
                  
                </tbody>
            </table>
            <?php  echo $pager;?>
 
        </div>
               <?php if(cv('perm.log.clear')) { ?>
               <div class='panel-footer'>
            <form action="" method="post">
    
                 <?php  echo tpl_form_field_daterange('cleartime', array('starttime'=>date('Y-m-d H:i', $clearstarttime),'endtime'=>date('Y-m-d  H:i', $clearendtime)),true);?>
                <input type="submit" name="clearlog" value="清除日志" class="btn btn-danger" onclick="return confirm('确认要清除此时间段操作日志?')" />
	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
 
                </form>
                   </div>
            <?php  } ?>
 
    </div>
</form>



<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
 
