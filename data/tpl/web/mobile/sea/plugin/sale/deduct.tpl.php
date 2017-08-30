<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form id="dataform"    <?php if(cv('sale.deduct.save')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                抵扣设置
            </div>
            <div class="panel-body">
                    <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分抵扣</label>
                       <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sale.deduct.save')) { ?>
                           <label class="radio-inline">
                               <input type="radio" name="data[creditdeduct]" value='1' <?php  if($set['creditdeduct']==1) { ?>checked<?php  } ?> /> 开启
                           </label>
                           <label class="radio-inline">
                               <input type="radio" name="data[creditdeduct]" value='0' <?php  if(empty($set['creditdeduct'])) { ?>checked<?php  } ?> /> 关闭
                            </label>
                           <span class='help-block'>开启积分抵扣, 商品最多抵扣的数目需要在商品【营销设置】中单独设置</span>
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  if($set['creditdeduct']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div> 
                   <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分抵扣比例</label>
                       <div class="col-sm-5">
                                <?php if(cv('sale.deduct.save')) { ?> 
                           <div class='input-group'>
                                   <input type="hidden" name="data[credit]" value="1" class="form-control" />
                                   <span class='input-group-addon'>1个积分 抵扣</span>
                                   <input type="text" name="data[money]"  value="<?php  echo $set['money'];?>" class="form-control" />
                                   <span class='input-group-addon'>元</span>
                           </div>
                           <span class='help-block'>积分抵扣比例设置</span>
                             <?php  } else { ?>
                           <div class='form-control-static'><?php  echo $set['credit'];?>积分 抵扣 <?php  echo $set['money'];?> 元</div>
                           <?php  } ?>
                       </div>
                   </div>
                 <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">余额抵扣</label>
                       <div class="col-sm-9 col-xs-12">
                             <?php if(cv('sale.deduct.save')) { ?>
                           <label class="radio-inline">
                               <input type="radio" name="data[moneydeduct]" value='1' <?php  if($set['moneydeduct']==1) { ?>checked<?php  } ?> /> 开启
                           </label>
                           <label class="radio-inline">
                               <input type="radio" name="data[moneydeduct]" value='0' <?php  if(empty($set['moneydeduct'])) { ?>checked<?php  } ?> /> 关闭
                           </label>
                           <span class='help-block'>会员可以用余额+在线支付方式支付订单,商品最多抵扣的数目需要在商品【营销设置】中单独设置</span>
                            <?php  } else { ?>
                           <div class='form-control-static'><?php  if($set['moneydeduct']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div>
				
				       <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">余额是否可以抵扣运费</label>
                       <div class="col-sm-9 col-xs-12">
                             <?php if(cv('sale.deduct.save')) { ?>
                           <label class="radio-inline">
                               <input type="radio" name="data[dispatchnodeduct]" value='0' <?php  if($set['dispatchnodeduct']==0) { ?>checked<?php  } ?> /> 可以
                           </label>
                           <label class="radio-inline">
                               <input type="radio" name="data[dispatchnodeduct]" value='1' <?php  if($set['dispatchnodeduct']==1) { ?>checked<?php  } ?> /> 不可以
                           </label>
                           <span class='help-block'>会员使用余额抵扣时，能不能抵扣运费</span>
                            <?php  } else { ?>
                           <div class='form-control-static'><?php  if($set['dispatchnodeduct']==1) { ?>不可以<?php  } else { ?>可以<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div>
				
				
                   <?php if(cv('sale.deduct.save')) { ?>
                <div class="form-group"></div>
                   <div class="form-group">
                           <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                           <div class="col-sm-9 col-xs-12">
                                 <input type="submit" name="submit"  value="保存设置" class="btn btn-primary"/>
                                 <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                           </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
