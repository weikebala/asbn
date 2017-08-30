<?php defined('IN_IA') or exit('Access Denied');?> <div class="diyform_main">
    <?php  $i=0;?>
    <?php  if(is_array($fields)) { foreach($fields as $k1 => $v1) { ?>
    <div class="dline <?php  if($v1['data_type'] == 1 || $v1['data_type'] == 3) { ?>dline1<?php  } ?>" <?php  if($i==count($fields)-1) { ?>style='border:none'<?php  } ?>>
        <div class="dtitle"><?php  echo $v1['tp_name']?></div>
        <div class='dinfo' >
            <div class='dinner  <?php  if($v1['tp_must'] == 1) { ?>must<?php  } ?>'>

            <?php  if($v1['data_type'] == 0) { ?>

                <input type="text" id='field_data<?php  echo $i?>' name='field_data<?php  echo $i?>' placeholder="请输入<?php  echo $v1['tp_name'];?>"  value="<?php  echo $f_data[$k1]?>" />
            <?php  } else if($v1['data_type'] == 1) { ?>
                <textarea class="" id='field_data<?php  echo $i?>' name='field_data<?php  echo $i?>' placeholder="请输入<?php  echo $v1['tp_name'];?>" ><?php  echo $f_data[$k1]?></textarea>

            <?php  } else if($v1['data_type'] == 2) { ?>
                <select id='field_data<?php  echo $i?>' name='field_data<?php  echo $i?>' class="select">
		<option value=''>请选择<?php  echo $v1['tp_name'];?></option>
                    <?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?>
                    <option value="<?php  echo $v2?>" <?php  if($f_data[$k1] == $v2) { ?>selected<?php  } ?>><?php  echo $v2?></option>
                    <?php  } } ?>
                </select>

            <?php  } else if($v1['data_type'] == 3) { ?>
                <?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?>
				<label class="checkbox-indline">
                <input type="checkbox" name='field_data<?php  echo $i?>[]' <?php  if(is_array($f_data[$k1]) &&  in_array($v2, $f_data[$k1])) { ?>checked<?php  } ?> value="<?php  echo $v2?>"/> <?php  echo $v2?>
				</label>
                <?php  } } ?>

            <?php  } else if($v1['data_type'] == 5) { ?>
                <?php  $img_max=$v1['tp_max'];?>
                
                        <div class="pic img_info" data-ogid='<?php  echo $i?>' data-max='<?php  echo $img_max?>'>
                          
                            <div class="images">
                                <?php  if(!empty($f_data[$k1])) { ?>
                                <?php  if(is_array($f_data[$k1])) { foreach($f_data[$k1] as $k2 => $v2) { ?>
                                <div data-img="<?php  echo $v2?>" class="img">
                                    <img src="<?php  echo tomedia($v2)?>">

                                    <div class="minus minus_del">
                                        <i class="fa fa-minus-circle"></i>
                                    </div>
                                </div>
                                <?php  } } ?>
                                <?php  } ?>
                            </div>
		        <div class="plus" style="position:relative;<?php  if(!empty($f_data[$k1])) { ?><?php  if($img_max == count($f_data[$k1])) { ?>display:none;<?php  } ?><?php  } ?>" ><i class="fa fa-plus" style="position:absolute;"></i>
                                <input type="file" name='imgFile<?php  echo $i?>' id='imgFile<?php  echo $i?>'  style="position:absolute;width:30px;height:30px;-webkit-tap-highlight-color: transparent;filter:alpha(Opacity=0); opacity: 0;" />
		        </div>
                        </div>
               

            <?php  } else if($v1['data_type'] == 6) { ?>
            <input type="text" id='field_data<?php  echo $i?>' name='field_data<?php  echo $i?>' placeholder="请输入<?php  echo $v1['tp_name'];?>" maxlength="18" value="<?php  echo $f_data[$k1]?>" />

            <?php  } else if($v1['data_type'] == 7) { ?>
                <input type="text" id="field_data<?php  echo $i?>" name='field_data<?php  echo $i?>' placeholder="请输入<?php  echo $v1['tp_name'];?>"  readonly value='<?php  if(!empty($f_data[$k1])) { ?><?php  echo $f_data[$k1]?><?php  } ?>'/>

            <?php  } else if($v1['data_type'] == 8) { ?>
 
                <input type="text" class="short" id="field_data<?php  echo $i?>_0" name='field_data<?php  echo $i?>' placeholder="开始日期" readonly value='<?php  if(!empty($f_data[$k1]['0'])) { ?><?php  echo $f_data[$k1]['0']?><?php  } ?>'/>
                <div style="float:left;margin:0 10px;line-height:40px;height:40px;">-</div>
                <input type="text" class="short" id="field_data<?php  echo $i?>_1" name='field_data<?php  echo $i?>' placeholder="结束日期" readonly value='<?php  if(!empty($f_data[$k1]['1'])) { ?><?php  echo $f_data[$k1]['1']?><?php  } ?>'/>

                <?php  } else if($v1['data_type'] == 9) { ?>
                <select id="sel-provance<?php  echo $i?>" onChange="selectCity(<?php  echo $i?>);" class="select">
                    <option value="" selected="true">省/直辖市</option>
                </select>
                <select id="sel-city<?php  echo $i?>" onChange="selectcounty(0,<?php  echo $i?>)" class="select">
                    <option value="" selected="true">请选择</option>
                </select>
                <select id="sel-area<?php  echo $i?>" class="select" style="display:none">
                    <option value="" selected="true">请选择</option>
                </select>
            <?php  } ?>


            </div>
        </div>
    </div>


    <?php  $i++;?>
    <?php  } } ?>

    </div>