<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="sea" />
            <input type="hidden" name="do" value="plugin" />
            <input type="hidden" name="p" value="supplier" />
            <input type="hidden" name="method" value="supplier_for" />
                 <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">ID</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" class="form-control"  name="mid" value="<?php  echo $_GPC['mid'];?>"/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">姓名</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" class="form-control"  name="realname" value="<?php  echo $_GPC['realname'];?>" placeholder="可搜索昵称/姓名/手机号"/> 
                </div>
            </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-sm-7 col-lg-9 col-xs-12">
                       <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                       <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                       <?php if(cv('member.member.export')) { ?>   
                        <button type="submit" name="export1" value="1" class="btn btn-primary">导出 Excel</button>
                        <?php  } ?>
                       
                    </div>
               </div> 
          
            
            <div class="form-group">
            </div>
        </form>
    </div>
</div><div class="clearfix">

<div class="panel panel-default">
    <div class="panel-heading">总数：<?php  echo $total;?>   </div>
    <div class="panel-body">
        <table class="table table-hover" style="overflow:visible;">
            <thead class="navbar-inner">
                <tr>
                    <th style='width:80px;'>会员ID</th>
                    <th style='width:80px;'>会员姓名</th>             
                    <th style='width:120px;'>用户名</th>
                    <th style='width:120px;'>密码</th>
					<th style='width:120px;'>手机号码</th>
                    <th style='width:120px;'>微信</th>
                    <th style='width:120px;'>产品名称</th>
                    <th style='width:120px;'>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td><?php  echo $row['realname'];?></td>
                    <td><?php  echo $row['username'];?></td>
                    <td><?php  echo $row['password'];?></td>
                    <td><?php  echo $row['mobile'];?></td>
                    <td><?php  echo $row['weixin'];?></td>
                    <td><?php  echo $row['productname'];?></td>
                    <td><a class="label label-default " href="<?php  echo $this->createPluginWebUrl('supplier/supplier_for',array('op' => 'af_supplier', 'id' => $row['id'], 'status' => 1));?>">驳回审核</a><a class="label label-default label-info" href="<?php  echo $this->createPluginWebUrl('supplier/supplier_for',array('op' => 'af_supplier', 'id' => $row['id'], 'status' => 2));?>">审核通过</a></td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
           <?php  echo $pager;?>
    </div>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>