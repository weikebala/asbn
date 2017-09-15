<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                        <div class="col-sm-9 col-xs-12">
                             <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name='status' value="0" <?php  if(empty($item['status'])) { ?>checked<?php  } ?> /> 暂停
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name='status' value="1" <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 开启
                            </label>
                                <?php  } else { ?>
                             <div class='form-control-static'><?php  if(empty($item['type'])) { ?>暂停<?php  } else { ?>开启<?php  } ?></div>
                             <?php  } ?>
                        </div>
                    </div>
                
                   <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
                        <div class="col-sm-9 col-xs-12">
                             <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name='type' value="0" <?php  if(empty($item['type'])) { ?>checked<?php  } ?> /> 兑换
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name='type' value="1" <?php  if($item['type']==1) { ?>checked<?php  } ?> /> 抽奖
                            </label>
                                <?php  } else { ?>
                             <div class='form-control-static'><?php  if(empty($item['type'])) { ?>兑换<?php  } else { ?>抽奖<?php  } ?></div>
                             <?php  } ?>
                        </div>
                    </div>
                 
                  <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动范围说明</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <input type='text' class='form-control' name='area' value="<?php  echo $item['area'];?>" />
                             <span class='help-block'>不填写默认"全国"</span>
                             <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['area'];?></div>
                             <?php  } ?>
                        </div>
                    </div>
        <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">运费</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <input type='text' class='form-control' name='dispatch' value="<?php  echo $item['dispatch'];?>" />
                             <span class='help-block'>线下兑换无需运费，全国统一运费，如不填写，则为包邮</span>
                             <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['dispatch'];?>元</div>
                             <?php  } ?>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">参与数限制</label>
                        <div class="col-sm-6">
                             <?php if( ce('creditshop.goods' ,$item) ) { ?>
                                  <div class="input-group">
                                   <span class="input-group-addon">每人每天</span>
                             <input type='text' class='form-control' value="<?php  echo $item['chanceday'];?>" name='chanceday' />
                              <span class="input-group-addon">次 每人共</span>
                              <input type='text' class='form-control' value="<?php  echo $item['chance'];?>" name='chance' />
                              <span class="input-group-addon">次</span>
                             </div>
                              <span class="help-block">空为不限制</span>
                              <?php  } else { ?>
                             <div class='form-control-static'>每人<?php  if($item['chance']==-1) { ?>无限<?php  } else { ?><?php  echo $item['chance'];?><?php  } ?>次机会</div>
                             <?php  } ?>
                        </div>
                   </div>
                      <div class="form-group">
                      <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品数限制</label> 
                          <div class="col-sm-6">
                                  <div class="input-group">
                            <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <span class="input-group-addon">每天提供</span>
                              <input type='text' class='form-control' value="<?php  echo $item['totalday'];?>" name="totalday" />
                              <span class="input-group-addon">份 总共</span>
                              <input type='text' class='form-control' value="<?php  echo $item['total'];?>" name="total" />
                              <span class="input-group-addon">份</span>
                              
                             </div>
                                <span class="help-block">空为不限制</span>
                                                           <?php  } else { ?>
                             <div class='form-control-static'>总共<?php  if($item['total']==-1) { ?>无限<?php  } else { ?><?php  echo $item['total'];?><?php  } ?>次机会</div>
                             <?php  } ?>
                        </div>
        
                  </div>
                  <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">消耗</label>
                        <div class="col-sm-6">
                              <?php if( ce('creditshop.goods' ,$item) ) { ?>
                            <div class="input-group">
                                <span class="input-group-addon">消耗</span>
                             <input type='text' class='form-control' value="<?php  echo $item['credit'];?>" name='credit'/>
                             <span class="input-group-addon">积分 + 花费</span>
                                <input type='text' class='form-control' value="<?php  echo $item['money'];?>" name='money'/>
                              <span class="input-group-addon">元&nbsp;&nbsp;
                                  <label class="checkbox-inline" style='margin-top:-8px;'>
                                    <input type="checkbox" name='usecredit2' value="1" <?php  if($item['usecredit2']==1) { ?>checked<?php  } ?> /> 优先使用余额支付
                                </label>
                              </span></div>
                              <span class="help-block">可任意组合，可以单独积分兑换，单独现金兑换，或者积分+现金形式兑换</span>
                                                       <?php  } else { ?>
                             <div class='form-control-static'>消耗 <?php  echo $item['credit'];?> 积分 花费 <?php  echo $item['money'];?> 元现金</div>
                             <?php  } ?>
                             </div>
                         
                    </div>
                
                   <div class="form-group" id='rate' style="<?php  if(empty($item['type'])) { ?>display:none<?php  } ?>">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">抽奖中奖概率</label>
                        <div class="col-sm-3">
                              <?php if( ce('creditshop.goods' ,$item) ) { ?>
                                  <div class="input-group">
                             <input type='text' class='form-control' value="<?php  echo $item['rate2'];?>" name='rate2' />
                              <span class="input-group-addon">分之</span>
                              <input type='text' class='form-control' value="<?php  echo $item['rate1'];?>" name='rate1'/>
                             </div>
                              <span class="help-block">同时填写才能生效，否则为中奖几率为0 ,填写相同值（且不等于0）为中奖率100%</span>
                              <?php  } else { ?>
                              <div class='form-control-static'>
                                  <?php  if(!empty($item['rate1']) && !empty($item['rate2'])) { ?>
                                        <?php  if($item['rate1']==$item['rate2']) { ?>
                                          必中
                                        <?php  } else { ?>
                                        <?php  echo $item['rate2'];?>分之<?php  echo $item['rate1'];?>
                                        <?php  } ?>
                                     <?php  } else { ?>
                                     永不中奖
                                     <?php  } ?>
                              </div>
                              <?php  } ?>
                        </div>
                   </div>
       <div class="form-group" >
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">使用有效期至</label>
                        <div class="col-sm-9 col-xs-12">
                             <?php if( ce('creditshop.goods' ,$item) ) { ?>
                                   <label class="checkbox-inline">
                                    <input type="checkbox" name='isendtime' value="1" <?php  if($item['isendtime']==1) { ?>checked<?php  } ?> /> 限时兑换
                                </label>
                                 <?php  echo tpl_form_field_date('endtime', $endtime,true)?>
                                <?php  } else { ?>
                             <div class='form-control-static'>
                                 <?php  if(empty($item['isendtime'])) { ?>
                                 无时间显示
                                 <?php  } else { ?>
                                 兑换之日起至<?php  echo $endtime;?>有效
                                 <?php  } ?>
                             </div>
                             <?php  } ?>
                        </div>
                    </div>
                  <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">兑换流程</label>
                        <div class="col-sm-9 col-xs-12">
                                 <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <?php  echo tpl_ueditor('detail',$item['detail'],array('height'=>200))?>
                             <?php  } else { ?>
                                <textarea id='detail' style='display:none'><?php  echo $item['detail'];?></textarea>
                            <a href='javascript:preview_html("#detail")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
                        </div>
                    </div>

    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">注意事项</label>
                        <div class="col-sm-9 col-xs-12">
                                 <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <?php  echo tpl_ueditor('noticedetail',$item['noticedetail'],array('height'=>200))?>
                             <?php  } else { ?>
                                <textarea id='noticedetail' style='display:none'><?php  echo $item['noticedetail'];?></textarea>
                            <a href='javascript:preview_html("#noticedetail")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
                        </div>
                    </div>

<script language='javascript'>
$(function(){
    
    $(':radio[name=type]').click(function(){
        
        if($(this).val()=='1'){
            $('#rate').show();
        }
        else{
            $('#rate').hide();
        }
        
    })
    
})    
</script>