<?php defined('IN_IA') or exit('Access Denied');?>  <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">提供商家</label>
                        <div class="col-sm-9 col-xs-12">
                                <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <input type='text' class='form-control' name='subtitle' value="<?php  echo $item['subtitle'];?>" />
                             <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $item['subtitle'];?></div>
                             <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家介绍</label>
                        <div class="col-sm-9 col-xs-12">
                                 <?php if( ce('creditshop.goods' ,$item) ) { ?>
                             <?php  echo tpl_ueditor('subdetail',$item['subdetail'])?>
                             <?php  } else { ?>
                                <textarea id='subdetail' style='display:none'><?php  echo $item['subdetail'];?></textarea>
                            <a href='javascript:preview_html("#subdetail")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
                        </div>
                    </div>
                
                