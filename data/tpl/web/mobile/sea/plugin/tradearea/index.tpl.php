<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>

<script type="text/javascript" src="../addons/sea/plugin/tradearea/template/static/js/cascade.js"></script>

<ul class="nav nav-tabs">
    <li <?php  if($_GPC['method']=='index' || $_GPC['method']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('tradearea',array('method'=>'index'))?>" style="cursor: pointer;">商圈</a></li>
    <?php if(cv('article.page.add')) { ?>
        <li <?php  if($_GPC['method']=='deliver') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('tradearea',array('method'=>'deliver'))?>" style="cursor: pointer;">配送员</a></li>
    <?php  } ?>
    <li <?php  if($_GPC['method']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('tradearea',array('method'=>'set'))?>" style="cursor: pointer;">基础设置</a></li>
</ul>
<?php  if($operation == 'display') { ?>

<form action="" method="post" onsubmit="return formcheck(this)">
     <div class='panel panel-default'>
            <div class='panel-heading'>
                商圈列表
            </div>
         <div class='panel-body'>

            <table class="table">
                <thead>
                    <tr>
                        <th class='col-sm-1'>商圈ID</th>
                        <th>商圈名称</th>
                        <th class='col-sm-2'>省/市/区</th>
                        <th class='col-sm-2'>商圈</th>
                        <th>配送员</th>
                        <th>添加时间</th>
                        <th>修改时间</th>
                        <th>添加人</th>
                        <th>是否开启</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['id'];?></td>
                        <td><?php  echo $row['tradearea_name'];?></td>
                        <td><?php  echo $row['province'];?>/<?php  echo $row['city'];?>/<?php  echo $row['district'];?></td>
                        <td><?php  echo $row['area'];?></td>
                        <td><?php  echo $row['deliver'];?></td>
                        <td><?php  echo date('Y/m/d',$row['addtime'])?></td>
                        <td><?php  echo date('Y/m/d',$row['edittime'])?></td>
                        <td><?php  echo $row['operator'];?></td>
                        <td>
                            <?php  if($row['status']==1) { ?>
                            <span class="label label-success">开启</span>
                            <?php  } else if($row['status']==0) { ?>
                            <span class="label label-warning">关闭</span>
                            <?php  } ?>
                        </td>
                        <td>
                            <a class='btn btn-default' data-target="#add_tradearea<?php  echo $row['id'];?>" data-toggle="modal" onclick="edit_area(<?php  echo $row['id'];?>);" title="编辑"><i class='fa fa-edit'></i></a>
                            <a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('tradearea', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删吗？');return false;" title='删除'><i class='fa fa-remove'></i></a>
                        </td>


                        <div class="modal fade" id="add_tradearea<?php  echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel<?php  echo $row['id'];?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ModalLabel<?php  echo $row['id'];?>">编辑商圈</h4>
                            </div>
                            <form method="post" action="<?php  echo $this->createPluginWebUrl('tradearea',array('op'=>'edit'))?>">
                                <div class="modal-body">
                                <input type="hidden" type="hidden" name="op" value="edit">
                                <input type="hidden" name="id" value="<?php  echo $row['id'];?>">
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">商圈-名称:</label>
                                        <input type="text" name="tradearea_name" class="form-control" value="<?php  echo $row['tradearea_name'];?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">商圈-省市区:</label>
                                        <p class="form-control-static ad2" id="e_address">
                                            <select id="edit_province<?php  echo $row['id'];?>" name="province" onChange="selectCity('edit_province<?php  echo $row['id'];?>','edit_city<?php  echo $row['id'];?>','edit_area<?php  echo $row['id'];?>');" class="select form-control" style="width: 30%; display:inline;">
                                                <option value="" selected="true">省/直辖市</option>
                                            </select>
                                            <select id="edit_city<?php  echo $row['id'];?>" name="city" onChange="selectcounty(0,'edit_province<?php  echo $row['id'];?>','edit_city<?php  echo $row['id'];?>','edit_area<?php  echo $row['id'];?>');" class="select form-control" style="width: 30%; display:inline;">
                                                <option value="" selected="true">请选择</option>
                                            </select>
                                            <select id="edit_area<?php  echo $row['id'];?>" name="district"  class="select form-control" style="width: 30%; display:inline;">
                                                <option value="" selected="true">请选择</option>
                                            </select>
                                        </p>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">商圈-具体区域(全区域):</label>
                                        <input type="text" name="area" class="form-control"  value="<?php  echo $row['area'];?>" required>  
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">商圈-配送员:</label>
                                        <select name="deliver_id" multiple class="form-control">
                                            <?php  if(is_array($deliver_list)) { foreach($deliver_list as $ro) { ?>
                                            <option value="<?php  echo $ro['id'];?>" <?php  if($ro['id']==$row['deliver_id']) { ?> selected="selected" <?php  } ?> ><?php  echo $ro['name'];?></option>
                                            <?php  } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label col-sm-2">开启状态:</label>
                                        <label class='radio-inline'><input type='radio' name='status' value='1' <?php  if($row['status']==1) { ?> checked="" <?php  } ?> /> 开启</label>
                                        <label class='radio-inline'><input type='radio' name='status' value='0' <?php  if($row['status']==0) { ?> checked="" <?php  } ?>/> 关闭</label> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    <button type="submit" class="btn btn-primary">提交保存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                    </tr>
                 <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $pager;?>
  
         </div>
           <div class='panel-footer'>
                <a class='btn btn-default' onclick="add_area();" data-target='#add_tradearea' data-toggle="modal"><i class="fa fa-plus"></i> 添加商圈</a>
         </div>
     </div>
       </form>


       <div class="modal fade" id="add_tradearea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">添加商圈</h4>
            </div>
            <form method="post" action="<?php  echo $this->createPluginWebUrl('tradearea',array('op'=>'add'))?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">商圈-名称:</label>
                        <input type="text" name="tradearea_name" class="form-control" id="recipient-name" placeholder='给商圈起个具体的名字' required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">商圈-省市区:</label>
                        <p class="form-control-static ad2" id="e_address">
                            <select id="add_province" name="province" onChange="selectCity('add_province','add_city','add_area');" class="select form-control" style="width: 30%; display:inline;">
                                <option value="" selected="true">省/直辖市</option>
                            </select>
                            <select id="add_city" name="city" onChange="selectcounty(0,'add_province','add_city','add_area');" class="select form-control" style="width: 30%; display:inline;">
                                <option value="" selected="true">请选择</option>
                            </select>
                            <select id="add_area" name="district"  class="select form-control" style="width: 30%; display:inline;">
                                <option value="" selected="true">请选择</option>
                            </select>
  
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">商圈-具体区域(全区域):</label>
                        <input type="text" name="area" class="form-control" id="recipient-name" value="" placeholder='具体商圈(某某街道)' required>  
                    </div>
                    <div class="form-group">
                    <label for="recipient-name" class="control-label">商圈-配送员:</label>
                        <select name="deliver_id" multiple class="form-control">
                        <?php  if(is_array($deliver_list)) { foreach($deliver_list as $row) { ?>
                          <option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
                        <?php  } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label col-sm-2">开启状态:</label>
                        <label class='radio-inline'><input type='radio' name='status' value='1'/> 开启</label>
                        <label class='radio-inline'><input type='radio' name='status' value='0' checked="" /> 关闭</label> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    function add_area(){
        cascdeInit('','','','add_province','add_city','add_area');
    }



    function edit_area(id){
        $.ajax({
            url: "<?php  echo $this->createPluginWebUrl('tradearea/index',array('op'=>'tradearea'))?>",
            dataType: "json",
            type: 'post',
            data: {id:id},
            success:function(json){
                if (json.status == 1) {
                cascdeInit(json.result.province,json.result.city,json.result.district,'edit_province'+id,'edit_city'+id,'edit_area'+id);
                }
                
            }
        });
    }

</script>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
