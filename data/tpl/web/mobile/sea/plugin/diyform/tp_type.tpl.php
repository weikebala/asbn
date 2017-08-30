<?php defined('IN_IA') or exit('Access Denied');?><div id="tp_item<?php  echo $kw?>" class="panel panel-default spec_item">
    <div class="panel-body">
        <input type="hidden" value="<?php  echo $data_type?>" class="form-control" name="tp_type[<?php  echo $kw?>]">


        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span><?php  echo $data_type_config[$data_type]?>名称</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" placeholder="" value="<?php  if($flag=1 && $data_type==6) { ?>身份证<?php  } else { ?><?php  echo $v1['tp_name']?><?php  } ?>" class="form-control spec_title tp_name" name="tp_name[<?php  echo $kw?>]" maxlength="5" style="width:100px;display:inline;">&nbsp;&nbsp;
                <input type="checkbox" name="tp_must[<?php  echo $kw?>]" value="1" <?php  if($v1['tp_must']==1) { ?>checked<?php  } ?>> 必填&nbsp;&nbsp;&nbsp;

                <?php  if($data_type==0) { ?>
                设置默认值&nbsp;
                <select id="tp_is_default<?php  echo $kw?>" name="tp_is_default[<?php  echo $kw?>]" onchange="tp_change_default('<?php  echo $kw?>')" class="form-control tp_is_default" style="width:90px;display:inline;">
                    <?php  if(is_array($default_data_config)) { foreach($default_data_config as $key => $value) { ?>
                    <option value="<?php  echo $key;?>" <?php  if($v1['tp_is_default']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                    <?php  } } ?>
                </select>

                <input type="text" id="tp_default<?php  echo $kw?>" placeholder="请输入自定义默认值" value="<?php  echo $v1['tp_default']?>"
                       class="form-control spec_title tp_default" name="tp_default[<?php  echo $kw?>]"
                       style="width:200px;display:<?php  if($v1['tp_is_default']==1) { ?>inline<?php  } else { ?>none<?php  } ?>;">

                <?php  } else if($data_type==5) { ?>

                最大数量
	      <select name="tp_max[<?php  echo $kw?>]" class="form-control" style="width:167px;display:inline;">
	 
                         <option value="1" <?php  if($v1['tp_max']==1 || !$v1['tp_max']) { ?>selected<?php  } ?>>1</option>
						 <option value="2" <?php  if($v1['tp_max']==1) { ?>selected<?php  } ?>>2</option>
						 <option value="3" <?php  if($v1['tp_max']==1) { ?>selected<?php  } ?>>3</option>
						 <option value="4" <?php  if($v1['tp_max']==1) { ?>selected<?php  } ?>>4</option>
						 <option value="5" <?php  if($v1['tp_max']==1) { ?>selected<?php  } ?>>5</option>
                
                </select>
             
                <?php  } else if($data_type==7) { ?>

                设置默认日期
                <select id="default_time_type<?php  echo $kw?>" name="default_time_type[<?php  echo $kw?>]" onchange="tp_change_default_time(this,'default_time<?php  echo $kw?>')" class="form-control" style="width:167px;display:inline;">
                    <?php  if(is_array($default_date_config)) { foreach($default_date_config as $key => $value) { ?>
                    <option value="<?php  echo $key;?>" <?php  if($v1['default_time_type']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                    <?php  } } ?>
                </select>
                <input type="text" id="default_time<?php  echo $kw?>" name="default_time[<?php  echo $kw?>]" placeholder="" value="<?php  if(!empty($v1['default_time'])) { ?><?php  echo $v1['default_time']?><?php  } ?>" class="datetimepicker form-control spec_title" style="width:120px;display: <?php  if($v1['default_time_type']==2) { ?>inline<?php  } else { ?>none<?php  } ?>;">

                <?php  } ?>

                <a onclick="removeType(this)" class="btn btn-danger" href="javascript:void(0);" style="margin-left: 40px;"><i class="fa fa-plus"></i> 删除字段</a>

            </div>
        </div>

        <?php  if(($data_type==2) || ($data_type==3)) { ?>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">选项</label>

            <div class="col-sm-9 col-xs-12">
                <textarea class="form-control" name="tp_text[<?php  echo $kw?>]" placeholder="一行一个选项" style="width: 400px;height: 120px;"><?php  if(!empty($v1['tp_text'])) { ?><?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?><?php  echo $v2."\n";?><?php  } } ?><?php  } ?></textarea>
            </div>
        </div>
        <?php  } else if($data_type==8) { ?>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                &nbsp;设置默认起始日期&nbsp;
                <select id="default_btime_type<?php  echo $kw?>" name="default_btime_type[<?php  echo $kw?>]" onchange="tp_change_default_time(this,'default_btime<?php  echo $kw?>')" class="form-control" style="width:167px;display:inline;">
                    <?php  if(is_array($default_date_config)) { foreach($default_date_config as $key => $value) { ?>
                    <option value="<?php  echo $key;?>" <?php  if($v1['default_btime_type']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                    <?php  } } ?>
                </select>
                <input type="text" id="default_btime<?php  echo $kw?>" name="default_btime[<?php  echo $kw?>]" placeholder="" value="<?php  if(!empty($v1['default_etime'])) { ?><?php  echo $v1['default_btime']?><?php  } ?>" class="datetimepicker form-control spec_title" style="width:120px;display:<?php  if($v1['default_btime_type']==2) { ?>inline<?php  } else { ?>none<?php  } ?>;margin-right: 25px;">


                &nbsp;&nbsp;&nbsp;设置默认结束日期&nbsp;
                <select id="default_etime_type<?php  echo $kw?>" name="default_etime_type[<?php  echo $kw?>]" onchange="tp_change_default_time(this,'default_etime<?php  echo $kw?>')" class="form-control" style="width:167px;display:inline;">
                    <?php  if(is_array($default_date_config)) { foreach($default_date_config as $key => $value) { ?>
                    <option value="<?php  echo $key;?>" <?php  if($v1['default_etime_type']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                    <?php  } } ?>
                </select>
                <input type="text" id="default_etime<?php  echo $kw?>" name="default_etime[<?php  echo $kw?>]" placeholder="" value="<?php  if(!empty($v1['default_etime'])) { ?><?php  echo $v1['default_etime']?><?php  } ?>" class="datetimepicker form-control spec_title" style="width:120px;display:<?php  if($v1['default_etime_type']==2) { ?>inline<?php  } else { ?>none<?php  } ?>;">

            </div>
        </div>

        <?php  } ?>

    </div>
</div>




    