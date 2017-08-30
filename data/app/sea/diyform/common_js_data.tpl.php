<?php defined('IN_IA') or exit('Access Denied');?> 


<?php  $i=0;?>
<?php  if(is_array($fields)) { foreach($fields as $k1 => $v1) { ?>

<?php  if($v1['tp_must'] == 1) { ?>
    <?php  if(($v1['data_type'] == 0 || $v1['data_type'] == 1)) { ?>
        if( $('#field_data<?php  echo $i?>').isEmpty()){
            core.tip.show('请输入<?php  echo $v1['tp_name']?>!');
            return;
        }
        <?php  if(($v1['data_type'] == 0 && $v1['tp_is_default'] == 3)) { ?>
            if( !$('#field_data<?php  echo $i?>').isMobile()){
                core.tip.show('请输入正确的<?php  echo $v1['tp_name']?>!');
                return;
            }
        <?php  } ?>
    <?php  } ?>
	
    <?php  if($v1['data_type'] == 2) { ?>
        if( $('#field_data<?php  echo $i?>').isEmpty()){
            core.tip.show('请选择<?php  echo $v1['tp_name']?>!');
            return;
        }
    <?php  } ?>


    <?php  if($v1['data_type'] == 6) { ?>
		if( $('#field_data<?php  echo $i?>').isEmpty()){
			core.tip.show('请输入<?php  echo $v1['tp_name']?>!');
			return;
		}

		if(!$('#field_data<?php  echo $i?>').isIDCard())
		{
			core.tip.show('请输入正确的<?php  echo $v1['tp_name']?>!');
			return;
		}
    <?php  } ?>

    <?php  if($v1['data_type'] == 7) { ?>
        if( $('#field_data<?php  echo $i?>').isEmpty()){
            core.tip.show('请选择<?php  echo $v1['tp_name']?>!');
            return;
        }
    <?php  } ?>

	<?php  if($v1['data_type'] == 8) { ?>
			if( $('#field_data<?php  echo $i?>_0').isEmpty() || $('#field_data<?php  echo $i?>_1').isEmpty()){
				core.tip.show('请选择<?php  echo $v1['tp_name']?>!');
				return;
			}
	<?php  } ?>
<?php  } ?>


 <?php  if($v1['data_type'] == 6) { ?>
 
	if(!$('#field_data<?php  echo $i?>').isEmpty()){
	 
	     if(!$('#field_data<?php  echo $i?>').isIDCard()){
		core.tip.show('请输入正确的<?php  echo $v1['tp_name']?>!');
		return;
	     }
	}
    <?php  } ?>
	
<?php  if($v1['data_type'] == 3) { ?>
 
    var mycheck<?php  echo $i?> = [];
    var j = 0;
    $("input[name^='field_data<?php  echo $i?>[]']:checked").each(function(){
        mycheck<?php  echo $i?>.push( $(this).val() );
        j++;
    });
    <?php  if($v1['tp_must'] == 1) { ?>
        if (j == 0) {
            core.tip.show('请选择<?php  echo $v1['tp_name']?>!');
            return;
        }
    <?php  } ?>
	 
<?php  } ?>

<?php  if($v1['data_type'] == 5) { ?>
    var images<?php  echo $i?> = [];
    $('.img_info[data-ogid=<?php  echo $i?>]').find('.img').each(function(){
        images<?php  echo $i?>.push($(this).data('img'));
    });

    <?php  if($v1['tp_must'] == 1) { ?>
        if(images<?php  echo $i?>.length<=0){
            core.tip.show('请选择<?php  echo $v1['tp_name']?>!');
            return;
        }
    <?php  } ?>
<?php  } ?>

<?php  if($v1['data_type'] == 9) { ?>
    var citys<?php  echo $i?> = new Array();
    citys<?php  echo $i?>[0] = $('#sel-provance<?php  echo $i?>').val();
    citys<?php  echo $i?>[1] = $('#sel-city<?php  echo $i?>').val();

    <?php  if($v1['tp_must'] == 1) { ?>
        if(citys<?php  echo $i?>[0]=='请选择省份'){
        core.tip.show('请选择<?php  echo $v1['tp_name']?>!');
        return;
    }
    <?php  } ?>
<?php  } ?>


<?php  $i++;?>
<?php  } } ?>

var diydata = {
<?php  $i=0;?>
<?php  if(is_array($fields)) { foreach($fields as $k1 => $v1) { ?>
<?php  if($v1['data_type'] == 3) { ?>
'<?php  echo $k1?>': mycheck<?php  echo $i?>,
<?php  } else if($v1['data_type'] == 5) { ?>
'<?php  echo $k1?>': images<?php  echo $i?>,
<?php  } else if($v1['data_type'] == 8) { ?>
'<?php  echo $k1?>_0': $('#field_data<?php  echo $i?>_0').val(),'<?php  echo $i?>_1': $('#field_data<?php  echo $i?>_1').val(),
<?php  } else if($v1['data_type'] == 9) { ?>
'<?php  echo $k1?>': citys<?php  echo $i?>,
<?php  } else { ?>
'<?php  echo $k1?>': $('#field_data<?php  echo $i?>').val(),
<?php  } ?>
<?php  $i++;?>
<?php  } } ?>
<?php  if($data_load_flag == 1) { ?>
'agentid':"<?php  echo $_GPC['mid'];?>"
<?php  } ?>
};
